<h1>Ebay Dropship Settings</h1>
<div class="e2w-content">
    <ul class="nav nav-tabs">
      <?php foreach($modules as $module):?>
      <li role="presentation" <?php echo $current_module == $module['id'] ? 'class="active"' : ""; ?>><a href="<?php echo admin_url('admin.php?page=e2w_setting&subpage='.$module['id']); ?>"><?php echo $module['name'] ?></a></li>
      <?php endforeach; ?>
    </ul>
