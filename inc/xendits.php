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
        Xendit::setApiKey('xnd_development_t0AMdVe0KbcNUIX6DannLBVUx6BonTrCr4UYJAQUa4lcWbjtnyCrRf5nq');
    }
}


$pg = new Xendit_PG();



// $params = [
//     "external_id" => "VA_fixed-12341234",
//     "bank_code" => "MANDIRI",
//     "name" => "Steve Wozniak"
// ];

// $createVA = \Xendit\VirtualAccounts::create($params);
// print_r($createVA);
// die();
