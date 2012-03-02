<?php

class sfAssetsGalleryPluginConfiguration extends sfPluginConfiguration
{
  function initialize ()
  {
    parent::initialize();

    if (class_exists('sfPlop'))
      sfPlop::loadPlugin(array(
        'modules' => array(
          'sfAssetLibrary' => array('name' => 'Media library', 'route' => '@sf_asset_library_root'),
          'sfAssetGallery' => array('name' => 'Media galleries', 'route' => '@sfAssetGallery')
        ),
        'slots' => array(
          'Asset' => 'Asset',
          'AssetGallery' => 'Asset gallery',
          'CustomGalleryAsset' => 'Custom gallery asset',
          'AssetGalleryNavigation' => 'Asset galleries list'
        )
      ));

  }
}

?>
