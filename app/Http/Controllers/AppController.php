<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function privacy()
    {
        return view('privacy-policy');
    }
}
