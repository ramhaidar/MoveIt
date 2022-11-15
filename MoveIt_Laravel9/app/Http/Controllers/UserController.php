<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registrasi_customer()
    {
        $data['title'] = 'Registrasi Customer';
        // return view('auth/registrasi_customer', $data);
        return view('auth/registrasi_customer');
    }

    public function registrasi_customer_action(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'nik' => 'required|unique:users,nik',
            'tanggal_lahir' => 'required',
            'password' => ['required','min:6','max:12'],
            'password_confirm' => 'required|same:password',
        ]);

        $step1 = $request->tanggal_lahir;
        $step2 = str_replace('-', '/', $step1);
        $step3 = DateTime::createFromFormat('d/m/Y', $step2);
        $formatted = $step3->format('Y-m-d');

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $formatted,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'is_customer' => true,
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi Sukses. Silahkan Login!');
    }

    public function registrasi_driver()
    {
        $data['title'] = 'Registrasi Driver';
        return view('auth/registrasi_driver', $data);
    }

    public function registrasi_driver_action(Request $request)
    {
        // dd($request->tanggal_lahir);
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'jenis_kendaraan' => ['required', 'not_regex:/Kendaraan/i'],
            'nomor_polisi' => 'required|unique:drivers,nomor_polisi',
            'nik' => 'required|unique:users,nik',
            'tanggal_lahir' => 'required',
            'password' => ['required','min:6','max:12'],
            'password_confirm' => 'required|same:password',
        ]);

        $step1 = $request->tanggal_lahir;
        $step2 = str_replace('-', '/', $step1);
        $step3 = DateTime::createFromFormat('d/m/Y', $step2);
        $formatted = $step3->format('Y-m-d');

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $formatted,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'is_driver' => true,
        ]);
        $user->save();

        // $buatID = User::where('name', $request->name)->get('user_id');

        $driver = new Driver([
            'driver_id' => $user->user_id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
        ]);

        $driver->save();

        return redirect()->route('login')->with('success', 'Registrasi Sukses. Silahkan Login!');
    }

    public function login()
    {
        $data['title'] = 'Login';
        return view('auth/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }

    public function ganti_password()
    {
        return view('auth/ganti_password');
    }

    public function ganti_password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function cek_login()
    {
        $user = Auth::user();
        if ($user)
        {
            return view('home', ['users' => $user, 'title' => 'Home'],);
        }
        else
        {
            return view('home');
        }
    }

    public function home()
    {
        $user = Auth::user();
        if ($user)
        {
            return view('home', ['users' => $user, 'title' => 'Home'],);
        }
    }
}
