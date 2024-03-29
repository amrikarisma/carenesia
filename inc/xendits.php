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
        add_action('wp_ajax_create_charge',  array($this, 'create_charge_credit_card'));
        add_action('wp_ajax_nopriv_create_charge', array($this, 'create_charge_credit_card'));
        add_action('wp_ajax_capture_charge',  array($this, 'capture_charge_credit_card'));
        add_action('wp_ajax_nopriv_capture_charge', array($this, 'capture_charge_credit_card'));
        add_action('wp_ajax_get_charge',  array($this, 'get_charge_credit_card'));
        add_action('wp_ajax_nopriv_get_charge', array($this, 'get_charge_credit_card'));
    }

    public function create_charge_credit_card()
    {
        $params = [
            'token_id' => $_POST['token_id'],
            'external_id' => 'card_' . time(),
            'authentication_id' => $_POST['authentication_id'],
            'amount' => $_POST['nominal'],
            'card_cvn' => $_POST['cc-cvc'],
            'capture' => false
        ];

        $createCharge = \Xendit\Cards::create($params);
        echo json_encode($createCharge);
        wp_die();
    }

    public function capture_charge_credit_card()
    {
        $id = $_POST['id'];
        $params = ['amount' => (int)$_POST['amount']];

        $captureCharge = \Xendit\Cards::capture($id, $params);
        echo json_encode($captureCharge);
        wp_die();
    }

    public function get_charge_credit_card()
    {
        $id = $_POST['id'];

        $getCharge = \Xendit\Cards::retrieve($id);
        echo json_encode($getCharge);
        wp_die();
    }
}


$pg = new Xendit_PG();
