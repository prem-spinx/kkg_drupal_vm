(function ($, Drupal, drupalSettings) {
    var type = $('.acmenu').attr('data-typec');
	if(type){       
    switch(type) {   	
      case 'practices':
        var menuitem = '.my-practice';
        break;
      case 'attorney':
        var menuitem = '.my-attorney';
        break;
      case 'industries':
        var menuitem = '.my-industry';
        break;
      case 'news':
        var menuitem = '.my-new';
        break;
      default:
    }
    jQuery(menuitem).addClass("menu-item--active-trail is-active");
	}
})(jQuery, Drupal, drupalSettings);
$('#edit-list').addClass( 'cmn-select-box' );