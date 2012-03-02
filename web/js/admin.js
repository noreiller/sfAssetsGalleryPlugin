var sfAssetGalleryAdmin = {

  init: function () {
    sfAssetGalleryAdmin.fixAssetLoader();
  },

  initOnDomReady: function () {
  },

  fixAssetLoader: function () {
//    window.removeEventListener('onLoad', sfAssetsLibrary.load, false);
    sfAssetsLibrary.load.prototype = sfAssetGalleryAdmin.newAssetLoader();
  },

  newAssetLoader: function () {
    var asset_url = document.getElementById('sf_asset_js_url');
    if (asset_url)
    {
      var url = asset_url.firstChild.data
      sfAssetsLibrary_Engine.url = url;
    }

    if (jQuery('.sf_asset_input_image').length > 0) {
      jQuery('.sf_asset_input_image').each(function(i,el) {
        sfAssetsLibrary.addEvent(el, 'click', function(e) {
          eval('var rel = ' + el.getAttribute('rel'));
          var fname = el.previousSibling.form.name;
          if (fname == undefined || fname == '')
            el.previousSibling.form.name = fname = 'sf_asset_input_image_form';
          sfAssetsLibrary.openWindow({
            form_name: fname,
            field_name: rel.name,
            type: rel.type,
            url: rel.url,
            scrollbars: 'yes'
          });
          sfAssetsLibrary.prevDef(e);
          sfAssetsLibrary.stopProp(e);
        }, false);
      });
    }

    if (jQuery('.sf_asset_delete_image').length > 0) {
      jQuery('.sf_asset_delete_image').each(function(i,el) {
        sfAssetsLibrary.addEvent(el, 'click', function(e) {
          document.getElementById(el.getAttribute('rel')).value = '';
          document.getElementById(el.getAttribute('rel') + '_img').src = '/sfAssetsLibraryPlugin/images/unknown.png';
          sfAssetsLibrary.prevDef(e);
          sfAssetsLibrary.stopProp(e);
        }, false);
      });
    }
  }

};

/**
 * Init on DOM ready.
 */
jQuery(document).ready(function (){
  sfAssetGalleryAdmin.initOnDomReady();
});

/**
 * Init now
 */
sfAssetGalleryAdmin.init();

