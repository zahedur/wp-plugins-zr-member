<?php

namespace Zr\Member\models;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Member Database table model.
 */
class Zr_Member_Model
{
    private string $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'zr_member';

        $zr_member_db_version = get_option('zr_member_db_version');

        if ($zr_member_db_version !== zr_member_db_version()) {
            register_activation_hook(dirname(__FILE__, 3) . '/zr-member.php', [$this, 'create_database_tables']);
            $this->create_database_tables();
        }
    }

    /**
     * return table name.
     */
    public function modelName(): string
    {
        return $this->table_name;
    }

    /**
     * Create database table.
     */
    public function create_database_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $this->table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        update_option('zr_member_db_version', zr_member_db_version());
    }
}