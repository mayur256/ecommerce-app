<?php
/**
 * Common Constants that can be used thoughout the application
 */

namespace App\Utils;

class Constant {
    const INTERNAL_SERVER_ERROR = "Internal Server Error. Please contact server admin.";
    const INVALID_CREDS = "Invalid Credentials";
    const SOMETHING_WRONG = "Something went wrong. Please try again later.";
    const DELETE_SUCCESS = "deleted successfully!";
    const NOT_FOUND = "not found!";
    const ORDER_STATUS = array(
        'pending' => 'pending',
        'awaiting_payment' => 'awaiting payment',
        'awaiting_fulfillment' => 'awaiting fulfillment',
        'awaiting_shipment' => 'awaiting shipment',
        'awaiting_pickup' => 'awaiting pickup',
        'partially_shipped' => 'partially shippped',
        'shipped' => 'shipped',
        'cancelled' => 'cancelled',
        'declined' => 'declined',
        'refunded' => 'refunded',
        'disputed' => 'disputed',
    );

    const PAYMENT_METHODS = array(
        'cards' => 'cards',
        'net_banking' => 'net banking',
        'upi' => 'upi',
        'cod' => 'cash on delivery'
    );

    const PAYMENT_STATUS = array(
        'awaiting' => 'awaiting',
        'success' => 'success',
        'failed' => 'failed'
    );
}
