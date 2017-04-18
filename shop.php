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
                            <li> <a href="cart.html">Cart - <span class="cart-amunt"></span> <i class="fa fa-shopping-cart"></i></a></li>
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
                        <li class="active"><a href="shop.php">Shop page</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
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
                
<?php

require 'common.php';

    foreach ($xml->channel->item as $item) {
    
        $content = $item->children('content', 'https://slickdeals.net/newsearch.php?mode=frontpage&searcharea=deals&searchin=first&rss=1');
        $html_string = $content->encoded;
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html_string);
        libxml_clear_errors();

        $title = (string) $item->title;
        $description = (string) $item->description;
        $img =(string) $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
        $productId = $dom->getElementsByTagName('a')->item(0)->getAttribute('data-product-products');
        $name = implode(' ', array_slice(explode(' ', $title), 0, 4));

        if(preg_match($pattern, $description,$matches)){
            $price=(string) $matches[0];
        }else{
            $price= "Free";
        }
    ?>

        
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="<?php echo $img; ?>" alt="">
                        </div>
                        <h2><a href="single-product.php?productId=<?php echo $productId ; ?>"><?php echo $name;?></a></h2>
                        <div class="product-carousel-price">
                            <ins><?php echo $price; ?></ins> <del>$999.00</del>
                        </div>  


                       <form method="post" action="shop.php?action=add" class="cart">
                        <input type="hidden" value="<?php echo $price; ?>" name="hidden_price">
                        <input type="text" value="<?php echo $productId; ?>" name="hidden_pId" >
                        <input type="hidden" value="<?php echo $name; ?>" name="hidden_name" >
                        <input type="hidden" value="<?php echo $img; ?>" name="hidden_img" >
                        <input type="hidden" value="1" name="hidden_quantity" >
                        <div class="product-option-shop">
                        <button name="add_to_cart" class="add_to_cart_button" type="submit">Add to cart</button>
                        </form>
                        </div>                       
                    </div>
                </div>




<?php

    }

?>

            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   <p>By Varsha Ubhrani</p>
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