<?php



/**
 * Skeleton subclass for representing a row from the 'sf_asset_gallery_element' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.6.0-dev on:
 *
 * Mon Mar 21 10:26:12 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.plugins.sfAssetsGalleryPlugin.lib.model
 */
class sfAssetGalleryElement extends BasesfAssetGalleryElement {

  /**
   * Shortut method to retrieve the asset of the gallery.
   * @return BaseObject
   */
  public function getAsset()
  {
    return $this->getsfAssetRelatedByAssetId();
  }

  /**
   * Shortut method to retrieve the thumb of the gallery.
   * @return BaseObject
   */
  public function getThumb()
  {
    return $this->getsfAssetRelatedByThumbId();
  }

  /**
   * Retrieve the content of the given type.
   * @return String
   */
  public function getContent($t = null)
  {
    $s = null;
    switch($t)
    {
      case 'author':
        $s = $this->getAsset()->getAuthor();
        break;
      case 'copyright':
        $s = $this->getAsset()->getCopyright();
        break;
      case 'description':
        $s = $this->getAsset()->getDescription();
        break;
      default:
        break;
    }

    return $s;
  }

  /**
   * Override the doSave function to do some custom tweaks.
   * @param PropelPDO $con
   */
  protected function doSave(PropelPDO $con)
  {
    if ($this->getAssetId() && !$this->getThumbId())
      $this->setThumbId($this->getAssetId());

    return parent::doSave($con);
  }

} // sfAssetGalleryElement