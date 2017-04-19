<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>

</body>
</html>

<?php
session_start();
$xml = simplexml_load_file('https://slickdeals.net/newsearch.php?mode=frontpage&searcharea=deals&searchin=first&rss=1', null, LIBXML_NOCDATA);
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$pattern = '/(\$[\d,]+(\.\d{2})?)/';



if(isset($_POST['add_to_cart'])){

    if (isset($_SESSION['shopping_cart'])) {

        $item_array_id=array_column($_SESSION['shopping_cart'], "item_id");
        if (!in_array($_POST['hidden_pId'], $item_array_id)) {

                $count = count($_SESSION['shopping_cart']);
                $item_array = array(
                   'item_id'=> $_POST['hidden_pId'] ,
                    'item_name'=> $_POST['hidden_name'],
                    'item_price'=>$_POST['hidden_price'],
                    'item_quantity'=>$_POST['hidden_quantity'],
                    'item_img'=>$_POST['hidden_img'],
                );
                $_SESSION['shopping_cart'][$count]=$item_array;
                echo '<div class="alert alert-success" id="success-alert">
					    <button type="button" class="close" data-dismiss="alert">x</button>
					    <strong>Success! </strong>
					    Product have added to your Cart.
					  </div>';


        }else{
           foreach ($_SESSION['shopping_cart'] as $keys => $values) {
				if ($values['item_id']===$_POST['hidden_pId']) {
					$_SESSION['shopping_cart'][$keys]['item_quantity'] += 1;
					}	
			}

			 echo '<div class="alert alert-success" id="success-alert">
					    <button type="button" class="close" data-dismiss="alert">x</button>
					    <strong>Success! </strong>
					    Product have added to your Cart.
					</div>';
        }
    }else{
        $item_array = array(
            'item_id'=> $_POST['hidden_pId'] ,
            'item_name'=> $_POST['hidden_name'],
            'item_price'=>$_POST['hidden_price'],
            'item_quantity'=>$_POST['hidden_quantity'],
            'item_img'=>$_POST['hidden_img'],

            );

        $_SESSION['shopping_cart'][0]=$item_array;
        echo '<div class="alert alert-success" id="success-alert">
			    <button type="button" class="close" data-dismiss="alert">x</button>
			    <strong>Success! </strong>
			    Product have added to your Cart.
			</div>';

    }
}
?>

