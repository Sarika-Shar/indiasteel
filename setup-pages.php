<?php
/**
 * Setup script to populate IndiaSteel pages with Breadcrumbs, Images & Elementor Layouts
 */
require_once __DIR__ . '/wp-load.php';

echo "Updating IndiaSteel Elementor Pages with Breadcrumbs & Visuals...\n";

// Helper function to create Elementor Section JSON
function indiasteel_make_shortcode_section( $shortcode_str ) {
	return array(
		'id'       => substr( md5( uniqid( rand(), true ) ), 0, 8 ),
		'elType'   => 'section',
		'settings' => array(
			'layout' => 'full_width',
			'gap'    => 'no',
		),
		'elements' => array(
			array(
				'id'       => substr( md5( uniqid( rand(), true ) ), 0, 8 ),
				'elType'   => 'column',
				'settings' => array(
					'_column_size' => 100,
				),
				'elements' => array(
					array(
						'id'         => substr( md5( uniqid( rand(), true ) ), 0, 8 ),
						'elType'     => 'widget',
						'widgetType' => 'shortcode',
						'settings'   => array(
							'shortcode' => $shortcode_str,
						),
					),
				),
			),
		),
	);
}

// 1. HOME PAGE (Post ID 9)
$home_sections = array(
	indiasteel_make_shortcode_section( '[indiasteel_hero_slider]' ),
	indiasteel_make_shortcode_section( '[indiasteel_enquiry_ribbon]' ),
	indiasteel_make_shortcode_section( '[indiasteel_metrics]' ),
	indiasteel_make_shortcode_section( '[indiasteel_yard_gallery]' ),
	indiasteel_make_shortcode_section( '[indiasteel_products]' ),
	indiasteel_make_shortcode_section( '[indiasteel_buysell]' ),
	indiasteel_make_shortcode_section( '[indiasteel_contact]' ),
);

$home_content = "[indiasteel_hero_slider]\n[indiasteel_enquiry_ribbon]\n[indiasteel_metrics]\n[indiasteel_yard_gallery]\n[indiasteel_products]\n[indiasteel_buysell]\n[indiasteel_contact]";

wp_update_post( array(
	'ID'           => 9,
	'post_title'   => 'Home',
	'post_content' => $home_content,
	'post_status'  => 'publish',
) );

update_post_meta( 9, '_elementor_edit_mode', 'builder' );
update_post_meta( 9, '_elementor_template_type', 'wp-page' );
update_post_meta( 9, '_elementor_version', '4.3.5' );
update_post_meta( 9, '_wp_page_template', 'elementor_header_footer' );
update_post_meta( 9, '_elementor_data', wp_slash( json_encode( $home_sections ) ) );
echo "✓ Home Page configured\n";


// 2. ABOUT US PAGE (Post ID 10) - With Breadcrumbs & Visual Mosaic Images
$about_sections = array(
	indiasteel_make_shortcode_section( '[indiasteel_breadcrumbs title="About IndiaSteel Corporation" subtitle="North India\'s trusted industrial scrap recycler & primary mill steel distributor since 1998." badge="Company Overview" current="About Us"]' ),
	indiasteel_make_shortcode_section( '[indiasteel_about_mosaic]' ),
	indiasteel_make_shortcode_section( '[indiasteel_yard_gallery]' ),
	indiasteel_make_shortcode_section( '[indiasteel_metrics]' ),
	indiasteel_make_shortcode_section( '[indiasteel_contact]' ),
);

$about_content = '[indiasteel_breadcrumbs title="About IndiaSteel Corporation" subtitle="North India\'s trusted industrial scrap recycler & primary mill steel distributor since 1998." badge="Company Overview" current="About Us"]' . "\n" .
	"[indiasteel_about_mosaic]\n[indiasteel_yard_gallery]\n[indiasteel_metrics]\n[indiasteel_contact]";

wp_update_post( array(
	'ID'           => 10,
	'post_title'   => 'About Us',
	'post_content' => $about_content,
	'post_status'  => 'publish',
) );

update_post_meta( 10, '_elementor_edit_mode', 'builder' );
update_post_meta( 10, '_elementor_template_type', 'wp-page' );
update_post_meta( 10, '_elementor_version', '4.3.5' );
update_post_meta( 10, '_wp_page_template', 'elementor_header_footer' );
update_post_meta( 10, '_elementor_data', wp_slash( json_encode( $about_sections ) ) );
echo "✓ About Us Page configured with Breadcrumbs & Visual Mosaic Images\n";


// 3. PRODUCTS PAGE (Post ID 11) - With Breadcrumbs & Visual Grid
$products_sections = array(
	indiasteel_make_shortcode_section( '[indiasteel_breadcrumbs title="Industrial Steel & Graded Scrap Portfolio" subtitle="Procure furnace-ready heavy melting scrap, certified TMT rebars, structural sections, and billets." badge="Material Catalogue" current="Products"]' ),
	indiasteel_make_shortcode_section( '[indiasteel_products]' ),
	indiasteel_make_shortcode_section( '[indiasteel_yard_gallery]' ),
	indiasteel_make_shortcode_section( '[indiasteel_metrics]' ),
	indiasteel_make_shortcode_section( '[indiasteel_contact]' ),
);

$products_content = '[indiasteel_breadcrumbs title="Industrial Steel & Graded Scrap Portfolio" subtitle="Procure furnace-ready heavy melting scrap, certified TMT rebars, structural sections, and billets." badge="Material Catalogue" current="Products"]' . "\n" .
	"[indiasteel_products]\n[indiasteel_yard_gallery]\n[indiasteel_metrics]\n[indiasteel_contact]";

wp_update_post( array(
	'ID'           => 11,
	'post_title'   => 'Products',
	'post_content' => $products_content,
	'post_status'  => 'publish',
) );

update_post_meta( 11, '_elementor_edit_mode', 'builder' );
update_post_meta( 11, '_elementor_template_type', 'wp-page' );
update_post_meta( 11, '_elementor_version', '4.3.5' );
update_post_meta( 11, '_wp_page_template', 'elementor_header_footer' );
update_post_meta( 11, '_elementor_data', wp_slash( json_encode( $products_sections ) ) );
echo "✓ Products Page configured with Breadcrumbs\n";


// 4. BUY & SELL PAGE (Post ID 12) - With Breadcrumbs
$buysell_sections = array(
	indiasteel_make_shortcode_section( '[indiasteel_breadcrumbs title="Buy & Sell Industrial Steel Portal" subtitle="Sell scrap with immediate RTGS payment or buy certified mill steel at spot market parity." badge="Trading Desk" current="Buy & Sell"]' ),
	indiasteel_make_shortcode_section( '[indiasteel_buysell]' ),
	indiasteel_make_shortcode_section( '[indiasteel_metrics]' ),
	indiasteel_make_shortcode_section( '[indiasteel_contact]' ),
);

$buysell_content = '[indiasteel_breadcrumbs title="Buy & Sell Industrial Steel Portal" subtitle="Sell scrap with immediate RTGS payment or buy certified mill steel at spot market parity." badge="Trading Desk" current="Buy & Sell"]' . "\n" .
	"[indiasteel_buysell]\n[indiasteel_metrics]\n[indiasteel_contact]";

wp_update_post( array(
	'ID'           => 12,
	'post_title'   => 'Buy & Sell',
	'post_content' => $buysell_content,
	'post_status'  => 'publish',
) );

update_post_meta( 12, '_elementor_edit_mode', 'builder' );
update_post_meta( 12, '_elementor_template_type', 'wp-page' );
update_post_meta( 12, '_elementor_version', '4.3.5' );
update_post_meta( 12, '_wp_page_template', 'elementor_header_footer' );
update_post_meta( 12, '_elementor_data', wp_slash( json_encode( $buysell_sections ) ) );
echo "✓ Buy & Sell Page configured with Breadcrumbs\n";


// 5. CONTACT US PAGE (Post ID 13) - With Breadcrumbs & Focus on WhatsApp & Direct Call
$contact_sections = array(
	indiasteel_make_shortcode_section( '[indiasteel_breadcrumbs title="Contact IndiaSteel Trading Desk" subtitle="Instant WhatsApp quotes, live yard operator calling, and certified weighbridge location details." badge="Direct Support" current="Contact Us"]' ),
	indiasteel_make_shortcode_section( '[indiasteel_contact]' ),
);

$contact_content = '[indiasteel_breadcrumbs title="Contact IndiaSteel Trading Desk" subtitle="Instant WhatsApp quotes, live yard operator calling, and certified weighbridge location details." badge="Direct Support" current="Contact Us"]' . "\n" .
	"[indiasteel_contact]";

wp_update_post( array(
	'ID'           => 13,
	'post_title'   => 'Contact Us',
	'post_content' => $contact_content,
	'post_status'  => 'publish',
) );

update_post_meta( 13, '_elementor_edit_mode', 'builder' );
update_post_meta( 13, '_elementor_template_type', 'wp-page' );
update_post_meta( 13, '_elementor_version', '4.3.5' );
update_post_meta( 13, '_wp_page_template', 'elementor_header_footer' );
update_post_meta( 13, '_elementor_data', wp_slash( json_encode( $contact_sections ) ) );
echo "✓ Contact Us Page configured with Breadcrumbs\n";

// Clear Elementor CSS cache
if ( class_exists( '\Elementor\Plugin' ) ) {
	\Elementor\Plugin::$instance->files_manager->clear_cache();
	echo "✓ Elementor cache flushed\n";
}

echo "All pages successfully updated with Light Theme & Breadcrumbs!\n";
