<?php
require 'common.php';
require 'vendor/autoload.php';
require_once('config.php');


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);

/*$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shoppingcart';*/

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

  

    $sql = "INSERT INTO User (userName, userEmail, userPhone,userAddress,userPassword)
            VALUES ('".$_POST["billing_first_name"]."','".$_POST["billing_email"]."','".$_POST["billing_phone"]."','".$_POST["billing_address"]."','".$_POST["account_password"]."')";
    
    if ($conn->query($sql) === TRUE) {
        $uID = $conn->insert_id;
        $query = "INSERT INTO Order_main (userId) VALUES ('$uID')";

        if ($conn->query($query) === TRUE) {
            $sql1 = "";
            $orderID=$conn->insert_id;
            foreach($_SESSION['shopping_cart'] as $keys => $values){
                $sql1 .= "INSERT INTO Order_items (orderId, productCode, quantity) VALUES ('".$orderID."', '".$values['item_id']."', '".$values['item_quantity']."');";
            }
           // insert order items into database
            $insertOrderMain = $conn->multi_query($sql1);

           
            
            if ($insertOrderMain) {



                  $db = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($db->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    }

                    $sql2="";

            foreach($_SESSION['shopping_cart'] as $keys1 => $values1){
                $price=(float)substr($values1['item_price'], 1);
                 $sql2 .= "INSERT INTO Product (productCode, productName,productPrice,productImg ) VALUES ('".$values1['item_id']."','".$values1['item_name']."','$price', '".$values1['item_img']."');";

            }

            $insertOrderItems = $db->multi_query($sql2);                       
            //$msg=.$orderID;

            $db->close();
            $from = new SendGrid\Email(null, "varshaubhrani90@gmail.com");
            $subject = "Order Details From Caliva";
            $to = new SendGrid\Email(null, $_POST["billing_email"]);
            $content = new SendGrid\Content("text/plain", "Your Order Number is #RxFsd");
            $mail = new SendGrid\Mail($from, $subject, $to, $content);

            $apiKey = getenv('SENDGRID_API_KEY');
            $sg = new \SendGrid($apiKey);

            $response = $sg->client->mail()->send()->post($mail);

           


if (isset($_SESSION['shopping_cart'])) {
    # code...
    unset($_SESSION['shopping_cart']);
}
            //echo '<script>window.location="orderSucess.php"</script>';






            } else {echo "Error: ". $conn->error;
            }
        } else {echo "Error: " . $query . "<br>" . $conn->error;}

    } else {
    echo "Error: " . $query . "<br>" . $conn->error;
}


$conn->close();

?>
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
                        <li><a href="orderLookup.php">Order-Lookup</a></li>
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
    </div>
    
     
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-12">
                    <br/><br/><br/><br/><br/><br/>Thank you for shopping with us. <br/> A confirmation has been sent to your email <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
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