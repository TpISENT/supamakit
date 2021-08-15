<form method="post">
    <div class="system_info">
        <div class="panel panel-primary mt20">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-lg-2">
                        <label>
                            <strong><?php _ex('Server address', 'e2w'); ?></strong>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-10">
                        <div class="form-group input-block no-margin clearfix">
                            <?php echo $server_ip;?>
                        </div>                                                                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-lg-2">
                        <label>
                            <strong><?php _ex('Php version', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('Php version', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-10">
                        <div class="form-group input-block no-margin clearfix">
                            <?php
                            $result = E2W_SystemInfo::php_check();
                            echo ($result['state']!=='ok'?'<span class="error">ERROR</span>':'<span class="ok">OK</span>');
                            if($result['state']!=='ok'){
                                echo '<div class="info-box" data-toggle="tooltip" title="'.$result['message'].'"></div>';
                            }
                            ?>
                        </div>                                                                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-lg-2">
                        <label>
                            <strong><?php _ex('Server ping', 'e2w'); ?></strong>
                        </label>
                        <div class="info-box" data-toggle="tooltip" title="<?php _ex('Server ping', 'setting description', 'e2w'); ?>"></div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-10">
                        <div class="form-group input-block no-margin clearfix">
                            <?php
                            $result = E2W_SystemInfo::server_ping();
                            echo ($result['state']!=='ok'?'<span class="error">ERROR</span>':'<span class="ok">OK</span>');
                            if(!empty($result['message'])){
                                echo '<div class="info-box" data-toggle="tooltip" title="'.$result['message'].'"></div>';
                            }
                            ?>
                        </div>                                                                     
                    </div>
                </div>
            </div>       
        </div>  
    </div>
</form>

<script>
    (function ($) {
        $(function () {
            
        });
    })(jQuery);
</script>



