<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;

class UploadController extends Controller
{

    public function upload(Request $request){

        try {
            $success = true;
            $message = "File save done";



            $file = $request->file('file');
            // Safe Getting, some times Symphony doesn't retrieve an extension
            $original_name = $file->getClientOriginalName();
            $size = $file->getClientSize();
            $extension = pathinfo($original_name, PATHINFO_EXTENSION);
            $name = substr($original_name, 0, -(strlen($extension) + 1));
            $filename = implode('.', [time() .  random_int(1, 10000) . strtolower($name), $extension]);
            $file->move(public_path('fotos'), $filename);

            return compact('original_name', 'success','message');

        }catch ( Exception $e){
            $success = false;
            $message = $e->getMessage();
            return compact('success','message');
        }
    }



}
