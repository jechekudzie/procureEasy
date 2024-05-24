<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //index
    public function index()
    {
        return redirect( )->route('admin.organisation-types.index');
    }
}
