<?php
/*
 * Plugin Name:       ZR Member
 * Plugin URI:        https://github.com/zahedur/wp-plugins-zr-member
 * Description:       The ZR Member plugin provides functionality for managing members on your WordPress website. It allows you to add, edit, and delete members easily.
 * Version:           1.0.0
 * Author:            Zahedur Rahman
 * Author URI:        https://zahedur.com
 * Text Domain:       zr-member
 * Domain Path:       /languages
 */

use Zr\Member\Zr_Admin;
use Zr\Member\Models\Zr_Member_Model;
use Zr\Member\Controllers\Zr_Member_Controller;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load composer autoload file
require_once __DIR__.'/vendor/autoload.php';

/**
 * Class Zr_Member
 * Main class for the zr member plugin.
 */
class Zr_Member {

    /**
     * Zr_Member constructor.
     * Initializes the main components related to zr Member.
     */
    public function __construct()
    {
        new Zr_Admin();
        new Zr_Member_Controller();
        add_action('init', [$this, 'init']);
        new Zr_Member_Model();
    }

    public function init() {
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );
    }


    /**
     * Enqueue styles.
     */
    public function enqueue_scripts()
    {
        wp_register_style( 'zr-member', plugins_url( 'assets/css/style.css', __FILE__ ) );

        wp_register_style( 'zr-member-bootstrap', plugins_url( 'assets/lib/bootstrap/css/bootstrap.min.css', __FILE__ ) );
        wp_register_style( 'zr-member-animatecss', plugins_url( 'assets/lib/animatecss/animate.css', __FILE__ ) );
        wp_register_script( 'zr-member-bootstrap', plugins_url( 'assets/lib/bootstrap/js/bootstrap.bundle.min.js', __FILE__ ) );
        wp_register_script( 'zr-member-sweetalert', plugins_url( 'assets/lib/sweetalert2/sweetalert2.js', __FILE__ ) );
        wp_register_script( 'zr-member-custom', plugins_url( 'assets/js/custom.js', __FILE__ ) );
    }

}

// Instantiate the Zr_Member class to initialize the plugin.
new Zr_Member();