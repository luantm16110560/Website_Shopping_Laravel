<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
@if($reviews->count()==0)
Chưa có mô tả cho sản phẩm này
@endif

<div class="container pb-cmnt-container" >
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div>
            @foreach($reviews as $review )
            <strong>{{$review->name}} </strong> 
            @if($review->rate==5)
            @for($i=0;$i< $review->rate ;$i++)  
            <img style="width: 10px;height: 10px;" src="{{asset('')}}source/image/icon/star.ico">
             @endfor
         
             @else
             @for($i=0;$i< $review->rate ;$i++)  
             <img style="width: 10px;height: 10px;" src="{{asset('')}}source/image/icon/star.ico">
             @endfor
             @for($i=0;$i<5- $review->rate ;$i++)  
                <img style="width: 10px;height: 10px;" src="{{asset('')}}source/image/icon/star_black.ico">
             @endfor
            @endif
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    
<script language="javascript">
    function deleteReview(id)
    {
        $.ajax({
            
        
                          url: '/product/delete_review/'+id,
                          type: 'get',
                     
                        success: function (data) {
                            window.location.reload();
                        }
        });
    }
</script>
            <br>
            {{$review->content}} 
            @if(Auth::check() && Auth::user()->id == $review->id_user)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span  onclick="deleteReview({{$data}})"   style="font-size: 12px" ><u style="color: blue;cursor: pointer;">Xóa</u></span> 
            @endif
           
            <br>
            <br>
            @endforeach 
            </div>
            <div class="row">{{$reviews->links()}}</div>
            @if(Auth::check())
            <div class="panel panel-info">
              

                <div class="panel-body">
                  
                    <form name="review" class="form-inline" onsubmit="return validateForm()" method="POST" action="{{route('up_review')}}">
                        <textarea placeholder="Đánh giá của bạn" class="pb-cmnt-textarea" id="content" name="content"></textarea>
                      @csrf
                      <div class="txt-center">
                        <div class="rating">
                            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                            <label for="star5" >☆</label>
                            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                            <label for="star4" >☆</label>
                            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                            <label for="star3" >☆</label>
                            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                            <label for="star2" >☆</label>
                            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                            <label for="star1" >☆</label>
                            <div class="clear"></div>
                        </div>
                        <input type="hidden" name='id_product' value="{{$data}}">
                        <button onclick="check()" type="submit" class="btn btn-primary" type="button">Đăng</button>
                        <script type="text/javascript">
                            function validateForm() {
                              var rate = document.forms["review"]["star"].value;
                         
                              if (rate == null || rate == "") {
                                alert("Bạn chưa chọn ☆ đánh giá ");
                                return false;
                              }
                            }
                          </script>
                    </div>
                  
                   
                    </form>
                </div>
            </div>
            @else
                Hãy <a target="_parent" href="/login"> đăng nhập</a>  để có thể đánh giá sản phẩm nhé
            @endif
        </div>
    </div>
</div>

<style>
    .pb-cmnt-container {
        font-family: Lato;
        margin-top: 100px;
    }

    .pb-cmnt-textarea {
        resize: none;
        padding: 20px;
        height: 130px;
        width: 100%;
        border: 1px solid #BCE8F1;
    }
    .txt-center {
  text-align: center;
}
.hide {
  display: none;
}

.clear {
  float: none;
  clear: both;
}

.rating {
    width: 90px;
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
}

.rating > label {
    float: right;
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.1em;
    cursor: pointer;
    color: #000;
}

.rating > label:hover,
.rating > label:hover ~ label,
.rating > input.radio-btn:checked ~ label {
    color: transparent;
}

.rating > label:hover:before,
.rating > label:hover ~ label:before,
.rating > input.radio-btn:checked ~ label:before,
.rating > input.radio-btn:checked ~ label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #FFD700;
}

</style>

