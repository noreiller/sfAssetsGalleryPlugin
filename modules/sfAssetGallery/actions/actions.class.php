<?php

require_once dirname(__FILE__).'/../lib/sfAssetGalleryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfAssetGalleryGeneratorHelper.class.php';

/**
 * sfAssetGallery actions.
 *
 * @package    plop
 * @subpackage sfAssetGallery
 * @author     Aurélien MANCA <aurelien.manca@gmail.com>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class sfAssetGalleryActions extends autoSfAssetGalleryActions
{
  public function preExecute()
  {
    $module = 'sfAssetGallery';
    if (!in_array($module, array_keys(sfPlop::getSafePluginModules())))
      $this->forward404();

    if (!$this->getUser()->isAuthenticated())
      $this->forward(sfConfig::get('sf_login_module'), sfConfig::get('sf_login_action'));

    if (!$this->getUser()->hasCredential($module))
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));

    parent::preExecute();

    $user = $this->getUser();
    $user->setCulture($user->getProfile()->getCulture());

    ProjectConfiguration::getActive()->LoadHelpers(array('I18N'));
    $this->getResponse()->setTitle(sfPlop::setMetaTitle(__('Media galleries', '', 'plopAdmin')));
  }
}
