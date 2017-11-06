<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index(){
        $tmp = [1,2,3];
        return view('admin.dashboard');
    }
}