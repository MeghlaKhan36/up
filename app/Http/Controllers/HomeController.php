<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('/home');
    }

    public function mail() {
        return view('pages.welcome');
    }

    public function recentFiles()
    {

        $files = File::where('file_status', '=', 'public')->orderBy('created_at', 'desc')->paginate(25);

        return view('pages.files')
            ->with('files', $files);
    }
}
