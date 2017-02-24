<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\File;

class UserController extends Controller
{
    /**
     * Logout function
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function settings($id)
    {
        if ( $id == Auth::User()->id ) {
            return view('pages.UpdateProfile');
        } else {
            return redirect('/');
        }
    }

    public function profile($id) {

        $user = User::find($id);

        if ( Auth::user()->id == $id ) {

            $files = File::where('author_id', '=', $id)->orderBy('created_at', 'desc')->paginate(5);

        } else {

            $files = File::where('author_id', '=', $id)
                   ->where('file_status', '=', 'public')->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('userprofile')
             ->with('files', $files)
             ->with('user', $user);

    }

    public function updateProfile(Request $request, $id)
    {

        $this->validate($request, [
            'info' => 'max:255',
            'first_name' => 'max:35',
            'last_name' => 'max:35'
        ]);

        $user = User::find($id);

        if ($request->file('profile_picture') === null) {
            $path = $user->profile_picture;
        } else {
            $fileExtension = $request->file('profile_picture')->getClientOriginalExtension();
            $fileName = bin2hex(openssl_random_pseudo_bytes(7)) . '.' . $fileExtension;

            $request->file('profile_picture')->move(
                base_path() . '/public/images/user/', $fileName
            );

            $path = '/images/user/' . $fileName;

            $user->profile_picture = $path;
        }

        $user_data = array(
            $user->info = $request->input('info'),
            $user->profile_picture = $path,
            $user->first_name = $request->input('first_name'),
            $user->last_name = $request->input('last_name')
        );

        $user->update($user_data);

        return redirect('../settings/' . $user->id)->with(['status' => 'Profile updated']);
    }

    public function updateAccount(Request $request, $id)
    {
        $user = User::find($id);

        if ( $request->input('name') !== $user->name ) {
            $this->validate($request, [
                'name' => 'unique:users|max:20',
                'email' => 'required|max:35',
            ]);
        }

        $account_status = 'active';

        if ( $request->input('deactivate') ) {

            $account_status = $request->input('deactivate');

        }

        $account_data = array(
            $user->name = $request->input('name'),
            $user->email = $request->input('email'),
            $user->account_status = $account_status
        );

        $user->update($account_data);

        if ( $user->account_status === 0 ) {

        }

        return redirect('../settings/' . $user->id)->with(['status' => 'Account updated']);
    }
}
