<td colspan="4">
  <p>
    <strong>
      <?php echo$sfAssetGallery->getTitle() ?>
      (<?php echo format_number_choice(
        '[0]No element|[1]One element|(1,Inf]%s elements',
      array('%s' => $sfAssetGallery->countElements()), $sfAssetGallery->countElements(), 'sfAssetGallery') ?>)
    </strong>
    <?php include_partial('sfAssetGallery/list_field_boolean', array('value' => $sfAssetGallery->getIsPublished())) ?>
  </p>
  <ul>
    <li><?php echo __('Created on %s', array('%s' => false !== strtotime($sfAssetGallery->getCreatedAt()) ? format_date($sfAssetGallery->getCreatedAt(), "f") : '&nbsp;'), 'sfAssetGallery') ?></li>
    <li><?php echo __('Updated on %s', array('%s' => false !== strtotime($sfAssetGallery->getUpdatedAt()) ? format_date($sfAssetGallery->getUpdatedAt(), "f") : '&nbsp;'), 'sfAssetGallery') ?></li>
  </ul>
</td>
