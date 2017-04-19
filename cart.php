<?php
require 'common.php';
require_once("dbcontroller.php");
$db_handle = new DBController();
$item_total = 0;
    if(isset($_GET['action'])){
        if($_GET['action']=='delete'){
            foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                
                if($values['item_id']==$_GET['id']){

                    unset($_SESSION['shopping_cart'][$keys]);
                    echo '<script>alert("Item Remove !!")</script';
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }         
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
   
     <div class="header-area">
        <div class="container">
            <div class="row">
               
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                            <li><a href="cart.html"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="checkout.html"><i class="fa fa-user"></i> Checkout</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Login</a></li>
                            <li> <a href="cart.php">Cart - <span class="cart-amunt">$100</span> <i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                </div>  
            </div>
        </div>
    </div> <!-- End site branding area -->
    
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
                        <li><a href="index.html">Home</a></li>
                        <li><a href="shop.php">Shop page</a></li>
                        <li class="active"><a href="cart.php">Cart</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li>
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
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">           
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                        <?php if (isset($_SESSION['shopping_cart'])) {?>
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-subtotal">Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php    
                                    
                                        foreach ($_SESSION['shopping_cart'] as $keys=> $values){
                                    ?>
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" href="cart.php?action=delete&id=<?php echo $values["item_id"] ?>">×</a> 
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?php echo $values['item_img'];?>"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.php?productId=<?php echo $values["item_id"]; ?>"><?php echo $values["item_name"]; ?></a> 
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="<?php echo $values['item_quantity']; ?>" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount"><?php echo $values['item_price']; ?></span> 
                                            </td>

                                            <?php
                                                $price=(float)substr($values['item_price'], 1);
                                                $total = number_format($price*$values["item_quantity"],2);
                                                $item_total += $total;
                                             ?>

                                            <td class="product-subtotal">
                                                <span class="amount">$<?php echo $total;?></span> 
                                            </td>
                                        </tr>
                                        <?php } 

                                         ?>
                                        <tr>
                                            <td colspan="6" align="right">
                                                <label>Total: $<?php echo $item_total;?></label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="6">
                                                <a href="checkout.php?total=<?php echo $item_total?>">Place Order</a>
                                            </td>
                                        </tr>
                            <?php }else{ echo "Your Cart Is Empty. Please "."<a href='shop.php'>Continue Shopping</a><br/>";}?>
                                    </tbody>
                                </table>
                            
                            </form>

                            <div class="cart-collaterals">


                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">$<?php echo $item_total;?></span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">$<?php echo $item_total;?></span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            </div>
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