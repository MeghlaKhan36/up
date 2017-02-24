<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $files = File::where('file_status', '=', 'public')->orderBy('created_at', 'desc')->take(10)->get();

        return view('home')
            ->with('files', $files);
    }
}