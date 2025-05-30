<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Class DashboardController extends Controller
{
     public function index()
     {
        return view('dashboard');
     }
}