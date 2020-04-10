
<?php 
    if(!empty($_COOKIE['style'])) $style = $_COOKIE['style'];
    else $style = 'style';

    require_once("classes/DBConnect.php");
    require_once("classes/ShoppingCart.php");
    require_once("classes/CartItem.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $DB->connect();
   
    $subcategorySql = "SELECT * FROM subcategory Where Active = 1";
    $subcategoryRows = $DB->executeSQL($subcategorySql)->fetchAll();

    session_start();
    $shoppingCart = new ShoppingCart();
    $shoppingCart->readFromSession();

    require_once 'classes/Auth.php';
    if (isset($_POST["password_change"]) ) {
        $passwordChanged = false;
        if (Auth::checkPassword($_SESSION['username'], $_POST["currentPassword"]) == 1 ) {
            if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
                Auth::changePassword($_SESSION['username'], $_POST["newPassword"]);
                $message = "Password successfully changed";
                $passwordChanged = true;
            } else {
                $message = "Password doesn't match";
            }
        } else {
            $message = "Current password is incorrect";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Customize user interface</title>
    <link rel="icon" href="images/logo-sports-shop-v1.gif" >
    <link id="stylesheet" type="text/css" href="css/<?php echo $style ?>.css" rel="stylesheet">
    <script src="js/modernizr-custom.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/date.js"></script>
    <script src="js/styleswitcher.jquery.js"></script>
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

<section id="content">
<div class="wrapper">
		<form>
			<fieldset>
        	<legend class="LegendAdmin">Administrative menu</legend>
	        	<ul class="MenuAdmin">
	        		<li class="adminList"><a href="MaintainSubcategory.php">Maintain subcategories</a></li>
		            <li class="adminList"><a href="MaintainItem.php">Maintain items</a></li>
		            <li class="adminList"><a href="Customize.php">Customize user interface</a></li>
		        </ul>
	        </fieldset>
		</form>


    <h2 class="hTheme">Change themes</h2>
        <table id="style-switcher" class="themeTabel">
            <tr>
                <th class="themeTH" colspan="3" scope="col">Themes</th>
            </tr>
            <tr>
                <td class="themeTD" id="style"> <a href="style-switcher.php?style=style">Original</a></td>
                <td class="themeTD" id="styleBlue"> <a href="style-switcher.php?style=styleBlue">Blue </a></td>
                <td class="themeTD" id="styleDark"> <a href="style-switcher.php?style=styleDark">Dark</a></td>     
            </tr>

        </table> 
        <br>
        <br>

    <?php if(isset($message)):?>
        <p class="<?php echo $passwordChanged ? 'success' : 'errorLog' ?>"><?php echo $message ?></p>
    <?php endif ?>


    <h2 class="hTheme">Change password</h2>
    <form action="Customize.php" method="post">
        
        <p>
            <label class="changePas" for="currentPassword">Current password</label>
            <input type="text" name="currentPassword" id="currentPassword">
        </p>
        <p>
            <label class="changePas" for="newPassword">New password</label>
            <input type="text" name="newPassword" id="newPassword">
        </p>
        <p>
            <label class="changePas" for="confirmPassword">Confirm password</label>
            <input type="text" name="confirmPassword" id="confirmPassword">
        </p>
        
        <p>
            <input class="submit" type="submit" name="password_change" id="password_change" value="Change">
        </p>
    </form>
    <br>
    <br>       
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
            <li><a href="Logout.php">Logout</a></li>
        </ul>
        <div id="datetime"></div>
    </nav>
</footer>

        <script type="text/javascript">
            $('#style-switcher a').styleSwitcher();
        </script>

</body>
</html>