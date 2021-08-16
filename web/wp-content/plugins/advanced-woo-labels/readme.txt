=== Advanced Woo Labels - Product Labels for WooCommerce ===
Contributors: Mihail Barinov
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=GSE37FC4Y7CEY
Tags: plugin, woocommerce, labels, product labels, badges, woocommerce labels, woocommerce badges, shop, store, ecommerce, merketing, products, tags
Requires at least: 4.0
Tested up to: 5.8
Stable tag: 1.27
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Labels plugin for WooCommerce. Create labels/badgets with custom styles and text for any of your WooCommerce product.

== Description ==

With the Advanced Woo Labels plugin you can easily create labels/badges for any of your WooCommerce products. Use label conditions to show labels only for specific product, page or user. Customize labels styles with build-in options.
Attract users attention by displaying inside labels information like **discount value**, **product quantity**, **product rating**, **shipping class**, **stock status**, **sale status**,  etc.

[Plugin home page](https://advanced-woo-labels.com/?utm_source=wp-repo&utm_medium=listing&utm_campaign=awl-repo) | [Features List](https://advanced-woo-labels.com/features/?utm_source=wp-repo&utm_medium=listing&utm_campaign=awl-repo)

= Main Features =

* Create **unlimited number** of labels for each WooCommerce product.
* Display label in **two positions**: on product image or before title. Align label at any side of this position.
* Use labels with **custom text**. Write any text inside product labels. Also use special **text variables** to show important product information like Price, Sale price, Discount percentage, Discount amount, SKU, Quantity.
* Choose from **5 different text label shapes**. Set unique styles for each of them with help of custom styling options.
* **Label groups**. Show several labels for one product. Set maximal number of such labels, their alignment, priority, distance between them.
* **Label conditions**. Show labels based on specific product, page or user conditions. Combine conditions to 'AND' and 'OR' groups to create more complex label rules.
* Create unlimited label variations with **advanced styling options**: change label color, font color, font size, opacity, paddings and margins, set any other custom css individually for each label.
* Cool admin panel with labels live preview.
* Special option to **change hooks** that used to display product labels if your theme has some problem with showing them or if you want to change labels position.
* Page builder plugins support: Gutenberg, Elementor, Beaver Builder, WPBakery, Divi Builder.

= Premium Features =

Additional features available only in PRO plugin version.

* **Image labels**. Use one of predefined images as a product label or upload your custom one. Additionally it is possible to use SVG images.
* **Emojis support**: Use any emoji inside the text label. Mix theme with text variables, plain text or other emojis.
* **More product conditions**: show WooCommerce labels based on product type, age, sale date, sales number, taxonomy, attributes, custom fields, etc.
* **More user conditions**: show labels only for users from certain countries, with specific devices, language, based on products in the cart or specific shop stats ( example: average products costs inside cart ).
* **Page conditions**: show labels only on specific page templates, page types or archive pages.
* **Date conditions**: show labels only on certains dates, time or day of week.
* **More text variables**: attributes, taxonomies, custom fields, sales number, reviews number, rating.
* **Labels styling**: borders, shadows, additional shapes.
* **Label links**: add any custom link inside your label. So now your product labels not just tell users some important information but can contain some useful links.
* **ACF plugin support**: advanced integration with Advanced Custom Fields plugin. Show value of any ACF field inside label. Also set label display conditions based on ACF fields values.

= Plugin Links =

[Home Page](https://advanced-woo-labels.com/?utm_source=wp-repo&utm_medium=listing&utm_campaign=awl-repo)
[Features List](https://advanced-woo-labels.com/features/?utm_source=wp-repo&utm_medium=listing&utm_campaign=awl-repo)
[Pricing](https://advanced-woo-labels.com/pricing/?utm_source=wp-repo&utm_medium=listing&utm_campaign=awl-repo)
[Docs](https://advanced-woo-labels.com/guide/?utm_source=wp-repo&utm_medium=listing&utm_campaign=awl-repo)
[Demo](https://demo.advanced-woo-labels.com/)

== Installation ==

1. Upload advanced-woo-labels to the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Adv. Woo Label -> Add New page and create your first label 

== Frequently Asked Questions ==

= Why do I need this plugin? =

This plugin is great to attract visitors attention to some of your products and to promote any of them.
Also labels may contain some additional product information that can be useful for your customers.

= Is it compatible with my WordPress themes? =

Plugin was built in such a way that it must work well with almost any WordPress theme. If themes are developed according to WordPress and WooCommerce guidelines ( it is using appropriate hooks ) then you will don't have any problem with it.
But if you still face any issue please use a plugin support forum to describe your problem there.

= Is this plugin compatible with the latest version of Woocommerce? =

Yep. This plugin is always compatible with the latest version of Woocommerce.

= Is it possible to apply multiple labels to a product? =

Yes, for any WooCommerce product you can display an unlimited number of different plugin labels. Also, inside the plugin settings page it is possible to set a maximal number of labels per product.

= Can I choose what products labels must be displayed? =

Sure. For any created label you can create special conditions rules that will describe on what products, pages and for what users these labels must be displayed. 
There is a large variety of such conditions and more information you can find [here](https://advanced-woo-labels.com/guide/label-conditions/). 

= Can I show inside labels text some values like product discount or quantity? =

Yes, you can use plugin [text variables](https://advanced-woo-labels.com/guide/text-variables/) to show a variety of different product parameters like price, discount value, sku, quantity, sales number, reviews, rating, attributes, etc.

== Screenshots ==

1. Labels and labels groups
2. Create unlimited number of labels and display theme everywhere
3. Show labels on product details page
4. Labels styling options
5. Labels styling options. Admin page
6. Labels positions
7. Change labels text and use special text variables
8. Labels edit page. Text option
9. Labels conditions options
10. Labels conditions. Admin page
11. Admin labels page

== Changelog ==

= 1.27 ( 02.08.2021 ) =
* Update - Support for Flatsome theme. Fix labels display for image gallery

= 1.26 ( 19.07.2021 ) =
* Update - Support for Elementor plugin. New option to disable labels for any Products block. New label display condition option - Is Elementor block.
* Update - Tested with WC 5.5

= 1.25 ( 05.07.2021 ) =
* Fix - Bug with incorrect discounts calculation
* Fix - Support for Product Slider for WooCommerce plugin

= 1.24 ( 21.06.2021 ) =
* Add - Support for Advanced Woo Search plugin
* Fix - Issue with not showing labels
* Fix - Discount text variables. Show discount value even if the product is not on sale.
* Update - Tested with WC 5.4

= 1.23 ( 07.06.2021 ) =
* Add - Woo Discount Rules plugin support
* Fix - Issues with WPML plugin labels duplicates
* Dev - Add awl_label_text_var_value filter
* Dev - Add awl_label_condition_compare_value filter
* Dev - Add awl_product_price filter
* Dev - Add awl_product_sale_price filter


= 1.22 ( 24.05.2021 ) =
* Add - Product Slider for WooCommerce plugin support
* Update - Tested with WC 5.3
* Update - Plugin settings page
* Dev - Update labels settings

= 1.21 ( 10.05.2021 ) =
* Dev - Add awl_labels_condition_rules filter
	
= 1.20 ( 27.04.2021 ) =
* Update - Woolementor plugin support</li>
* Update - Tested with WC 5.2</li>
* Update - SAVE_AMOUNT and SAVE_PERCENT text variables. Make it work with custom product types</li>
* Fix - Display conditions for product variations</li>

= 1.19 ( 12.04.2021 ) =
* Add - Woolementor plugin support
* Add - Support for JetWooBuilder For Elementor plugin
* Update - Flatsome theme integration
* Fix - Hooks settings rewrite issue
* Fix - Use localtime instead of UTF time
* Fix - Quantity label condition
* Dev - Add awl_js_container_selectors filter

= 1.18 ( 29.03.2021 ) =
* Add - Oxygen Builder plugin support
* Fix - Parent theme name detection

= 1.17 ( 15.03.2021 ) =
* Add - Support for WooLentor – WooCommerce Elementor Addons + Builder plugin
* Update - Astra theme support. Remove default out-of-stock labels if needed
* Fix - Labels display when AJAX load is using
* Fix - Bug with not displayed labels on archive and single product pages
* Dev - Add awl_enable_labels filter

= 1.16 ( 01.03.2021 ) =
* Update - Elementor plugin support. Add integration for single product template

= 1.15 ( 15.02.2021 ) =
* Add - Integration for BoxShop theme
* Update - Text variables. Add {REGULAR_PRICE} text variable

= 1.14 ( 02.02.2021 ) =
* Fix - Bug with not displayed labels when using Jet Smart Filters plugin
* Dev - Add extra check for $product object before showing labels
* Dev - Update number_per_product and  number_per_position options default values

= 1.13 ( 18.01.2021 ) =
* Add - Integration for Martfury theme
* Add - Support for Elementor posts blocks when showing products
* Dev - JS labels integration. Add timeout

= 1.12 ( 04.01.2021 ) =
* Add - Support for Stockie theme
* Update - Label settings page. Add link to the plugin docs about text variables

= 1.11 ( 14.12.2020 ) =
* Add - Support for Flatsome theme quick view lightbox
* Update - Flatsome theme integration

= 1.10 ( 30.11.2020 ) =
* Add - Welcome message
* Update - Admin dashboard links
* Update - Woodmart theme support
* Dev - Update constants declaration

= 1.09 ( 16.11.2020 ) =
* Add - Support for Konado theme
* Update - Flatsome theme integration

= 1.08 ( 02.11.2020 ) =
* Fix - Divi Builder integration
* Dev - Add awl_admin_page_options filter filter
* Dev - Add awl_label_admin_options filter
* Dev - Add awl_current_label_markup filter

= 1.07 ( 19.10.2020 ) =
* Update - Oxygen theme support
* Fix - Discount calculation for product variations
* Dev - Add awl_show_label_for_product filter
* Dev - Add awl_show_labels_for_product filter

= 1.06 ( 06.10.2020 ) =
* Update - Support for The Gem theme
* Fix - Discount calculations for variable products

= 1.05 ( 21.09.2020 ) =
* Update - Labels admin quick edit links
* Update - WooCommerce compatible version

= 1.04 ( 07.09.2020 ) =
* Update - Plugin settings page
* Fix - Bug with label settings with zero value
* Fix - Display labels inside Elementor plugin preview window

= 1.03 ( 24.08.2020 ) =
* Add – Styles for select2 library
* Add - Portuguese (Brazil) translation
* Update – WooCommerce supported version
* Fix – Label condition options for product attributes

= 1.02 ( 12.08.2020 ) =
* Update – Ajax calls
* Update – Add advanced select for large values
* Add - Pro version tab

= 1.01 ( 27.07.2020 ) =
* Add - Ajax toggle for label status
* Update - Improve support for Twenty Twenty theme
* Update - Color picker script

= 1.00 ( 13.07.2020 ) =
* First Release