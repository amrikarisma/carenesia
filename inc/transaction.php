<?php

/**
 * Transaction func
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$current_db_version = 1;
$installed_db_version = (int)get_option('db_transactions_version', 0);

if ($current_db_version > $installed_db_version) {
    app_create_transactions_db();
    update_option('db_transactions_version', $current_db_version);
}

add_action('wp_ajax_create_donation',  'create_donation_ajax');
add_action('wp_ajax_nopriv_create_donation', 'create_donation_ajax');
add_action('wp_ajax_update_donation',  'update_donation_ajax');
add_action('wp_ajax_nopriv_update_donation', 'update_donation_ajax');

add_action('wp_ajax_manual_confirmation',  'manual_confirmation_ajax');
add_action('wp_ajax_nopriv_manual_confirmation', 'manual_confirmation_ajax');

function app_create_transactions_db()
{
    global $wpdb;

    // define query
    $query = array(
        "CREATE TABLE {$wpdb->prefix}transactions (
      transaction_id BIGINT NOT NULL AUTO_INCREMENT,
      transaction_post_id BIGINT(20) NOT NULL,
      transaction_amount BIGINT(20) NOT NULL,
      transaction_name VARCHAR(180) NOT NULL,
      transaction_email VARCHAR(180) NOT NULL,
      transaction_payment_method VARCHAR(180) NOT NULL,
      transaction_bank VARCHAR(180) NOT NULL,
      transaction_status VARCHAR(30) NOT NULL,
      transaction_external_id VARCHAR(190) NOT NULL,
      transaction_request_date DATETIME NOT NULL,
      transaction_paid_date DATETIME NULL,
      PRIMARY KEY (transaction_id)
    )"
    );

    // execute query
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);
}

function add_donation($data)
{

    global $wpdb;

    $query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}transactions where `transaction_status` = 'PENDING' AND `transaction_external_id` = '{$data['external_id']}' ");

    if (!empty($query)) {
        return false;
    }

    return $wpdb->insert($wpdb->prefix . 'transactions', array(
        'transaction_post_id' => $data['post_id'],
        'transaction_amount' => $data['amount'],
        'transaction_name' => $data['name'],
        'transaction_email' => $data['email'],
        'transaction_payment_method' => $data['payment_method'],
        'transaction_bank' => $data['bank'],
        'transaction_status' => $data['status'],
        'transaction_external_id' => $data['external_id'],
        'transaction_request_date' => $data['request_date'],
        'transaction_paid_date' => $data['paid_date'] ?? null,
    ));
}

function get_donation($condition, $value = null)
{
    global $wpdb;
    if ($condition == 'post_id') {
        $query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}transactions where `post_id` = '{$value}' ");
    } elseif ($condition == 'total') {
        $query = $wpdb->get_var("SELECT SUM(transaction_amount) FROM {$wpdb->prefix}transactions where `transaction_post_id` = '{$value}' AND (`transaction_status` = 'PAID' OR `transaction_status` = 'CAPTURED') ");
    } elseif ($condition == 'check') {
        $query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}transactions where `transaction_status` = 'PENDING' AND `transaction_external_id` = '{$value}' ");
    } elseif ($condition == 'needconfirm') {
        $query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}transactions where `transaction_status` = 'PENDING' AND `transaction_image` IS NOT NULL ");
    }
    $results = $query;
    return $results;
}

function update_donation($data)
{
    global $wpdb;

    $param['transaction_paid_date'] = strtotime(date_i18n('Y-m-d H:i:s'));

    if (isset($data['status'])) {
        $param['transaction_status'] = $data['status'];
    }
    if (isset($data['bank_code'])) {
        $param['transaction_bank'] = $data['bank_code'];
    }
    if (isset($data['paid_date'])) {
        $param['transaction_paid_date'] = $data['paid_date'];
    }
    if (isset($data['image'])) {
        $param['transaction_image'] = $data['image'];
    }

    $results = $wpdb->update($wpdb->prefix . 'transactions', $param, array(
        // where clause
        'transaction_external_id' => $data['external_id']
    ));

    return json_encode($results);
}
function delete_donation()
{
    global $wpdb;
    $wpdb->delete($wpdb->prefix . 'transactions', array(
        'subscriber_email' => 'friyanto@gmail.com'
    ));
}

function create_donation_ajax()
{
    $store_donation = add_donation([
        'post_id'   => (int)$_POST['post_id'],
        'amount'    => (int)$_POST['amount'],
        'name'    => $_POST['name'],
        'email'    => $_POST['email'],
        'request_date'    => current_time('mysql'),
        'payment_method'    => $_POST['method'],
        'bank'    => $_POST['bank'],
        'status'    => $_POST['status'],
        'external_id'    => $_POST['external_id'],
    ]);

    echo $store_donation;
    wp_die();
}
function update_donation_ajax()
{
    $update = update_donation([
        'external_id'   => $_POST['external_id'],
        'status'    => $_POST['status'],
        'paid_date'    => $_POST['paid_date'],
    ]);

    echo $update;
    wp_die();
}

function manual_confirmation_ajax()
{
    global $wpdb;

    $query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}transactions where `transaction_status` = 'PENDING' AND `transaction_external_id` = '{$_POST['external_id']}' ");
    if (empty($query)) {
        $data = [
            'status'    => 'failed',
            'message'   => 'data not found'
        ];
        echo json_encode($data);
        wp_die();
    }
    $update = update_donation([
        'external_id'   => $_POST['external_id'],
        'status'    => $_POST['status'],
        'paid_date'    => current_time('mysql'),
    ]);

    if ($update) {
        $data = [
            'status'    => 'success',
            'message'   => 'success update status'
        ];
    } else {
        $data = [
            'status'    => 'failed',
            'message'   => 'failed update status',
        ];
    }
    echo json_encode($data);
    wp_die();
}
