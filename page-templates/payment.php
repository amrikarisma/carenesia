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


if (isset($_GET['va']) && $_GET['va'] == 'paid') {
    var_dump($_GET);
    die();
    return;
}


$nominal = $_POST['nominal'];
$bank = $_POST['va_banks'];
$name = $_POST['first_name'] . ' ' . $_POST['last_name'];

$params = [
    "external_id" => "VA_fixed-" . strtotime(date_i18n('Y-m-d H:i:s')),
    "bank_code" => $bank,
    "name" => $name,
    "expected_amount"   => $nominal
];

$createVA = \Xendit\VirtualAccounts::create($params);

get_header();

get_template_part('section-templates/general/general', 'header');
get_template_part('loop-templates/content', 'payment', $createVA);

get_footer();
