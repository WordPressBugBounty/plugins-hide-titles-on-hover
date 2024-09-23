<?php
/*
Plugin Name: Hide titles on hover
Description: When you go over a link with your mouse, the title of that link will not appear any more.
Author: Jose Mortellaro
Author URI: https://josemortellaro.com
Domain Path: /languages/
Text Domain: hide-titles-on-hover
Version: 0.0.5
*/
/*  This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'wp_footer',function(){
  ?>
  <script id="hide-title-attributes">
  function hide_title_attributes(el){
    var t = el.querySelectorAll('[title]');
    if(t && t.length > 0){
      for(var n=0;n<t.length;++n){
        var title=t[n].title;
        t[n].removeAttribute('title');
        t[n].setAttribute('aria-label',title);
      }
    }
  }
  hide_title_attributes(document.body);
  document.body.onmouseover = function(e){
    if(e.target.innerHTML.indexOf('title=')>-1){
      hide_title_attributes(e.target);   
    }
    else if(e.target.title){
      var t=e.target.title;
      e.target.removeAttribute('title');
      e.target.setAttribute('aria-label',t);     
    }
  }
  </script>
  <?php
},999999 );

add_filter( 'plugin_action_links_hide-titles-on-hover/hide-titles-on-hover.php', function ( $links ) {
  // Add a settings link to the action links in the plugins page.
  $settings_link = ' | <a class="htoh-upgrade" style="color:#B07700;font-weight:bold" target="_htoh" rel="noopener" href="https://shop.josemortellaro.com/downloads/custom-title-tooltip/">'. __( 'Upgrade','hide-titles-on-hover' ). ' <span style="position:relative;top:-10px;' . ( is_rtl() ? 'right' : 'left' ) . ':-6px;display:inline-block">👑</span></a>';
  array_push( $links, $settings_link );
  return $links;
} );
