<?php

/**
 * sfWidgetFormAssetExtraInput
 *
 * @package    symfony
 * @subpackage widget
 * @see        sfWidgetFormAssetInput
 * @author     Aurélien MANCA <aurelien.manca@gmail.com>
 * @author     Massimiliano Arione <garakkio@gmail.com>
 */
class sfWidgetFormAssetExtraInput extends sfWidgetFormInputHidden
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * asset_type: The asset type ('all' for all types)
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   * @see sfWidgetFormInput
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);
    $this->addOption('asset_type', 'image');
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetFormInput
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    sfProjectConfiguration::getActive()->loadHelpers('sfAsset');
    init_asset_library();

    $html = parent::render($name, $value, $attributes, $errors);
    $attributes = $this->fixFormId(array('name' => $name));
    $html .= $this->input_sf_asset_image_tag($name, $value, array('id' => $attributes['id'], 'type' => $this->getOption('asset_type')));

    return $html;
  }

  /**
   * get input form field
   * @param  string  $name
   * @param  integer $value   possible value of asset id
   * @param  array   $options
   * @return string
   */
  function input_sf_asset_image_tag($name, $value = null, $options = array())
  {
    $url = str_replace('&', '&amp;', url_for('@sf_asset_library_list?dir=' . sfConfig::get('app_sfAssetsLibrary_upload_dir', 'media') . '&popup=2'));
    $asset = empty($value) ? new sfAsset : sfAssetPeer::retrieveByPK($value);

    return
      '<a class="sf_asset_input_image" id="' . $options['id'] . '_link" href="#" rel="{url: \'' . $url . '\', name: \'' . $name . '\', type: \'' . $options['type'] . '\'}">'
      . image_tag('/sfAssetsLibraryPlugin/images/folder_open', array(
        'alt' => 'Insert Image',
        'title' => __('Insert Image', null, 'sfAsset')))
      . '</a> '
      . image_tag('/sfPlopPlugin/vendor/famfamfam/silk/folder_delete', array(
        'id' => $options['id'] . '_delete',
        'class' => 'sf_asset_delete_image',
        'rel' => $options['id'],
        'alt' => 'Delete Image',
        'title' => __('Delete Image', null, 'sfAsset')))
      . ' '
      . asset_image_tag($asset, 'small', array('id' => $options['id'] . '_img'))
    ;
  }

  /**
   * Gets the JavaScript paths associated with the widget.
   *
   * @return array An array of JavaScript paths
   */
  public function getJavascripts()
  {
    return array(
      '/sfAssetsLibraryPlugin/js/main',
      '/sfAssetsGalleryPlugin/js/admin'
    );
  }

  /**
   * this is needed for correct rendering in admin generator
   */
  public function isHidden()
  {
    return false;
  }
}