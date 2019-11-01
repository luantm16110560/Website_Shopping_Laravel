<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
       
        if($request->hasFile('file'))
        {
           
           
            $myDate = Carbon\Carbon::now()->toDateString();

            $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";

            $myFile=$request->file->getClientOriginalName();

            $filename =$myDate."_".$myTime."_".$myFile;

            //echo $filename;
           $request->file->storeAs('image/slide',$filename); 
       

            DB::table('slides')->insert(
                ['image' => $filename, 'status'=>1]
            );
        
        }
 
     
    }
}
