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
    <title>Maintain Category</title>
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

       
        <p class="newbutton"> <a href="InsertEditSubcategory.php">Add New</a></p>
            


        <table class="adminTabel">


            <tr>
                <th class="adminTH">Category ID</th>
                <th class="adminTH">Category Name</th>
                <th class="adminTH">Active</th>
                <th class="adminTH">Edit</th>
                <th class="adminTH">Delete</th>
            </tr>
<?php
    
    require_once("classes/DBConnect.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $conn = $DB->connect();

      
    if (isset($_GET["subcategoryId"])){
        $sql = "delete from subcategory where SubcategoryId=:subcategoryId";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":subcategoryId" , $_GET["subcategoryId"], PDO::PARAM_INT);
                $stmt->execute();
            }
            catch (PDOException $e){
                if ($e->getCode() == 23000) {
                    echo "<p class='errorLog'>Can not delete category because it contains products</p>";

                    $SubcategoryId = $_GET["subcategoryId"];
                }    
            } 
    }


    $sql = "SELECT * FROM subcategory";
    try {
        $rows = $DB->executeSQL($sql);
        foreach ($rows as $row) {
?>  
        <tr>
                <td class="adminTD"><?php echo $row["SubcategoryId"]?></td>
                <td class="adminTD"><?php echo $row["SubcategoryName"]?></td>
                <td class="adminTD"><input type="checkbox" <?php echo ($row["Active"])? "checked" : "" ?> disabled></td>
                <td class="adminTD center"><a class="linkEdit" href="InsertEditSubcategory.php?subcategoryId=<?php echo $row["SubcategoryId"] ?>">Edit</a></td>
                <td class="adminTD center"><a class="linkDelete" href="MaintainSubcategory.php?subcategoryId=<?php echo $row["SubcategoryId"] ?>" >Delete</a></td>
            </tr> 

<?php                                                                 
        } 
    }
    catch(PDOException $e){
    echo "Query failed:" . $e->getMessage();
    } 

?>        
        </table>


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