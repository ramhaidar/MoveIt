<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard/dashboard_admin', ['account' => $user, 'users' => User::all(), 'drivers' => Driver::all()],);
        }
    }

    public function driver()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            // $test = User::with('driver')->get()->where('is_driver', '1')->where('user_id', $userId)->all();
            $test = User::with('driver')->where('id', Auth::id())->get();
            // dd($test);
            return view('dashboard/dashboard_driver', ['account' => $user, 'test' => $test, 'accountId' => $userId, 'users' => User::all(), 'drivers' => Driver::all()],);
        }
    }

    public function customer()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard/dashboard_customer', ['account' => $user, 'accountId' => $userId, 'users' => User::all(), 'drivers' => Driver::all()],);
        }
    }
}
