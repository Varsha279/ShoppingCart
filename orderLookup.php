<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Page-Caliva</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
  </head>
  <body>
   
     <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Products & Deals</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li class="active"><a href="orderLookup.php">Order-Lookup</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Caliva Store</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End mainmenu area -->   
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">   
            <div id="order_review" class="col-md-4">
                 <div class="woocommerce-info">Want to LookUp what you just ordered?</div>

                                    <form enctype="multipart/form-data" action="orderLookup.php" class="order" method="post" id="order" name="order">

                                        <p id="first_name_field" class="form-row form-row-first validate-required">
                                                <label for="first_name">*Enter Name : &nbsp;&nbsp;&nbsp;</label>
                                                <input type="text" value="" placeholder="" id="first_name" name="first_name" class="input-text" required>
                                        </p>
                                         <p id="email_field" class="form-row form-row-first validate-required">
                                                <label for="email">*Enter Email : &nbsp;&nbsp;&nbsp;</label>
                                                <input type="text" value="" placeholder="" id="email" name="email" class="input-text" required>
                                        </p>
                                        <p id="orderId_field" class="form-row form-row-first validate-required">
                                                <label for="orderId">*Enter OrderID : </label>
                                                <input type="text" value="" placeholder="" id="orderId" name="orderId" class="input-text" required>
                                        </p>
                                        <div class="form-row place-order">
                                            <input type="submit" value="Show Details" id="show_details" name="show_details" class="button alt">
                                        </div>

                                    </form>
                <div class="clear"></div>
                </div>      

        <div class="container">
            <div class="row">           
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                                

<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql3 = "Select * from Product";
 $result3 = $conn->query($sql3);
 foreach ($result3 as $value3) {
     # code...
    echo $value3['productName'];
    echo $value3['productCode'].'<br/>';
 }


if(isset($_POST['show_details'])){ 
    $sql = "SELECT productCode,quantity from order_items WHERE orderId = (Select orderId from User INNER JOIN Order_main ON User.userId=Order_main.userId and userName='".$_POST["first_name"]."' and userEmail='".$_POST["email"]."')";

    $result = $conn->query($sql);
    $sql1 = "";
    print_r($result);

    while ($row = $result->fetch_assoc()) {
         $sql1 .= "SELECT DISTINCT productName,productPrice,productImg FROM Product WHERE productCode='".$row['productCode']."'; ";

} 
                                    if (!$conn->multi_query($sql1)) {
                                        echo "Sorry. No Order is found. Please try again with Correct orderID or Please Continue Shopping ";
                                   }else{

                                    echo "<div class='woocommerce-info'>Hello, ". $_POST["first_name"].". Your Order Details</div>";
                                    ?>


                                    <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-price">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>



<?php                                            do {
                                                if ($res = $conn->store_result()) {
                                                    $result = $res->fetch_all(MYSQLI_ASSOC);
                                                    //$res->free();
                                                    print_r($result);
                                                foreach ($result as $keys => $values) { 
                                                    ?>

                                                        
                                                <tr class="cart_item">
                                                 <td class="product-thumbnail">
                                                    <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?php echo $values['productImg'];?>"></a>
                                                </td>

                                                <td class="product-name">
                                                    <!-- <a href="single-product.php?productId=<?php echo $values["productCode"]; ?>"></a>  -->
                                                    <label><?php echo $values["productName"]; ?></label>
                                                </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount"><?php echo $values['productPrice']; ?></span> 
                                            </td>

                                            </tr>

                                             <?php           }
                                                    }
                                            } while ($conn->more_results() && $conn->next_result());
                                            }

                                                       
                                            }
                                            $conn->close(); ?>
</tbody>
</table>
                            </div>

                        </div>                       
                    </div>                    
                </div></div><



            </div>
        </div>
    </div>


    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>Caliva<span>Store</span></h2>
                        <p>we appreciate your bussiness with us.<br/>Thanks for visiting</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="">My account</a></li>
                            <li><a href="">Order history</a></li>
                            <li><a href="">Wishlist</a></li>
                            <li><a href="">Vendor contact</a></li>
                            <li><a href="">Front page</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <li><a href="">Mobile Phone</a></li>
                            <li><a href="">Home accesseries</a></li>
                            <li><a href="">LED TV</a></li>
                            <li><a href="">Computer</a></li>
                            <li><a href="">Gadets</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">                
                <div class="col-md-12">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
  </body>
</html>