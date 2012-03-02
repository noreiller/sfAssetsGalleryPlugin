<?php

/**
 * sfAssetGalleryElement form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class sfAssetGalleryElementForm extends BasesfAssetGalleryElementForm
{
  public function configure()
  {
    unset(
      $this['created_at'],
      $this['updated_at']
    );

    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('sfAssetGallery');

    if ($this->getObject()->isNew())
      unset($this['id']);

    $this->widgetSchema['gallery_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['gallery_id'] = new sfValidatorPropelChoice(array(
      'required' => false,
      'model' => 'sfAssetGallery'
    ));
    $this->setDefault('gallery_id',  $this->getOption('gallery_id'));

    $this->widgetSchema['asset_id'] = new sfWidgetFormAssetExtraInput();
    $this->validatorSchema['asset_id'] = new sfValidatorPropelChoice(array(
      'required' => false,
      'model' => 'sfAsset'
    ));

    $this->widgetSchema['thumb_id'] = new sfWidgetFormAssetExtraInput();
    $this->validatorSchema['thumb_id'] = new sfValidatorPropelChoice(array(
      'required' => false,
      'model' => 'sfAsset'
    ));

    $this->widgetSchema['sortable_rank'] = new sfWidgetFormInputHidden();

    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array(
        'callback' => array($this, 'checkEmpty')
      ))
    );
  }

  public function checkEmpty(sfValidatorBase $validator, $values = array())
  {
    if (
      array_key_exists('asset_id', $values)
      && array_key_exists('thumb_id', $values)
    )
    {
      if (!$values['asset_id'])
      {
        $values = null;
      }

      if ($values['asset_id'] && !$values['thumb_id'])
      {
        $values['thumb_id'] = $values['asset_id'];
      }
    }

    return $values;
  }
}
