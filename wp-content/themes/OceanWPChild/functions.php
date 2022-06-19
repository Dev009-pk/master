<?php
add_action( 'wp_enqueue_scripts', 'OceanWPChild_enqueue_child_theme_styles', PHP_INT_MAX);

function OceanWPChild_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', array('parent-style') );
}

/* Register Custom Post Type Promo "Code Start" */
function register_promo() {

    $labels = array(
        'name' => _x('Promo', 'post type general name'),
        'singular_name' => _x('Promo', 'post type singular name'),
        'add_new' => _x('Add New', 'Promo'),
        'add_new_item' => __('Add New Case Promo'),
        'edit_item' => __('Edit Case Promo'),
        'new_item' => __('New Case Promo'),
        'all_items' => __('All Case Promo'),
        'view_item' => __('View Case Promo'),
        'search_items' => __('Search Case Promo'),
        'not_found' => __('No Promo found'),
        'not_found_in_trash' => __('No Promo found in the Trash'),
        'menu_name' => 'Promo'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Promo Related information will be hold on this',
        'public' => true,
        'show_in_menu' => true,
        'menu' => 5,
        'menu_icon'=>'dashicons-admin-post',
        'supports' => array('title', 'editor', 'thumbnail', 'post-format', 'excerpt'),
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'taxonomies' => array('categorypromo')
    );
    /* Register Taxonomy For Post Type Promo "Code Start" */
    register_taxonomy(
        'categorypromo', 'promo', array(
        'hierarchical' => true,
        'label' => 'Promo Category',
        'show_admin_column' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true
    ));
    /* Register Taxonomy For Post Type Promo "Code End" */
    register_post_type('promo', $args);
}
add_action('init', 'register_promo');

/* Register Custom Post Type Promo "Code End" */

/* Pagination For Custom Post Type Promo "Code Start" */
function pagination($pages = '', $range = 4){
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}
	if(1 != $pages)
	{
		echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
		if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
		echo "</div>\n";
	}
}
/* Pagination For Custom Post Type Promo "Code End" */

/* hook For Custom Post Type Promo "Code Start" */
function RenderCategoryShop() {

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args = array(
		'posts_per_page' => 1,
		'post_type' => 'promo',
		'paged' => $paged
	);
	$custom_query = new WP_Query( $args );
	?>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				while($custom_query->have_posts()) :
					$custom_query->the_post(); ?>
					<div class="develop-box">
	
						<div class="develop-underbox">
							<div class="develop-title"><h3 class="smNew"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
							</div>
								<div class="develop-uei"><a href="<?php the_permalink(); ?>">View</a></div>
							</div>
	
							<div class="develop-image">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
							</div>
	
						</div>
	
					<?php endwhile; ?>
				
				</main>
			</div>
		</div>
<?php 
}
add_action('woocommerce_before_shop_loop','RenderCategoryShop',140);
/* hook For Custom Post Type Promo "Code End" */