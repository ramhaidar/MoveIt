<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Registrasi Customer';
        return view('auth/register', $data);
    }

    public function register_action(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'nik' => 'required|unique:users,nik',
            'tanggal_lahir' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $unformatted = $request->tanggal_lahir;
        $formatted = date("Y-m-d", strtotime($unformatted));

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

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }

    public function register_driver()
    {
        $data['title'] = 'Registrasi Customer';
        return view('auth/register_driver', $data);
    }

    public function register_driver_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'jenis_kendaraan' => 'required',
            'nomor_polisi' => 'required|unique:users,nomor_polisi',
            'nik' => 'required|unique:users,nik',
            'tanggal_lahir' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $unformatted = $request->tanggal_lahir;
        $formatted = date("Y-m-d", strtotime($unformatted));

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

        $driver = new Driver([
            'driver_id' => $user->id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
        ]);

        $driver->save();

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
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

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('auth/password', $data);
    }

    public function password_action(Request $request)
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
        return view('home', ['users' => $user, 'title' => 'Home'],);
    }
}
