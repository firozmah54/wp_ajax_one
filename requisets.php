<?php 
/**
 * Plugin Name: Ajax Requires Plugin
 * Plugin URI: https://wedevs.academy
 * Description:  how to ajax requires in  WordPress.
 * Version: 0.1.0
 * Author: Firoz mahmud
 * Author URI: https://firoz.co
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ajax
 */

 if(!defined('ABSPATH')) {
    exit;
 }

 class Wedevs_Ajax_Requires_Plugin {
    private static $instance;
    public static function get_instance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->register_constants();
        $this->require_classes();
    }
     public function require_classes() {
        require_once __DIR__ . '/includes/ajax.php';
        
        new wedevs_Ajax_requiest_wp_plugin();
    }

    private function register_constants() {
		define( 'WEDEVS_ACADEMY_URL', plugin_dir_url( __FILE__ ) );
	}
 }

 Wedevs_Ajax_Requires_Plugin::get_instance();