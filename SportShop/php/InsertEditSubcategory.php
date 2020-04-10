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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>InsertEdit Category </title>
    <link rel="icon" href="images/logo-sports-shop-v1.gif" >
     <link id="stylesheet" type="text/css" href="css/<?php echo $style ?>.css" rel="stylesheet">
    <script src="js/modernizr-custom.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/date.js"></script>
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

<?php
    require_once("classes/DBConnect.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $conn = $DB->connect();

    if(isset($_POST["submit"])){
        if (isset($_POST["subcategoryId"]) && strlen($_POST["subcategoryId"]) > 0) {
            $sql = "update subcategory set SubcategoryName=:SubcategoryName, Active=:Active where SubcategoryId=:subcategoryId";
                try {
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(":SubcategoryName" , $_POST["SubcategoryName"], PDO::PARAM_INT);
                    $stmt->bindValue(":Active" , isset( $_POST["active"]) && $_POST["active"] == 'on' ? 1 : 0, PDO::PARAM_BOOL);
                    $stmt->bindValue(":subcategoryId" , $_POST["subcategoryId"], PDO::PARAM_INT);
                    $stmt->execute();
                }
                catch (PDOException $e){
                    echo "Query failed: " . $e->getMessage();
                    }    
         
                echo "<p class='success'>Subcategory Updated </p>";  
        } else {
            insertForm($conn);
        }
    } else {
        if (isset($_GET["subcategoryId"]) && strlen($_GET["subcategoryId"]) > 0){
            $sql = "select SubcategoryName, Active from subcategory where SubcategoryId=:subcategoryId";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":subcategoryId" , $_GET["subcategoryId"], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
        }
    }
    

    function insertForm($conn){
        if(isset($_POST["SubcategoryName"]) && strlen($_POST["SubcategoryName"]) > 0){
            $sql = "insert into subcategory (SubcategoryName) values (:SubcategoryName)";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":SubcategoryName" , $_POST["SubcategoryName"], PDO::PARAM_STR);
                $stmt->execute();
            } 
            catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }

            echo "<p class='success'>Subcategory Added </p>";  
        }

        else {
            echo "<p class='errorLog'> Please supply the Subcategory name </p>";
        }
    }

    $DB->disconnect();

?> 



	<form action="InsertEditSubcategory.php" method="post">
    <fieldset>
        <p class="center">
			<label class="lableTheme" for="SubcategoryName">Subcategory Name</label>
			<input type="text" name="SubcategoryName" id="SubcategoryName" value="<?php echo isset($result) ? $result['SubcategoryName']: '' ?>">
            <br><br>
            <label class="activeline lableTheme" for="SubcategoryActive">Active</label>
            <input type="checkbox" name="active" <?php echo (isset($result) && $result["Active"])? "checked" : "" ?>>
            <input type="hidden" name="subcategoryId" value="<?php echo isset($_GET["subcategoryId"]) ? $_GET["subcategoryId"]: '' ?>">
		</p>

        <p class="center">
		<input class="submit" type="submit" name="submit" id="" value="Insert">
		</p>
    </fieldset>    
	</form>
</div>   
 
<div class="wrapper">
<a href="AdminMenu.php"><p class="back">Back to Administrative menu</p></a>
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
</body>
</html>
