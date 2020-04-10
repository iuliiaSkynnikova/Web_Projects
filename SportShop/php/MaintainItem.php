<?php 
    if(!empty($_COOKIE['style'])) $style = $_COOKIE['style'];
    else $style = 'style';

    require_once("classes/DBConnect.php");
    require_once("classes/ShoppingCart.php");
    require_once("classes/CartItem.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $conn = $DB->connect();
       

    session_start();
    $shoppingCart = new ShoppingCart();
    $shoppingCart->readFromSession();

    $subcategorySql = "SELECT * FROM subcategory Where Active = 1";
    $subcategoryRows = $DB->executeSQL($subcategorySql)->fetchAll();
      
    $deleteResult = -1;
    if (isset($_GET["ItemId"])){
        $sql = "select count(*) from orderitem where ItemId = :ItemId";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':ItemId', $_GET["ItemId"], PDO::PARAM_INT);
        $statement->execute();
        $deleteResult = $statement->fetchColumn();
        if( $deleteResult == 0) {
            $sql = "delete from item where ItemId=:ItemId";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":ItemId" , $_GET["ItemId"], PDO::PARAM_INT);
                $stmt->execute();
            }
            catch (PDOException $e){
                echo "Query failed: " . $e->getMessage();
            } 
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Maintain Item</title>
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

<?php if( $deleteResult > 0) {?>
<section class="wrapper">
    <div class="errorLog">Item can't be deleted because it's used in one of the oreders</div>

</section>
<?php } ?>
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

       
        <p class="newbutton"> <a href="InsertEditItem.php">Add New</a></p>
            


        <table class="adminTabel">
            <tr>
                <th class="adminTH">Item ID</th>
                <th class="adminTH">Item Name</th>
                <th class="adminTH">Description</th>
                <th class="adminTH">Photo</th>
                <th class="adminTH">Price</th>
                <th class="adminTH">Category</th>
                <th class="adminTH">Subcategory</th>
                <th class="adminTH">Active</th>
                <th class="adminTH">Edit</th>
                <th class="adminTH">Delete</th>
            </tr>
<?php
    
    

    $sql = "SELECT ItemId, ItemName, Description, Photo, Price, CategoryName, SubcategoryName, item.Active FROM item, category, subcategory
     WHERE item.CategoryId = category.CategoryId  AND item.SubcategoryId = subcategory.SubcategoryId order by ItemId";

    try {
        $rows = $DB->executeSQL($sql);
        foreach ($rows as $row) {

?>  
        <tr>
                <td class="adminTD"><?php echo $row["ItemId"]?></td>
                <td class="adminTD"><?php echo $row["ItemName"]?></td>
                <td class="adminTD"><?php echo $row["Description"]?></td>
                <td class="adminTD"><?php echo $row["Photo"]?></td>
                <td class="adminTD"><?php echo $row["Price"]?>$</td>
                <td class="adminTD"><?php echo $row["CategoryName"]?></td>
                <td class="adminTD"><?php echo $row["SubcategoryName"]?></td>
                <td class="adminTD"><input type="checkbox" <?php echo ($row["Active"])? "checked" : "" ?> disabled></td>
                <td class="adminTD center"><a class="linkEdit" href="InsertEditItem.php?ItemId=<?php echo $row["ItemId"] ?>">Edit</a></td>
                <td class="adminTD center"><a class="linkDelete" href="MaintainItem.php?ItemId=<?php echo $row["ItemId"] ?>" >Delete</a></td>
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