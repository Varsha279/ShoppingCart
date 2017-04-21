<?php
require 'common.php';
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

if(isset($_POST['place_order'])){


    $sql = "INSERT INTO User (userName, userEmail, userPhone,userAddress,userPassword)
            VALUES ('".$_POST["billing_first_name"]."','".$_POST["billing_email"]."','".$_POST["billing_phone"]."','".$_POST["billing_address"]."','".$_POST["account_password"]."')";
    
    if ($conn->query($sql) === TRUE) {
        $uID = $conn->insert_id;
        $query = "INSERT INTO Order_main (userId) VALUES ('$uID')";

        if ($conn->query($query) === TRUE) {

            $orderId = $conn->insert_id;
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


            $db->close();

            $to = $_POST["billing_email"];
            $subject = "Order Details from Caliva";
            $msg = "Thanks for shopping with us"."<br/>".$orderId;
            mail($to,$subject,$msg);



            echo '<script>window.location="orderSucess.php"</script>';






            } else {echo "Error: ". $conn->error;
            }
        } else {echo "Error: " . $query . "<br>" . $conn->error;}

    } else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
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
                        <li class="active"><a href="checkout.php">Checkout</a></li>
                        <li><a href="orderLookup.php">Order-Lookup</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->   
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">   
            <div id="order_review" class="col-md-4">
                 <div class="woocommerce-info">Returning customer? <a class="showlogin" data-toggle="collapse" href="#login-form-wrap" aria-expanded="false" aria-controls="login-form-wrap">Click here to login</a></div>

                                    <table class="shop_table">
                                        <thead>
                                            <tr class="cart-subtotal">
                                                <th>Cart Total</th>
                                                <td><span class="amount">$<?php echo $_GET['total'];?></span>
                                                </td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>

                                                    Free Shipping
                                                    <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                                </td>
                                            </tr>


                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">$<?php echo $_GET['total'];?></span></strong> </td>
                                            </tr>

                                        </thead>
                                        
                                    </table>
                                        <div class="clear"></div>

                                </div>        
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form id="login-form-wrap" class="login collapse" method="post">


                                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>

                                <p class="form-row form-row-first">
                                    <label for="username">Username or email <span class="required">*</span>
                                    </label>
                                    <input type="text" id="username" name="username" class="input-text">
                                </p>
                                <p class="form-row form-row-last">
                                    <label for="password">Password <span class="required">*</span>
                                    </label>
                                    <input type="password" id="password" name="password" class="input-text">
                                </p>
                                <div class="clear"></div>


                                <p class="form-row">
                                    <input type="submit" value="Login" name="login" class="button">
                                    <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me </label>
                                </p>
                                <p class="lost_password">
                                    <a href="#">Lost your password?</a>
                                </p>

                                <div class="clear"></div>
                            </form>

                            <form enctype="multipart/form-data" action="checkout.php?total=<?php echo $_GET['total'];?>" class="checkout" method="post" id="checkout" name="checkout">

                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing Details</h3>
                                            <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                <label class="" for="billing_country">Country <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <select rel="calc_shipping_state" class="country_to_state" id="calc_shipping_country" name="calc_shipping_country">
                                                    <option value="">Select a country…</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="IN">India</option>
                                                    <option value="NZ">New Zealand</option>                                   
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option selected="selected" value="US">United States (US)</option>
                                                    <option value="UK">United Kingdom (US)</option>
                                                </select>
                                            </p>

                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name">Name <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_first_name" name="billing_first_name" class="input-text" data-pattern-error="Please use only letters for your city." pattern="[A-z ']*" required>
                                            </p>


                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Address <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="Street address" id="address" name="billing_address" class="input-text " required>
                                            </p>

                                            <p id="billing_city_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_city">Town / City <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="Town / City" id="billing_city" name="billing_city" class="input-text ">
                                            </p>

                                            <p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                                <label class="" for="billing_state">County</label>
                                                <input type="text" id="billing_state" name="billing_state" placeholder="State / County" value="" class="input-text ">
                                            </p>
                                            <p id="billing_postcode_field" class="form-row form-row-last address-field validate-required validate-postcode" data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                                <label class="" for="billing_postcode">Postcode <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="Postcode / Zip" id="billing_postcode" name="billing_postal" class="input-text " required>
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">Email Address <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="email" value="" placeholder="" id="billing_email" name="billing_email" class="input-text " required>
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                            </p>
                                            <div class="clear"></div>


                                            <div class="create-account">
                                                <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                                <p id="account_password_field" class="form-row validate-required">
                                                    <label class="" for="account_password">Account password <abbr title="required" class="required">*</abbr>
                                                    </label>
                                                    <input type="password" value="" placeholder="Password" id="account_password" name="account_password" class="input-text">
                                                </p>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="form-row place-order">

                                            <input type="submit" data-value="Place order" value="Place order" id="place_order" name="place_order" class="button alt">


                                        </div>
                                

                                        </div>
                                    </div>


                                        
                            </form>

                        </div>                       
                    </div>                    
                </div>



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