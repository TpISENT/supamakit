<?php
/**
 * Filter functions for Styling Section of Theme Options
 */

if ( ! function_exists( 'redux_toggle_use_predefined_colors' ) ) {
	function redux_toggle_use_predefined_colors( $enable ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['use_predefined_color'] ) && $tokoo_options['use_predefined_color'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if( ! function_exists( 'redux_apply_primary_color' ) ) {
	function redux_apply_primary_color( $color ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['main_color'] ) ) {
			$color = $tokoo_options['main_color'];
		}

		return $color;
	}
}

if ( ! function_exists( 'sass_darken' ) ) {
	function sass_darken( $hex, $percent ) {
		preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $tokoo_primary_color );
		str_replace( '%', '', $percent );
		$percent = (int) $percent;
		$color = "#";
		for( $i = 1; $i <= 3; $i++ ) {
			$tokoo_primary_color[$i] = hexdec( $tokoo_primary_color[$i] );
			if ( $percent > 50 ) $percent = 50;
			$dv = 100 - ( $percent * 2 );
			$tokoo_primary_color[$i] = round( $tokoo_primary_color[$i] * ( $dv ) / 100 );
			$color .= str_pad( dechex( $tokoo_primary_color[$i] ), 2, '0', STR_PAD_LEFT );
		}
		return $color;
	}
}

if ( ! function_exists( 'sass_lighten' ) ) {
	function sass_lighten( $hex, $percent ) {
		preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $tokoo_primary_color);
		str_replace('%', '', $percent);
		$percent = (int) $percent;
		$color = "#";
		for($i = 1; $i <= 3; $i++) {
			$tokoo_primary_color[$i] = hexdec($tokoo_primary_color[$i]);
			$tokoo_primary_color[$i] = round($tokoo_primary_color[$i] * (100+($percent*2))/100);
			$color .= str_pad(dechex($tokoo_primary_color[$i]), 2, '0', STR_PAD_LEFT);
		}
		return $color;
	}
}

if ( ! function_exists( 'redux_apply_custom_color_css' ) ) {
	function redux_apply_custom_color_css() {
		global $tokoo_options;

		if ( isset( $tokoo_options['use_predefined_color'] ) && $tokoo_options['use_predefined_color'] ) {
			return;
		}

		$how_to_include = isset( $tokoo_options['include_custom_color'] ) ? $tokoo_options['include_custom_color'] : '1';

		if ( $how_to_include != '1' ) {
			return;
		}

		?><style type="text/css"><?php echo redux_get_custom_color_css(); ?></style><?php
	}
}

if ( ! function_exists( 'redux_get_custom_color_css' ) ) {
	function redux_get_custom_color_css() {
		global $tokoo_options;

		$tokoo_primary_color      = isset( $tokoo_options['custom_primary_color'] ) ? $tokoo_options['custom_primary_color'] : '#45b44d';
		$primary_text_color = isset( $tokoo_options['custom_primary_text_color'] ) ? $tokoo_options['custom_primary_text_color'] : '#fff';

		$active_background  = sass_darken( $tokoo_primary_color, '100%' );
		$active_border      = sass_darken( $tokoo_primary_color, '100%' );

		$styles 	        = '
		.header-aside a,
		.about-job .job-title,
		.about-job a:hover,
		.about-job a:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.comment-navigation a,
		.page-numbers .current,
		nav.page-numbers > span,
		.article .entry-featured-image:hover .post-icon, 
		.article .entry-featured-image:focus .post-icon,
		.url,
		.single-article .tk-list li:before,
		.single-article blockquote.tk-blockquote,
		.post-navigation a,
		.nav-previous:before,
		.nav-next:after,
		.single-post-footer .author-name,
		.cart-contents .count,
		.header-wishlist .count,
		.feature-icon,
		.widget-area .widget .current-cat .child-indicator,
		.cart-header-subtitle strong, 
		.cart-header-subtitle .woocommerce-Price-amount,
		.checkout-steps a.active, 
		.checkout-steps a.always-active,
		.register-benefits-banner .register-benefits-banner-inner .banner-icon i,
		.register-benefits-banner .register-benefits-banner-inner .banner-content h3,
		.shop-view-switcher li > a.active,
		.wc-terms-and-conditions  a,
		.coupon-form-subtitle a,
		.woocommerce-Price-amount,
		.woocommerce-breadcrumb a,
		.login-register-tab.active,
		.woocommerce-lost-password .site-content-inner .page-title,
		.woocommerce-MyAccount-navigation-link.is-active,
		.woocommerce-MyAccount-navigation-link > a,
		.product_title,
		.wc-tabs > li.active > a,
		.info-message-subtitle a, 
		.info-message-subtitle strong,
		.widget-area .widget_product_categories .product-categories li.current-cat.cat-parent > .cat-item-inner > .cat-item-link,
		.single-product .single-product-summary-inner .price-details .price,
		.single-product .product_meta span a,
		.single-product-feature-list ul .feature-inner .feature-thumbnail i,
		.vertical-menu-title a,
		.vertical-nav > .menu-item > a:hover,
		.section-flash-sale-block .section-title i,
		.section-flash-sale-block .marketing-text:before,
		.categories-nav .nav-link.active,
		.categories-nav .nav-link:hover,
		.view-products,
		.view-products:hover,
		.view-products:focus,
		.advanced-review .rating-histogram .rating-count:not(.zero),
		.advanced-review .comment-text .meta .woocommerce-review__verified,
		.register-benefits ul li:before,
		.price,
		.article .entry-title a:hover,
        .entry-content a,
        form.comment-form .logged-in-as a,
        .ais-menu .ais-menu--list .ais-menu--item .ais-menu--link:hover,
        .ais-pagination--item__active a,
        .reply .comment-edit-link,
        .comment-text a,
        .dokan-widget-area .widget #cat-drop-stack ul > li .children a.selected {
			color: ' . $tokoo_primary_color . ';
		}

		.masthead-v3 .tokoo-svg {
			fill:' . $tokoo_primary_color . ';
		}

		@media (max-width: 767.98px) {
			.checkout-steps li:before {
				border-left-color: ' . $tokoo_primary_color . ';
			}
		}

		.masthead-v3 .header-icon-link .count,
		.masthead:not(.masthead-v3),
		.widget_tag_cloud .tag-cloud-link:hover,
		.onsale,
		.handheld-header .handheld-header-links .cart .count,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:focus {
			background-color: ' . $tokoo_primary_color . ';
			color: ' . $primary_text_color . ';
		}

		.checkout-steps a.active:before, 
		.checkout-steps a.always-active:before,
		.widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce-widget-layered-nav-list__item--chosen .checkbox-indicator,
		#scrollUp,
		.slick-dots li.slick-active button:before {
			background-color: ' . $tokoo_primary_color . ';

		}

		.widget_tag_cloud .tag-cloud-link,
		.widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-widget-layered-nav-list__item--chosen .checkbox-indicator,
		.rev_slider_wrapper .tp-tabs .tp-tab.selected,
		.slick-dots li.slick-active button:before,
		.advanced-review .comment-text .meta .woocommerce-review__verified,
		.slick-arrow,
		.single-product .product-images-wrapper .tokoo-single-product-gallery-thumbnails .slick-vertical .slick-arrow:not(.disabled) {
			border-color:' . $tokoo_primary_color . ';
		}

		.checkout-steps a.active, 
		.checkout-steps a.always-active,
		.login-register-tab.active,
		.woocommerce-MyAccount-navigation-link.is-active,
		.wc-tabs > li.active > a,
		.categories-nav .nav-link.active:after,
		.single-product .product-images-wrapper .tokoo-single-product-gallery-thumbnails .tokoo-single-product-gallery-thumbnails__wrapper .slick-slide.slick-current img,
		.woocommerce-lost-password .site-content-inner .page-header {
			border-bottom-color:' . $tokoo_primary_color . ';
		}

		.contact-form .wpcf7 form.wpcf7-form input[type="submit"],
		.return-to-shop .button,
		.checkout-button,
		button[name="woocommerce_checkout_place_order"],
		.woocommerce-mini-cart__buttons .button:last-child,
		.btn-action,
		.added_to_cart,
		.single_add_to_cart_button,
		.advanced-review .advanced-review-comment .form-submit input,
		form.woocommerce-ResetPassword .login-form-footer .button, form.woocommerce-ResetPassword .woocommerce-Button, 
		.login-register-forms .login-form-footer .button, 
		.login-register-forms .woocommerce-Button,
		.table-compare tbody tr td .button,
		.woocommerce-MyAccount-content .btn-primary,
		.dokan-dashboard .dokan-dashboard-wrap .dokan-btn-success,
		.dokan-theme-tokoo .dokan-panel-body .add_note .dokan-form-group .btn-primary,
		.woocommerce-account.logged-in .dokan-become-seller .form-row input[type="submit"],
		.widget.widget_layered_nav .woocommerce-widget-layered-nav-dropdown .woocommerce-widget-layered-nav-dropdown__submit,
		div.wpforms-container-full.wpforms-contact-form .wpforms-form input[type=submit], 
		div.wpforms-container-full.wpforms-contact-form .wpforms-form button[type=submit], 
		div.wpforms-container-full.wpforms-contact-form .wpforms-form .wpforms-page-button  {
			color: ' . $primary_text_color . ';
			background-color: ' . $tokoo_primary_color . ';
			border-color: ' . $tokoo_primary_color . ';
		}


		.contact-form .wpcf7 form.wpcf7-form input[type="submit"]:hover,
		.return-to-shop .button:hover,
		.checkout-button:hover,
		button[name="woocommerce_checkout_place_order"]:hover,
		.woocommerce-mini-cart__buttons .button:last-child:hover,
		.btn-action:hover,
		.added_to_cart:hover,
		.single_add_to_cart_button:hover,
		.advanced-review .advanced-review-comment .form-submit input:hover,
		form.woocommerce-ResetPassword .login-form-footer .button:hover, form.woocommerce-ResetPassword .woocommerce-Button:hover, 
		.login-register-forms .login-form-footer .button:hover, 
		.login-register-forms .woocommerce-Button:hover,
		.table-compare tbody tr td .button:hover,
		.widget.widget_layered_nav .woocommerce-widget-layered-nav-dropdown .woocommerce-widget-layered-nav-dropdown__submit,
		div.wpforms-container-full.wpforms-contact-form .wpforms-form input[type=submit]:hover, 
		div.wpforms-container-full.wpforms-contact-form .wpforms-form button[type=submit]:hover, 
		div.wpforms-container-full.wpforms-contact-form .wpforms-form .wpforms-page-button:hover {
			color: ' . $primary_text_color . ';
			background-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
			border-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
		}

		.contact-form .wpcf7 form.wpcf7-form input[type="submit"]:focus,
		.return-to-shop .button:focus,
		.checkout-button:focus,
		button[name="woocommerce_checkout_place_order"]:focus,
		.woocommerce-mini-cart__buttons .button:last-child:focus,
		.btn-action:focus,
		.added_to_cart:focus,
		.single_add_to_cart_button:focus,
		.advanced-review .advanced-review-comment .form-submit input:focus,
		form.woocommerce-ResetPassword .login-form-footer .button:focus, form.woocommerce-ResetPassword .woocommerce-Button:focus, 
		.login-register-forms .login-form-footer .button:focus, 
		.login-register-forms .woocommerce-Button:focus,
		.table-compare tbody tr td .button:focus,
		.widget.widget_layered_nav .woocommerce-widget-layered-nav-dropdown .woocommerce-widget-layered-nav-dropdown__submit,
		div.wpforms-container-full.wpforms-contact-form .wpforms-form input[type=submit]:focus, 
		div.wpforms-container-full.wpforms-contact-form .wpforms-form button[type=submit]:focus, 
		div.wpforms-container-full.wpforms-contact-form .wpforms-form .wpforms-page-button:focus {
			color: ' . $primary_text_color . ';
			background-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
			border-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
		}

		.secondary-nav-menu > li + li:before {
			background-color: ' . sass_darken( $tokoo_primary_color, '17%' ) . ' !important;
		}

		.primary-nav {
			background-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
		}

		.top-bar {
			  background-color: ' . sass_darken( $tokoo_primary_color, '10.9%' ) . ' !important;
		}

		

		input[name="apply_coupon"] {
			color: ' . $tokoo_primary_color . ';
			background-color: transparent;
    		background-image: none;
			border-color: transparent;
		}

		.top-bar a,
		.secondary-nav-menu > li > a,
		.primary-nav-menu > li > a{
			color:' . $primary_text_color . '!important;
		}

		.checkout-button,
		.entry-content a.btn-action,
		.entry-content a.added_to_cart,
		.entry-content a.button,
		.departments-menu-title,
		.departments-menu-title:hover,
		.departments-menu-title:focus {
			color: ' . $primary_text_color . '!important;
		}


		.header-user-account-dropdown li > a {
			color: ' . $primary_text_color . ';
		}

		@media (min-width: 1200px) {
		    .tokoo-svg {
		        fill: ' . $primary_text_color . ';

		    }

		    .header-icon i,
		    .site-branding .site-title  {
		    	color: ' . $primary_text_color . ';
		    }
		}

		input[name="apply_coupon"]:hover {
			color: ' . $primary_text_color . ';
			background-color: ' . $tokoo_primary_color . ';
			border-color: ' . $tokoo_primary_color . ';
		}


		/*........Dokan.......*/

		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover,
		.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:focus,
		.dokan-coupon-content .code:hover,
		.dokan-subscription-content .pack_content_wrapper .product_pack_item .pack_price {
			background-color: ' . $tokoo_primary_color . ';
		}

		input.dokan-btn-theme[type="submit"],
		a.dokan-btn-theme, 
		.dokan-btn-theme,
		.dokan-theme-tokoo .dokan-panel-body .add_note input[type=submit],
		.woocommerce-progress-form-wrapper .button {
			color: ' . $primary_text_color . ';
			background-color: ' . $tokoo_primary_color . ';
			border-color: ' . $tokoo_primary_color . ';
		}

		input.dokan-btn-theme[type="submit"]:hover,
		a.dokan-btn-theme:hover,
		a.dokan-btn-theme:focus, 
		.dokan-btn-theme:hover,
		.dokan-btn-theme:focus,
		input.dokan-btn-theme[type="submit"]:focus,
		.dokan-theme-tokoo .dokan-panel-body .add_note input[type=submit]:hover,
		.dokan-theme-tokoo .dokan-panel-body .add_note input[type=submit]:focus,
		.woocommerce-progress-form-wrapper .button:hover,
		.woocommerce-progress-form-wrapper .button:focus {
			color: ' . $primary_text_color . ';
			background-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
			border-color: ' . sass_darken( $tokoo_primary_color, '4%' ) . ' !important;
		}

		.dokan-store .pagination-wrap ul.pagination > li > span.current,
		.dokan-dashboard .pagination-wrap ul.pagination > li > span.current,
		.dokan-pagination-container .dokan-pagination li.active a,
		.dokan-coupon-content .code a, 
		.dokan-coupon-content .code span,
		.dokan-dashboard-content ul.dokan_tabs li.active a,
		.dokan-product-listing .dokan-product-listing-area .row-actions .edit a:hover, 
		.dokan-product-listing .dokan-product-listing-area .row-actions .view a:hover, 
		.dokan-product-listing .dokan-product-listing-area .row-actions .duplicate a:hover,
		.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li.active a,
		ul.subsubsub li.active a,
		.dokan-coupon-content .row-actions .edit a:hover,
		.dokan-single-store .store-coupon-wrap .code span.outside,
		.dokan-subscription-content .seller_subs_info span,
		.dokan-panel .dokan-panel-body .wc-order-data-row table.wc-order-totals tbody tr td.refunded-total,
		.dokan-reviews-content .dokan-reviews-area .dokan-comments-wrap ul.dokan-cmt-row-actions li a:hover {
			color: ' . $tokoo_primary_color . ';
		}';

				
		return $styles;
	}
}

function redux_load_external_custom_css() {
	global $tokoo_options;

	if ( isset( $tokoo_options['use_predefined_color'] ) && $tokoo_options['use_predefined_color'] ) {
		return;
	}

	$how_to_include = isset( $tokoo_options['include_custom_color'] ) ? $tokoo_options['include_custom_color'] : '1';

	if ( $how_to_include == '1' ) {
		return;
	}

	$custom_color_file = get_stylesheet_directory() . '/custom-color.css';

	if ( file_exists( $custom_color_file ) ) {
		wp_enqueue_style( 'tokoo-custom-color', get_stylesheet_directory_uri() . '/custom-color.css' );
	}
}

function redux_toggle_custom_css_page() {
	global $tokoo_options;

	if ( isset( $tokoo_options['use_predefined_color'] ) && $tokoo_options['use_predefined_color'] ) {
		$should_add = false;
	} else {
		if ( !isset( $tokoo_options['include_custom_color'] ) ) {
			$tokoo_options['include_custom_color'] = '1';
		}

		if ( $tokoo_options['include_custom_color'] == '2' ) {
			$should_add = true;
		} else {
			$should_add = false;
		}
	}

	return $should_add;
}
