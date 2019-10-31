<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function getIndex()
   {
       $slide = Slide::all();

        echo $slide;
       //return view('page.trangchu',compact('my_slide'));
       return view('page.trangchu')->with('my_slide',$slide);
   }
   public function getProductType()
   {
       return view('page.loai_sanpham');
   }
   public function getProductDetail()
   {
    return view('page.chitiet_sanpham');
   }
   public function getContact()
   {
       return view('page.lienhe');
   }
   public function getAbout()
   {
       return view('page.gioithieu');
   }
}
