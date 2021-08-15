(function($, window){
    'use strict';

    var is_rtl = $('body,html').hasClass('rtl');

    /*===================================================================================*/
    /*  Block UI Defaults
    /*===================================================================================*/
    if( typeof $.blockUI !== "undefined" ) {
        $.blockUI.defaults.message                      = null;
        $.blockUI.defaults.overlayCSS.background        = '#fff url(' + tokoo_options.ajax_loader_url + ') no-repeat center';
        $.blockUI.defaults.overlayCSS.backgroundSize    = '16px 16px';
        $.blockUI.defaults.overlayCSS.opacity           = 0.6;
    }

    /*===================================================================================*/
    /*  Shop Grid/List Switcher
    /*===================================================================================*/

    $( '#tokoo-shop-view-switcher-grid' ).on( 'click', function(e) {
        e.preventDefault();
        $( this ).addClass( 'active' );
        $( '#tokoo-shop-view-switcher-list' ).removeClass( 'active' );
        $( '#tokoo-shop-view-content' ).removeClass( 'list-view' );
        $( '#tokoo-shop-view-content' ).addClass( 'grid-view' );
    } );

    $( '#tokoo-shop-view-switcher-list' ).on( 'click', function(e) {
        e.preventDefault();
        $( this ).addClass( 'active' );
        $( '#tokoo-shop-view-switcher-grid' ).removeClass( 'active' );
        $( '#tokoo-shop-view-content' ).removeClass( 'grid-view' );
        $( '#tokoo-shop-view-content' ).addClass( 'list-view' );
    } );


    /*===================================================================================*/
    /*  Add to Cart animation
    /*===================================================================================*/

    $( 'body' ).on( 'adding_to_cart', function( e, $btn, data){
        $btn.closest( '.product, .section-products-carousel .product-inner' ).block();
    });

    $( 'body' ).on( 'added_to_cart', function(){
        $( '.product, .section-products-carousel .product-inner' ).unblock();
    });

    /*===================================================================================*/
    /*  Deal Countdown timer
    /*===================================================================================*/

    $( '.deal-countdown-timer' ).each( function() {
        var deal_countdown_text = tokoo_options.deal_countdown_text;

        // set the date we're counting down to
        var deal_time_diff = $(this).children('.deal-time-diff').text();
        var countdown_output = $(this).children('.deal-countdown');
        var target_date = ( new Date().getTime() ) + ( deal_time_diff * 1000 );

        // variables for time units
        var days, hours, minutes, seconds;

        // update the tag with id "countdown" every 1 second
        setInterval( function () {

            // find the amount of "seconds" between now and target
            var current_date = new Date().getTime();
            var seconds_left = (target_date - current_date) / 1000;

            // do some time calculations
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;

            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;

            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);

            // format countdown string + set tag value
            countdown_output.html( '<span data-value="' + days + '" class="days"><span class="value">' + days +  '</span><b>' + deal_countdown_text.days_text + '</b></span><span class="hours"><span class="value">' + hours + '</span><b>' + deal_countdown_text.hours_text + '</b></span><span class="minutes"><span class="value">'
            + minutes + '</span><b>' + deal_countdown_text.mins_text + '</b></span><span class="seconds"><span class="value">' + seconds + '</span><b>' + deal_countdown_text.secs_text + '</b></span>' );

        }, 1000 );
    });

    /*===================================================================================*/
    /*  YITH Wishlist
    /*===================================================================================*/

    $( '.add_to_wishlist' ).on( 'click', function() {
        $( this ).closest( '.images-and-summary' ).block();
        $( this ).closest( '.product-inner' ).block();
        $( this ).closest( '.product-list-view-inner' ).block();
        $( this ).closest( '.product-item-inner' ).block();
    });

    $( '.yith-wcwl-wishlistaddedbrowse > .feedback' ).on( 'click', function() {
        var browseWishlistURL = $( this ).next().attr( 'href' );
        window.location.href = browseWishlistURL;
    });

    $( document ).on( 'added_to_wishlist', function() {
        $( '.images-and-summary' ).unblock();
        $( '.product-inner' ).unblock();
        $( '.product-list-view-inner' ).unblock();
        $( '.product-item-inner' ).unblock();
    });

    $('.masonry-articles').masonry({
        itemSelector: '.article'
    });

    /*===================================================================================*/
    /*  WooCompare
    /*===================================================================================*/


    $( document ).on( 'click', '.add-to-compare-link:not(.added)', function(e) {

        e.preventDefault();

        var button = $(this),
        data = {
            _yitnonce_ajax: yith_woocompare.nonceadd,
            action: yith_woocompare.actionadd,
            id: button.data('product_id'),
            context: 'frontend'
        },
        widget_list = $('.yith-woocompare-widget ul.products-list');

        // add ajax loader
        if( typeof woocommerce_params != 'undefined' ) {
            button.closest( '.product-inner' ).block();
            widget_list.block();
        }

        $.ajax({
            type: 'post',
            url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
            data: data,
            dataType: 'json',
            success: function(response){

                if( typeof woocommerce_params != 'undefined' ) {
                    $( '.product-inner' ).unblock();
                    widget_list.unblock()
                }

                button.addClass('added')
                .attr( 'href', tokoo_options.compare_page_url )
                .text( yith_woocompare.added_label );
                // add the product in the widget
                widget_list.html( response.widget_table );
            }
        });
    });

    /*===================================================================================*/
    /*  Slick Carousel
    /*===================================================================================*/

    $('[data-ride="tk-slick-carousel"]').each( function() {
        var $slick_target = false;

        if ( $(this).data( 'slick' ) !== 'undefined' && $(this).find( $(this).data( 'wrap' ) ).length > 0 ) {
            $slick_target = $(this).find( $(this).data( 'wrap' ) );
            $slick_target.data( 'slick', $(this).data( 'slick' ) );
        } else if ( $(this).data( 'slick' ) !== 'undefined' && $(this).is( $(this).data( 'wrap' ) ) ) {
            $slick_target = $(this);
        }

        if( $slick_target ) {
            $slick_target.slick();
        }
    });

    /*===================================================================================*/
    /*  Handheld Sidebar
    /*===================================================================================*/
    // Handheld Sidebar Toggler
    $( '.handheld-sidebar-toggle .sidebar-toggler' ).on( 'click', function() {
        $( this ).closest('.site-content').toggleClass( "active-hh-sidebar" );
    } );

    // Handheld Sidebar Close Trigger when click outside menu slide
    $( document ).on("click", function(event) {
        if ( $( '.site-content' ).hasClass( 'active-hh-sidebar' ) ) {
            if ( ! $( '.handheld-sidebar-toggle' ).is( event.target ) && 0 === $( '.handheld-sidebar-toggle' ).has( event.target ).length && ! $( '#secondary' ).is( event.target ) && 0 === $( '#secondary' ).has( event.target ).length ) {
                $( '.site-content' ).toggleClass( "active-hh-sidebar" );
            }
        }
    });

    /*===================================================================================*/
    /*  Departments Menu Height
    /*===================================================================================*/

    var $departments_menu_dropdown = $( '.departments-menu .dropdown-menu' ),
        departments_menu_dropdown_height = $departments_menu_dropdown.height();

    $departments_menu_dropdown.find( '.menu-item-has-children > .sub-menu' ).each( function() {
        $(this).find( '.menu-item-object-static_block' ).css( 'min-height', departments_menu_dropdown_height + 17 );
        $(this).css( 'min-height', departments_menu_dropdown_height + 17 );
    });


    /*===================================================================================*/
    /*  Primarymenu Menu Height
    /*===================================================================================*/

    var $departments_menu_dropdown = $( '.departments-menu .dropdown-menu, .primary-nav-menu .primary-vertical-nav .sub-menu' ),
        departments_menu_dropdown_height = $departments_menu_dropdown.height();

    $departments_menu_dropdown.find( '.menu-item-has-children > .sub-menu' ).each( function() {
        $(this).find( '.menu-item-object-static_block' ).css( 'min-height', departments_menu_dropdown_height + 16 );
        $(this).css( 'min-height', departments_menu_dropdown_height + 16 );
    });

    /*===================================================================================*/
    /*  Vertical Menu
    /*===================================================================================*/

    // if ( $( window ).width() > 768 ) {
        // Vertical Menu Height
        var $departments_menu_dropdown = $( '.vertical-nav-block-inner' ),
            departments_menu_dropdown_height = $departments_menu_dropdown.height();

        $departments_menu_dropdown.find( '.menu-item-has-children > .sub-menu' ).each( function() {
            $(this).find( '.menu-item-object-static_block' ).css( 'min-height', departments_menu_dropdown_height - 2 );
            $(this).css( 'min-height', departments_menu_dropdown_height - 2 );
        });

        $( '.vertical-nav, .departments-menu, .primary-nav-menu' ).on( 'mouseleave', function() {
            var $this = $(this);
            $this.removeClass( 'animated-dropdown' );
        });

        $( '.vertical-nav .menu-item, .departments-menu .menu-item, .primary-nav-menu .menu-item' ).on( 'mouseenter', function() {
            var $this = $(this),
                $departments_menu = $this.parents( '.vertical-nav, .departments-menu, .primary-nav-menu' ),
                $container = $this.parents( '.tokoo-animate-dropdown' );

            if ( $departments_menu.length > 0 ) {
                $container = $departments_menu;
            }

            if ( $this.hasClass( 'menu-item-has-children' ) ) {
                if ( ! $container.hasClass( 'animated-dropdown' ) ) {
                    setTimeout(function(){
                        $container.addClass( 'animated-dropdown' );
                    }, 200);
                }
            } else if ( $container.hasClass( 'animated-dropdown' ) ) {
                var $parent = $this.parents( '.menu-item-has-children' );
                if ( $parent.length <= 0 ) {
                    $container.removeClass( 'animated-dropdown' );
                }
            }
        });

        $( '.vertical-nav .menu-item-has-children' ).on({
            mouseenter: function() {
                var $this = $(this),
                    $dropdown_menu = $this.find( '> .sub-menu' ),
                    $departments_menu = $this.parents( '.vertical-nav' ),
                    css_properties = {},
                    animation_duration = 300,
                    has_changed_width = true,
                    animated_class = '',
                    $container = '';

                if ( $departments_menu.length > 0 ) {
                    $container = $this.parent('.sub-menu');
                }

                $dropdown_menu.css( {
                    visibility: 'visible',
                    display:    'block'
                } );

                if ( ! $container.hasClass( 'animated-dropdown' ) ) {
                    $dropdown_menu.animate( css_properties, animation_duration, function() {
                        $container.addClass( 'animated-dropdown' );
                    });
                } else {
                    $dropdown_menu.css( css_properties );
                }
            }, mouseleave: function() {
                var $this = $(this)
                $this.find( '> .sub-menu' ).css({
                    visibility: 'hidden',
                    display:    'none',
                });

                if( ! $this.parent('.sub-menu').hasClass('vertical-nav') ) {
                    $this.parent('.sub-menu').removeClass( 'animated-dropdown' );
                }
            }
        });
    // }

    /*===================================================================================*/
    /*  Sticky Header
    /*===================================================================================*/

    $('.site-header .tokoo-sticky-wrap').each(function(){
        var tm_sticky_header = new Waypoint.Sticky({
            element: $(this),
            stuckClass: 'stuck animated fadeInDown faster',
            offset: function() {
                return -this.element.clientHeight
            }
        });
    });


    /*===================================================================================*/
    /*  Off Canvas Menu
    /*===================================================================================*/

    $( '.off-canvas-navigation-wrapper .navbar-toggle-hamburger' ).on( 'click', function() {
        var css_properties = {
            transform:  'translateX(250px)',
            transition: 'all .5s'
        };

        if( is_rtl ) {
            css_properties.transform = 'translateX(-250px)';
        }

        if ( $( this ).parents( '.stuck' ).length > 0 ) {
            $('html, body').animate({
                scrollTop: $('body')
            }, 0);
        }

        $( this ).closest('.off-canvas-navigation-wrapper').toggleClass( "toggled" );
        $('#page').toggleClass( "off-canvas-bg-opacity" ).css( css_properties );
    } );

    $( '.off-canvas-navigation-wrapper .navbar-toggle-close' ).on( 'click', function() {
        $( this ).closest('.off-canvas-navigation-wrapper').removeClass( "toggled" );
        $('#page').css({'transform': 'none','transition': 'all .5s'}).removeClass( "off-canvas-bg-opacity" );
    } );

    $( document ).on("click", function(event) {
        if ( $( '.off-canvas-navigation-wrapper' ).hasClass( 'toggled' ) ) {
            if ( ! $( '.off-canvas-navigation-wrapper' ).is( event.target ) && 0 === $( '.off-canvas-navigation-wrapper' ).has( event.target ).length ) {
                $( '.off-canvas-navigation-wrapper' ).removeClass( "toggled" );
                $('#page').css({'transform': 'none','transition': 'all .5s'}).removeClass( "off-canvas-bg-opacity" );
            }
        }
    });

    $( '.handheld-header-links .search > a' ).on( 'click', function(e) {
        $( this ).closest('.search').toggleClass( 'active' );
        $('body').toggleClass( 'disableScroll' );
        e.preventDefault();
    });

    $( document ).on("click", function(event) {
        if ( $( '.handheld-header-links .search' ).hasClass( 'active' ) ) {
            if ( ! $( '.handheld-header-links .search' ).is( event.target ) && 0 === $( '.handheld-header-links .search' ).has( event.target ).length ) {
                $( 'body' ).removeClass( 'disableScroll' );
                $( '.handheld-header-links .search' ).removeClass( "active" );
            }
        }
    });

    /*===================================================================================*/
    /*  Products LIVE Search
    /*===================================================================================*/

    if( tokoo_options.enable_live_search == '1' ) {

        if ( tokoo_options.ajax_url.indexOf( '?' ) > 1 ) {
            var prefetch_url    = tokoo_options.ajax_url + '&action=products_live_search&fn=get_ajax_search';
            var remote_url      = tokoo_options.ajax_url + '&action=products_live_search&fn=get_ajax_search&terms=%QUERY';
        } else {
            var prefetch_url    = tokoo_options.ajax_url + '?action=products_live_search&fn=get_ajax_search';
            var remote_url      = tokoo_options.ajax_url + '?action=products_live_search&fn=get_ajax_search&terms=%QUERY';
        }

        var searchProducts = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: prefetch_url,
            remote: {
                url: remote_url,
                wildcard: '%QUERY',
            },
            identify: function(obj) {
                return obj.id;
            }
        });

        searchProducts.initialize();

        $( '.header-search .search-field' ).typeahead( tokoo_options.typeahead_options,
            {
                name: 'search',
                source: searchProducts.ttAdapter(),
                displayKey: 'value',
                limit: tokoo_options.live_search_limit,
                templates: {
                    empty : [
                        '<div class="empty-message">',
                        tokoo_options.live_search_empty_msg,
                        '</div>'
                    ].join('\n'),
                    suggestion: Handlebars.compile( tokoo_options.live_search_template )
                }
            }
        );
    }

    /*===================================================================================*/
    /*  Smooth scroll for checkout steps with @href started with '#' only
    /*===================================================================================*/

    if ($("p").hasClass("order-info")) {
        $("body").addClass('woocommerce-track-order');
    }

    /*===================================================================================*/
    /*  Smooth scroll for checkout steps with @href started with '#' only
    /*===================================================================================*/

    $('.checkout-steps > li').on('click', '.review-step', function(e) {
        e.preventDefault();
        $( this ).addClass( 'always-active' );
        // target element id
        var id = $(this).attr('href');

        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }

        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();

        // top position relative to the document
        var pos = $id.offset().top;

        // animated top scrolling
        $('body, html').animate({scrollTop: pos});
    });

})(jQuery);
