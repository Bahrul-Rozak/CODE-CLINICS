<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClearDatabaseController extends Controller
{
    public function index(){
        return view('admin.backend.clear-database.index');
    }
}
