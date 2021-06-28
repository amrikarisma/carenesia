<?php

/**
 * Template Name: Payment Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package UnderStrap
 */

use SimpleSoftwareIO\QrCode\Generator;
use Xendit\Payouts;
use Xendit\Xendit;

// Exit if accessed directly.
defined('ABSPATH') || exit;


$json = json_decode(file_get_contents('php://input'));

if (isset($_GET['va']) && $_GET['va'] == 'paid') {
    $update = update_donation([
        'external_id'   => $json->external_id,
        'status'    => $json->status,
        'bank_code'    => $json->bank_code
    ]);
    header('Content-Type: application/json');
    echo $update;
    return;
}

if (isset($_GET['va']) && $_GET['va'] == 'created') {
    $update = update_donation([
        'external_id'   => $json->external_id,
        'status'    => $json->status,
        'bank_code'    => $json->bank_code
    ]);
    header('Content-Type: application/json');
    echo $update;
    return;
}
if (isset($_GET['qr']) && $_GET['qr'] == 'webhook') {
    $update = update_donation([
        'external_id'   => $json->qr_code->external_id,
        'status'    => $json->status,
        'bank_code'    => 'QR Code'
    ]);
    header('Content-Type: application/json');
    echo $update;
    return;
}
if (isset($_GET['invoice']) && $_GET['invoice'] == 'paid') {
    $update = update_donation([
        'external_id'   => $json->external_id,
        'status'    => $json->status,
        'bank_code'    => $json->bank_code,
    ]);
    header('Content-Type: application/json');
    echo $update;
    return;
}

if (isset($_POST['payment_method'])) {
    $nominal = (int)$_POST['nominal'];

    if ($_POST['payment_method'] == 'credit_card') {
    } elseif ($_POST['payment_method'] == 'bank') {
        $bank = $_POST['va_banks'];
        $email = $_POST['email'];
        $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
        $external_id = "VA_fixed-" . strtotime(date_i18n('Y-m-d H:i:s'));
        $paramsVA = [
            "external_id" => $external_id,
            "bank_code" => $bank,
            "name" => $name,
            "expected_amount"   => $nominal
        ];

        $createVA = \Xendit\VirtualAccounts::create($paramsVA);

        $paramsQR = [
            'external_id' => $external_id,
            'type' => 'STATIC',
            'callback_url' => site_url('/pembayaran/?qr=webhook'),
            'amount' => $nominal,
        ];

        $qr_code = \Xendit\QRCode::create($paramsQR);

        $qrcode = new Generator;
        $args = [
            'qr_code'   => [
                'scan'  => $qrcode->size(300)->generate($qr_code['qr_string']),
            ],
            'va'        => $createVA
        ];

        add_donation([
            'post_id'   => (int)$_POST['post_id'],
            'amount'    => (int)$args['va']['expected_amount'],
            'name'    => $args['va']['name'],
            'email'    => $email,
            'request_date'    => current_time('mysql'),
            'bank'    => $args['va']['bank_code'],
            'status'    => $args['va']['status'],
            'external_id'    => $args['va']['external_id'],
        ]);
    }
}

get_header();

get_template_part('section-templates/general/general', 'header');

if (isset($args)) {
    get_template_part('loop-templates/content', 'payment', $args);
} else {
    if (isset($_GET['status']) && ($_GET['status'] == 'VERIFIED' || $_GET['status'] == 'APPROVED')) {

        get_template_part('loop-templates/content', 'payment-status', $success);
    }
}


get_footer();
