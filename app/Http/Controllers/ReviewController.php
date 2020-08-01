<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_Review;
use Auth;
class ReviewController extends Controller
{
    public function getReview(Request $req,$id_product)
    {
        $reviews=User_Review::where('id_product',$id_product)
        ->join('users','user_review.id_user','=','users.id')->paginate(5);
        $first_data=$id_product;

        return view('page.review')->with('reviews',$reviews)->with('data',$first_data);
    }
    public function postReview(Request $req)
    {
        $count =User_Review::where('id_user',Auth::user()->id)
        ->where('id_product',$req->id_product)->count();
      if($count==0)
      {
        $new_review= new User_Review();
        $new_review->id_user=Auth::user()->id;
        $new_review->content=$req->content;
        $new_review->rate=$req->star;
        $new_review->id_product=$req->id_product;
        $new_review->save();
        return redirect()->back();
      }
      else
      {
        $old_review =User_Review::where('id_user',Auth::user()->id)
        ->where('id_product',$req->id_product)->first();
        $old_review->content=$req->content;
        $old_review->rate=$req->star;
        $old_review->save();
        return redirect()->back();
      }
    }
    public function deleteReview(Request $req,$id_product)
    {
        //echo('cc');
        $review_want_delete=User_Review::where('id_product',$id_product)
        ->where('id_user',Auth::user()->id)->first();
        $review_want_delete->delete();
       // echo($review_want_delete);
    }
  
}
