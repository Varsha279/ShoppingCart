# ShoppingCart
This website is developed in HTML, CSS, JS, PHP, BOOTSTRAP and MYSQL deployed on HEROKU cloud deployment https://powerful-depths-56393.herokuapp.com/ . Basically, the products and deals are fetched from RSS feed i.e. parsing through XML and displaying it on the page. Also, I have used the STRIPE API for the payments of the products and SENDGRID addon of heroku to send Emails to the customer.

Instruction About the site.
1.	The Home Page is just a static page nothing will be clickable, since I just made it for the website to look good.
2.	On the top of the Navigation Bar, The PRODUCT & DEALS page is the one which loads all the deals from the RSS feed and you can browse all the products.
3.	If you click Product Name it will navigate to single product page where a detailed description and image is added.
4.	Now, you can add product to cart from the PRODUCT & DEALS page or the single page.
5.	As soon as you add product into cart, you can see your cart by clicking the CART tab in the navigation bar
6.	There in the cart you can view the subtotal and the total. You can also remove the product from the cart
7.	For adding quantity you need to click addToCart button twice either on PRODUCT & DEALS page or SINGLE-PRODUCT page.
8.	After adding products to the cart, you can click PLACE ORDER link at the bottom of the cart to place your order.
9.	It will navigate to the checkout, where you can PAY WITH CARD via stripe gateway. For testing the payment. Please use only dummy card (4242424242424242/any year/any 3 digit CVV) or from https://stripe.com/docs/testing page as the stripe is activated on test mode.
10.	Then you need to fill out a registration form which takes USER DETAILS from registration and is stored into database.
11.	As soon as you fill that form you will be navigated to Order Success page and an email will be sent to your email id you entered with an order# via the sendgrid addon for heroku (will take 1-2 mins for the mail) and also the cart will be emptied.
12.	Then from the home page you can click the ORDER_LOOKUP tab from the navigation, there you need to fill your name, email and order# to look your order details.

