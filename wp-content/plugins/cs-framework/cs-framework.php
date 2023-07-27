<?php
/**
 * Plugin Name: cs framework
 * Plugin URI: http://themeforest.net/user/Chimpstudio/
 * Description: Goalclub cs framework
 * Version: 1.5
 * Author: ChimpStudio
 * Author URI: http://themeforest.net/user/Chimpstudio/
 * @package WP Goalclub
 * Text Domain: framework
 */

// Direct access not allowed.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class cs_framework {

    public $admin_notices;

    /**
     * construct function.
     */
    public function __construct() {
        // Define constants
        define('FRAMEWORK_CORE_DIR', WP_PLUGIN_DIR . '/cs-framework');
        define('FRAMEWORK_LANGUAGES_DIR', FRAMEWORK_CORE_DIR . '/languages');
        $this->admin_notices = array();
        //admin notices
        add_action('admin_notices', array( $this, 'framework_notices_callback' ));
        // Initialize plugin
        add_action('init', array( $this, 'init' ), 1);
		
    }

    /**
     * Initialize application, load text domain, enqueue scripts, include classes and add actions
     */
    public function init() {
        // Add Plugin textdomain
        $locale = apply_filters('plugin_locale', get_locale(), 'framework');
        load_textdomain('framework', FRAMEWORK_LANGUAGES_DIR . '/cs-framework' . "-" . $locale . '.mo');
        load_plugin_textdomain('framework', false, FRAMEWORK_LANGUAGES_DIR);

        /*Required files for front end*/
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }


    /**
     * Admin notification
     */
    public function framework_notices_callback() {
        if ( isset($this->admin_notices) && ! empty($this->admin_notices) ) {
            foreach ( $this->admin_notices as $value ) {
                echo $value;
            }
        }
    }

}

new cs_framework();

/* add action widget register */
if (!function_exists('cs_widget_register')) {
    function cs_widget_register($name) {
        add_action( 'widgets_init', function() use ($name) { return register_widget($name); } );
    }
}

/* add action for meta boxes */
if (!function_exists('cs_meta_boxes')) {
    function cs_meta_boxes($name) {
        add_action( 'add_meta_boxes', $name);
    }
}

/* add meta boxe */
if (!function_exists('cs_meta_box')) {
    function cs_meta_box($id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null) {
		add_meta_box( $id, __($title,'framework'), $callback, $screen , $context , $priority, $callback_args);  
    }
}

/* send mail */
if (!function_exists('cs_mail')) {
    function cs_mail($to, $subject, $message, $headers = '', $attachments = array()) {
		return wp_mail( $to, $subject, $message, $headers, $attachments);  
    }
}

/* base 64 encode */
if (!function_exists('base_64_encode')) {
    function base_64_encode($string = '') {
		return base64_encode($string); 
    }
}

/* base 64 decode */
if (!function_exists('base_64_decode')) {
    function base_64_decode($string = '') {
		return base64_decode($string); 
    }
}

/* register taxonomy */
if (!function_exists('cs_register_taxonomy')) {
    function cs_register_taxonomy($taxonomy, $object_type, $args ) {
		register_taxonomy($taxonomy, $object_type, $args ); 
    }
}

/* register post type */
if (!function_exists('cs_register_post_type')) {
    function cs_register_post_type( $post_type, $args = array() ) {
		 register_post_type( $post_type, $args );
    }
}

/* initialize CURL issue resolve */
if (!function_exists('cs_curl')) {
    function cs_curl() {
			$ci = curl_init();
			return $ci;
    }
}

/* Execute CURL issue resolve */
if (!function_exists('cs_curl_exec')) {
    function cs_curl_exec($ci) {
			$response = curl_exec($ci); 	
			return $response;
    }
}

/* add short code */
if (!function_exists('cs_shortcode_add')) {
    function cs_shortcode_add($tag, $callback) {
			add_shortcode($tag, $callback);
    }
}

/* deregister script */
if (!function_exists('cs_wp_der_script')) {
    function cs_wp_der_script($var) {
			wp_deregister_script($var);
    }
}

/* return $_SERVER  */
if (!function_exists('cs_glob_server')) {
    function cs_glob_server($var) {
		if($var != ''){
			return $_SERVER[$var];
		}else{
			return $_SERVER;
		}
			
    }
}

/* Remove filter */
if (!function_exists('cs_remove_filters')) {
    function cs_remove_filters($tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
			remove_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1 );
    }
}


/* special_function */
if (!function_exists('cs_special_function')) {
    function cs_special_function($value) {
			if(isset($value) && $value != ''){
				return $value;
			}
			return false;
    }
}

/* cs_check_underscore_translation_error */
if (!function_exists('cs_check_underscore_translation_error')) {
    function cs_check_underscore_translation_error($value, $text_domain) {

       if($value != '' && $text_domain != '' && $text_domain == 'goalklub'){
            return __($value, $text_domain);

       }else if ($text_domain != 'goalklub'){
           return __($value, 'goalklub');

       }else if ($value == ''){
           return __('NULL', $text_domain);

       }else if($text_domain == ''){
           return __($value, 'goalklub');

       }else if(is_object($value)){
           return __('Object', $text_domain);

       }else if (is_array($value)){
           return __('array', $text_domain);

       }else{
           return __('Some thing else', $text_domain);
       }
    }
}


/* cs_check_e_translation_error */
if (!function_exists('cs_check_e_translation_error')) {
    function cs_check_e_translation_error($value, $text_domain) {

        if($value != '' && $text_domain != '' && $text_domain == 'goalklub'){
            return _e($value, $text_domain);

        }else if ($text_domain != 'goalklub'){
            return _e($value, 'goalklub');

        }else if ($value == ''){
            return _e('NULL', $text_domain);

        }else if($text_domain == ''){
            return _e($value, 'goalklub');

        }else if(is_object($value)){
            return _e('Object', $text_domain);

        }else if (is_array($value)){
            return _e('array', $text_domain);

        }else{
            return _e('Some thing else', $text_domain);
        }
    }
}

