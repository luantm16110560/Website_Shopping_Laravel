<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   public function getIndex()
   {
       return view('page.trangchu');
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
