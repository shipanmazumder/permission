<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class DashboardController extends Controller
{
     public function __construct() {
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"dashboard");
            Session::put('sub_menu',"dashboard");
            return $next($request);
        });
    }
    public function index()
    {
        // dd(session('top_menu'));
        return view("admin.dashboard.dashboard");
    }
}
