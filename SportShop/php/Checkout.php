<?php
    
    require_once("classes/DBConnect.php");
    require_once("classes/ShoppingCart.php");
    require_once("classes/CartItem.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $DB->connect();
   
    $subcategorySql = "SELECT * FROM subcategory  Where Active = 1";
    $subcategoryRows = $DB->executeSQL($subcategorySql)->fetchAll();

    session_start();
    $shoppingCart = new ShoppingCart();
    $shoppingCart->readFromSession();

    $sessionUpdated = false;
    foreach ($_POST as $key => $value) {
        if($key != 'update') {
            foreach ($shoppingCart->getItems() as $item) {
                if($item->getItemId() == (int)$key) {
                    $item->setQuantity($value);
                    $sessionUpdated = true;
                }
            }
        }
    };
    if(isset($_GET["delete"])){
         $shoppingCart->removeItem($_GET["delete"]);
         $sessionUpdated = true;
    }
    if($sessionUpdated){
        $shoppingCart->saveToSession();
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="icon" href="images/logo-sports-shop-v1.gif" >
    <link rel="stylesheet" href="css/style.css">
    <script src="js/modernizr-custom.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/date.js"></script>
    <script src="js/validation.js"></script>
   
</head>
<body>
	<header >
    <div class="wrapper">
        <a href="HomePage.php"><img src="images/logo-sports-shop-v1.gif" width="108" height="83" alt="Sport Gear Logo"></a>
        <a class="shoppingBag" href="Checkout.php">
            <img src="images/red-shopping-bag-md.png" width="108" height="83" alt="Shopping bag image">
            <div id="checkout">
                <p> <?php echo $shoppingCart->count() ?> item/s</p>
                <p> $<?php echo $shoppingCart->calculateTotal() ?></p>
                <h5>CHECKOUT</h5>
            </div>
        </a>
        <form id="searchForm" action="ProductList.php" method="get" >
            <input class="searchText" type="text" name="search" id="search" placeholder="What are you looking for?">
            <input class="searchButton" type="submit" name="submitButton" value="Search">
        </form> 
    </div>
    <nav class="mainNave">
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li>
                <a href="ProductList.php?category=1">Sport for Women</a>
                <ul class="submenu">
                <?php foreach ($subcategoryRows as $scRow) { ?>
                    <li>
                        <a href="ProductList.php?category=1&subcategory=<?php echo $scRow["SubcategoryId"] ?>">
                            <?php echo $scRow["SubcategoryName"] ?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </li>
            <li><a href="ProductList.php?category=2">Sport for Men</a>
                <ul class="submenu">
                <?php foreach ($subcategoryRows as $scRow) { ?>
                    <li>
                        <a href="ProductList.php?category=2&subcategory=<?php echo $scRow["SubcategoryId"] ?>">
                            <?php echo $scRow["SubcategoryName"] ?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </li>
            <li><a href="ProductList.php?category=3">Sport for Kids</a>
                <ul class="submenu">
                <?php foreach ($subcategoryRows as $scRow) { ?>
                    <li>
                        <a href="ProductList.php?category=3&subcategory=<?php echo $scRow["SubcategoryId"] ?>">
                            <?php echo $scRow["SubcategoryName"] ?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </li>
            <li><a href="ContactUs.php">Contact us</a></li>
        </ul>
    </nav>
</header>

<section class="wrapper">

<h2 class="SCart">Review shopping cart</h2>
    <form action="Checkout.php" method="post" id="updateForm">
        <table class="SCartTabel">
            <tr>
                <th class="SCartTH" colspan="2" scope="col">Item</th>
                <th class="SCartTH">Price</th>
                <th class="SCartTH">Qty</th>
                <th class="SCartTH">Total</th>
                <th class="SCartTH"></th>
            </tr>
            <?php foreach ($shoppingCart->getItems() as $item) { ?>
            <tr>
                <td class="SCartTD">
                    <?php echo $item->getItemName()?>
                </td>
                <td class="SCartTD">size:<?php echo $item->getSize()?></td>
                <td class="SCartTD">$<?php echo $item->getPrice()?></td>
                <td class="SCartTD">
                    <input type="number" 
                           name="<?php echo $item->getItemId()?>" 
                           id="qty" 
                           value="<?php echo $item->getQuantity()?>">
                </td>
                <td class="SCartTD">$<?php echo $item->getTotal()?></td>
                <td class="SCartTD">
                    <p class="SCartbutton">
                        <a href="Checkout.php?delete=<?php echo $item->getItemId()?>">Delete</a>
                    </p>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="SCartTD tdTotal"><strong>Order Total: $<?php echo $shoppingCart->calculateTotal() ?></strong></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td> <p class="SCartbutton "><a href="#" onclick="document.getElementById('updateForm').submit(); return false;">Update</p></td>
                <td> <p class="SCartbutton "><a href="#" onclick="document.getElementById('hiddenForm').style.display='block'; return false;">Checkout</a></p></td>
            </tr>               
        </table>
    </form>

<div id="hiddenForm">
    <h2 class="SCart">Checkout</h2>
    <form id="checkoutForm"  action="HomePage.php" method="post">

        <fieldset>
        <legend>Contact information</legend>
            <p class="contact">
                <label for="firstname">First name:</label>
                <input type="text" id="firstname" name="firstname"  placeholder="John" required="" autofocus="" >
            </p>
            <p class="contact">
                <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname"   placeholder="Smith" required="" >
            </p>
            <p class="contact">
                <label for="address">Delivery address:</label>
                <input type="text" id="address" name="address"   placeholder="123 Main street, Anytown, NSW, 2200 " required="" >
            </p>
            <p class="contact">
                <label for="phone">Contact number:</label>
                <input type="text" name="phone" id="phone" placeholder="02 9988 7766" required="">
            </p>
            <p class="contact">
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" placeholder="john.smith@gmail.com" required="">
            </p>
            
        </fieldset>

        <fieldset>

        <legend>Payment</legend>
            <div class="card-wrapper"></div>
            <p class="contact">
                <label for="number">Creadit card number:</label>
                <input type="text" id="number" name="number" required="" autofocus="" >
            </p>
            <p class="contact">
                <label for="name">Name on credit card:</label>
                <input type="text" name="name" id="name" required="">
            </p>
            <p class="contact">
                <label for="expiry">Expiry date:</label>
                <input type="text" id="expiry" name="expiry"   placeholder="mm/yy" required="" >
            </p>
                <p class="contact">
                <label for="CVV">CVV:</label>
                <input type="text" name="cvc" id="cvc"  required="">
            </p>
             
        </fieldset>
        

            <p class="center">
                <input class="submit" type="submit" name="Pay" id="Pay" value="Pay">
            </p>
    </form>

    <script src="js/dist/jquery.card.js"></script>
    <script>
        $('#checkoutForm').card({
            container: '.card-wrapper',
            placeholders: {
                number: '**** **** **** ****',
                name: 'Jhon Smith',
                expiry: 'mm/yyyy',
                cvc: '***'
            }
        })
     </script>
</div>     

</section>   

<footer>
    <nav class="footerNav clearFix wrapper">
        <ul class="toright">
            <li><a href="https://www.facebook.com/" target="_blank"><img src="images/icon-facebook.png" width="20" height="20" alt="Facebook"></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><img src="images/icon-instagram.png" width="20" height="20" alt="Instagram"></a></li>
            <li><a href="https://twitter.com/" target="_blank"><img src="images/icon-twitter.png" width="20" height="20" alt="Twitter"></a></li>
        </ul>


        <ul class="toleft">
            <li>Copyright 2017 Sport Gear |</li>
            <li><a href="ContactUs.php">Contact us |</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
        <div id="datetime"></div>
    </nav>
</footer>
</body>
</html>