<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registrasi_customer()
    {
        $data['title'] = 'Registrasi Customer';
        return view('auth/registrasi_customer');
    }

    public function registrasi_customer_action(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:6', 'max:30'],
            'username' => ['required', 'unique:users,username', 'alpha_dash', 'min:6', 'max:10'],
            'email' => ['required', 'unique:users,email'],
            'nik' => ['required', 'unique:users,nik', 'digits:16', 'numeric'],
            'nomor_telepon' => ['required', 'unique:users,nomor_telepon', 'regex:/^08.*$/i', 'min_digits:11', 'max_digits:13', 'numeric'],
            'tanggal_lahir' => ['required', 'date_format:m/d/Y'],
            'password' => ['required', 'min:6', 'max:12'],
            'password_confirm' => ['required', 'same:password'],
        ]);

        $formatted = DateTime::createFromFormat('m/d/Y', str_replace('-', '/', $request->tanggal_lahir))->format('Y-m-d');

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $formatted,
            'nik' => $request->nik,
            'nomor_telepon' => $request->nomor_telepon,
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
        $request->validate([
            'name' => ['required', 'min:6', 'max:30'],
            'username' => ['required', 'unique:users,username', 'alpha_dash', 'min:6', 'max:10'],
            'email' => ['required', 'unique:users,email'],
            'jenis_kendaraan' => ['required', 'not_regex:/Kendaraan/i'],
            'nomor_polisi' => ['required', 'unique:drivers,nomor_polisi'],
            'nik' => ['required', 'unique:users,nik', 'digits:16', 'numeric'],
            'nomor_telepon' => ['required', 'unique:users,nomor_telepon', 'regex:/^08.*$/i', 'min_digits:11', 'max_digits:13', 'numeric'],
            'tanggal_lahir' => ['required', 'date_format:m/d/Y'],
            'password' => ['required', 'min:6', 'max:12'],
            'password_confirm' => ['required', 'same:password'],
        ]);

        $formatted = DateTime::createFromFormat('m/d/Y', str_replace('-', '/', $request->tanggal_lahir))->format('Y-m-d');

        $driver = new Driver([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
        ]);
        $driver->save();

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $formatted,
            'nik' => $request->nik,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
            'is_driver' => true,
            'driver_id' => $driver->id,
        ]);
        $user->save();

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
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect('dashboard-admin');
            } elseif ($user->is_driver) {
                return redirect('dashboard-driver');
            } elseif ($user->is_customer) {
                return redirect('dashboard-customer');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Username dan/atau Password Salah.',
            'password' => 'Username dan/atau Password Salah.',
        ]);
    }

    public function ganti_password()
    {
        return view('auth/ganti_password', [
            'account' => Auth::user(),
        ], );
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
        return back()->with('success', 'Password Berhasil Diganti!');
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
        if ($user) {
            return view('home', ['users' => $user, 'title' => 'Home'], );
        } else {
            // return redirect('home');
            // return redirect()->route('/');
            return view('home');
        }
    }

    public function home()
    {
        $user = Auth::user();
        if ($user) {
            return view('home', ['users' => $user, 'title' => 'Home'], );
        }
        return redirect('/');
    }
}
