<?php

namespace Zr\Member;

// Exit if accessed directly
use Zr\Member\Controllers\Zr_Member_Controller;
use Zr\Member\models\Zr_Member_Model;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Zr_Admin_Post_View_Count
 *
 * This class manages the display and sorting of post view counts in the WordPress admin panel.
 */
class Zr_Admin
{
    /**
     * Zr_Admin constructor.
     * Registers necessary hooks for initializing the functionality.
     */
    public function __construct()
    {
        add_action('init', [$this, 'init']);
    }

    /**
     * Initialization function.
     */
    public function init()
    {
        //create an admin page
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {

        add_menu_page(
            esc_html__('ZR Members', 'zr-member'),
            esc_html__('ZR Members', 'zr-member'),
            'manage_options',
            'zr-member',
            [$this, 'zr_members'],
            'dashicons-groups'
        );

        add_submenu_page(
            'zr-member',
            esc_html__('Add New Member', 'zr-member'),
            esc_html__('Add New Member', 'zr-member'),
            'manage_options',
            'add-new-member',
            [$this, 'add_new_member']
        );

    }

    public function zr_members() {
        $zr_member_controller = new Zr_Member_Controller();
        $zr_member_controller->zr_members();
    }

    public function add_new_member() {
        $zr_member_controller = new Zr_Member_Controller();
        $zr_member_controller->zr_add_member();
    }

}
