<?php

/**
 * sfWidgetFormAssetExtraInput
 *
 * @package    symfony
 * @subpackage widget
 * @see        sfWidgetFormPropelChoice
 * @author     Aurélien MANCA <aurelien.manca@gmail.com>
 */
class sfWidgetFormAssetExtraChoice extends sfWidgetFormInput
{
  /**
   * Constructor.
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addOption('culture', sfPlop::get('sf_plop_default_culture'));
    $this->addOption('url', '@sf_plop_ws_repository');
    $this->addOption('query_string', array(
      'folder=/assets',
      'type=file'
    ));
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if (isset($attributes['class']))
      $attributes['class'] .= ' w-autocomplete';
    else
      $attributes['class'] = 'w-autocomplete';

    $attributes['data-autocomplete-url'] = url_for($this->getOption('url')
      . '?sf_culture=' . $this->getOption('culture'))
      . '?' . implode('&', $this->getOption('query_string'));

    return parent::render($name, $value, $attributes, $errors);
  }
}