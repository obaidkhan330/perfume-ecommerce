<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
  public function index()
{
    $user= Auth::user();
    if($user->role !== 'admin'){
       return redirect('/')->with('error', 'Unauthorized Access!');
    }
    return view('admin.dashboard');
}
}
