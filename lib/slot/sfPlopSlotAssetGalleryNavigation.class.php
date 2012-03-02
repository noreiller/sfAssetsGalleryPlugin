<?php

class sfPlopSlotAssetGalleryNavigation extends sfPlopSlotNone
{
  public function getSlotValue($slot, $settings)
  {
    return get_partial('sfAssetGallery/' . $slot->getTemplate(), array(
      'slot' => $slot,
      'settings' => $settings,
    ) + $this->getParams($slot, $settings));
  }

  protected function getParams($slot, $settings)
  {
    $pages_ids = array();

    $q = sfPlopPageQuery::create()
      ->filterByTreeLevel($slot->getPage()->getLevel() + 1)
    ;
    $pages = $slot->getPage()->getBranch($q);
    foreach ($pages as $page)
      $pages_ids []= $page->getId();

    $slotConfigs = sfPlopSlotConfigQuery::create()
      ->innerJoinsfPlopSlot()
      ->filterByPageId($pages_ids)
      ->usesfPlopPageQuery()
        ->orderByTreeLeft()
      ->endUse()
      ->find()
    ;

    foreach ($slotConfigs as $i => $slotConfig)
      if (
        !$slotConfig->getTemplate() != 'AssetGallery'
        && !$slotConfig->getSlot()->ispublished()
      )
        unset($slotConfigs[$i]);

    return array('slotConfigs' => $slotConfigs);
  }
}
