<?php

namespace App\Http\Controllers\super_admin_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('templating.super-admin-view.index');
    }
}
