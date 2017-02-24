<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\User;
use Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|min:3'
        ]);

        $searchQuery = $request->input('search');

        $users = User::where('name', '=', $searchQuery)
              ->orWhere('name', 'like', '%' . $searchQuery . '%')->get();

        if ( Auth::user() ) {

            $files = File::where('title', '=', $searchQuery)
                ->orWhere('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%')->get();

            return view('pages.searchresults')
                ->with('search', $searchQuery)
                ->with('users', $users)
                ->with('files', $files);

        } else {

            $files = File::where('title', 'like', '%' . $searchQuery . '%')
                ->where('file_status', '=', 'public')->get();

            return view('pages.searchresults')
                ->with('search', $searchQuery)
                ->with('users', $users)
                ->with('files', $files);
        }
    }
}
