<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;
	public $totalPrice2 = 0;
	public $size=35;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
			$this->totalPrice2 = $oldCart->totalPrice2;
			$this->size=$oldCart->size;
		}
	}

	public function add($item, $id){
		$giohang = ['qty'=>0, 'price' => $item->unit_price,'price2' => $item->promotion_price, 'item' => $item,'size'=>$item->size];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$giohang['qty']++;

		$giohang['price'] = $item->unit_price * $giohang['qty'];
		$giohang['size']=$item->size;
		$giohang['price2'] = $item->promotion_price * $giohang['qty'];
		$this->items[$id] = $giohang;
		$this->totalQty++;
		if($item->promotion_price == 0)
		{
			$this->totalPrice += $item->unit_price;
			$this->totalPrice2 += $item->unit_price;
		}
		else
		{
			$this->totalPrice += $item->promotion_price;
			$this->totalPrice2 += $item->unit_price;
		}
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		// if($this->items[$id]['price2'] == 0)
		// {
		// 	$this->items[$id]['price'] -= $this->items[$id]['price'];
		// }
		// else
		// {
		// 	$this->items[$id]['price'] -= $this->items[$id]['price2'];
		// }
		$this->totalQty--;
		// $this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['price2'] == 0)
		{
			$this->totalPrice -= $this->items[$id]['price'];
		}
		else
		{
			$this->totalPrice -= $this->items[$id]['price2'];
		}
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		
		if($this->items[$id]['price2'] == 0)
		{
			$this->totalPrice -= $this->items[$id]['price'];
		}
		else
		{
			$this->totalPrice -= $this->items[$id]['price2'];
		}
		unset($this->items[$id]);
	}
}
