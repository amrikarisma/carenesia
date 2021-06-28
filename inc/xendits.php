<?php

/**
 * Add Xendits support
 *
 * @package Xendits
 */

use Xendit\Balance;
use Xendit\Xendit;

require __DIR__ . '/../vendor/autoload.php';

// Exit if accessed directly.
defined('ABSPATH') || exit;

class Xendit_PG
{
    function __construct()
    {
        define('XENDIT_API_KEY', 'xnd_development_t0AMdVe0KbcNUIX6DannLBVUx6BonTrCr4UYJAQUa4lcWbjtnyCrRf5nq');
        define('XENDIT_PUBLIC_API_KEY', 'xnd_public_development_039TJL12Pcug6HJ5f8lphjP0VIYABLanQeMuy89glG7HS4FP3MdsCflAMGBS');
        Xendit::setApiKey(XENDIT_API_KEY);
        // add_action('wp_ajax_create_charge',  array($this, 'create_charge_credit_card'));
        // add_action('wp_ajax_nopriv_create_charge', array($this, 'create_charge_credit_card'));
    }
}


$pg = new Xendit_PG();
