<?php

/**
 * sfAssetGallery form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class sfAssetGalleryForm extends BasesfAssetGalleryForm
{
  public function configure()
  {
    unset(
      $this['created_at'],
      $this['updated_at']
    );

    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('sfAssetGallery');

    $this->widgetSchema['is_published']->setLabel('Is published ?');

    if (!$this->getObject()->isNew())
    {
      $objects = $this->getObject()->getsfAssetGalleryElements(
        sfAssetGalleryElementQuery::create()->orderBySortableRank()
      );

      foreach($objects as $i => $object)
        $this->embedForm('element_' . ($i + 1), new sfAssetGalleryElementForm(
          $object,
          array('gallery_id' => $this->getObject()->getId())
        ));

      $this->embedForm('new_element', new sfAssetGalleryElementForm(
        null,
        array('gallery_id' => $this->getObject()->getId())
      ));
    }
  }

  /**
   * Override the saveEmbeddedForms method to check if there an empty form to
   * remove.
   */
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $forms)
    {
      $values = $this->getValues();
      $forms = $this->embeddedForms;
      foreach($forms as $name => $form)
      {
        if (
          array_key_exists($name, $values)
          && is_null($values[$name])
        )
        {
          if (!$forms[$name]->getObject()->isNew())
            $forms[$name]->getObject()->delete();
          unset(
            $forms[$name],
            $values[$name]
          );
        }
      }
    }

    return parent::saveEmbeddedForms($con, $forms);
  }

}
