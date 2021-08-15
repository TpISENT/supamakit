<div class="e2w-content">
    <div class="page-main">
        <form class="search-panel" method="GET" id="e2w-search-form">
            <input type="hidden" name="page" id="page" value="<?php echo esc_attr(((isset($_GET['page'])) ? $_GET['page'] : '')); ?>" />
            <input type="hidden" name="cur_page" id="cur_page" value="<?php echo esc_attr(((isset($_GET['cur_page'])) ? $_GET['cur_page'] : '')); ?>" />
            <input type="hidden" name="e2w_sort" id="e2w_sort" value="<?php echo $filter['sort']; ?>" />
            <input type="hidden" name="e2w_search" id="e2w_search" value="1" />
            <div class="search-panel-header">
                <h3 class="search-panel-title">Search for products</h3>
                <button class="btn btn-default to-right modal-search-open" type="button">Import product by URL or ID</button>
            </div>
            <div class="search-panel-body">
                <div class="search-panel-simple">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group" style="float: left;width: calc(100% - 170px);">
                                <input class="form-control" type="text" name="e2w_keywords" id="e2w_keywords" placeholder="Enter Keywords" value="<?php echo esc_attr(isset($filter['keywords']) ? $filter['keywords'] : ""); ?>">
                                <select id="e2w_category" class="form-control" name="e2w_category" aria-invalid="false">
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php if (isset($filter['category']) && $filter['category'] == $cat['id']): ?>selected="selected"<?php endif; ?>><?php if (intval($cat['level']) > 1): ?> - <?php endif; ?><?php echo $cat['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="search-panel-buttons" style="float: right;">
                                <button class="btn btn-info no-outline" id="e2w-do-filter" type="button"><?php _e('Search', 'e2w'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-panel-advanced" style="display: block;">
                    <div class="search-panel-row">
                        <div class="search-panel-col">
                            <label>Price</label>
                            <input type="text" class="form-control" name="e2w_min_price" placeholder="Price from" value="<?php echo esc_attr(isset($filter['min_price']) ? $filter['min_price'] : ""); ?>">
                            <input type="text" class="form-control" name="e2w_max_price" placeholder="Price to" value="<?php echo esc_attr(isset($filter['max_price']) ? $filter['max_price'] : ""); ?>">
                        </div>
                        <div class="search-panel-col">
                            <label>Seller's Feedback score</label>
                            <input type="text" class="form-control" name="e2w_min_feedback" placeholder="Score from 0" value="<?php echo esc_attr(isset($filter['min_feedback']) ? $filter['min_feedback'] : ""); ?>">
                            <input type="text" class="form-control" name="e2w_max_feedback" placeholder="Score to 400 000+" value="<?php echo esc_attr(isset($filter['max_feedback']) ? $filter['max_feedback'] : ""); ?>">
                        </div>
                        
                        <div class="search-panel-col c-small">
                            <label>Condition</label>
                            <select name="e2w_condition" class="form-control">
                                <option value="1000"<?php if(isset($filter['condition']) && $filter['condition'] == 1000):?> selected="selected"<?php endif;?>>New</option>
                                <option value="1500"<?php if(isset($filter['condition']) && $filter['condition'] == 1500):?> selected="selected"<?php endif;?>>New other (see details)</option>
                                <option value="1750"<?php if(isset($filter['condition']) && $filter['condition'] == 1750):?> selected="selected"<?php endif;?>>New with defects</option>
                                <option value="2000"<?php if(isset($filter['condition']) && $filter['condition'] == 2000):?> selected="selected"<?php endif;?>>Manufacturer refurbished</option>
                                <option value="2500"<?php if(isset($filter['condition']) && $filter['condition'] == 2500):?> selected="selected"<?php endif;?>>Seller refurbished</option>
                                <option value="3000"<?php if(isset($filter['condition']) && $filter['condition'] == 3000):?> selected="selected"<?php endif;?>>Used</option>
                                <option value="4000"<?php if(isset($filter['condition']) && $filter['condition'] == 4000):?> selected="selected"<?php endif;?>>Very Good</option>
                                <option value="5000"<?php if(isset($filter['condition']) && $filter['condition'] == 5000):?> selected="selected"<?php endif;?>>Good</option>
                                <option value="6000"<?php if(isset($filter['condition']) && $filter['condition'] == 6000):?> selected="selected"<?php endif;?>>Acceptable</option>
                                <option value="7000"<?php if(isset($filter['condition']) && $filter['condition'] == 7000):?> selected="selected"<?php endif;?>>For parts or not working</option>
                            </select>
                        </div>
                        
                        <div class="search-panel-col c-small">
                            <label>Listing Type</label>
                            <select name="e2w_listing_type" class="form-control">
                                <option value="FixedPrice"<?php if(isset($filter['listing_type']) && $filter['listing_type'] == 'FixedPrice'):?> selected="selected"<?php endif;?>>Fixed Price</option>
                                <option value="All"<?php if(isset($filter['listing_type']) && $filter['listing_type'] == 'All'):?> selected="selected"<?php endif;?>>All</option>
                                <option value="Auction"<?php if(isset($filter['listing_type']) && $filter['listing_type'] == 'Auction'):?> selected="selected"<?php endif;?>>Auction</option>
                                <option value="AuctionWithBIN"<?php if(isset($filter['listing_type']) && $filter['listing_type'] == 'AuctionWithBIN'):?> selected="selected"<?php endif;?>>Auction With Buy It Now</option>
                                <option value="Classified"<?php if(isset($filter['listing_type']) && $filter['listing_type'] == 'Classified'):?> selected="selected"<?php endif;?>>Classified</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="search-panel-row">
                        <div class="search-panel-col">
                            <label>Store name</label>
                            <input type="text" style="max-width: 100%;" class="form-control" name="e2w_store" placeholder="Store name" value="<?php echo esc_attr(isset($filter['store']) ? $filter['store'] : ""); ?>">
                        </div>
                        <div class="search-panel-col">
                            <br/>
                            <input type="checkbox" class="form-control" id="e2w_free_shipping_only" name="e2w_free_shipping_only" value="yes" <?php if (isset($filter['free_shipping_only'])): ?>checked<?php endif; ?>/>
                            <label for="e2w_free_shipping_only">Free shipping only</label>
                        </div>
                    </div>
                </div>
                <div class="search-panel__row"><span class="country-select-title">Search on site</span>
                    <div class="country-select" id="my-list">
                        <?php 
                        $cur_sitecode = isset($filter['sitecode'])?$filter['sitecode']:e2w_get_setting('default_sitecode');
                        ?>
                        <select name="e2w_sitecode" id="e2w_sitecode" class="form-control small-input">
                            <?php foreach(E2W_EbaySite::get_sites() as $site):?>
                                <option value="<?php echo $site->sitecode;?>" <?php if ($cur_sitecode == $site->sitecode): ?>selected="selected"<?php endif; ?>><?php echo $site->sitename;?></option>
                            <?php endforeach;?>
                        </select>
                    </div><span class="country-select-descr"><a href="https://developer.ebay.com/DevZone/XML/Docs/Reference/ebay/types/SiteCodeType.html">Please take into account the currency</a> for the chosen eBay site</span>
                </div>
            </div>

            <div class="modal-overlay modal-search">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Import product by URL or ID</h3>
                        <a class="modal-btn-close" href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cross"></use></svg></a>
                    </div>
                    <div class="modal-body">
                        <label>Product URL</label>
                        <input class="form-control" type="text" id="url_value">
                        <div class="separator">or</div>
                        <label>Product ID</label>
                        <input class="form-control" type="text" id="id_value">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default modal-close" type="button">Cancel</button>
                        <button id="import-by-id-url-btn" class="btn btn-success" type="button">
                            <div class="btn-icon-wrap cssload-container"><div class="cssload-speeding-wheel"></div></div>
                            Import
                        </button>
                    </div>
                </div>
            </div>

        </form>
        
        <div>
            <div class="import-all-panel">
                <button type="button" class="btn btn-success no-outline btn-icon-left import_all"><div class="btn-loader-wrap"><div class="e2w-loader"></div></div><span class="btn-icon-wrap add"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-add"></use></svg></span>Add all to import list</button>
            </div>
            <div class="sort-panel">
                <label for="e2w-sort-selector">Sort by:</label>
                <select class="form-control" id="e2w-sort-selector">
                    <?php foreach ($sort_list as $sort_id=>$sort_value): ?>
                        <option value="<?php echo $sort_id;?>" <?php if ($filter['sort'] == $sort_id): ?>selected="selected"<?php endif; ?>><?php echo $sort_value;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="search-result">
            <div class="messages"><?php settings_errors('e2w_products_list'); ?></div>
            <?php $localizator = E2W_EbayLocalizator::getInstance(); ?>
            <?php if ($load_products_result['state'] != 'error'): ?>
                <?php if (!$load_products_result['total']): ?>
                    <p>products not found</p>
                <?php else: ?>
                    <?php $row_ind = 0; ?>
                    <?php foreach ($load_products_result['products'] as $product): ?>
                        <?php
                        if ($row_ind == 0) {
                            echo '<div class="search-result__row">';
                        }
                        ?>
                        <article class="product-card<?php if ($product['post_id'] || $product['import_id']): ?> product-card--added<?php endif; ?>" data-id="<?php echo $product['id'] ?>">
                            <div class="product-card__img"><a href="<?php echo $product['affiliate_url'] ?>" target="_blank"><img src="<?php echo E2W()->plugin_url . 'assets/img/blank_image.png'; ?>" class="lazy" data-original="<?php echo $product['thumb'] ?>" alt="#"></a>
                                <div class="product-card__marked-corner">
                                    <svg class="product-card__marked-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-selected"></use></svg>
                                </div>
                            </div>
                            <div class="product-card__body">
                                <div class="product-card__meta">
                                    <div class="product-card__title"><a href="<?php echo $product['affiliate_url'] ?>" target="_blank"><?php echo $product['title']; ?></a></div>
                                </div>
                                <div class="product-card__price-wrapper">
                                    <h4><span class="product-card__price"><?php echo $localizator->getLocaleCurr($product['currency']); ?><?php echo $product['local_price']; ?></span><span class="product-card__discount"><?php echo $localizator->getLocaleCurr(); ?><?php echo $product['local_regular_price']; ?></span></h4>
                                </div>
                                <span class="product-card__subtitle" style="display:none">
                                    <div>
                                        <div class="product-card-shipping-info"<?php if (isset($product['shipping_to_country'])): ?> data-country="<?php echo $product['shipping_to_country'] ?>"<?php endif; ?>>
                                            <div class="shipping-title">Choose shipping country</div>
                                            <div class="delivery-time"></div>
                                        </div>
                                    </div>
                                </span>
                                <div class="product-card__meta-wrapper">
                                    <div class="product-card__rating">
                                        <?php $star_value = round(5*$product['positiveFeedbackPercent']/100); ?>
                                        <?php for ($i = 0; $i < $star_value; $i++): ?>
                                            <svg class="icon-star"><use xlink:href="#icon-star"></use></svg>
                                        <?php endfor; ?>
                                        <?php for ($i = $star_value; $i < 5; $i++): ?>
                                            <svg class="icon-empty-star"><use xlink:href="#icon-star"></use></svg>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="product-card__supplier">
                                        <div class="product-card__orderscount"><a href="<?php echo $product['store_url']; ?>" target="_blank"><?php echo $product['store_name']; ?></a></div><img class="supplier-icon" src="<?php echo E2W()->plugin_url . '/assets/img/icons/supplier_ebay_2x.png'; ?>" width="16" height="16">
                                    </div>
                                </div>
                                <div class="product-card__actions">
                                    <button class="btn <?php echo ($product['post_id'] || $product['import_id']) ? 'btn-default' : 'btn-success'; ?> no-outline btn-icon-left"><span class="title"><?php if ($product['post_id'] || $product['import_id']): ?>Remove from import list<?php else: ?>Add to import list<?php endif; ?></span>
                                        <div class="btn-loader-wrap"><div class="e2w-loader"></div></div>
                                        <span class="btn-icon-wrap add"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-add"></use></svg></span>
                                        <span class="btn-icon-wrap remove"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cross"></use></svg></span>
                                    </button>
                                </div>
                            </div>
                        </article>
                        <?php $row_ind++; ?>
                        <?php
                        if ($row_ind == 4) {
                            echo '</div>';
                            $row_ind = 0;
                        }
                        ?>
                    <?php endforeach; ?>
                    <?php
                    if (0 < $row_ind && $row_ind < 4) {
                        echo '</div>';
                    }
                    ?>
                    <?php if (isset($filter['country'])): ?>
                        <script>
                            (function ($) {
                                $(function () {
                                    chech_products_view();
                                    $(window).scroll(function () {
                                        chech_products_view();
                                    });
                                });
                            })(jQuery);
                        </script>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        <?php if ($load_products_result['state'] != 'error' && $load_products_result['total_pages'] > 0): ?>
            <div id="e2w-search-pagination" class="pagination">
                <div class="pagination__wrapper">
                    <ul class="pagination__list">
                        <li <?php if (1 == $load_products_result['page']): ?>class="disabled"<?php endif; ?>><a href="#" rel="<?php echo $load_products_result['page'] - 1; ?>">«</a></li>
                        <?php foreach ($load_products_result['pages_list'] as $p): ?>
                            <?php if ($p): ?>
                                <?php if ($p == $load_products_result['page']): ?>
                                    <li class="active"><span><?php echo $p; ?></span></li>
                                <?php else: ?>
                                    <li><a href="#" rel="<?php echo $p; ?>"><?php echo $p; ?></a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li class="disabled"><span>...</span></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <li <?php if ($load_products_result['total_pages'] == $load_products_result['page']): ?>class="disabled"<?php endif; ?>><a href="#" rel="<?php echo $load_products_result['page'] + 1; ?>">»</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="modal-overlay modal-shipping">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Available shipping methods</h3>
                    <a class="modal-btn-close" href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cross"></use></svg></a>
                </div>
                <div class="modal-body">
                    <div class="container-flex"><span>Calculate your shipping price:</span>
                        <div class="country-select" id="my-list">
                            <select id="modal-country-select" class="form-control country_list" style="width: 100%;">
                                <?php foreach ($countries as $country): ?>
                                    <option value="<?php echo $country['c']; ?>"<?php if (isset($filter['country']) && $filter['country'] == $country['c']): ?> selected="selected"<?php endif; ?>><?php echo $country['n']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="message-container">
                        <div class="shipping-method"> <span class="shipping-method-title">These are the shipping methods you will be able to select when processing orders:</span>
                            <div class="shipping-method">
                                <table class="shipping-table">
                                    <thead>
                                        <tr>
                                            <th><strong>Shipping Method</strong></th>
                                            <th><strong>Estimated Delivery Time</strong></th>
                                            <th><strong>Shipping Cost</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Free Worldwide Shipping</td>
                                            <td>19-39</td>
                                            <td>$0.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default modal-close" type="button">OK</button>
                </div>
            </div>
        </div>

    </div>
    
    <div class="modal-overlay modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">#title#</h3>
                <a class="modal-btn-close" href="#"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cross"></use></svg></a>
            </div>
            <div class="modal-body">
                #body#
            </div>
            <div class="modal-footer">
                <button class="btn btn-default no-btn" type="button"><?php _e('No', 'e2w'); ?></button>
                <button class="btn btn-success yes-btn" type="button"><?php _e('Yes', 'e2w'); ?></button>
            </div>
        </div>
    </div>
    
    
    <script>

    (function ($) {
        $("#e2w_sitecode").change(function () {
            var this_btn = this;
            var data = {'action': 'e2w_get_categories', 'sitecode': $(this_btn).val()};
            jQuery.post(ajaxurl, data).done(function (response) {
                var json = jQuery.parseJSON(response);
                if (json.state !== 'ok') {
                    console.log(json);
                }else{
                    var cur_category = $('#e2w_category').val();
                    $('#e2w_category option').remove();
                    $.each(json.categories, function (i, item) {
                        $('#e2w_category').append('<option value="'+item.id+'"'+(item.id==cur_category?' selected="selected"':'')+'>'+(item.level>1?' - ':'')+item.name+'</option>');
                    });
                }
            }).fail(function (xhr, status, error) {
                console.log(error);
            });
            
            return false;
        });
    })(jQuery);


</script>
    
</div>
