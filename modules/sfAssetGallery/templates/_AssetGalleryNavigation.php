<?php use_helper('sfAsset') ?>

<?php if (count($slotConfigs) > 0): ?>
  <ul class="w-list">
    <?php foreach($slotConfigs as $galleryConfig): ?>
      <?php
	$gallery_id = $galleryConfig->getOption('gallery_id', '', $settings['culture']);
	if (!$gallery_id && $settings['culture'] != sfPlop::get('sf_plop_default_culture'))
	  $gallery_id = $galleryConfig->getOption('gallery_id', null, sfPlop::get('sf_plop_default_culture'));
	$gallery = sfAssetGalleryPeer::retrieveByPK($gallery_id);
      ?>
      <?php if ($gallery): ?>
	<li>
	  <?php echo link_to(
	    asset_image_tag($gallery->getThumb())
	      . content_tag('span', $gallery->getTitle()),
	    '@sf_plop_page_show?slug=' . $galleryConfig->getPage()->getSlug()
	  ) ?>
	</li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>