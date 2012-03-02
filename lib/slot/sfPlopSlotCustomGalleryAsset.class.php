<?php

class sfPlopSlotCustomGalleryAsset extends sfPlopSlotStandard
{
  public function getContentClasses() { return 'RichText'; }

  public function getFields($slot)
  {
    return array(
      'value' => new sfWidgetFormPlopRichText(array(
        'label' => 'Content'
      )),
      'asset_id' => new sfWidgetFormAssetExtraChoice(array(
        'label' => 'Media'
      ))
    );
  }

  public function getValidators($slot) {
    return array(
      'value' => new sfValidatorString(array(
        'required' => false
      )),
      'asset_id' => new sfValidatorString(array(
        'required' => false
      ))
    );
  }

  public function getSlotValue($slot, $settings)
  {
    sfProjectConfiguration::getActive()->loadHelpers(array('Partial'));

    return include_partial('sfAssetGallery/' . $slot->getTemplate(), array(
      'slot' => $slot,
      'settings' => $settings,
    ) + $this->getParams($slot, $settings));
  }

  public function getParams($slot, $settings) {
    $asset_id = $slot->getOption('asset_id', null, $settings['culture']);
    $asset = empty($asset_id) ? new sfAsset : sfAssetPeer::retrieveFromUrl($asset_id);

    if (!$asset)
      $asset = new sfAsset();

    return array(
      'asset' => $asset
    );
  }
}
