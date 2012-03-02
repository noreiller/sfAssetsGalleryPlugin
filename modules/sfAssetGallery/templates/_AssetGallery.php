<?php if ($gallery && $gallery->hasElement()): ?>
  <?php use_helper('sfAsset') ?>

  <div class="w-gallery <?php if ($autoplay): ?>autoplay<?php endif; ?>">
    <div class="w-gallery-contents">
      <?php foreach ($gallery->getElements() as $element): ?>
        <div class="w-gallery-content">
          <?php $asset = $element->getAsset() ?>
          <?php echo asset_image_tag($asset, 'full', array('class' => 'w-gallery-content-img')) ?>
          <?php if ($legend != 'hidden' && $element->getContent($legend) != ''): ?>
            <div class="w-gallery-content-legend">
              <?php echo $element->getContent($legend); ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if ($use_prev_next_buttons): ?>
      <a href="#" class="w-gallery-prev">&#9668;</a>
      <a href="#" class="w-gallery-next">&#9658;</a>
    <?php endif; ?>
    <?php if (in_array($pagination, array('thumbs', 'thumbs-slider'))): ?>
      <ul class="w-menu w-gallery-menu w-gallery-menu-thumbs <?php if ($pagination == 'thumbs-slider') echo 'w-gallery-menu-slider' ?>">
        <?php foreach ($gallery->getElements() as $i => $element): ?>
          <?php $asset = $element->getThumb() ?>
          <li><a href="#<?php echo $i; ?>"><?php echo asset_image_tag($asset, $thumb_size) ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php elseif ($pagination == 'numbers'): ?>
      <ul class="w-menu w-gallery-menu w-gallery-menu-numbers">
        <?php for ($i = 0; $i < count($gallery->getElements()); $i++): ?>
          <li><a href="#<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
        <?php endfor; ?>
      </ul>
    <?php endif; ?>
  </div>

<?php endif; ?>