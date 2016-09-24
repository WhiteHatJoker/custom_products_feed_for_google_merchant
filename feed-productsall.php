<?php  
/** 
 * RSS2 Feed Template for displaying RSS2 Posts feed. 
 * 
 * @package WordPress 
 */  
   
header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);   

/**
 * Start RSS feed.
*/
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>'; ?>  

<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    xmlns:g="http://base.google.com/ns/1.0"
    xmlns:c="http://base.google.com/cns/1.0"
    <?php do_action( 'rss2_ns' ); ?>
>

<!-- RSS feed defaults -->   
<channel>  
    <title><?php bloginfo_rss( 'name' ); ?></title>  
    <link><?php bloginfo_rss( 'url' ) ?></link>
    <description><?php bloginfo_rss( 'description' ) ?></description>  
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>  
    <language><?php bloginfo_rss( 'language' ); ?></language>  
    <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'daily' ); ?></sy:updatePeriod>  
    <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency><atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />

    <!-- Feed Logo (optional) -->
    <image>
        <url>http://www.tisinal.com/wp-content/uploads/2016/09/Tis-favicon-2-1.jpg</url>
        <title>
            <?php bloginfo_rss( 'description' ) ?>
        </title>
        <link><?php bloginfo_rss( 'url' ) ?></link>
    </image>
    <?php do_action('rss2_head'); ?>


    <?php  
    $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'post_status' => 'publish' );  
    $loop = new WP_Query( $args );  
    while ( $loop->have_posts() ) : $loop->the_post(); global $product;  
    ?>  
    <item>  
        <title><?php the_title_rss() ?></title>  
        <link><?php the_permalink_rss() ?></link>
        <g:mobile_link><?php the_permalink_rss() ?></g:mobile_link>  
        <g:image_link><?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?></g:image_link>  
        <g:price><?php echo $product -> get_price(); ?> USD</g:price>  
        <g:condition>New</g:condition>  
        <g:id><?php echo $id; ?></g:id>  
        <g:availability><?php echo $product -> is_in_stock() ? 'In Stock' : 'Out of Stock'; ?></g:availability>  
        <g:brand><?php echo WCV_Vendors::get_vendor_shop_name(get_the_author_meta( 'ID' )); ?></g:brand>  
        <g:product_type>Heim Garten > Beleuchtung > Leuchtmittel > LED-Leuchtmittel</g:product_type>  
        <g:google_product_category><?php 
       	if ( has_term( array('gift-boxes', 'gift-sets', 'gifts' ), 'product_cat' ) ) {
       		echo 136;
       	} elseif ( has_term( 'do-it-yourself-kits', 'product_cat' ) ) {
			echo 5904;
		} elseif ( has_term( array('chocolate', 'caramels', 'marshmallows' ), 'product_cat' ) ) {
			echo 4748;
		} elseif ( has_term( array('cakes', 'cookies', 'biscotti', 'maple-treats', 'honey-sticks' ), 'product_cat' ) ) {
			echo 1876;
		} elseif ( has_term( 'meats', 'product_cat' ) ) {
			echo 4628;
		} elseif ( has_term( 'seafoods', 'product_cat' ) ) {
			echo 4629;
		} elseif ( has_term( 'cheeses', 'product_cat' ) ) {
			echo 429;
		} elseif ( has_term( array('hot-sauce', 'marinades-rubs', 'dressings-and-toppings', 'pickled-and-cured', 'maple-syrup', 'honey-pantry-items' ), 'product_cat' ) ) {
			echo 427;
		} elseif ( has_term( array('spices', 'seasonings', 'salts' ), 'product_cat' ) ) {
			echo 4608;
		} elseif ( has_term( array('granola', 'oatmeal' ), 'product_cat' ) ) {
			echo 431;
		} elseif ( has_term( array('nut-butters', 'jams-and-jelly' ), 'product_cat' ) ) {
			echo 5740;
		} elseif ( has_term( 'pasta', 'product_cat' ) ) {
			echo 434;
		} elseif ( has_term( array('baking-mixes', 'olive-oils' ), 'product_cat' ) ) {
			echo 2660;
		} elseif ( has_term( 'staples', 'product_cat' ) ) {
			echo 430;
		} elseif ( has_term( 'tea', 'product_cat' ) ) {
    		echo 2073;
		} elseif ( has_term( 'coffee', 'product_cat' ) ) {
    		echo 1868;
		} elseif ( has_term( array('bitters', 'mixers'), 'product_cat' ) ) {
    		echo 7486;
		} elseif ( has_term ( 'nuts-mixes', 'product_cat' ) ) {
			echo 433;
		} elseif ( has_term ( array('popcorn', 'energy-bars' ), 'product_cat' ) ) {
			echo 423;
		} elseif ( has_term ( array('tea-sets', 'other' ), 'product_cat' ) ) {
			echo 672;
		} elseif ( has_term( 'health-beauty', 'product_cat' ) ) {
			echo 567;
		} else {
			echo 422;
		}
			?>
		</g:google_product_category>   
        <g:mpn><?php echo $product -> get_sku(); ?></g:mpn>  
<?php if (get_option('rss_use_excerpt')) : ?>  
        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>  
<?php else : ?>  
        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>  
<?php endif; ?>  
   
<?php rss_enclosure(); ?>  
    <?php do_action('rss2_item'); ?>  
    </item>  
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</channel>  
</rss>  
