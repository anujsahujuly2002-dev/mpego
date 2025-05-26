<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\LogoutRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $logoutRepository;

    public function __construct()
    {
        $this->logoutRepository = New LogoutRepository;
    }
    public function dashboard () {
        return view('admin.dashboard');   
    }

    public function logout(Request $request){
        $logout = $this->logoutRepository->logout($request);
        return redirect()->route('admin.login')->with('success',"Your account has been logged out successfully.");
    }
}   
