<?php

/**
 * Template Name: Payment Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package UnderStrap
 */

use Xendit\Payouts;
use Xendit\Xendit;

// Exit if accessed directly.
defined('ABSPATH') || exit;


$json = file_get_contents('php://input');

if (isset($_GET['va']) && $_GET['va'] == 'paid') {
    header('Content-Type: application/json');
    echo $json;
    return;
}

if (isset($_GET['va']) && $_GET['va'] == 'created') {
    header('Content-Type: application/json');
    echo $json;
    return;
}



$nominal = (int)$_POST['nominal'];
$bank = $_POST['va_banks'];
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
    'callback_url' => 'https://webhook.site',
    'amount' => $nominal,
];

$qr_code = \Xendit\QRCode::create($paramsQR);
$args = [
    'qr_code'   => $qr_code,
    'va'        => $createVA
];
get_header();

get_template_part('section-templates/general/general', 'header');
get_template_part('loop-templates/content', 'payment', $args);

get_footer();
