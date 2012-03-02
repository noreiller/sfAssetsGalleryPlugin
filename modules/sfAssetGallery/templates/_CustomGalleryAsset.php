<?php use_helper('sfAsset') ?>

<div class="w-gallery-content">
  <?php if ($asset->isImage() || $asset->isPdf()) echo asset_image_tag($asset) ?>
  <div class="w-gallery-content-legend">
    <?php echo $slot->getValue($settings['culture']); ?>
  </div>
</div>