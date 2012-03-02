<?php



/**
 * Skeleton subclass for representing a row from the 'sf_asset_gallery' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.6.0-dev on:
 *
 * Mon Mar 21 10:26:11 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.plugins.sfAssetsGalleryPlugin.lib.model
 */
class sfAssetGallery extends BasesfAssetGallery {

  /**
   * If the object is displayed, the title is sent.
   * @return Boolean
   */
  public function __toString()
  {
    return $this->getTitle();
  }

  /**
   * Check if the the gallery has at least one element.
   * @return Boolean
   */
  public function hasElement()
  {
    return $this->countElements() > 0 ? true : false;
  }

  /**
   * Shortut method to retrieve the number of elements of the gallery.
   * @return Array BaseObject collection
   */
  public function countElements()
  {
    return count($this->getElements());
  }

  /**
   * Shortcut method to retrieve the elements of the gallery.
   * @return Array BaseObject collection
   */
  public function getElements()
  {
    return $this->getsfAssetGalleryElements();
  }

  /**
   * Get the thumb of the first element of the gallery
   * @return sfAsset
   */
  public function getThumb()
  {
    if ($this->hasElement())
    {
      $elements = $this->getElements();
      return $elements[0]->getsfAssetRelatedByThumbId();
    }
  }

} // sfAssetGallery
