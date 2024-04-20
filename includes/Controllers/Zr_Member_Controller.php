<?php

namespace Zr\Member\Controllers;

use Zr\Member\Models\Zr_Member_Model;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Zr_Member_Controller
 *
 * The Zr_Member_Controller class handles member management actions for the Zr Member plugin.
 * It registers action hooks to process member creation, updating, and deletion in the WordPress admin panel.
 *
 * @since 1.0.0
 */
class Zr_Member_Controller
{
    public function __construct()
    {
        // Register action hooks for member management
        add_action( 'admin_post_zr_create_member_action', [$this, 'zr_create_member'] );
        add_action( 'admin_post_zr_update_member_action', [$this, 'zr_update_member'] );
        add_action( 'admin_post_zr_delete_member_action', [$this, 'zr_delete_member'] );
    }

    /**
     * All member List.
     */
    public function zr_members() {
        global $wpdb;

        $member_model = new Zr_Member_Model();

        if (isset($_GET['zr_member_edit'])) {
            $member_id = $_GET['zr_member_id'];

            // Prepare SQL query to select a row by ID
            $query = $wpdb->prepare("SELECT * FROM {$member_model->modelName()} WHERE id = %d", $member_id);

            // Get the single row
            $member = $wpdb->get_row($query);

            return include_once(plugin_dir_path(__FILE__) . '../Views/pages/edit-member.php');
        }


        $members = $wpdb->get_results("SELECT * FROM {$member_model->modelName()}");
        $total_members = $wpdb->get_var("SELECT COUNT(*) FROM {$member_model->modelName()}");

        include_once(plugin_dir_path(__FILE__) . '../Views/pages/members.php');
    }

    /**
     * Add New Member.
     */
    public function zr_add_member() {
        include_once(plugin_dir_path(__FILE__) . '../Views/pages/add-member.php');
    }

    /**
     * Create New Member.
     */
    public function zr_create_member() {
        // Verify nonce
        if ( ! isset( $_POST['zr_create_member'] ) || ! wp_verify_nonce( $_POST['zr_create_member'], 'zr_create_new_member' ) ) {
            // Nonce verification failed, handle the error or redirect
            wp_die( esc_html__('Security check failed!', 'zr-member'), 'Error', array( 'response' => 403 ) );
        }

        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_text_field( sanitize_email($_POST['email']) );


        // Validation
        $validation = $this->validation($_POST);

        if ( ! empty( $validation ) ) {
            // Redirect back to the form with error messages
            $redirect_url = add_query_arg( 'errors', $validation, wp_get_referer() );
            wp_redirect( $redirect_url );
            exit;
        }

        global $wpdb;
        $memberModel = new Zr_Member_Model();
        $wpdb->insert($memberModel->modelName(), ['name' => $name, 'email' => $email]);

        $redirect_url = add_query_arg( 'zr_success_msg', esc_html__('Member created successfully!', 'zr-member'), admin_url( 'admin.php?page=zr-member' ) );
        wp_redirect( $redirect_url );
    }

    /**
     * Update Member.
     */
    public function zr_update_member() {
        // Verify nonce
        if ( ! isset( $_POST['zr_update_member'] ) || ! wp_verify_nonce( $_POST['zr_update_member'], 'zr_update_member_action' ) ) {
            // Nonce verification failed, handle the error or redirect
            wp_die( esc_html__('Security check failed!', 'zr-member'), 'Error', array( 'response' => 403 ) );
        }

        $id = sanitize_text_field($_POST['id']);
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_text_field( sanitize_email($_POST['email']) );


        // Validation
        $validation = $this->validation($_POST);

        if ( ! empty( $validation ) ) {
            // Redirect back to the form with error messages
            $redirect_url = add_query_arg( 'errors', $validation, wp_get_referer() );
            wp_redirect( $redirect_url );
            exit;
        }

        global $wpdb;
        $memberModel = new Zr_Member_Model();
        $wpdb->update($memberModel->modelName(), ['name' => $name, 'email' => $email], ['id' => $id]);

        $redirect_url = add_query_arg( 'zr_success_msg', esc_html__('Member updated successfully!', 'zr-member'), admin_url( 'admin.php?page=zr-member' ) );
        wp_redirect( $redirect_url );
    }

    /**
     * Delete Member.
     */
    public function zr_delete_member() {
        // Verify nonce
        if ( ! isset( $_POST['zr_delete_member'] ) || ! wp_verify_nonce( $_POST['zr_delete_member'], 'zr_delete_member_action' ) ) {
            // Nonce verification failed, handle the error or redirect
            wp_die( esc_html__('Security check failed!', 'zr-member'), 'Error', array( 'response' => 403 ) );
        }

        $id = sanitize_text_field($_POST['id']);

        global $wpdb;
        $memberModel = new Zr_Member_Model();

        $wpdb->delete($memberModel->modelName(), ['id' => $id]);

        $redirect_url = add_query_arg( 'zr_success_msg', esc_html__('Member deleted successfully!', 'zr-member'), admin_url( 'admin.php?page=zr-member' ) );
        wp_redirect( $redirect_url );
    }

    /**
     * Member Add, Update Validation.
     */
    private function validation($data) {
        $errors = [];

        // Validate form data
        if ( empty( $data['name'] ) ) {
            $errors['name'] = esc_html__('Name field is required.', 'zr-member');
        }

        if ( empty( $data['email'] ) ) {
            $errors['email'] = esc_html__('Email field is required.', 'zr-member');
        }else {
            if ( ! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = esc_html__('Invalid email address.', 'zr-member');
            }
        }
        return $errors;

    }
}