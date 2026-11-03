<?php
/**
 * IndiaSteel Child Theme Functions - Modern Light Industrial Edition
 *
 * @package IndiaSteel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Theme Assets
 */
function indiasteel_enqueue_scripts() {
	wp_enqueue_style( 'hello-elementor-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'indiasteel-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap', array(), null );
	wp_enqueue_style( 'font-awesome-6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
	wp_enqueue_style( 'indiasteel-custom-style', get_stylesheet_directory_uri() . '/assets/css/indiasteel.css', array( 'hello-elementor-parent-style' ), '2.1.0' );
	wp_enqueue_script( 'indiasteel-custom-script', get_stylesheet_directory_uri() . '/assets/js/indiasteel.js', array(), '2.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'indiasteel_enqueue_scripts', 20 );

/**
 * Shortcode: IndiaSteel Topbar + Header (Light Theme Header)
 */
function indiasteel_header_shortcode() {
	ob_start();
	$home_url = home_url( '/' );
	$custom_header_logo = get_option( 'is_header_logo' );
	if ( ! empty( $custom_header_logo ) ) {
		$logo_url = $custom_header_logo;
	} else {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		} else {
			$logo_url = get_stylesheet_directory_uri() . '/assets/images/indiasteel-logo-dark.svg';
		}
	}
	?>
	<!-- Top Bar -->
	<div class="indiasteel-topbar">
		<div class="steel-container">
			<div class="topbar-left">
				<div class="topbar-badge"><?php echo esc_html( get_option( 'is_topbar_badge', 'Live Scrap Market' ) ); ?></div>
				<div class="topbar-item"><i class="fa-solid fa-scale-balanced" style="color:#ea580c;"></i> <?php echo esc_html( get_option( 'is_topbar_scale', '100T Electronic Weighbridge On-Site' ) ); ?></div>
				<div class="topbar-item"><i class="fa-solid fa-location-dot" style="color:#ea580c;"></i> <?php echo esc_html( get_option( 'is_topbar_location', 'Industrial Area Ph-II, New Delhi' ) ); ?></div>
			</div>
			<div class="topbar-right">
				<div class="topbar-item"><i class="fa-regular fa-clock" style="color:#ea580c;"></i> <?php echo esc_html( get_option( 'is_topbar_timing', '8:00 AM - 7:30 PM (Mon-Sat)' ) ); ?></div>
				<div class="topbar-item"><i class="fa-solid fa-bolt" style="color:#ea580c;"></i> <?php echo esc_html( get_option( 'is_topbar_settlement', 'Immediate RTGS Scrap Settlements' ) ); ?></div>
			</div>
		</div>
	</div>

	<!-- Main Header -->
	<header class="indiasteel-header" id="site-header">
		<div class="steel-container">
			<div class="site-logo">
				<a href="<?php echo esc_url( $home_url ); ?>" title="IndiaSteel">
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="IndiaSteel Scrap & Steel Corporation" />
				</a>
			</div>

			<nav class="indiasteel-nav" aria-label="Main Navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'fallback_cb'    => function() use ( $home_url ) {
						echo '<ul>
							<li><a href="' . esc_url( $home_url ) . '">Home</a></li>
							<li><a href="' . esc_url( $home_url . 'about/' ) . '">About</a></li>
							<li><a href="' . esc_url( $home_url . 'products/' ) . '">Products</a></li>
							<li><a href="' . esc_url( $home_url . 'showcase/' ) . '">Showcase</a></li>
							<li><a href="' . esc_url( $home_url . 'buy-sell/' ) . '">Buy &amp; Sell</a></li>
							<li><a href="' . esc_url( $home_url . 'contact/' ) . '">Contact</a></li>
						</ul>';
					}
				) );
				?>
			</nav>

			<div class="header-actions">
				<?php 
				$header_phone_val = get_option( 'is_header_phone', '+91 98765 43210' );
				$header_call_text = get_option( 'is_header_call_text', 'Call Now: +91 98765 43210' );
				$clean_phone = preg_replace( '/[^0-9+]/', '', $header_phone_val );
				?>
				<a href="tel:<?php echo esc_attr( $clean_phone ); ?>" class="btn-call-quick">
					<i class="fa-solid fa-phone"></i>
					<span><?php echo esc_html( $header_call_text ); ?></span>
				</a>
				<button class="mobile-nav-toggle" aria-label="Toggle navigation">
					<i class="fa-solid fa-bars"></i>
				</button>
			</div>
		</div>
	</header>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_header', 'indiasteel_header_shortcode' );

/**
 * Shortcode: Breadcrumbs & Page Banner Component
 */
function indiasteel_breadcrumbs_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'title'    => 'Industrial Steel Solutions',
		'subtitle' => 'Supplying prime steel and procuring heavy metal scrap across India.',
		'badge'    => 'IndiaSteel Portal',
		'current'  => 'Current Page',
	), $atts, 'indiasteel_breadcrumbs' );

	ob_start();
	$home_url = home_url( '/' );
	?>
	<section class="steel-page-banner">
		<div class="steel-container">
			<?php if ( ! empty( $atts['badge'] ) ) : ?>
				<div class="banner-badge">
					<i class="fa-solid fa-shield-halved"></i> <?php echo esc_html( $atts['badge'] ); ?>
				</div>
			<?php endif; ?>

			<h1 class="banner-title"><?php echo esc_html( $atts['title'] ); ?></h1>
			<p class="banner-desc"><?php echo esc_html( $atts['subtitle'] ); ?></p>

			<nav aria-label="Breadcrumb">
				<ul class="steel-breadcrumbs">
					<li>
						<a href="<?php echo esc_url( $home_url ); ?>">
							<i class="fa-solid fa-house"></i> Home
						</a>
					</li>
					<li><span class="separator"><i class="fa-solid fa-chevron-right"></i></span></li>
					<li class="current"><?php echo esc_html( $atts['current'] ); ?></li>
				</ul>
			</nav>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_breadcrumbs', 'indiasteel_breadcrumbs_shortcode' );

/**
 * Shortcode: Hero Image Slider
 */
function indiasteel_hero_slider_shortcode() {
	ob_start();
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	?>
	<div class="steel-hero-slider-wrap">
		<div class="steel-slider-container">
			<!-- Slide 1: Scrap Yard -->
			<div class="steel-slide active" style="background-image: url('<?php echo esc_url( $img_base . 'hero-slide-scrap.jpg' ); ?>');">
				<div class="steel-slide-overlay"></div>
				<div class="steel-container">
					<div class="steel-slide-content">
						<div class="slide-badge">
							<i class="fa-solid fa-recycle"></i> Industrial Scrap Procurement
						</div>
						<h1 class="slide-title">
							Highest Spot Rates &amp; <span class="accent">Instant RTGS</span> For Scrap
						</h1>
						<p class="slide-subtitle">
							Heavy Melting Scrap (HMS 1 &amp; 2), factory turnings, rail cuttings, and plant demolition steel.
						</p>
						<div class="slide-pills-row">
							<div class="slide-pill"><i class="fa-solid fa-scale-balanced"></i> 100% Calibrated Weighbridge</div>
							<div class="slide-pill"><i class="fa-solid fa-bolt"></i> Immediate Payment</div>
							<div class="slide-pill"><i class="fa-solid fa-truck-pickup"></i> Free Yard Pickup</div>
						</div>
						<div class="hero-cta-group">
							<a href="tel:+919876543210" class="btn-primary-steel btn-pulse">
								<i class="fa-solid fa-phone-volume"></i> Call Now: +91 98765 43210
							</a>
							<a href="#quick-quote" class="btn-secondary-steel">
								<i class="fa-solid fa-clipboard-list"></i> Enquiry Form
							</a>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20have%20scrap%20metal%20to%20sell.%20Please%20quote%20today's%20rate." target="_blank" class="btn-whatsapp-steel">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp Quote
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Slide 2: Rolling Mill & Finished Steel -->
			<div class="steel-slide" style="background-image: url('<?php echo esc_url( $img_base . 'hero-slide-mill.jpg' ); ?>');">
				<div class="steel-slide-overlay"></div>
				<div class="steel-container">
					<div class="steel-slide-content">
						<div class="slide-badge">
							<i class="fa-solid fa-industry"></i> Direct Primary Mill Supply
						</div>
						<h2 class="slide-title">
							Certified <span class="accent">TMT Rebars (Fe 550D)</span>, Beams &amp; Billets
						</h2>
						<p class="slide-subtitle">
							BIS certified primary steel, induction billets, and structural sections with mill test certificates.
						</p>
						<div class="slide-pills-row">
							<div class="slide-pill"><i class="fa-solid fa-certificate"></i> Mill Test Reports (MTC)</div>
							<div class="slide-pill"><i class="fa-solid fa-cubes-stacked"></i> 5,000+ MT Yard Stock</div>
							<div class="slide-pill"><i class="fa-solid fa-tag"></i> Direct Mill Parity</div>
						</div>
						<div class="hero-cta-group">
							<a href="tel:+919876543210" class="btn-primary-steel btn-pulse">
								<i class="fa-solid fa-phone-volume"></i> Call Now: +91 98765 43210
							</a>
							<a href="#quick-quote" class="btn-secondary-steel">
								<i class="fa-solid fa-file-invoice"></i> Request Mill Rates
							</a>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20need%20a%20rate%20quote%20for%20TMT%20Rebars%20and%20Prime%20Steel." target="_blank" class="btn-whatsapp-steel">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp Sales
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Slide 3: Weighbridge & Logistics -->
			<div class="steel-slide" style="background-image: url('<?php echo esc_url( $img_base . 'hero-slide-weighbridge.jpg' ); ?>');">
				<div class="steel-slide-overlay"></div>
				<div class="steel-container">
					<div class="steel-slide-content">
						<div class="slide-badge">
							<i class="fa-solid fa-truck-moving"></i> 100 MT Weighbridge &amp; Fleet
						</div>
						<h2 class="slide-title">
							Precision Weighing &amp; <span class="accent">Nationwide Fleet</span> Dispatch
						</h2>
						<p class="slide-subtitle">
							Computerized electronic weighbridge terminal, on-site spectrometer metal testing, and 24-hour turnaround.
						</p>
						<div class="slide-pills-row">
							<div class="slide-pill"><i class="fa-solid fa-print"></i> Computerized Tare &amp; Gross</div>
							<div class="slide-pill"><i class="fa-solid fa-microchip"></i> Spectrometer Verified</div>
							<div class="slide-pill"><i class="fa-solid fa-clock-rotate-left"></i> 24-Hour Clearance</div>
						</div>
						<div class="hero-cta-group">
							<a href="tel:+919876543210" class="btn-primary-steel btn-pulse">
								<i class="fa-solid fa-phone-volume"></i> Call Now: +91 98765 43210
							</a>
							<a href="#quick-quote" class="btn-secondary-steel">
								<i class="fa-solid fa-calendar-check"></i> Book Weighbridge
							</a>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20want%20to%20dispatch%20material%20to%20your%20yard." target="_blank" class="btn-whatsapp-steel">
								<i class="fa-brands fa-whatsapp"></i> Chat with Yard
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Controls -->
		<button class="slider-arrow prev" aria-label="Previous slide"><i class="fa-solid fa-chevron-left"></i></button>
		<button class="slider-arrow next" aria-label="Next slide"><i class="fa-solid fa-chevron-right"></i></button>

		<div class="slider-dots">
			<div class="slider-dot active"></div>
			<div class="slider-dot"></div>
			<div class="slider-dot"></div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_hero_slider', 'indiasteel_hero_slider_shortcode' );

/**
 * Shortcode: Quick Rate Enquiry Ribbon (Hero Fold Docked)
 */
function indiasteel_enquiry_ribbon_shortcode() {
	ob_start();
	?>
	<div class="quick-enquiry-ribbon" id="quick-quote">
		<div class="steel-container">
			<form class="ribbon-form">
				<select name="deal_type" class="ribbon-select">
					<option value="I Want to Sell Scrap to IndiaSteel">⚡ Sell Scrap to Us</option>
					<option value="I Want to Buy Steel from IndiaSteel">🏗️ Buy Steel from Us</option>
				</select>

				<input type="text" name="client_name" class="ribbon-input" placeholder="Your Name / Company" required>

				<select name="material_category" class="ribbon-select">
					<option value="Heavy Melting Scrap (HMS 1 & 2)">Heavy Melting Scrap (HMS 1 &amp; 2)</option>
					<option value="TMT Rebars (Fe 550D / 500D)">TMT Rebars (Fe 550D / 500D)</option>
					<option value="MS Billets &amp; Ingots">MS Billets &amp; Ingots</option>
					<option value="Structural Angles, Channels &amp; Beams">Angles, Channels &amp; Beams</option>
					<option value="Stainless Steel Scrap (SS 304/316)">Stainless Steel Scrap</option>
					<option value="Steel Pipes &amp; Hollow Sections">Steel Pipes &amp; Tubes</option>
				</select>

				<input type="tel" name="client_phone" class="ribbon-input" placeholder="WhatsApp / Phone" required>

				<button type="submit" class="btn-ribbon-submit">
					<i class="fa-brands fa-whatsapp"></i> Get Instant Quote
				</button>
			</form>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_enquiry_ribbon', 'indiasteel_enquiry_ribbon_shortcode' );

/**
 * Shortcode: Interactive 8-Card Visual Product Gallery (Clean, Minimal Text)
 */
function indiasteel_visual_product_gallery_shortcode() {
	ob_start();
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	?>
	<section class="showcase-gallery-section" id="showcase-gallery">
		<div class="steel-container">
			<div class="section-header" style="margin-bottom: 35px;">
				<span class="section-subtitle-tag">VISUAL MATERIAL CATALOGUE</span>
				<h2 class="section-title">Prime Steel Products &amp; Graded Scrap</h2>
				<p class="section-desc">Browse our certified industrial product inventory with on-site weighbridge verification and daily mill parity rates.</p>
			</div>

			<!-- Filter Tabs -->
			<div class="showcase-filter-tabs">
				<button class="showcase-tab-btn active" data-filter="all">All Products (8)</button>
				<button class="showcase-tab-btn" data-filter="scrap">Scrap Metals (3)</button>
				<button class="showcase-tab-btn" data-filter="prime">Prime Steel (3)</button>
				<button class="showcase-tab-btn" data-filter="operations">Yard Operations (2)</button>
			</div>

			<!-- 8 High-Visual Cards -->
			<div class="showcase-grid">
				<!-- 1. HMS Scrap -->
				<div class="showcase-item-card" data-category="scrap">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-scrap.jpg' ); ?>" alt="Heavy Melting Scrap HMS 1 & 2" />
						<span class="showcase-badge" style="background:#ea580c;">Scrap Metal</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">Heavy Melting Scrap (HMS 1 &amp; 2)</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-weight-hanging" style="color:#ea580c;"></i> ISRI 200-206 • 6mm+ • Min 10 MT
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Heavy Melting Scrap (HMS 1 & 2)">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20Heavy%20Melting%20Scrap%20HMS." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 2. TMT Rebars -->
				<div class="showcase-item-card" data-category="prime">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-mill.jpg' ); ?>" alt="Certified TMT Rebars Fe 550D" />
						<span class="showcase-badge" style="background:#0284c7;">Prime Steel</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">Certified TMT Rebars (Fe 550D)</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-certificate" style="color:#0284c7;"></i> IS 1786 BIS • 8mm to 32mm • MTC
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Certified TMT Rebars Fe 550D">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20TMT%20Rebars%20Fe%20550D." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 3. MS Billets -->
				<div class="showcase-item-card" data-category="prime">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'gallery-billets.jpg' ); ?>" alt="Continuous Cast MS Billets" />
						<span class="showcase-badge" style="background:#0284c7;">Prime Steel</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">MS Billets &amp; Induction Ingots</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-cubes-stacked" style="color:#0284c7;"></i> IS 2830 • 100x100mm • Min 25 MT
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="MS Billets & Ingots">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20MS%20Billets%20and%20Ingots." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 4. Steel Pipes -->
				<div class="showcase-item-card" data-category="prime">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'gallery-pipes.jpg' ); ?>" alt="Industrial Pipes & Hollow Sections" />
						<span class="showcase-badge" style="background:#0284c7;">Prime Steel</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">Steel Pipes &amp; Hollow Sections</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-shapes" style="color:#0284c7;"></i> IS 1239/4923 • Round &amp; SHS/RHS
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Steel Pipes & Hollow Sections">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20Steel%20Pipes%20and%20Tubes." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 5. Stainless Steel Scrap -->
				<div class="showcase-item-card" data-category="scrap">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'gallery-stainless.jpg' ); ?>" alt="Stainless Steel Scrap SS 304 / 316" />
						<span class="showcase-badge" style="background:#ea580c;">Alloy Scrap</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">Stainless Steel Scrap (SS 304/316)</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-magnet" style="color:#ea580c;"></i> Non-Magnetic • XRF Gun Verified
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Stainless Steel Scrap (SS 304/316)">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20Stainless%20Steel%20Scrap." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 6. Hydraulic Shearing -->
				<div class="showcase-item-card" data-category="operations">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'gallery-shearing.jpg' ); ?>" alt="Hydraulic Heavy Scrap Shears" />
						<span class="showcase-badge" style="background:#475569;">Machinery</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">Hydraulic Alligator Scrap Shears</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-gears" style="color:#475569;"></i> High-Density Baling &amp; Custom Sizing
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Scrap Shearing & Sizing Service">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20need%20custom%20scrap%20shearing%20and%20processing." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 7. 100T Weighbridge -->
				<div class="showcase-item-card" data-category="operations">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-weighbridge.jpg' ); ?>" alt="100-Ton Electronic Weighbridge" />
						<span class="showcase-badge" style="background:#475569;">Calibration</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">100T Electronic Weighbridge</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-scale-balanced" style="color:#475569;"></i> Digital Loadcells • Computerized Slips
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Weighbridge Slot Booking">Book Slot</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20want%20to%20book%20a%20weighbridge%20slot." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- 8. Transport Fleet -->
				<div class="showcase-item-card" data-category="operations">
					<div class="showcase-img-wrap">
						<img src="<?php echo esc_url( $img_base . 'gallery-fleet.jpg' ); ?>" alt="Multi-Axle Fleet Logistics" />
						<span class="showcase-badge" style="background:#475569;">Logistics</span>
					</div>
					<div class="showcase-body">
						<h3 class="showcase-title">Multi-Axle Transport Fleet</h3>
						<div class="showcase-specs-pill">
							<i class="fa-solid fa-truck-fast" style="color:#475569;"></i> Pan-India Dispatch • 24-Hour Clearance
						</div>
						<div class="showcase-actions">
							<button class="btn-showcase-enquire btn-enquire-card" data-product="Fleet Transport Booking">Enquire</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20need%20bulk%20steel/scrap%20freight%20logistics." target="_blank" class="btn-showcase-wa">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Direct Contact Action Strip -->
			<div class="showcase-contact-strip">
				<div class="strip-text">
					<h3>Need Custom Steel Sizes or Instant Scrap Purchase?</h3>
					<p>Speak live with our chief weighbridge operator or prime steel sales desk.</p>
				</div>
				<div class="strip-buttons">
					<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20want%20to%20enquire%20about%20bulk%20materials%20from%20your%20showcase." target="_blank" class="btn-whatsapp-steel" style="font-size:14px; padding:12px 22px;">
						<i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
					</a>
					<a href="tel:+919876543210" class="btn-primary-steel" style="font-size:14px; padding:12px 22px;">
						<i class="fa-solid fa-phone"></i> Call Now: +91 98765 43210
					</a>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_visual_product_gallery', 'indiasteel_visual_product_gallery_shortcode' );

/**
 * Shortcode: Visual Scrap Yard & Processing Photo Gallery
 */
function indiasteel_yard_gallery_shortcode() {
	ob_start();
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	?>
	<section class="steel-gallery-section" id="yard-gallery">
		<div class="steel-container">
			<div class="section-header" style="margin-bottom: 25px;">
				<span class="section-subtitle-tag">FACILITY &amp; OPERATIONS TOUR</span>
				<h2 class="section-title">Inside IndiaSteel Yards &amp; Processing</h2>
				<p class="section-desc">Experience our 6-acre heavy processing terminal, high-tonnage shears, induction casting, and computerized weighbridge operations.</p>
			</div>

			<!-- Bento Filter Tabs -->
			<div class="bento-filter-nav">
				<button class="bento-filter-pill active" data-filter="all">All Operations (6)</button>
				<button class="bento-filter-pill" data-filter="scrap">Scrap Yard</button>
				<button class="bento-filter-pill" data-filter="mill">Steel Processing</button>
				<button class="bento-filter-pill" data-filter="weighbridge">Weighbridge &amp; Fleet</button>
			</div>

			<!-- 12-Column Modern Bento Grid -->
			<div class="bento-grid">
				<!-- Bento Item 1: Large Featured Hero Card (Span 7) -->
				<div class="bento-card bento-hero-card" data-category="scrap" data-title="Heavy Crane Magnet &amp; HMS Scrap Sorting Yard" data-desc="6-acre heavy scrap terminal sorting over 350 MT of ferrous materials daily." data-img="<?php echo esc_url( $img_base . 'hero-slide-scrap.jpg' ); ?>">
					<img src="<?php echo esc_url( $img_base . 'hero-slide-scrap.jpg' ); ?>" alt="Heavy Crane Magnet Scrap Sorting Yard" class="bento-img" />
					<div class="bento-live-badge">
						<span class="pulse-dot"></span> Live Yard: 6-Acre Terminal
					</div>
					<div class="bento-overlay">
						<span class="bento-tag">Primary Scrap Sorting</span>
						<h3 class="bento-title">Heavy Crane Magnet &amp; HMS Sorting Yard</h3>
						<p class="bento-micro-desc">ISRI 200-206 • 350 MT Daily Sorting • Computerized Weighbridge</p>
						<div class="bento-actions">
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20have%20scrap%20metal%20to%20sell." target="_blank" class="bento-cta-btn">
								<i class="fa-brands fa-whatsapp"></i> Chat with Yard Desk
							</a>
							<button class="bento-zoom-btn" title="View Full Photo"><i class="fa-solid fa-expand"></i></button>
						</div>
					</div>
				</div>

				<!-- Bento Item 2: Hydraulic Shears (Span 5 Top) -->
				<div class="bento-card bento-card-compact" data-category="scrap" data-title="Hydraulic Alligator Scrap Shears" data-desc="High-density scrap shearing and baling for furnace-ready feed." data-img="<?php echo esc_url( $img_base . 'gallery-shearing.jpg' ); ?>">
					<img src="<?php echo esc_url( $img_base . 'gallery-shearing.jpg' ); ?>" alt="Hydraulic Heavy Scrap Shears" class="bento-img" />
					<div class="bento-overlay">
						<span class="bento-tag">Processing Machinery</span>
						<h3 class="bento-title">Hydraulic Alligator Shears &amp; Baling</h3>
						<div class="bento-hover-pill"><i class="fa-solid fa-expand"></i> Click to Zoom</div>
					</div>
				</div>

				<!-- Bento Item 3: Induction Cast Billets (Span 5 Bottom) -->
				<div class="bento-card bento-card-compact" data-category="mill" data-title="Continuous Cast Induction Billets" data-desc="IS 2830 certified 100x100mm and 125x125mm high-grade billets." data-img="<?php echo esc_url( $img_base . 'gallery-billets.jpg' ); ?>">
					<img src="<?php echo esc_url( $img_base . 'gallery-billets.jpg' ); ?>" alt="Continuous Cast Induction Billets" class="bento-img" />
					<div class="bento-overlay">
						<span class="bento-tag">Metallurgy</span>
						<h3 class="bento-title">Continuous Cast Billets &amp; Ingots</h3>
						<div class="bento-hover-pill"><i class="fa-solid fa-expand"></i> Click to Zoom</div>
					</div>
				</div>

				<!-- Bento Item 4: 100T Weighbridge (Span 4) -->
				<div class="bento-card bento-card-sub" data-category="weighbridge" data-title="100-Ton Electronic Weighbridge" data-desc="Computerized digital tare &amp; gross scale with instant printed weight slips." data-img="<?php echo esc_url( $img_base . 'hero-slide-weighbridge.jpg' ); ?>">
					<img src="<?php echo esc_url( $img_base . 'hero-slide-weighbridge.jpg' ); ?>" alt="100-Ton Electronic Weighbridge" class="bento-img" />
					<div class="bento-overlay">
						<span class="bento-tag">Precision Scale</span>
						<h3 class="bento-title">100T Electronic Weighbridge</h3>
						<div class="bento-hover-pill"><i class="fa-solid fa-expand"></i> Click to Zoom</div>
					</div>
				</div>

				<!-- Bento Item 5: TMT Rebars Warehouse (Span 4) -->
				<div class="bento-card bento-card-sub" data-category="mill" data-title="Certified TMT Rebars Warehouse" data-desc="Ex-stock inventory of Fe 550D/500D rebars from primary mills." data-img="<?php echo esc_url( $img_base . 'hero-slide-mill.jpg' ); ?>">
					<img src="<?php echo esc_url( $img_base . 'hero-slide-mill.jpg' ); ?>" alt="Certified TMT Rebars Warehouse" class="bento-img" />
					<div class="bento-overlay">
						<span class="bento-tag">Ready Stock</span>
						<h3 class="bento-title">TMT Rebars (Fe 550D) Stock</h3>
						<div class="bento-hover-pill"><i class="fa-solid fa-expand"></i> Click to Zoom</div>
					</div>
				</div>

				<!-- Bento Item 6: Logistics Fleet (Span 4) -->
				<div class="bento-card bento-card-sub" data-category="weighbridge" data-title="Pan-India Multi-Axle Fleet" data-desc="25+ heavy trailer trucks providing 24-hour rapid site clearance." data-img="<?php echo esc_url( $img_base . 'gallery-fleet.jpg' ); ?>">
					<img src="<?php echo esc_url( $img_base . 'gallery-fleet.jpg' ); ?>" alt="Pan-India Logistics Fleet" class="bento-img" />
					<div class="bento-overlay">
						<span class="bento-tag">Nationwide Logistics</span>
						<h3 class="bento-title">Heavy Transport Fleet</h3>
						<div class="bento-hover-pill"><i class="fa-solid fa-expand"></i> Click to Zoom</div>
					</div>
				</div>
			</div>

			<!-- Interactive Lightbox Modal Component -->
			<div class="bento-lightbox-modal" id="bentoLightbox">
				<div class="bento-lightbox-backdrop"></div>
				<div class="bento-lightbox-content">
					<button class="bento-lightbox-close" aria-label="Close Preview">&times;</button>
					<div class="bento-lightbox-media">
						<img src="" alt="" id="lightboxImg" />
					</div>
					<div class="bento-lightbox-info">
						<h3 id="lightboxTitle"></h3>
						<p id="lightboxDesc"></p>
						<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20have%20an%20enquiry%20regarding%20your%20materials/operations." target="_blank" class="btn-whatsapp-steel" style="margin-top:14px; font-size:13px; padding:10px 18px; display:inline-flex;">
							<i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp About This
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_yard_gallery', 'indiasteel_yard_gallery_shortcode' );

/**
 * Shortcode: About Page Visual Mosaic & Facility Overview
 */
function indiasteel_about_mosaic_shortcode() {
	ob_start();
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	$home_url = home_url( '/' );
	?>
	<section class="about-mosaic-section">
		<div class="steel-container">
			<div class="about-grid-content">
				<div>
					<span class="section-subtitle-tag">INDUSTRIAL INFRASTRUCTURE</span>
					<h2 style="font-size: 34px; margin-bottom: 16px; color: var(--steel-heading);">
						6-Acre Processing Yard &amp; 100-Ton Calibrated Weighbridge
					</h2>
					<p style="color: var(--steel-muted); font-size: 15px; line-height: 1.8; margin-bottom: 20px;">
						Established in 1998, IndiaSteel operates one of North India's most advanced ferrous recycling terminals. With high-capacity hydraulic scrap shears, automated balers, and on-site optical spectrometers, we process over 85,000 MT of industrial scrap and prime steel annually.
					</p>

					<div class="about-facility-card">
						<h3 style="color: var(--steel-heading);">
							<i class="fa-solid fa-award" style="color:#ea580c;"></i> Certified Credentials &amp; Standards
						</h3>
						<ul class="buysell-features-list" style="margin-bottom: 0;">
							<li><span class="feature-bullet">✔</span> <strong>ISO 9001:2015 Certified</strong> Quality Management System.</li>
							<li><span class="feature-bullet">✔</span> <strong>Govt. Pollution Control Board</strong> Authorized Green Scrap Recycler.</li>
							<li><span class="feature-bullet">✔</span> <strong>Direct Mill Tie-ups:</strong> Authorized stockist for SAIL, RINL, JSPL &amp; TATA Steel distributors.</li>
							<li><span class="feature-bullet">✔</span> <strong>Dedicated Logistics:</strong> Fleet of 25+ trailers for 24-hour factory scrap clearance.</li>
						</ul>
					</div>

					<div style="display: flex; gap: 14px; margin-top: 25px;">
						<a href="<?php echo esc_url( $home_url . 'buy-sell/' ); ?>" class="btn-primary-steel">
							<i class="fa-solid fa-scale-balanced"></i> Trade With Us
						</a>
						<a href="tel:+919876543210" class="btn-secondary-steel">
							<i class="fa-solid fa-phone"></i> Call Yard Desk
						</a>
					</div>
				</div>

				<!-- 4-Image Mosaic Grid -->
				<div class="about-mosaic-images">
					<div class="mosaic-item">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-scrap.jpg' ); ?>" alt="Scrap Yard Sorting Crane" />
						<span class="mosaic-badge">Heavy Scrap Sorting Yard</span>
					</div>
					<div class="mosaic-item">
						<img src="<?php echo esc_url( $img_base . 'gallery-shearing.jpg' ); ?>" alt="Hydraulic Scrap Shears" />
						<span class="mosaic-badge">Hydraulic Alligator Shears</span>
					</div>
					<div class="mosaic-item">
						<img src="<?php echo esc_url( $img_base . 'gallery-billets.jpg' ); ?>" alt="Induction Billets & Ingots" />
						<span class="mosaic-badge">High-Grade MS Billets</span>
					</div>
					<div class="mosaic-item">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-weighbridge.jpg' ); ?>" alt="Electronic Weighbridge" />
						<span class="mosaic-badge">100T Electronic Scale</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_about_mosaic', 'indiasteel_about_mosaic_shortcode' );

/**
 * Shortcode: Metrics & Ticker
 */
function indiasteel_metrics_shortcode() {
	ob_start();
	?>
	<div class="steel-ticker-bar">
		<div class="steel-container">
			<div class="steel-ticker-grid">
				<div class="ticker-stat-item">
					<div class="ticker-number">85,000+ MT</div>
					<div class="ticker-label">Annual Scrap &amp; Steel Traded</div>
				</div>
				<div class="ticker-stat-item">
					<div class="ticker-number">1,400+</div>
					<div class="ticker-label">Industrial Clients &amp; Mills</div>
				</div>
				<div class="ticker-stat-item">
					<div class="ticker-number">100%</div>
					<div class="ticker-label">Same-Day RTGS Settlement</div>
				</div>
				<div class="ticker-stat-item">
					<div class="ticker-number">24 Hours</div>
					<div class="ticker-label">Scrap Yard Clearance Time</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_metrics', 'indiasteel_metrics_shortcode' );

/**
 * Shortcode: Products Section (Light Theme - No Add to Cart!)
 */
function indiasteel_products_shortcode() {
	ob_start();
	$img_base = get_stylesheet_directory_uri() . '/assets/images/';
	?>
	<section class="steel-products-section" id="products-catalog">
		<div class="steel-container">
			<div class="section-header">
				<span class="section-subtitle-tag">INDUSTRIAL MATERIAL CATALOGUE</span>
				<h2 class="section-title">Certified Steel &amp; Graded Scrap Products</h2>
				<p class="section-desc">
					Transparent bulk procurement for rolling mills, engineering fabricators, and construction contractors. Verified by computerized weighbridge and spectrometer analysis.
				</p>
			</div>

			<div class="steel-tab-filters">
				<button class="tab-filter-btn active" data-filter="all">All Materials (6)</button>
				<button class="tab-filter-btn" data-filter="scrap">Scrap Steel (3)</button>
				<button class="tab-filter-btn" data-filter="prime">Prime &amp; Structural Steel (3)</button>
			</div>

			<div class="steel-products-grid">
				<!-- Card 1: HMS 1 & 2 Scrap -->
				<div class="steel-product-card" data-category="scrap">
					<span class="product-card-badge product-badge-scrap">Scrap Metal</span>
					<div class="product-media">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-scrap.jpg' ); ?>" alt="Heavy Melting Scrap HMS 1 & 2" />
					</div>
					<div class="product-body">
						<div class="product-subtitle">ISRI Code 200 - 206</div>
						<h3 class="product-title">Heavy Melting Scrap (HMS 1 &amp; 2)</h3>
						<div class="product-specs">
							<div class="spec-row"><span class="spec-label">Thickness:</span><span class="spec-value">6mm+ (HMS 1) / 3mm+ (HMS 2)</span></div>
							<div class="spec-row"><span class="spec-label">Min Order:</span><span class="spec-value">10 Metric Tonnes</span></div>
							<div class="spec-row"><span class="spec-label">Use:</span><span class="spec-value">Induction &amp; Arc Furnaces</span></div>
						</div>
						<div class="product-card-actions">
							<button class="btn-enquire-card" data-product="Heavy Melting Scrap (HMS 1 & 2)">Enquire Rate</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20Heavy%20Melting%20Scrap%20(HMS%201%20and%202)." target="_blank" class="btn-whatsapp-card">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- Card 2: TMT Rebars -->
				<div class="steel-product-card" data-category="prime">
					<span class="product-card-badge product-badge-prime">Prime Steel</span>
					<div class="product-media">
						<img src="<?php echo esc_url( $img_base . 'hero-slide-mill.jpg' ); ?>" alt="TMT Rebars Fe 550D" />
					</div>
					<div class="product-body">
						<div class="product-subtitle">IS 1786 BIS Certified</div>
						<h3 class="product-title">TMT Rebars (Fe 550D / 500D)</h3>
						<div class="product-specs">
							<div class="spec-row"><span class="spec-label">Sizes:</span><span class="spec-value">8mm, 10mm, 12mm, 16mm, 20mm, 25mm, 32mm</span></div>
							<div class="spec-row"><span class="spec-label">Length:</span><span class="spec-value">12 Meters Standard</span></div>
							<div class="spec-row"><span class="spec-label">Report:</span><span class="spec-value">Mill Test Certificate (MTC)</span></div>
						</div>
						<div class="product-card-actions">
							<button class="btn-enquire-card" data-product="TMT Rebars (Fe 550D / 500D)">Enquire Rate</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20TMT%20Rebars%20Fe%20550D." target="_blank" class="btn-whatsapp-card">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- Card 3: MS Billets & Ingots -->
				<div class="steel-product-card" data-category="prime">
					<span class="product-card-badge product-badge-prime">Semi-Finished</span>
					<div class="product-media">
						<img src="<?php echo esc_url( $img_base . 'gallery-billets.jpg' ); ?>" alt="MS Billets & Ingots" />
					</div>
					<div class="product-body">
						<div class="product-subtitle">IS 2830 / IS 2831</div>
						<h3 class="product-title">MS Billets &amp; Ingots</h3>
						<div class="product-specs">
							<div class="spec-row"><span class="spec-label">Section:</span><span class="spec-value">100x100mm, 125x125mm, 150x150mm</span></div>
							<div class="spec-row"><span class="spec-label">Length:</span><span class="spec-value">6m to 12m Standard</span></div>
							<div class="spec-row"><span class="spec-label">Min Order:</span><span class="spec-value">25 Metric Tonnes</span></div>
						</div>
						<div class="product-card-actions">
							<button class="btn-enquire-card" data-product="MS Billets & Ingots">Enquire Rate</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20MS%20Billets%20and%20Ingots." target="_blank" class="btn-whatsapp-card">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- Card 4: Structural Steel Sections -->
				<div class="steel-product-card" data-category="prime">
					<span class="product-card-badge product-badge-prime">Structural Steel</span>
					<div class="product-media">
						<img src="<?php echo esc_url( $img_base . 'steel-sections.svg' ); ?>" alt="MS Angles, Channels & Beams" />
					</div>
					<div class="product-body">
						<div class="product-subtitle">IS 2062 Grade E250 / E350</div>
						<h3 class="product-title">MS Angles, Channels &amp; Beams</h3>
						<div class="product-specs">
							<div class="spec-row"><span class="spec-label">Profiles:</span><span class="spec-value">ISMB 100-600, ISMC 75-400, ISA 25-200</span></div>
							<div class="spec-row"><span class="spec-label">Origin:</span><span class="spec-value">SAIL / Jindal / Vizag Rolling</span></div>
							<div class="spec-row"><span class="spec-label">Test:</span><span class="spec-value">Complete Mill Test Report</span></div>
						</div>
						<div class="product-card-actions">
							<button class="btn-enquire-card" data-product="MS Angles, Channels & Beams">Enquire Rate</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20MS%20Angles,%20Channels%20and%20Beams." target="_blank" class="btn-whatsapp-card">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- Card 5: Stainless Steel Scrap -->
				<div class="steel-product-card" data-category="scrap">
					<span class="product-card-badge product-badge-scrap">Alloy Scrap</span>
					<div class="product-media">
						<img src="<?php echo esc_url( $img_base . 'gallery-stainless.jpg' ); ?>" alt="Stainless Steel Scrap SS 304 / 316" />
					</div>
					<div class="product-body">
						<div class="product-subtitle">Alloy Solids &amp; Turnings</div>
						<h3 class="product-title">Stainless Steel Scrap (SS 304 / 316)</h3>
						<div class="product-specs">
							<div class="spec-row"><span class="spec-label">Grades:</span><span class="spec-value">SS 304 (18/8), SS 316/316L, SS 310</span></div>
							<div class="spec-row"><span class="spec-label">Testing:</span><span class="spec-value">On-Site Spectrometer / XRF Gun</span></div>
							<div class="spec-row"><span class="spec-label">Payment:</span><span class="spec-value">Immediate Spot Rate RTGS</span></div>
						</div>
						<div class="product-card-actions">
							<button class="btn-enquire-card" data-product="Stainless Steel Scrap (SS 304 / 316)">Enquire Rate</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20Stainless%20Steel%20Scrap." target="_blank" class="btn-whatsapp-card">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>

				<!-- Card 6: Steel Pipes & Hollow Sections -->
				<div class="steel-product-card" data-category="prime">
					<span class="product-card-badge product-badge-prime">Pipes &amp; Tubes</span>
					<div class="product-media">
						<img src="<?php echo esc_url( $img_base . 'gallery-pipes.jpg' ); ?>" alt="Steel Pipes & Hollow Sections" />
					</div>
					<div class="product-body">
						<div class="product-subtitle">IS 1239 / IS 3589 / IS 4923</div>
						<h3 class="product-title">Steel Pipes &amp; Hollow Sections</h3>
						<div class="product-specs">
							<div class="spec-row"><span class="spec-label">Sizes:</span><span class="spec-value">15mm to 350mm NB / SHS / RHS</span></div>
							<div class="spec-row"><span class="spec-label">Thickness:</span><span class="spec-value">1.6mm to 10.0mm Light/Heavy</span></div>
							<div class="spec-row"><span class="spec-label">Finish:</span><span class="spec-value">Black Painted, Bare Oiled, GI</span></div>
						</div>
						<div class="product-card-actions">
							<button class="btn-enquire-card" data-product="Steel Pipes & Hollow Sections">Enquire Rate</button>
							<a href="https://wa.me/919876543210?text=Hello%20IndiaSteel,%20I%20am%20enquiring%20about%20rates%20for%20Steel%20Pipes%20and%20Tubes." target="_blank" class="btn-whatsapp-card">
								<i class="fa-brands fa-whatsapp"></i> WhatsApp
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_products', 'indiasteel_products_shortcode' );

/**
 * Shortcode: Buy & Sell Portal
 */
function indiasteel_buysell_shortcode() {
	ob_start();
	?>
	<section class="buysell-section" style="padding: 70px 0; background: #ffffff;">
		<div class="steel-container">
			<div class="section-header" style="margin-bottom: 30px;">
				<span class="section-subtitle-tag">TRANSPARENT INDUSTRIAL TRADING</span>
				<h2 class="section-title">Buy &amp; Sell Steel Materials With IndiaSteel</h2>
				<p class="section-desc">
					Direct wholesale trades, computer-calibrated weighbridge certificates, and same-day electronic RTGS settlements.
				</p>
			</div>

			<div class="buysell-dual-grid">
				<!-- Portal 1: Sell to Us -->
				<div class="buysell-card sell-card">
					<span class="buysell-icon-tag sell-tag">
						<i class="fa-solid fa-arrow-down-long"></i> Sell Scrap &amp; Surplus To Us
					</span>
					<h3>Instant Yard Purchase &amp; Payment</h3>
					<ul class="buysell-features-list">
						<li><span class="feature-bullet">✔</span> <strong>Top Market Value:</strong> Daily updated LME &amp; Indian Mandi index pricing.</li>
						<li><span class="feature-bullet">✔</span> <strong>Computerized Weighbridge:</strong> 100 MT electronic scale with instant printout.</li>
						<li><span class="feature-bullet">✔</span> <strong>Instant Settlement:</strong> Full RTGS/NEFT payment before vehicle leaves our yard.</li>
						<li><span class="feature-bullet">✔</span> <strong>Yard Pickup Fleet:</strong> Cranes and trailers deployed for lots over 15 MT.</li>
					</ul>
					<div style="display: flex; gap: 12px; flex-wrap: wrap;">
						<a href="tel:+919876543210" class="btn-primary-steel">
							<i class="fa-solid fa-phone"></i> Call Scrap Desk: +91 98765 43210
						</a>
						<a href="#quick-quote" class="btn-secondary-steel">
							<i class="fa-solid fa-file-invoice"></i> Submit Scrap
						</a>
					</div>
				</div>

				<!-- Portal 2: Buy from Us -->
				<div class="buysell-card buy-card">
					<span class="buysell-icon-tag buy-tag">
						<i class="fa-solid fa-arrow-up-long"></i> Buy Prime Steel From Us
					</span>
					<h3>Direct Mill Supply &amp; Graded Stock</h3>
					<ul class="buysell-features-list">
						<li><span class="feature-bullet">✔</span> <strong>Tested Quality:</strong> Original Mill Test Certificate (MTC) with each consignment.</li>
						<li><span class="feature-bullet">✔</span> <strong>Consistent Volume:</strong> Ready ex-stock yard inventory exceeding 5,000 MT.</li>
						<li><span class="feature-bullet">✔</span> <strong>Prompt Logistics:</strong> Direct multi-axle trailers dispatched to your project site.</li>
						<li><span class="feature-bullet">✔</span> <strong>Competitive Mill Parity:</strong> Transparent price quotation without middlemen.</li>
					</ul>
					<div style="display: flex; gap: 12px; flex-wrap: wrap;">
						<a href="tel:+919876543211" class="btn-primary-steel" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color:#ffffff !important;">
							<i class="fa-solid fa-phone"></i> Call Sales Desk: +91 98765 43211
						</a>
						<a href="#quick-quote" class="btn-secondary-steel">
							<i class="fa-solid fa-quote-left"></i> Request Mill Price
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_buysell', 'indiasteel_buysell_shortcode' );

/**
 * Shortcode: Contact Section (Light Theme - WhatsApp & Direct Call Main Focus)
 */
function indiasteel_contact_shortcode() {
	ob_start();
	$c_phone = get_option( 'is_footer_phone', '+91 98765 43210' );
	$c_whatsapp = get_option( 'is_footer_whatsapp', '+91 98765 43210' );
	$c_address = get_option( 'is_footer_address', 'Plot No. 84 - 86, Steel & Metal Market, Industrial Area Phase-II, New Delhi - 110020, India' );
	$c_email = get_option( 'is_footer_email', 'sales@indiasteel.example.com' );
	$c_clean_phone = preg_replace( '/[^0-9+]/', '', $c_phone );
	$c_clean_whatsapp = preg_replace( '/[^0-9]/', '', $c_whatsapp );
	$c_wa_msg = get_option( 'is_floating_whatsapp_msg', 'Hello IndiaSteel, I want to discuss a scrap/steel trade enquiry.' );
	?>
	<section class="steel-contact-section" id="contact">
		<div class="steel-container">
			<div class="contact-focus-headline" style="text-align: center; max-width: 680px; margin: 0 auto 40px;">
				<span class="section-subtitle-tag">DIRECT TRADING DESK</span>
				<h2 class="section-title">Connect Directly With Our Yard Traders</h2>
				<p class="section-desc">
					Skip the waiting queue. Speak live with our chief weighbridge operator or chat directly on WhatsApp.
				</p>
			</div>

			<!-- Main Focus: Chat Now via WhatsApp or Direct Call -->
			<div class="contact-channel-cards">
				<!-- Channel 1: WhatsApp (Primary Focus) -->
				<div class="channel-card channel-card-whatsapp">
					<div class="channel-icon-wrap">
						<i class="fa-brands fa-whatsapp"></i>
					</div>
					<h3>Chat Now via WhatsApp</h3>
					<p>Average response time under 5 minutes. Share photographs of scrap lots, mill requirements, or get instant rate updates.</p>
					<a href="https://wa.me/<?php echo esc_attr( $c_clean_whatsapp ); ?>?text=<?php echo rawurlencode( $c_wa_msg ); ?>" target="_blank" class="btn-channel-whatsapp">
						<i class="fa-brands fa-whatsapp"></i> Chat Now on WhatsApp
					</a>
				</div>

				<!-- Channel 2: Direct Call (Primary Focus) -->
				<div class="channel-card channel-card-phone">
					<div class="channel-icon-wrap">
						<i class="fa-solid fa-phone-volume"></i>
					</div>
					<h3>Direct Yard &amp; Sales Call</h3>
					<p>Speak live with our chief weighbridge operator or prime steel trader. Get binding price quotes and loading schedules.</p>
					<a href="tel:<?php echo esc_attr( $c_clean_phone ); ?>" class="btn-channel-phone">
						<i class="fa-solid fa-phone"></i> Call Now: <?php echo esc_html( $c_phone ); ?>
					</a>
				</div>
			</div>

			<!-- Yard Details & Map Overview -->
			<div class="contact-details-grid">
				<div class="yard-info-card">
					<h3 style="font-size: 20px; margin-bottom: 20px; border-bottom: 1px solid var(--steel-border); padding-bottom: 10px; color: var(--steel-heading);">
						<i class="fa-solid fa-warehouse" style="color:#ea580c;"></i> Yard &amp; Registered Office
					</h3>

					<div class="yard-info-item">
						<div class="yard-info-icon"><i class="fa-solid fa-location-dot"></i></div>
						<div class="yard-info-text">
							<strong>Central Stockyard &amp; Weighbridge:</strong>
							<span><?php echo esc_html( $c_address ); ?></span>
						</div>
					</div>

					<div class="yard-info-item">
						<div class="yard-info-icon"><i class="fa-solid fa-phone"></i></div>
						<div class="yard-info-text">
							<strong>Direct Telephone Lines:</strong>
							<span>Scrap Desk: <a href="tel:<?php echo esc_attr( $c_clean_phone ); ?>"><?php echo esc_html( $c_phone ); ?></a></span>
						</div>
					</div>

					<div class="yard-info-item">
						<div class="yard-info-icon"><i class="fa-solid fa-envelope"></i></div>
						<div class="yard-info-text">
							<strong>Official Email:</strong>
							<span><a href="mailto:<?php echo esc_attr( $c_email ); ?>"><?php echo esc_html( $c_email ); ?></a></span>
						</div>
					</div>

					<div class="yard-info-item">
						<div class="yard-info-icon"><i class="fa-regular fa-clock"></i></div>
						<div class="yard-info-text">
							<strong>Weighbridge &amp; Loading Hours:</strong>
							<span><?php echo esc_html( get_option( 'is_topbar_timing', 'Monday - Saturday: 8:00 AM – 7:30 PM' ) ); ?></span>
						</div>
					</div>
				</div>

				<div class="yard-info-card" style="background: #ffffff; display:flex; flex-direction:column; justify-content:center;">
					<h3 style="font-size: 18px; margin-bottom: 14px; color: var(--steel-heading);">
						<i class="fa-solid fa-file-shield" style="color:#0284c7;"></i> Verification &amp; Tax Compliance
					</h3>
					<div style="background:#f8fafc; border:1px solid var(--steel-border); border-radius:6px; padding:18px; font-size:13px;">
						<div style="margin-bottom:8px;"><strong>GSTIN:</strong> 07AAACI8492K1Z9</div>
						<div style="margin-bottom:8px;"><strong>PAN:</strong> AAACI8492K</div>
						<div style="margin-bottom:8px;"><strong>MSME Reg:</strong> UDYAM-DL-08-0049120</div>
						<div><strong>Scale Calibrated:</strong> Metrology Dept. Cert #2026/DL/902</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_contact', 'indiasteel_contact_shortcode' );

/**
 * Shortcode: IndiaSteel Footer (Grounding Dark Slate Theme)
 */
function indiasteel_footer_shortcode() {
	ob_start();
	$home_url = home_url( '/' );
	$custom_footer_logo = get_option( 'is_footer_logo' );
	if ( ! empty( $custom_footer_logo ) ) {
		$logo_url = $custom_footer_logo;
	} else {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		} else {
			$logo_url = get_stylesheet_directory_uri() . '/assets/images/indiasteel-logo.svg';
		}
	}
	$footer_about = get_option( 'is_footer_about', 'IndiaSteel Scrap & Steel Corporation is an established market leader in ferrous scrap procurement and certified prime structural steel supply.' );
	$badge_1 = get_option( 'is_badge_1', 'ISO 9001:2015' );
	$badge_2 = get_option( 'is_badge_2', 'Govt. Authorized' );
	$badge_3 = get_option( 'is_badge_3', '100T Scale' );

	$footer_address = get_option( 'is_footer_address', 'Plot 84-86, Industrial Area Phase II, New Delhi - 110020, India' );
	$footer_phone = get_option( 'is_footer_phone', '+91 98765 43210' );
	$footer_whatsapp = get_option( 'is_footer_whatsapp', '+91 98765 43210' );
	$footer_email = get_option( 'is_footer_email', 'sales@indiasteel.example.com' );

	$clean_footer_phone = preg_replace( '/[^0-9+]/', '', $footer_phone );
	$clean_whatsapp = preg_replace( '/[^0-9]/', '', $footer_whatsapp );

	$footer_copyright = get_option( 'is_footer_copyright', 'IndiaSteel Scrap & Steel Corporation. All Rights Reserved.' );
	$footer_tagline = get_option( 'is_footer_tagline', 'Modern Industrial Steel Theme | Clean & High-Volume Trading' );

	$whatsapp_msg = get_option( 'is_floating_whatsapp_msg', 'Hello IndiaSteel, I have an enquiry regarding Scrap or Steel.' );
	?>
	<footer class="indiasteel-footer" id="site-footer">
		<div class="steel-container">
			<div class="footer-top-grid">
				<!-- Col 1: About -->
				<div class="footer-about">
					<div style="margin-bottom: 18px;">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="IndiaSteel" style="height: 42px; width:auto;" />
					</div>
					<p>
						<?php echo esc_html( $footer_about ); ?>
					</p>
					<div class="footer-cert-badges">
						<?php if ( ! empty( $badge_1 ) ) : ?><span class="footer-badge-pill"><?php echo esc_html( $badge_1 ); ?></span><?php endif; ?>
						<?php if ( ! empty( $badge_2 ) ) : ?><span class="footer-badge-pill"><?php echo esc_html( $badge_2 ); ?></span><?php endif; ?>
						<?php if ( ! empty( $badge_3 ) ) : ?><span class="footer-badge-pill"><?php echo esc_html( $badge_3 ); ?></span><?php endif; ?>
					</div>
				</div>

				<!-- Col 2: Navigation -->
				<div>
					<h3 class="footer-widget-title"><?php echo esc_html( get_option( 'is_footer_col2_title', 'Quick Navigation' ) ); ?></h3>
					<ul class="footer-links-list">
						<li><a href="<?php echo esc_url( $home_url ); ?>">Home</a></li>
						<li><a href="<?php echo esc_url( $home_url . 'about/' ); ?>">About Us</a></li>
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>">Products Catalog</a></li>
						<li><a href="<?php echo esc_url( $home_url . 'showcase/' ); ?>">Showcase</a></li>
						<li><a href="<?php echo esc_url( $home_url . 'buy-sell/' ); ?>">Buy &amp; Sell Portal</a></li>
						<li><a href="<?php echo esc_url( $home_url . 'contact/' ); ?>">Contact &amp; Yard Details</a></li>
					</ul>
				</div>

				<!-- Col 3: Categories -->
				<div>
					<h3 class="footer-widget-title"><?php echo esc_html( get_option( 'is_footer_col3_title', 'Steel Categories' ) ); ?></h3>
					<ul class="footer-links-list">
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>"><?php echo esc_html( get_option( 'is_cat_1', 'Heavy Melting Scrap (HMS)' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>"><?php echo esc_html( get_option( 'is_cat_2', 'TMT Rebars (Fe 550D)' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>"><?php echo esc_html( get_option( 'is_cat_3', 'MS Billets & Ingots' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>"><?php echo esc_html( get_option( 'is_cat_4', 'MS Angles & Channels' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>"><?php echo esc_html( get_option( 'is_cat_5', 'Stainless Steel Scrap' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( $home_url . 'products/' ); ?>"><?php echo esc_html( get_option( 'is_cat_6', 'Steel Pipes & Tubes' ) ); ?></a></li>
					</ul>
				</div>

				<!-- Col 4: Contact -->
				<div>
					<h3 class="footer-widget-title"><?php echo esc_html( get_option( 'is_footer_col4_title', 'Yard Location & Contact' ) ); ?></h3>
					<div class="footer-contact-item">
						<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
						<span><?php echo esc_html( $footer_address ); ?></span>
					</div>
					<div class="footer-contact-item">
						<span class="icon"><i class="fa-solid fa-phone"></i></span>
						<span><a href="tel:<?php echo esc_attr( $clean_footer_phone ); ?>" style="color:#fbbf24; font-weight:700;"><?php echo esc_html( $footer_phone ); ?></a></span>
					</div>
					<div class="footer-contact-item">
						<span class="icon"><i class="fa-brands fa-whatsapp"></i></span>
						<span><a href="https://wa.me/<?php echo esc_attr( $clean_whatsapp ); ?>" target="_blank" style="color:#22c55e; font-weight:700;">WhatsApp: <?php echo esc_html( $footer_whatsapp ); ?></a></span>
					</div>
					<div class="footer-contact-item">
						<span class="icon"><i class="fa-solid fa-envelope"></i></span>
						<span><?php echo esc_html( $footer_email ); ?></span>
					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<div>
					&copy; <?php echo date('Y'); ?> <?php echo esc_html( $footer_copyright ); ?>
				</div>
				<div style="font-size: 12px; color: #94a3b8;">
					<?php echo esc_html( $footer_tagline ); ?>
				</div>
			</div>
		</div>
	</footer>

	<!-- Sticky Floating WhatsApp & Direct Call Bar -->
	<div class="steel-floating-cta">
		<a href="https://wa.me/<?php echo esc_attr( $clean_whatsapp ); ?>?text=<?php echo rawurlencode( $whatsapp_msg ); ?>" target="_blank" class="floating-whatsapp-btn" title="Chat on WhatsApp">
			<i class="fa-brands fa-whatsapp"></i>
		</a>
		<a href="tel:<?php echo esc_attr( $clean_footer_phone ); ?>" class="floating-call-btn" title="Direct Call">
			<i class="fa-solid fa-phone"></i>
		</a>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'indiasteel_footer', 'indiasteel_footer_shortcode' );

/**
 * Replace Default Hello Elementor Header and Footer with IndiaSteel Templates
 */
function indiasteel_custom_header() {
	echo do_shortcode( '[indiasteel_header]' );
}
function indiasteel_custom_footer() {
	echo do_shortcode( '[indiasteel_footer]' );
}

add_action( 'hello_elementor_header', 'indiasteel_custom_header' );
add_action( 'hello_elementor_footer', 'indiasteel_custom_footer' );

/**
 * Register IndiaSteel Theme Settings Page in WP Admin
 */
function indiasteel_add_admin_menu() {
	add_menu_page(
		'IndiaSteel Settings',
		'IndiaSteel Settings',
		'manage_options',
		'indiasteel-settings',
		'indiasteel_settings_page_html',
		'dashicons-hammer',
		59
	);
}
add_action( 'admin_menu', 'indiasteel_add_admin_menu' );

/**
 * Enqueue scripts for IndiaSteel Settings Page
 */
function indiasteel_admin_scripts( $hook ) {
	if ( 'toplevel_page_indiasteel-settings' !== $hook ) {
		return;
	}
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'indiasteel_admin_scripts' );

/**
 * Register settings
 */
function indiasteel_register_settings() {
	$settings = array(
		// Logos
		'is_header_logo',
		'is_footer_logo',
		// Topbar
		'is_topbar_badge',
		'is_topbar_scale',
		'is_topbar_location',
		'is_topbar_timing',
		'is_topbar_settlement',
		// Header
		'is_header_phone',
		'is_header_call_text',
		// Footer Col 1
		'is_footer_about',
		'is_badge_1',
		'is_badge_2',
		'is_badge_3',
		// Footer Col 2 & 3
		'is_footer_col2_title',
		'is_footer_col3_title',
		'is_cat_1',
		'is_cat_2',
		'is_cat_3',
		'is_cat_4',
		'is_cat_5',
		'is_cat_6',
		// Footer Col 4 Contact
		'is_footer_col4_title',
		'is_footer_address',
		'is_footer_phone',
		'is_footer_whatsapp',
		'is_footer_email',
		// Footer Bottom & CTA
		'is_footer_copyright',
		'is_footer_tagline',
		'is_floating_whatsapp_msg',
	);

	foreach ( $settings as $setting ) {
		register_setting( 'indiasteel_settings_group', $setting, 'sanitize_text_field' );
	}
}
add_action( 'admin_init', 'indiasteel_register_settings' );

/**
 * Settings Page HTML
 */
function indiasteel_settings_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$header_logo = get_option( 'is_header_logo', '' );
	$footer_logo = get_option( 'is_footer_logo', '' );
	?>
	<div class="wrap" style="max-width: 960px;">
		<div style="background:linear-gradient(135deg, #1e293b, #0f172a); color:#fff; padding:24px 28px; border-radius:10px; margin-top:20px; box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);">
			<h1 style="color:#fff; margin:0 0 8px 0; font-size:24px; display:flex; align-items:center; gap:10px;">
				<span class="dashicons dashicons-hammer" style="font-size:28px; width:28px; height:28px; color:#f97316;"></span>
				IndiaSteel Header &amp; Footer Management
			</h1>
			<p style="margin:0; color:#94a3b8; font-size:14px;">
				यहाँ से आप वेबसाइट के <strong>Topbar</strong>, <strong>Header (Logo + Menu + Call Button)</strong> और <strong>Footer (Links, Address, Phone, WhatsApp)</strong> की सभी जानकारियाँ आसानी से बदल सकती हैं।
			</p>
		</div>

		<?php settings_errors(); ?>

		<form method="post" action="options.php" style="background:#fff; padding:28px 32px; border-radius:10px; box-shadow:0 1px 3px rgba(0,0,0,0.08); margin-top:20px;">
			<?php settings_fields( 'indiasteel_settings_group' ); ?>

			<!-- Section 1: Topbar -->
			<div style="background:#fff7ed; border-left:4px solid #ea580c; padding:12px 18px; border-radius:4px; margin-bottom:15px;">
				<h2 style="margin:0; color:#9a3412; font-size:18px;">1. Topbar Settings (ऊपर की पट्टी)</h2>
				<p style="margin:4px 0 0 0; color:#7c2d12; font-size:13px;">वेबसाइट के सबसे ऊपर दिखने वाले लाइव बैज, कांटा (Weighbridge), लोकेशन और टाइमिंग्स बदलें।</p>
			</div>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="is_topbar_badge">Topbar Badge (पीला/नारंगी टैग)</label></th>
					<td>
						<input name="is_topbar_badge" type="text" id="is_topbar_badge" value="<?php echo esc_attr( get_option( 'is_topbar_badge', 'Live Scrap Market' ) ); ?>" class="regular-text" />
						<p class="description">उदा: Live Scrap Market या Today Scrap Rate</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_topbar_scale">Weighbridge / Scale Text</label></th>
					<td>
						<input name="is_topbar_scale" type="text" id="is_topbar_scale" value="<?php echo esc_attr( get_option( 'is_topbar_scale', '100T Electronic Weighbridge On-Site' ) ); ?>" class="large-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_topbar_location">Location / Area</label></th>
					<td>
						<input name="is_topbar_location" type="text" id="is_topbar_location" value="<?php echo esc_attr( get_option( 'is_topbar_location', 'Industrial Area Ph-II, New Delhi' ) ); ?>" class="large-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_topbar_timing">Yard Working Hours</label></th>
					<td>
						<input name="is_topbar_timing" type="text" id="is_topbar_timing" value="<?php echo esc_attr( get_option( 'is_topbar_timing', '8:00 AM - 7:30 PM (Mon-Sat)' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_topbar_settlement">Settlements Notice</label></th>
					<td>
						<input name="is_topbar_settlement" type="text" id="is_topbar_settlement" value="<?php echo esc_attr( get_option( 'is_topbar_settlement', 'Immediate RTGS Scrap Settlements' ) ); ?>" class="large-text" />
					</td>
				</tr>
			</table>

			<hr style="border:0; border-top:1px solid #e2e8f0; margin:25px 0;" />

			<!-- Section 2: Header -->
			<div style="background:#eff6ff; border-left:4px solid #2563eb; padding:12px 18px; border-radius:4px; margin-bottom:15px;">
				<h2 style="margin:0; color:#1e40af; font-size:18px;">2. Header Settings (लोगो, मेनू और कॉल बटन)</h2>
				<p style="margin:4px 0 0 0; color:#1d4ed8; font-size:13px;">हेडर का लोगो, कॉल बटन का टेक्स्ट और फ़ोन नंबर यहाँ से बदलें।</p>
			</div>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="is_header_logo">Header Logo (वेबसाइट लोगो)</label></th>
					<td>
						<div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
							<input name="is_header_logo" type="text" id="is_header_logo" value="<?php echo esc_attr( $header_logo ); ?>" class="large-text" placeholder="https://.../logo.png" />
							<button type="button" class="button button-secondary" id="upload_header_logo_btn">Choose Logo (लोगो चुनें)</button>
						</div>
						<div id="header_logo_preview_wrap" style="background:#f1f5f9; padding:8px 12px; display:inline-block; border-radius:4px;">
							<img id="header_logo_preview" src="<?php echo esc_url( $header_logo ? $header_logo : get_stylesheet_directory_uri() . '/assets/images/indiasteel-logo-dark.svg' ); ?>" style="max-height:45px; width:auto; vertical-align:middle;" alt="Header Logo Preview" />
						</div>
						<p class="description">नया लोगो चुनने के लिए "Choose Logo" बटन दबाएँ। (खाली छोड़ने पर डिफ़ॉल्ट लोगो दिखेगा)</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label>Navigation Menu (मेनू)</label></th>
					<td>
						<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="button button-secondary" target="_blank">
							<span class="dashicons dashicons-menu" style="vertical-align:text-top; margin-right:4px;"></span>
							Click Here to Edit Menu (मेनू बदलने के लिए यहाँ क्लिक करें)
						</a>
						<p class="description">हेडर का मेनू (Home, About, Products, आदि) WordPress के Menus पेज से आसानी से मैनेज होता है।</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_header_call_text">Quick Call Button Text</label></th>
					<td>
						<input name="is_header_call_text" type="text" id="is_header_call_text" value="<?php echo esc_attr( get_option( 'is_header_call_text', 'Call Now: +91 98765 43210' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_header_phone">Header Call Phone Number</label></th>
					<td>
						<input name="is_header_phone" type="text" id="is_header_phone" value="<?php echo esc_attr( get_option( 'is_header_phone', '+91 98765 43210' ) ); ?>" class="regular-text" />
						<p class="description">बटन दबाते ही जिस नंबर पर कॉल जाएगी</p>
					</td>
				</tr>
			</table>

			<hr style="border:0; border-top:1px solid #e2e8f0; margin:25px 0;" />

			<!-- Section 3: Footer -->
			<div style="background:#f8fafc; border-left:4px solid #475569; padding:12px 18px; border-radius:4px; margin-bottom:15px;">
				<h2 style="margin:0; color:#0f172a; font-size:18px;">3. Footer Settings (फुटर - 4 कॉलम)</h2>
				<p style="margin:4px 0 0 0; color:#475569; font-size:13px;">फुटर का लोगो, अबाउट टेक्स्ट, बैज, केटेगरी लिंक्स और कॉन्टैक्ट डिटेल्स बदलें।</p>
			</div>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="is_footer_logo">Footer Logo (फुटर लोगो)</label></th>
					<td>
						<div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
							<input name="is_footer_logo" type="text" id="is_footer_logo" value="<?php echo esc_attr( $footer_logo ); ?>" class="large-text" placeholder="https://.../logo-white.png" />
							<button type="button" class="button button-secondary" id="upload_footer_logo_btn">Choose Logo (लोगो चुनें)</button>
						</div>
						<div id="footer_logo_preview_wrap" style="background:#0f172a; padding:8px 12px; display:inline-block; border-radius:4px;">
							<img id="footer_logo_preview" src="<?php echo esc_url( $footer_logo ? $footer_logo : get_stylesheet_directory_uri() . '/assets/images/indiasteel-logo.svg' ); ?>" style="max-height:40px; width:auto; vertical-align:middle;" alt="Footer Logo Preview" />
						</div>
						<p class="description">फुटर के डार्क बैकग्राउंड के लिए हल्का/सफेद लोगो चुनें।</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_about">Footer Column 1: About Us Text</label></th>
					<td>
						<textarea name="is_footer_about" id="is_footer_about" rows="3" class="large-text"><?php echo esc_textarea( get_option( 'is_footer_about', 'IndiaSteel Scrap & Steel Corporation is an established market leader in ferrous scrap procurement and certified prime structural steel supply.' ) ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label>Footer Trust Badges (3 बैज)</label></th>
					<td>
						<input name="is_badge_1" type="text" value="<?php echo esc_attr( get_option( 'is_badge_1', 'ISO 9001:2015' ) ); ?>" style="width:150px; margin-right:8px;" placeholder="Badge 1" />
						<input name="is_badge_2" type="text" value="<?php echo esc_attr( get_option( 'is_badge_2', 'Govt. Authorized' ) ); ?>" style="width:150px; margin-right:8px;" placeholder="Badge 2" />
						<input name="is_badge_3" type="text" value="<?php echo esc_attr( get_option( 'is_badge_3', '100T Scale' ) ); ?>" style="width:150px;" placeholder="Badge 3" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_col2_title">Column 2 Heading</label></th>
					<td>
						<input name="is_footer_col2_title" type="text" id="is_footer_col2_title" value="<?php echo esc_attr( get_option( 'is_footer_col2_title', 'Quick Navigation' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_col3_title">Column 3 Heading</label></th>
					<td>
						<input name="is_footer_col3_title" type="text" id="is_footer_col3_title" value="<?php echo esc_attr( get_option( 'is_footer_col3_title', 'Steel Categories' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label>Steel Categories (6 प्रोडक्ट्स)</label></th>
					<td>
						<div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; max-width:650px;">
							<input name="is_cat_1" type="text" value="<?php echo esc_attr( get_option( 'is_cat_1', 'Heavy Melting Scrap (HMS)' ) ); ?>" placeholder="Product 1" />
							<input name="is_cat_2" type="text" value="<?php echo esc_attr( get_option( 'is_cat_2', 'TMT Rebars (Fe 550D)' ) ); ?>" placeholder="Product 2" />
							<input name="is_cat_3" type="text" value="<?php echo esc_attr( get_option( 'is_cat_3', 'MS Billets & Ingots' ) ); ?>" placeholder="Product 3" />
							<input name="is_cat_4" type="text" value="<?php echo esc_attr( get_option( 'is_cat_4', 'MS Angles & Channels' ) ); ?>" placeholder="Product 4" />
							<input name="is_cat_5" type="text" value="<?php echo esc_attr( get_option( 'is_cat_5', 'Stainless Steel Scrap' ) ); ?>" placeholder="Product 5" />
							<input name="is_cat_6" type="text" value="<?php echo esc_attr( get_option( 'is_cat_6', 'Steel Pipes & Tubes' ) ); ?>" placeholder="Product 6" />
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_col4_title">Column 4 Heading</label></th>
					<td>
						<input name="is_footer_col4_title" type="text" id="is_footer_col4_title" value="<?php echo esc_attr( get_option( 'is_footer_col4_title', 'Yard Location & Contact' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_address">Yard Address (यार्ड का पता)</label></th>
					<td>
						<textarea name="is_footer_address" id="is_footer_address" rows="2" class="large-text"><?php echo esc_textarea( get_option( 'is_footer_address', 'Plot 84-86, Industrial Area Phase II, New Delhi - 110020, India' ) ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_phone">Footer Phone Number</label></th>
					<td>
						<input name="is_footer_phone" type="text" id="is_footer_phone" value="<?php echo esc_attr( get_option( 'is_footer_phone', '+91 98765 43210' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_whatsapp">Footer WhatsApp Number</label></th>
					<td>
						<input name="is_footer_whatsapp" type="text" id="is_footer_whatsapp" value="<?php echo esc_attr( get_option( 'is_footer_whatsapp', '+91 98765 43210' ) ); ?>" class="regular-text" />
						<p class="description">उदा: +91 98765 43210 (Country code के साथ)</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_email">Official Email (ईमेल)</label></th>
					<td>
						<input name="is_footer_email" type="email" id="is_footer_email" value="<?php echo esc_attr( get_option( 'is_footer_email', 'sales@indiasteel.example.com' ) ); ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_copyright">Copyright Text</label></th>
					<td>
						<input name="is_footer_copyright" type="text" id="is_footer_copyright" value="<?php echo esc_attr( get_option( 'is_footer_copyright', 'IndiaSteel Scrap & Steel Corporation. All Rights Reserved.' ) ); ?>" class="large-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_footer_tagline">Bottom Tagline</label></th>
					<td>
						<input name="is_footer_tagline" type="text" id="is_footer_tagline" value="<?php echo esc_attr( get_option( 'is_footer_tagline', 'Modern Industrial Steel Theme | Clean & High-Volume Trading' ) ); ?>" class="large-text" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="is_floating_whatsapp_msg">Floating WhatsApp Message</label></th>
					<td>
						<input name="is_floating_whatsapp_msg" type="text" id="is_floating_whatsapp_msg" value="<?php echo esc_attr( get_option( 'is_floating_whatsapp_msg', 'Hello IndiaSteel, I have an enquiry regarding Scrap or Steel.' ) ); ?>" class="large-text" />
						<p class="description">जब कोई ग्राहक स्क्रीन पर दिखने वाले WhatsApp बटन को दबाएगा तो चैट में यह मैसेज पहले से लिखा आएगा।</p>
					</td>
				</tr>
			</table>

			<div style="position:sticky; bottom:20px; background:#f8fafc; padding:15px 20px; border:1px solid #e2e8f0; border-radius:6px; margin-top:25px; display:flex; align-items:center; justify-content:space-between;">
				<span style="color:#64748b; font-size:13px;">बदलाव करने के बाद सेव बटन दबाना न भूलें:</span>
				<?php submit_button( 'Save Changes (सेव करें)', 'primary', 'submit', false, array( 'style' => 'background:#ea580c; border-color:#ea580c; font-size:15px; padding:6px 24px;' ) ); ?>
			</div>
		</form>
	</div>

	<script>
	jQuery(document).ready(function($){
		function setupLogoUploader(btnId, inputId, previewId) {
			$(btnId).on('click', function(e){
				e.preventDefault();
				var frame = wp.media({
					title: 'Select or Upload Logo',
					button: { text: 'Use this Logo' },
					multiple: false
				});
				frame.on('select', function(){
					var attachment = frame.state().get('selection').first().toJSON();
					$(inputId).val(attachment.url);
					$(previewId).attr('src', attachment.url);
				});
				frame.open();
			});
		}
		setupLogoUploader('#upload_header_logo_btn', '#is_header_logo', '#header_logo_preview');
		setupLogoUploader('#upload_footer_logo_btn', '#is_footer_logo', '#footer_logo_preview');
	});
	</script>
	<?php
}


