<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Carbon;
use Intervention\Image\ImageManagerStatic as Image;
class BannerController extends Controller
{
    public function getBanner()
    {
        $slides=Slide::where('status',1)->get();
        return view('page.manage.manage_banner')->with('slides',$slides);
    }
    public function postBanner(Request $req)
    {
     
        if($req->hasFile('imageInput'))// input type name=""
        {
            $myDate = Carbon\Carbon::now()->toDateString();
 
             $myTime =  Carbon\Carbon::now()->hour."h_".Carbon\Carbon::now()->minute."m_".Carbon\Carbon::now()->second."s";
 
             $myFile=$req->imageInput->getClientOriginalName(); //input type name=""
 
            $filename =$myDate."_".$myTime."_".$myFile;
            $slide = new Slide();
            $slide->image=$filename;
            $slide->status=1;
            $slide->save();


            $image= $req->file('imageInput');
            $image_resize = Image::make($image->getRealPath());
       
    
            $image_resize->save(public_path('source/image/banner/'.$filename));

            return back();
        }
  
    }
    public function deleteBanner(Request $req,$id_banner)
    {
        $slide = Slide::where('id',$id_banner);
        $slide->delete();
        return redirect()->back();
    }
}
