<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Type_Product;
use App\Product;
use GuzzleHttp\Client;
use DB;
class BotManController extends Controller
{
     /**
     * Place your BotMan logic here.
     */
 
   
    public $url,$gender,$type_id,$number;
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {

            $this->askName($botman);                
        });
  
        $botman->listen();
    }
  
  
    public function askName($botman)
    {
      
        $botman->ask('Tomshoe chào quý khách, Tên của quý khách là gì?  ', function(Answer $answer,$botman) {
  
            $name = $answer->getText();
        
            $this->say('Chào '.$name.' Bạn cần tư vấn gì? ');

            $question = Question::create(' ')
            ->fallback('Help')
            ->callbackId('error_help')
            ->addButtons([
                Button::create('Tư vấn sản phẩm')->value('Tư vấn sản phẩm'),
                Button::create('Tư vấn chọn size giày')->value('Tư vấn chọn size giày'),
                Button::create('Top sản phẩm')->value('Top sản phẩm'),
            ]);
    
        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) 
            {
              
                if($answer->getValue()=='Tư vấn sản phẩm')
                {
                    $question = Question::create('Giới tính của bạn là gì')
                    ->fallback('gender')
                    ->callbackId('gender_error')
                    ->addButtons([
                        Button::create('Nam')->value('Nam'),
                        Button::create('Nữ')->value('Nữ'),
                    ]);
            
                    $this->ask($question, function (Answer $answer) {
              
                        if ($answer->isInteractiveMessageReply()) 
                        {
                           
                            $answerGender = $answer->getValue();
                            if($answerGender=='Nam' || $answerGender=='Nữ')
                            {
                                $this->gender=$answerGender;
                               
    
                                $count=Type_Product::where('status','=',1)->count();
                                $question = Question::create(' ')
                                ->fallback('type_product')
                                ->callbackId('error_type_product');
                              
                                $type_product=Type_Product::where('status','=',1)->get();
                                //$this->say();
                                $this->say('Hiện tại TomShoe có '.$count.' mặt hàng, bạn quan tâm đến loại nào');
                                foreach($type_product as $type){
                           
                                $question->addButtons([
                                    Button::create($type->name)->value($type->id),
                                    ]);
                                
                                }
                                $this->ask($question, function (Answer $answer) {
                                    // Detect if button was clicked:
                                    if ($answer->isInteractiveMessageReply()) {
                                        $answer_id_type = $answer->getValue();
                                   
                                        $this->type_id=$answer_id_type;
    
                                        $product = Product::where('status',1)
                                        ->where('id_type',$this->type_id)
                                        ->where('gender',$this->gender)->first();
    
    
                                        if(is_null($product))
                                        {
                                            $this->say('Sản phẩm hiện tại chưa có');
                                        }
                                        else
                                        {
                                        $url='http://tomshoe.cc/'.$this->gender.'/'.$this->type_id;
                                
                                        $src='/source/image/product/'.$product->image;
                                        $img = "<img src='$src'> <br>";
    
                                        $a = "<a target='_top' href='${$url}' style='text-align:center' >Xem chi tiết </a>";
                                        
                                      
                                        // $this->say('');
                                        $style="height:300px; max-width: 100%;zoom: 0.9;";
                                        $iframe="<iframe src=".$url." style='${$style}' ></iframe>";
                                           
    
                                        $this->say('Dưới đây là sản phẩm bạn đang quan tâm'.'<br><br>'.$iframe.'<br><br>'.$a);
                                        }
                                     
                                    }
                                });
                               
                            }
                            
                       
                        }
                    });
                }
                if($answer->getValue()=='Tư vấn chọn size giày')
                {
                    $this->say('<b>Bước 1:</b> Đặt bàn chân ngay ngắn lên trên tờ giấy trắng,
                    đánh dấu điểm ở gót chân và điểm ở đầu ngón chân dài nhất');
                  
                    $img = "<img src='https://static.fado.vn/uploads/news/2014/07/30/Amazon247.VN_1406693061.238.jpg'> <br>";
                    $this->say($img);
                    $question = Question::create(' ')
                    ->fallback('')
                    ->callbackId('')
                    ->addButtons([
                        Button::create('Đã hoàn thành bước 1')->value('Đã hoàn thành bước 1')
                        
                    ]);
            
                    $this->ask($question, function (Answer $answer) {
              
                        if ($answer->isInteractiveMessageReply()) 
                        {
                            if($answer->getValue()=='Đã hoàn thành bước 1')
                            {
                                $this->say('<b>Bước 2:</b> Dùng thước đo khoảng cách giữa 2 điểm vừa đánh dấu');
                                $img = "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRAR7cyHZOfHzY_DcUMhSzelbvO0uIhUz2UFfImxgQ2fbfPI05U&usqp=CAU'> <br>";
                                $this->say($img);
                                $question = Question::create(' ')
                                ->fallback('')
                                ->callbackId('')
                                ->addButtons([
                                    Button::create('Đã hoàn thành bước 2')->value('Đã hoàn thành bước 2')
                                    
                                ]);
                                $this->ask($question, function (Answer $answer) {
              
                                    if ($answer->isInteractiveMessageReply()) 
                                    {
                                        if($answer->getValue()=='Đã hoàn thành bước 2')
                                        {
                                            $this->say('<b>Bước 3:</b>Trả lời câu hỏi');
                                            $this->say('Giới tính của bạn');
                                            $question = Question::create(' ')
                                            ->fallback(' ')
                                            ->callbackId(' ')
                                            ->addButtons([
                                                Button::create('Nam')->value('Nam'),
                                                Button::create('Nữ')->value('Nữ'),
                                            ]);
                                            $this->ask($question, function (Answer $answer) {
              
                                                if ($answer->isInteractiveMessageReply()) 
                                                {
                                                    if($answer->getValue()=='Nam')
                                                    {
                                                        $img = "<img style='max-width:120%' src='https://storage.googleapis.com/cdn.nhanh.vn/store/20446/artCT/60127/sizegiay_nam.jpg'> <br>";
                                                        $a = "<a target='_blank' href='https://thethaovip.com.vn/cach-do-chon-size-giay-va-bang-quy-doi-size-giay-chuan-n60127.html' style='text-align:center' >Xem chi tiết </a>";
                                                        $this->say($img.$a);
                                                        // $this->ask('Số bạn vừa đo là bao nhiêu cm', function(Answer $answer) {
                                                        //     $result=$answer->getText();
                                                        //     $jsonString = file_get_contents(base_path('public/source/file/male.json'));
                                                        //     $data = json_decode($jsonString, true);
                                                          
                                                        //     for($i=0; $i<count($data); $i++) 
                                                        //     {
                                                        //         if($data[$i]['cm']==$result)
                                                        //         {
                                                        //             $this->say('Size phù hợp với bạn là: '.'<b style="color:red">'.$data[$i]['size'].'</b>');
                                                        //             break;
                                                                  
                                                        //         } 
                                                        //         if($i==count($data)-1)
                                                        //         {
                                                        //             $question = Question::create('Xin lỗi chúng tôi không tìm được size ')
                                                        //             ->fallback('')
                                                        //             ->callbackId('')
                                                        //             ->addButtons([
                                                        //                 Button::create('Tại sao')->value('Tại sao') 
                                                        //             ]);
                                                        //             $this->ask($question, function (Answer $answer) {
              
                                                        //                 if ($answer->isInteractiveMessageReply()) 
                                                        //                 {
                                                        //                     if($answer->getValue()=='Tại sao')
                                                        //                     {
                                                        //                     //    $this->say($gender);
                                                                                
                                                                    
                                                        //                     }
                                                        //                 }
                                                        //             });
                                                        //         }
                                                        //     }
                                                           
                                                        // });
                                                    }
                                                    if($answer->getValue()=='Nữ')
                                                    {
                                                        $img = "<img style='max-width:120%' src='https://storage.googleapis.com/cdn.nhanh.vn/store/20446/artCT/60127/sizegiay_nu.jpg'> <br>";
                                                        $a = "<a target='_top' href='https://thethaovip.com.vn/cach-do-chon-size-giay-va-bang-quy-doi-size-giay-chuan-n60127.html' style='text-align:center' >Xem chi tiết </a>";
                                                        $this->say($img.$a);
                                                        // $this->ask('Số bạn vừa đo là bao nhiêu cm', function(Answer $answer) {
                                                        //     $result=$answer->getText();
                                                        //     $jsonString = file_get_contents(base_path('public/source/file/female.json'));
                                                        //     $data = json_decode($jsonString, true);
                                                          
                                                        //     for($i=0; $i<count($data); $i++) 
                                                        //     {
                                                        //         if($data[$i]['cm']==$result)
                                                        //         {
                                                        //             $this->say('Size phù hợp với bạn là: '.'<b style="color:red">'.$data[$i]['size'].'</b>');
                                                        //             break;
                                                                  
                                                        //         } 
                                                        //         if($i==count($data)-1)
                                                        //         {
                                            
                                                        //             $question = Question::create('Xin lỗi chúng tôi không tìm được size ')
                                                        //             ->fallback('')
                                                        //             ->callbackId('')
                                                        //             ->addButtons([
                                                        //                 Button::create('Tại sao')->value('Tại sao') 
                                                        //             ]);
                                                        //             $this->ask($question, function (Answer $answer) {
              
                                                        //                 if ($answer->isInteractiveMessageReply()) 
                                                        //                 {
                                                        //                     if($answer->getValue()=='Tại sao')
                                                        //                     {
                                                        //                     //    $this->say($gender);
                                                                             
                                                                    
                                                        //                     }
                                                        //                 }
                                                        //             });
                                                        //         }
                                                        //     }
                                                           
                                                        // });
                                                    }
                                                       
                                                }
                                            });
                                        }

                                    }
                                });

                            }
                        }
                    });
                }
                if($answer->getValue()=='Top sản phẩm')
                { 
                    $question = Question::create('Top sản phẩm')
                    ->fallback('')
                    ->callbackId('')
                    ->addButtons([
                        Button::create('Sản phẩm đang khuyến mãi')->value('Sản phẩm đang khuyến mãi'),
                        Button::create('Sản phẩm yêu thích nhất')->value('Sản phẩm yêu thích nhất'),
                       
                    ]);
                       
                    $this->ask($question, function (Answer $answer) {

                        
                      
                            if($answer->getValue()=='Sản phẩm đang khuyến mãi')
                            {
                                $product=Product::where('status',1)
                                ->where('promotion_price','<>',0)->get();
            
                                $count=Product::where('status',1)
                                ->where('promotion_price','<>',0)->count();
                                
                                $url='http://tomshoe.cc/sale';
                        
                                $a = "<a target='_top' href='${$url}' style='text-align:center' >Xem chi tiết </a>";
                            
                                $style="height:400px; max-width: 100%;zoom: 0.9;";
                                $iframe="<iframe src=".$url." style='${$style}' ></iframe>";
                                
            
                                $this->say('Hiện có '.$count.' sản phẩm đang khuyến mãi <br><br>'.$iframe.'<br><br>'.$a);
                            
                            }
                            if($answer->getValue()=='Sản phẩm yêu thích nhất')
                            {
                                   
                                $url='http://tomshoe.cc/best_like';
                        
                                $a = "<a target='_top' href='${$url}' style='text-align:center' >Xem chi tiết </a>";
                            
                                $style="height:400px; max-width: 100%;zoom: 0.9;";
                                $iframe="<iframe src=".$url." style='${$style}' ></iframe>";
                                $this->say('Top sản phẩm được yêu thích nhất'.'<br><br>'.$iframe.'<br><br>'.$a);
                            }
                    

                    });
                }
                
               

            }
        });
            
           
        });
      
    }
    
}
