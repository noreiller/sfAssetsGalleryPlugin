<?php

class sfPlopSlotAssetGallery extends sfPlopSlotStandard
{
  public function isContentEditable() {
    return false;
  }

  public function isContentOptionable() {
    return true;
  }

  public function getFieldHelps() {
    return array(
      'thumb_size' => 'Only used if the pagination contains thumbnails.'
    );
  }

  public function getFields($slot) {
    return array(
      'gallery_id' => new sfWidgetFormPropelChoice(array(
        'label' => 'Gallery',
        'model' => 'sfAssetGallery',
        'add_empty' => true
      )),
      'legend' => new sfWidgetFormChoice(array(
        'choices' => $this->getLegendChoice(),
        'label' => 'Legend'
      )),
      'pagination' => new sfWidgetFormChoice(array(
        'choices' => $this->getPaginationChoice(),
        'label' => 'Pagination'
      )),
      'thumb_size' => new sfWidgetFormChoice(array(
        'choices' => $this->getThumbSizeChoice(),
        'label' => 'Thumbnail size'
      )),
      'use_prev_next_buttons' => new sfWidgetFormInputCheckbox(array(
        'value_attribute_value' => true,
        'label' => 'Use previous and next buttons ?'
      )),
      'autoplay' => new sfWidgetFormInputCheckbox(array(
        'value_attribute_value' => true,
        'label' => 'Autoplay ?'
      ))
    );
  }

  public function getValidators($slot) {
    return array(
      'gallery_id' => new sfValidatorPropelChoice(array(
        'required' => false,
        'model' => 'sfAssetGallery'
      )),
      'legend' => new sfValidatorChoice(array(
        'required' => false,
        'choices' => array_keys($this->getLegendChoice())
      )),
      'pagination' => new sfValidatorChoice(array(
        'required' => false,
        'choices' => array_keys($this->getPaginationChoice())
      )),
      'thumb_size' => new sfValidatorChoice(array(
        'required' => false,
        'choices' => array_keys($this->getThumbSizeChoice())
      )),
      'use_prev_next_buttons' => new sfValidatorBoolean(),
      'autoplay' => new sfValidatorBoolean()
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

  protected function getParams($slot, $settings)
  {
    $return = array();
    $gallery = sfAssetGalleryPeer::retrieveByPk($slot->getOption('gallery_id', null, $settings['culture']));

    if (!$gallery)
      $gallery = sfAssetGalleryPeer::retrieveByTitle($slot->getOption('gallery_id', null, $settings['culture']));

    if ($gallery && $gallery->getIsPublished())
    {
      $return['gallery'] = $gallery;
      $return['pagination'] = $slot->getOption('pagination', 'numbers', $settings['culture']);
      $return['thumb_size'] = $slot->getOption('thumb_size', 'small', $settings['culture']);
      $return['legend'] = $slot->getOption('legend', 'hidden', $settings['culture']);
      $return['use_prev_next_buttons'] = $slot->getOption('use_prev_next_buttons', false, $settings['culture']);
      $return['autoplay'] = $slot->getOption('autoplay', false, $settings['culture']);
    }
    else
      $return['gallery'] = null;

    return $return;
  }

  protected function getLegendChoice()
  {
    return array(
      'hidden' => 'Hidden',
      'description' => 'Description',
      'author' => 'Author',
      'copyright' => 'Copyright'
    );
  }

  protected function getPaginationChoice()
  {
    return array(
      'hidden' => 'Hidden',
      'numbers' => 'Numbers',
      'thumbs' => 'Thumbs',
      'thumbs-slider' => 'Thumbs in slider'
    );
  }

  protected function getThumbSizeChoice()
  {
    return array(
      'full' => 'Full',
      'small' => 'Small',
      'large' => 'Large'
    );
  }
}
