<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        // $this->middleware('CheckAge');
        // $this->middleware('CheckAge')->only('index','show');
        // $this->middleware('CheckAge')->except('index');
    }

    public function index(){
        return view('demo.admin.index');
    }

    public function show(){
        return view('demo.admin.show');
    }

    public function add(){
        return view('demo.admin.add');
    }
}
