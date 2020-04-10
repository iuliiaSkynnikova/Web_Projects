<?php
class CartItem{
	private $_itemName;
	private $_quantity;
	private $_price;
	private $_itemId;
	private $_size;
 
	public function __construct($itemName, $quantity, $_size, $price, $itemId){
		$this->_itemName = $itemName;
		$this->_quantity = (int)$quantity;
		$this->_size = $_size;
		$this->_price = (float)$price;
		$this->_itemId = (int)$itemId;
	}


	public function getQuantity(){
	 	return $this->_quantity;
	}

	public function setQuantity($value){
		$this->_quantity = (int)$value;
	}
	 
	public function getPrice(){
		return $this->_price;
	}

	public function getItemId(){
	 	return $this->_itemId;
	}

	public function getItemName(){
	 	return $this->_itemName;
	}
	public function getTotal(){
		return $this->_quantity * $this->_price;
	}
	public function getSize(){
		return $this->_size;
	}
}

?>