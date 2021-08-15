<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="dotstore_plugin_sidebar">

    <?php 
$review_url = '';
$plugin_at = '';
$review_url = esc_url( 'https://wordpress.org/plugins/woo-advanced-product-size-chart/#reviews' );
$plugin_at = 'WP.org';
?>
    <div class="dotstore-important-link">
        <div class="image_box">
            <img src="<?php 
echo  esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/rate-us.png' ) ;
?>" alt="<?php 
esc_attr_e( 'Rate us', 'size-chart-for-woocommerce' );
?> ">
        </div>
        <div class="content_box">
            <h3><?php 
esc_html_e( 'Like This Plugin?', 'size-chart-for-woocommerce' );
?></h3>
            <p class="star-container">
                <a href="<?php 
echo  esc_url( $review_url ) ;
?>" target="_blank">
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                </a>
            </p>
            <p><?php 
esc_html_e( 'Your Review is very important to us as it helps us to grow more.', 'size-chart-for-woocommerce' );
?></p>
            <a class="btn_style" href="<?php 
echo  esc_url( $review_url ) ;
?>" target="_blank"><?php 
esc_html_e( 'Review Us on ', 'size-chart-for-woocommerce' );
?> <?php 
esc_html_e( $plugin_at, 'size-chart-for-woocommerce' );
?></a>
        </div>
    </div>
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-image-rotate-right"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Free vs Pro Feature', 'size-chart-for-woocommerce' );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'Here’s an at a glance view of the main differences between Premium and free plugin features.', 'size-chart-for-woocommerce' );
?></p>
            <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/woocommerce-advanced-product-size-charts' ) ;
?>"><?php 
esc_html_e( 'Click here »', 'size-chart-for-woocommerce' );
?></a>
        </div>
    </div>
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-star-filled"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Suggest A Feature', 'size-chart-for-woocommerce' );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'Let us know how we can improve the plugin experience.', 'size-chart-for-woocommerce' );
?></p>
            <p><?php 
esc_html_e( 'Do you have any feedback &amp; feature requests?', 'size-chart-for-woocommerce' );
?></p>
            <a target="_blank" href="https://www.thedotstore.com/feature-requests/><?php 
esc_html_e( 'Submit Request »', 'size-chart-for-woocommerce' );
?></a>
        </div>
    </div>
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-editor-kitchensink"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Changelog', 'size-chart-for-woocommerce' );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'We improvise our products on a regular basis to deliver the best results to customer satisfaction.', 'size-chart-for-woocommerce' );
?></p>
            <a target="_blank" href="https://www.thedotstore.com/woocommerce-advanced-product-size-charts/#tab-update-log"><?php 
esc_html_e( 'Visit Here »', 'size-chart-for-woocommerce' );
?></a>
        </div>
    </div>

    <!-- html for popular plugin !-->
    <div class="dotstore-important-link dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-plugins-checked"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Our Popular Plugins', 'size-chart-for-woocommerce' );
?></span>
        </div>
        <div class="video-detail important-link">
            <ul>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( SCFW_PLUGIN_URL ) . 'admin/images/advance-flat-rate.png' ;
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/flat-rate-shipping-plugin-for-woocommerce/' ) ;
?> "><?php 
esc_html_e( 'Flat Rate Shipping Plugin for WC', 'size-chart-for-woocommerce' );
?></a>
                </li> 
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( SCFW_PLUGIN_URL ) . 'admin/images/woo-conditional-product-fees-for-checkout.png' ;
?>">
                    <a  target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/product/woocommerce-extra-fees-plugin/' ) ;
?>"><?php 
esc_html_e( 'Extra Fees Plugin for WC', 'size-chart-for-woocommerce' );
?></a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php 
echo  esc_url( SCFW_PLUGIN_URL ) . 'admin/images/woo-advanced-product-size-chart.png' ;
?>">
                    <a  target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/woocommerce-advanced-product-size-charts/' ) ;
?>"><?php 
esc_html_e( 'Product Size Charts Plugin for WC', 'size-chart-for-woocommerce' );
?></a>
                </li>
                <li>
                    <img  class="sidebar_plugin_icone" src="<?php 
echo  esc_url( SCFW_PLUGIN_URL ) . 'admin/images/woo-blocker-lite-prevent-fake-orders-and-blacklist-fraud-customers.png' ;
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/woocommerce-anti-fraud' ) ;
?>"><?php 
esc_html_e( 'Fraud Prevention Plugin for WC', 'size-chart-for-woocommerce' );
?></a>
                </li>
                <li>
                    <img  class="sidebar_plugin_icone" src="<?php 
echo  esc_url( SCFW_PLUGIN_URL ) . 'admin/images/hide-shipping-method-for-woocommerce.png' ;
?>">
                    <a target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/hide-shipping-method-for-woocommerce' ) ;
?>"><?php 
esc_html_e( 'Hide Shipping Method For WC', 'size-chart-for-woocommerce' );
?></a>
                </li>
                </br>
            </ul>
        </div>
        <div class="view-button">
            <a class="button button-primary button-large" target="_blank" href="<?php 
echo  esc_url( 'https://www.thedotstore.com/plugins' ) ;
?>"><?php 
esc_html_e( 'VIEW ALL', 'size-chart-for-woocommerce' );
?></a>
        </div>
    </div>
    <!-- html end for popular plugin !-->
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-sos"></span>
            <span class="heading-text"><?php 
esc_html_e( 'Five Star Support', 'size-chart-for-woocommerce' );
?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php 
esc_html_e( 'Got a question? Get in touch with theDotstore developers. We are happy to help!', 'size-chart-for-woocommerce' );
?> </p>
            <a target="_blank" href="https://www.thedotstore.com/support/"><?php 
esc_html_e( 'Submit a Ticket »', 'size-chart-for-woocommerce' );
?></a>
        </div>
    </div>
</div>
</div>
</body>
</html>
