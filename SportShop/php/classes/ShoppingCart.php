<?php
require_once("CartItem.php");

class ShoppingCart{
	private $_cartItems = array();
	private $_shoppingOrderId;
	

public function count(){
	return count($this->_cartItems);
}

public function clear(){
	 $_cartItems = array();
	 unset($_SESSION['cart']);
	 session_write_close();
}

public function setShoppingOrderID($id){
	$this->_shoppingOrderId = (int)$id;
}

public function __construct(){
	 $this->_cartItems = array();
 }

public function getItems(){
	 return $this->_cartItems;
}
 
public function addItem($cartItem){
	$found = $this->inCart($cartItem);
  	if($found != null){
  		$this->updateItem($cartItem);
 	}
 	else{
 		$this->_cartItems[] = $cartItem;
 	}
}

public function updateItem($cartItem){
	 $index = $this->itemIndex($cartItem);
	 $this->_cartItems[$index]->setQuantity($this->_cartItems[$index]->getQuantity() +	$cartItem->getQuantity());
}
 
public function removeItem($itemId){
	for ($i=0; $i<$this->count(); $i++) {
		$item = $this->_cartItems[$i];
		if($item->getItemId() == (int)$itemId) {
			unset($this->_cartItems[$i]);
 		 	$this->_cartItems = array_values($this->_cartItems);
 		 	break;
		}
	}
}
 
public function calculateTotal(){
	 $total = 0.0;
	 foreach ($this->_cartItems as $item){
		 $total += $item->getTotal();
	 }	 
	 return $total;
 }

 public function saveToSession() {
	$_SESSION['cart'] = $this->_cartItems;
	session_write_close();
 }

 public function readFromSession() {
	if( isset($_SESSION['cart'])) {
		$this->_cartItems = $_SESSION['cart'];
	} else {
		$_SESSION['cart'] = $this->_cartItems;
		session_write_close();
	}
 }

 public function saveCart($Address, $ContactNumber, $CreditCardNumber, $CSV, $Email, $ExpiryDate, $FirstName, $LastName, $NameOnCard){
	$dsn = "mysql:host=localhost; dbname=sportgear";
	$username = "root";
	$password = "";
	try	{
		$conn = new PDO($dsn, $username, $password);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}

	$sql = "insert into customer(Address, ContactNumber, CreditCardNumber, CSV, Email,
	ExpiryDate, FirstName, LastName, NameOnCard) values (:Address, :ContactNumber,
	:CreditCardNumber, :CSV, :Email, :ExpiryDate, :FirstName, :LastName, :NameOnCard)";

	try {
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(":Address" , $Address, PDO::PARAM_STR);
		$stmt->bindValue(":ContactNumber" , $ContactNumber, PDO::PARAM_STR);
		$stmt->bindValue(":CreditCardNumber" , $CreditCardNumber, PDO::PARAM_STR);
		$stmt->bindValue(":CSV" , $CSV, PDO::PARAM_STR);
		$stmt->bindValue(":Email" , $Email, PDO::PARAM_STR);
		$stmt->bindValue(":ExpiryDate" , $ExpiryDate, PDO::PARAM_STR);
		$stmt->bindValue(":FirstName" , $FirstName, PDO::PARAM_STR);
		$stmt->bindValue(":LastName" , $LastName, PDO::PARAM_STR);
		$stmt->bindValue(":NameOnCard" , $NameOnCard, PDO::PARAM_STR);
		$stmt->execute();
	
		$sql = "select LAST_INSERT_ID()";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$customerID = $stmt->fetch();
	}
	catch (PDOException $e){
		echo "failed to add customer: " . $e->getMessage();
	}

	$sql = "insert into ordercustomer(CustomerId, OrderDate) values (:CustomerId, curdate())";

	try {
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(":CustomerId" , $customerID[0], PDO::PARAM_INT);
		$stmt->execute();
	
		$sql = "select LAST_INSERT_ID()";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$orderID = $stmt->fetch();
	}
	catch (PDOException $e){
		echo "failed to add an order: " . $e->getMessage();
	}

	foreach ($this->_cartItems as $item){
		$sql = "insert into orderitem(ItemID, Price, Quantity, OrderID) values(:ItemID,
		:Price, :Quantity, :OrderID)";
	 	try{
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(":ItemID" , $item->getItemId(), PDO::PARAM_INT);
			$stmt->bindValue(":Price" , $item->getPrice(), PDO::PARAM_STR);
			$stmt->bindValue(":Quantity" , $item->getQuantity(), PDO::PARAM_INT);
			$stmt->bindValue(":OrderID" , $orderID[0], PDO::PARAM_INT);
			$stmt->execute();
		}
		catch (PDOException $e){
			echo "failed to add items to the order: " . $e->getMessage();
		}
	}
	
	return $orderID[0];
}




private function inCart($cartItem){
	$found = null;
	foreach($this->_cartItems as $item) {
		if ($item->getItemId() == $cartItem->getItemId() ){
			$found = $item;
		}
	}
	return $found;
}



private function itemIndex($cartItem){
	$index = -1;
	for($i=0; $i<$this->count(); $i++){
		if($cartItem->getItemId() == $this->_cartItems[$i]->getItemId()){
			$index = $i;
		}
	}
	return $index;
 }
	 


public function displayArray(){
	print_r($this->_cartItems);
}
}

?>