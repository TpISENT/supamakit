<form method="post">
    <input type="hidden" name="setting_form" value="1"/>
    <div class="account_options<?php if ($account->custom_account): ?> custom_account<?php endif; ?> account_type_<?php echo $account->account_type; ?>">
        <div class="panel panel-primary mt20">
            <div class="panel-heading">
                <h3 class="display-inline"><?php _ex('Account settings', 'Setting title', 'e2w'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>
                            <strong><?php _ex('Use custom account', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('You can use your own Ebay API Keys if needed', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="form-group input-block no-margin clearfix">
                            <input type="checkbox" class="form-control float-left mr20" id="e2w_use_custom_account" name="e2w_use_custom_account" value="yes" <?php if ($account->custom_account): ?>checked<?php endif; ?>/>
                            <div class="default_account">
                                <?php _ex('You are using default account', 'e2w'); ?>
                            </div>
                        </div>                                                                     
                    </div>
                </div>

                <div class="row account_fields">
                    <div class="col-sm-4">
                        <label for="e2w_app_id">
                            <strong><?php _ex('AppID', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('When you create the App, the Ebay open platform will generate an AppID', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group input-block no-margin">
                            <input type="text" class="form-control small-input" id="e2w_app_id" name="e2w_app_id" value="<?php echo $account->account_data['app_id'] ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="panel panel-primary account_fields">
            <div class="panel-heading">
                <h3 class="display-inline"><?php _ex('Affiliate settings', 'Setting title', 'e2w'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="row account_fields">
                    <div class="col-md-12">
                        <div class="row-comments">
                        <b>Tracking ID</b> can be any string. Please input it if you want to generate your affiliate links and earn the commission.
                        </div>
                    </div>
                </div>
                <div class="row account_fields">
                    <div class="col-sm-4">
                        <label for="e2w_tracking_id">
                            <strong><?php _ex('Tracking Id', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('Specify the affiliate value obtained from your tracking partner.', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group input-block no-margin">
                            <input type="text" class="form-control small-input" id="e2w_tracking_id" name="e2w_tracking_id" value="<?php echo $account->account_data['tracking_id'] ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row account_fields">
                    <div class="col-sm-4">
                        <label for="e2w_network_id">
                            <strong><?php _ex('Network Id', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('Specifies your tracking partner for affiliate commissions.', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group input-block no-margin">
                            <select class="form-control small-input" id="e2w_network_id" name="e2w_network_id">
                                <option value="2" <?php if ($account->account_data['network_id'] == "2"): ?>selected="selected"<?php endif; ?>><?php _ex('Be Free', 'Setting option', 'e2w'); ?></option>
                                <option value="3" <?php if ($account->account_data['network_id'] == "3"): ?>selected="selected"<?php endif; ?>><?php _ex('Affilinet', 'Setting option', 'e2w'); ?></option>
                                <option value="4" <?php if ($account->account_data['network_id'] == "4"): ?>selected="selected"<?php endif; ?>><?php _ex('TradeDoubler', 'Setting option', 'e2w'); ?></option>
                                <option value="5" <?php if ($account->account_data['network_id'] == "5"): ?>selected="selected"<?php endif; ?>><?php _ex('Mediaplex', 'Setting option', 'e2w'); ?></option>
                                <option value="6" <?php if ($account->account_data['network_id'] == "6"): ?>selected="selected"<?php endif; ?>><?php _ex('DoubleClick', 'Setting option', 'e2w'); ?></option>
                                <option value="7" <?php if ($account->account_data['network_id'] == "7"): ?>selected="selected"<?php endif; ?>><?php _ex('Allyes', 'Setting option', 'e2w'); ?></option>
                                <option value="8" <?php if ($account->account_data['network_id'] == "8"): ?>selected="selected"<?php endif; ?>><?php _ex('BJMT', 'Setting option', 'e2w'); ?></option>
                                <option value="9" <?php if ($account->account_data['network_id'] == "9"): ?>selected="selected"<?php endif; ?>><?php _ex('eBay Partner Network', 'Setting option', 'e2w'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row account_fields">
                    <div class="col-sm-4">
                        <label for="e2w_custom_id">
                            <strong><?php _ex('Custom Id', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('You can define an affiliate customId if you want an ID to monitor your marketing efforts.', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group input-block no-margin">
                            <input type="text" class="form-control small-input" id="e2w_custom_id" name="e2w_custom_id" value="<?php echo $account->account_data['custom_id'] ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="row pt20 border-top">
        <div class="col-sm-12">
            <input class="btn btn-success js-main-submit" type="submit" value="<?php _e('Save settings', 'e2w'); ?>"/>
        </div>
    </div>

</form>

<script>
    (function ($) {
        $('[data-toggle="tooltip"]').tooltip({"placement": "top"});

        $("#e2w_use_custom_account").change(function () {
            if ($(this).is(':checked')) {
                $(this).parents('.account_options').addClass('custom_account');
            } else {
                $(this).parents('.account_options').removeClass('custom_account');
            }
            return true;
        });
    })(jQuery);
</script>
