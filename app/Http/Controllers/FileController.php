<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon;
class FileController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }
    public function storeFile(request $request)
    {

        if($request->hasFile('file')) {

            $myDate = Carbon\Carbon::now()->toDateString();

            $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";
    
            $myFile=$request->file->getClientOriginalName();

            $filename =$myDate."_".$myTime."_".$myFile;
    



            $image       = $request->file('file');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(270, 320);
            $image_resize->save(public_path('source/image/slide/'.$filename));

            DB::table('slides')->insert(
                ['image' => $filename, 'status'=>1]
            );
         
         }
 
     
    }
}
