# Custom products feed for google merchant
If you want to create a feed of your products to be submitted to Google Merchant Center, then follow instructions below to create a custom feed of all your products.

## Installation
1. Copy functions.php code and feed-productsall.php into your WordPress theme folder.
2. Update [line 63](feed-productsall.php#L63) with either your category or the code to dynamically output the your product categories.(on development stage)
3. Update [lines 65-110](feed-productsall.php#L65-L110) to check your products for their categories and assign specific IDs of google categories to them. `if ( has_term( array('gift-boxes', 'gift-sets', 'gifts' ), 'product_cat' ) ) { echo 136;` code reads as if your single product belongs to gift-boxes or gift-sets or gifts category slugs, then output 136 in that field. 136 corressponds to the ID of the google product category, so you would need to lookup that specific ID that you would want to put here.
4. Now you can access your feed from `yoursite.com??feed=productsall`. This link you would need to add to your Google Merchant account.
