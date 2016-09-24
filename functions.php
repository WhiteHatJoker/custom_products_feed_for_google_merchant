//Custom RSS feed for Google Merchants
add_action( 'after_setup_theme', 'my_rss_template' );

function my_rss_template() {
	add_feed( 'productsall', 'my_custom_rss_render' );
}

function my_custom_rss_render() {
	get_template_part( 'feed', 'productsall' );
}
