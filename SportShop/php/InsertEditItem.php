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
    <title>InsertEdit Item </title>
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

    function saveFile($categoryId){
        if(!file_exists($_FILES['Photo']['tmp_name'])) {
            return null;
        }
        $target_dir = "images/";
        if($categoryId == 1){
            $target_dir = $target_dir . "Women/";
        }else if($categoryId == 2){
            $target_dir = $target_dir . "Men/";
        }else if($categoryId == 3){
            $target_dir = $target_dir . "Kids/";
        }

        $target_file = $target_dir . basename($_FILES["Photo"]["name"]);
        echo $target_dir;
        $uplodOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        echo $imageFileType;
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["Photo"]["tmp_name"]);
            if ($check !== false) {
                $uplodOk = 1;
            }
            else{
                echo "<p class='errorLog'>File is not a image.</p>";
                $uplodOk = 0;
            }

        }
        
        if (file_exists($target_file)) {
            echo "<p class='errorLog'>Sorry, file already exists.</p>";
            $uplodOk = 0;
            return basename( $_FILES["Photo"]["name"]);
        } 
        if ($_FILES["Photo"]["size"] > 500000) {
            echo "<p class='errorLog'>Sorry, file is too large.</p>";
            $uplodOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" ) {
            echo "<p class='errorLog'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
            $uplodOk = 0;
        }
        echo $uplodOk;
        if ($uplodOk == 0) {
            echo "<p class='errorLog'>Sorry, your file was not upload. </p>";
        }
        else{
            if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["Photo"]["name"]) . " has been uploaded.";
                return basename($_FILES["Photo"]["name"]);
            }
            else{
                echo "<p class='errorLog'>Sorry, there was an error uploading your file. </p>";
                return null;
            }
        }
    } 

    if(isset($_POST["submit"])){
        if (isset($_POST["ItemId"]) && strlen($_POST["ItemId"]) > 0) {
            $Photo = saveFile($_POST["CategoryId"]);
            $sql = "update item set ItemName=:ItemName, Description=:Description, Photo=:Photo, Price=:Price, CategoryId=:CategoryId, SubcategoryId=:SubcategoryId, Active=:Active where ItemId=:ItemId";
                try {
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(":ItemId" , $_POST["ItemId"], PDO::PARAM_INT);
                    $stmt->bindValue(":ItemName" , $_POST["ItemName"], PDO::PARAM_INT);
                    $stmt->bindValue(":Description" , $_POST["Description"], PDO::PARAM_STR);
                    $stmt->bindValue(":Photo" , $Photo, PDO::PARAM_STR);
                    $stmt->bindValue(":Price" , $_POST["Price"], PDO::PARAM_STR);
                    $stmt->bindValue(":CategoryId" , $_POST["CategoryId"], PDO::PARAM_INT);
                    $stmt->bindValue(":SubcategoryId" , $_POST["SubcategoryId"], PDO::PARAM_INT);
                    $stmt->bindValue(":Active" ,isset( $_POST["active"]) && $_POST["active"] == 'on' ? 1 : 0, PDO::PARAM_BOOL);
                    $stmt->execute();
                }
                catch (PDOException $e){
                    echo "Query failed: " . $e->getMessage();
                    }    
         
                echo "<p class='success'>Item Updated </p>";  
        } else {
            insertForm($conn);
        }
    } else {
        if (isset($_GET["ItemId"]) && strlen($_GET["ItemId"]) > 0){
            $sql = "select * from item where ItemId=:ItemId";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":ItemId" , $_GET["ItemId"], PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
        }
    }


    function insertForm($conn){
        $Photo = saveFile($_POST["CategoryId"]);
        if(isset($_POST["ItemName"]) && strlen($_POST["ItemName"]) > 0){
            $sql = "insert into item (ItemName, Description, Photo, Price, CategoryId, SubcategoryId, Active ) values (:ItemName, :Description, :Photo, :Price, :CategoryId, :SubcategoryId, :Active)";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":ItemName" , $_POST["ItemName"], PDO::PARAM_STR);
                $stmt->bindValue(":Description" , $_POST["Description"], PDO::PARAM_STR);
                $stmt->bindValue(":Photo" , $Photo, PDO::PARAM_STR);
                $stmt->bindValue(":Price" , $_POST["Price"], PDO::PARAM_STR);
                $stmt->bindValue(":CategoryId" , $_POST["CategoryId"], PDO::PARAM_INT);
                $stmt->bindValue(":SubcategoryId" , $_POST["SubcategoryId"], PDO::PARAM_INT);
                $stmt->bindValue(":Active" ,isset( $_POST["active"]) && $_POST["active"] == 'on' ? 1 : 0, PDO::PARAM_BOOL);
                $stmt->execute();
            } 
            catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }

            echo "<p class='success'>Item Added </p>";  
        }

        else {
            echo "<p class='errorLog'> Please supply all Item's information </p>";
        }
    }

    $DB->disconnect();

?> 



	<form action="InsertEditItem.php" method="post" enctype="multipart/form-data">
		<fieldset>
        <p class="center">
			<label class="lableTheme" for="ItemName">Item Name</label>
            <input type="hidden" name="ItemId" value="<?php echo isset($_GET["ItemId"]) ? $_GET["ItemId"]: '' ?>">
			<input type="text" name="ItemName" id="ItemName" value="<?php echo isset($result) ? $result['ItemName']: '' ?>">
        </p>
        <p class="center">
            <label class="lableTheme" for="Description">Description</label>
            <input type="text" name="Description" id="Description" value="<?php echo isset($result) ? $result['Description']: '' ?>">
        </p>
        <p>
            <label class="photoline lableTheme" for="Photo">Photo</label>
            <span><?php if(isset($result)) { 
                echo $result['Photo'];
            }?> 
            </span>    
           <input type="file" name="Photo" id="Photo"> 
            

        </p>
        <p class="center">
            <label class="lableTheme" for="Price">$ Price</label>
            <input type="text" name="Price" id="Price" value="<?php echo isset($result) ? $result['Price']: '' ?>">
        </p>
        <p class="center">
            <label class="lableTheme" for="CategoryId">Category</label>
            <select name="CategoryId" id="CategoryId">
            <?php
                $sql = "select CategoryId, CategoryName from category";
                try{
                    $rows = $conn->query($sql);
                foreach ($rows as $row) {
                    echo  "<option value=\"" . $row["CategoryId"] . "\">" . $row["CategoryName"] . "</option>"  ;
                }
                }
                catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }
            ?>
        </select>   
        </p>
        <p class="center">
            <label class="lableTheme" for="SubcategoryId">Subcategory</label>
            <select name="SubcategoryId" id="SubcategoryId">
            <?php
                $sql = "select SubcategoryId, SubcategoryName from subcategory";
                try{
                    $rows = $conn->query($sql);
                foreach ($rows as $row) {
                    echo  "<option value=\"" . $row["SubcategoryId"] . "\">" . $row["SubcategoryName"] . "</option>"  ;
                }
                }
                catch (PDOException $e) {
                echo "Query failed: " . $e->getMessage();
            }
            ?>
        </select>   
        </p>
        <p class="center">
            <label class="activeline lableTheme" for="SubcategoryActive">Active</label>
            <input type="checkbox" name="active" <?php echo (isset($result) && $result["Active"])? "checked" : "" ?>>
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
