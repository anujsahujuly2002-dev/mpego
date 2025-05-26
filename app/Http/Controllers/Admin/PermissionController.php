<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index() {
        return view('admin.permission.index');
    }
    public function create() {
        return view('admin.permission.creare');
    }
}
