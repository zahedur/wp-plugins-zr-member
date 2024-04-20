<?php

// plugin version
function zr_member_db_version(): string
{
    return '1.0.0';
}

// Display error messages for input field
function field_validation($errors, $field) {
    if ( isset( $errors ) && array_key_exists('errors', $errors) ) {
        if ( array_key_exists( $field, $errors['errors'] ) ) {
            return '<span class="text-danger">' . esc_html( $errors['errors'][$field] ) . '</span>';
        }
    }
}
