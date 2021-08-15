<div id="chrome-notify" class="panel panel-default small-padding margin-top">   
    <div class="panel-body">
        <div class="container-flex flex-between"> 
            <div class="container-flex">
                <img class="display-block margin-right" width="16" src="<?php echo E2W()->plugin_url . 'assets/img/logo_chrome.png'; ?>" alt="chrome extension">
                <span class="display-block"><strong><?php _e('Save time adding and ordering products by using the MA Ebay Dropship Chrome Extension!', 'e2w'); ?></strong></span>
            </div>
            <div class="container-flex">
                <a class="btn btn-primary btn-sm chrome-install mr10" target="_blank" href="<?php echo E2W()->chrome_url; ?>"><?php _e('Get Chrome Extension', 'e2w'); ?></a>
                <a href="#" class="btn-link small chrome-notify-close" alt="<?php _e('Close', 'e2w'); ?>">
                    <svg class="icon-small-cross"> 
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-small-cross"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <script>(function ($) {
            $('.chrome-notify-close').click(function () {$(this).closest('.panel').remove();return false;});
        })(jQuery);</script>
</div>

