<?php
/**
 * Template Name: Order Now
 *
 * @package OceanWP WordPress theme
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?><?php oceanwp_schema_markup( 'html' ); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php wp_head(); ?>
	</head>

	<!-- Begin Body -->
	<body <?php body_class(); ?><?php oceanwp_schema_markup( 'body' ); ?>>
<?php
$current_user = wp_get_current_user();
printf( __( 'Nickname: %s', 'textdomain' ), esc_html( $current_user->nickname ) ) . '<br />';echo "<br/>";
printf( __( 'User ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );
echo "<br/>";
$products = wc_get_products(array(
    'category' => array($current_user->nickname),
));
foreach ($products as $key => $value) {
print_r($value->name);echo "<br/>";
}

?>

	</body>
</html>