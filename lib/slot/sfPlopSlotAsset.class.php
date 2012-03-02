<?php

class sfPlopSlotAsset extends sfPlopSlotStandard
{
  public function isContentEditable() {
    return false;
  }

  public function isContentOptionable() {
    return true;
  }

  public function getFields($slot) {
    return array(
      'asset_id' => new sfWidgetFormAssetExtraChoice(array(
        'label' => 'Media'
      ))
    );
  }

  public function getValidators($slot) {
    return array(
      'asset_id' => new sfValidatorString(array(
        'required' => false
      ))
    );
  }

  public function getSlotValue($slot, $settings) {
    sfProjectConfiguration::getActive()->loadHelpers('sfAsset');
    $asset_id = $slot->getOption('asset_id', null, $settings['culture']);
    $asset = empty($asset_id) ? new sfAsset : sfAssetPeer::retrieveFromUrl($asset_id);

    if (!$asset)
      $asset = new sfAsset();

    return asset_image_tag($asset, ($asset->isNew()) ? 'small' : 'full')
      . ($asset->getDescription() != '' ? content_tag('span', $asset->getDescription(), 'class=desc') : null);
  }
}
