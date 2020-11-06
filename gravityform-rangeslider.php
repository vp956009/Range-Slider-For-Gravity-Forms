<?php  
/**
 * Plugin Name: Range Slider for Gravity Form
 * Description: This plugin allows create Rangeslider for gravityfrom.
 * Version: 1.0
 * Author: Ocean Infotech
 * Author URI: https://www.xeeshop.com
 * Copyright:2019 
 */
if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('OCRSGF_PLUGIN_NAME')) {
    define('OCRSGF_PLUGIN_NAME', 'Range Slider Gravity Form');
}
if (!defined('OCRSGF_PLUGIN_VERSION')) {
    define('OCRSGF_PLUGIN_VERSION', '2.0.0');
}
if (!defined('OCRSGF_PLUGIN_FILE')) {
    define('OCRSGF_PLUGIN_FILE', __FILE__);
}
if (!defined('OCRSGF_PLUGIN_DIR')) {
    define('OCRSGF_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCRSGF_DOMAIN')) {
    define('OCRSGF_DOMAIN', 'ocrsgf');
}
if (!class_exists('OCRSGF')) {

  	class OCRSGF {
      protected static $OCRSGF_instance;
  
      function includes() {
                     include_once('admin/gravity_rangeslider.php');
      }
      function init() { 
            add_action( 'wp_enqueue_scripts',array($this,'enqueue_custom_script'), 9000);  
            add_action('admin_enqueue_scripts', array($this, 'OCRSGF_load_admin_script_style'));      
      }
      function OCRSGF_load_admin_script_style(){
       wp_enqueue_style( 'OCRSGF_admin_css', OCRSGF_PLUGIN_DIR . '/includes/css/admin_style.css', false, '1.0.0' );
      
      }
      function enqueue_custom_script() {
          //wp_enqueue_script( 'custom_script_jquery', OCRSGF_PLUGIN_DIR.'/includes/js/jquery.min.js');
          wp_enqueue_style( 'OCGFRS-style-css', OCRSGF_PLUGIN_DIR . '/includes/css/style.css', false, '2.0.0' );
          wp_enqueue_script( 'OCGFRS-jquery-ui-js', OCRSGF_PLUGIN_DIR .'/includes/js/jquery-ui.js', false, '2.0.0' );
          wp_enqueue_script( 'OCGFRS-jquery-ui-touch-punch-js', OCRSGF_PLUGIN_DIR .'/includes/js/jquery.ui.touch-punch.min.js', false, '2.0.0' );
          wp_enqueue_style( 'OCGFRS-jquery-ui-css', OCRSGF_PLUGIN_DIR .'/includes/js/jquery-ui.css', false, '2.0.0' );  
          wp_enqueue_style( 'OCGFRS-jquery-ui-slider-pips-css', OCRSGF_PLUGIN_DIR .'/includes/js/jquery-ui-slider-pips.css', false, '2.0.0' ); 
      
          wp_enqueue_script( 'OCGFRS-jquery-ui-slider-pips-js', OCRSGF_PLUGIN_DIR .'/includes/js/jquery-ui-slider-pips.js', false, '2.0.0' );
          wp_enqueue_script( 'custom_script', OCRSGF_PLUGIN_DIR.'/includes/js/front.js');
      }
          //Plugin Rating
      public static function do_activation() {
            set_transient('ocgfrs-first-rating', true, MONTH_IN_SECONDS);
      }
      public static function OCRSGF_instance() {
        if (!isset(self::$OCRSGF_instance)) {
          self::$OCRSGF_instance = new self();
          self::$OCRSGF_instance->init();
          self::$OCRSGF_instance->includes();
          }
        return self::$OCRSGF_instance;
          }
  		}
  		add_action('plugins_loaded', array('OCRSGF', 'OCRSGF_instance'));
      register_activation_hook(OCRSGF_PLUGIN_FILE, array('OCRSGF', 'do_activation'));
}
