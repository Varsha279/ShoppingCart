<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_Jjh6vG76F8qhWlVQHXHq0Yyd",
  "publishable_key" => "pk_test_hIOzJ74DufrDHkYxwS4TleNZ"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>