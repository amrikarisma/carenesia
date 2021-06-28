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
    $wpdb->insert($wpdb->prefix . 'transactions', array(
        'transaction_post_id' => $data['post_id'],
        'transaction_amount' => $data['amount'],
        'transaction_name' => $data['name'],
        'transaction_email' => $data['email'],
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
        $query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}transactions where `post_id` = {$value} ");
    } elseif ($condition == 'total') {
        $query = $wpdb->get_var("SELECT SUM(transaction_amount) FROM {$wpdb->prefix}transactions where `transaction_post_id` = {$value} AND `transaction_status` = 'ACTIVE'");
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


add_action('wp_ajax_create_charge',  'create_charge_credit_card');
add_action('wp_ajax_nopriv_create_charge', 'create_charge_credit_card');

function create_charge_credit_card()
{
    $params = [
        'token_id' => $_POST['token_id'],
        'external_id' => 'card_' . time(),
        'authentication_id' => $_POST['authentication_id'],
        'amount' => $_POST['nominal'],
        'card_cvn' => $_POST['cc-cvc'],
        'capture' => false
    ];

    // $createCharge = \Xendit\Cards::create($params);
    header('Content-Type: application/json');
    return wp_json_encode($params);
    die(); // this is required to terminate immediately and return a proper response
}
