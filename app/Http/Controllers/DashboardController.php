<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    public function showMenu()
    {
        return view('dashboard', Student::all());
    }

}
