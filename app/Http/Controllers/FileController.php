<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use App\File;
use Session;
use Storage;
use Gate;

class FileController extends Controller
{
    public function newFile(Request $request)
    {
        return view('pages.uploadfile');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'max:30',
            'file' => 'required|file|max:100024',
            'file_status' => 'required'
        ]);

        $file = $request->file('file');

        $randomStr = substr(md5(rand()), 0, 3);
        $fileOrgName = $request->file('file')->getClientOriginalName();

        /**
         * Encrypts the file
         * store encrypted file to encrypted folder
         * store path of encrypted file to db
         */
        if ( $request->input('enc_status') === 'encrypt' ) {
            $this->validate($request, [
                'enc_pass' => 'required|min:6'
            ]);

            $enc_pass = $request->input('enc_pass');
            $enc_status = $request->input('enc_status');
            $method = "AES-256-CBC";
            $iv_length = openssl_cipher_iv_length($method);
            $strong = false;
            $code = sha1(openssl_random_pseudo_bytes($iv_length, $strong));
            $iv = substr($code, 5, 16);

            $request->file('file')->move(
                base_path() . '/public/uploads/encrypted/', $randomStr . $fileOrgName
            );

            $path = base_path() . '/public/uploads/encrypted/' . $randomStr . $fileOrgName;

            $input = fopen($path, 'rb');
            $plaintext = fread($input, filesize($path));
            fclose($input);

            $output = fopen($path, 'w');
            $ciphertext = openssl_encrypt($plaintext, $method, $enc_pass, OPENSSL_RAW_DATA, $iv);
            fwrite($output, $ciphertext);

            fclose($output);

        } else {
            $enc_status = 0;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $randomStr . $fileOrgName
            );

            $path = public_path() . '/uploads/' . $randomStr . $fileOrgName;

            $file = $request->file('file');

            $enc_pass = 0;
            $iv = 0;
        }

        $file = new File(array(
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author_id' => Auth::user()->id,
            'filesize' => $file->getClientSize(),
            'path' => $path,
            'file_status' => $request->input('file_status'),
            'enc_status' => $enc_status,
            'enc_pass' => $enc_pass,
            'vector' => $iv,
            'org_name' => $fileOrgName
        ));

        $file->save();

        return redirect('/user/' . $file->user->id)->with(['status' => 'File added']);

    }

    public function updateFile($id)
    {
        $file = File::find($id);

        return view('pages.updatefile', compact('file'));
    }

    public function saveUpdatedFile(Request $request, $id)
    {
        $file = File::find($id);
        $user = Auth::user();

        $this->validate($request, [
            'title' => 'max:30',
            'description' => 'max:35',
        ]);


        $file_data = array(
            $file->title = $request->input('title'),
            $file->description = $request->input('description')
        );

        $file->update($file_data);

        return redirect('../user/' . $user->id)->with(['status' => 'File info updated']);
    }

    public function deleteFile($id)
    {
        $file = File::find($id);
        $user_id = $file->user->id;

        if (Gate::forUser(Auth::user())->allows('temper', $file)) {
            $file_path = $file->path;
            unlink($file_path);
            $file->delete();
        }

        return redirect('/user/' . $user_id)->with(['status' => 'File deleted']);
    }

    public function download(Request $request, $id)
    {
        $file = File::find($id);

        if ($file->enc_status === 'encrypt')
        {
            return view('pages.decryptfile', compact('file'));
        } else {
            return response()->download($file->path);
        }
    }

    /**
     * Copy encrypted file to decrypted folder
     * Decrypt the file
     * Delete decrypted file after download
     */
    public function decryptFile(Request $request, $id)
    {
        $file = File::find($id);

        $enc_path = $file->path;
        $file_name = $file->org_name;
        $iv = $file->vector;
        $method = "AES-256-CBC";
        $enc_pass = $request->input('enc_pass');
        $dest = 'public/decrypted/' . $file_name;

        if (!is_dir('public/decrypted/')) {
          mkdir('public/decrypted', 0777, true);
        }

        $output = fopen($dest, 'w');
        $input = fopen($enc_path, 'r');

        $ciphertext = fread($input, filesize($enc_path));
        $plaintext = openssl_decrypt($ciphertext, $method, $enc_pass, OPENSSL_RAW_DATA, $iv);

        fwrite($output, $plaintext);

        fclose($input);
        fclose($output);

        return response()->download($dest)->deleteFileAfterSend(true);
    }

}
