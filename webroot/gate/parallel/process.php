<?php

session_start();

/*
 * Use the Pay API operation to transfer funds from a sender�s PayPal account to one or more receivers� PayPal accounts. You can use the Pay API operation to make simple payments, chained payments, or parallel payments; these payments can be explicitly approved, preapproved, or implicitly approved.

  Use the Pay API operation to transfer funds from a sender's PayPal account to one or more receivers' PayPal accounts. You can use the Pay API operation to make simple payments, chained payments, or parallel payments; these payments can be explicitly approved, preapproved, or implicitly approved.

  Parallel payments are useful in cases when a buyer intends to make a single payment for items from multiple sellers. Examples include the following scenarios:

  a single payment for multiple items from different merchants, such as a combination of items in your inventory and items that partners drop ship for you.
  purchases of items related to an event, such as a trip that requires airfare, car rental, and a hotel booking.

 * Create your PayRequest message by setting the common fields. If you want more than a simple payment, add fields for the specific kind of request, which include parallel payments, chained payments, implicit payments, and preapproved payments.
 */
require_once('../PPBootStrap.php');
require_once('../Common/Constants.php');
define("DEFAULT_SELECT", "- Select -");
$returnUrl = "http://www.formget.com/tutorial/paypal-adaptive-payment/parallel/success.php";
$cancelUrl = "http://www.formget.com/tutorial/paypal-adaptive-payment/parallel/index.php";
$memo = "Adaptive Payment";
$actionType = "PAY";
$currencyCode = "USD";

if ($_POST['booking'] == 'f') {
    $receiverEmail = array("airline@outlook.com");
    $receiverAmount = array("300.00");
    $primaryReceiver = array("false");
    $_SESSION['facilty_provider'] = array("AirGo Airline's Test Store");
} elseif ($_POST['booking'] == 'h') {
    $receiverEmail = array("hotel@outlook.com");
    $receiverAmount = array("200.00");
    $primaryReceiver = array("false");
    $_SESSION['facilty_provider'] = array("Hotel TheCompany's Test Store");
} elseif ($_POST['booking'] == 'c') {
    $receiverEmail = array("car-merchants@outlook.com");
    $receiverAmount = array("100.00");
    $primaryReceiver = array("false");
    $_SESSION['facilty_provider'] = array("MyCar Car Company's Test Store");
} elseif ($_POST['booking'] == 'fh') {
    $receiverEmail = array("airline@outlook.com", "hotel@outlook.com");
    $receiverAmount = array("300.00", "200.00");
    $primaryReceiver = array("false", "false");
    $_SESSION['facilty_provider'] = array("AirGo Airline's Test Store", "Hotel TheCompany's Test Store");
} elseif ($_POST['booking'] == 'fc') {
    $receiverEmail = array("airline@outlook.com", "car-merchants@outlook.com");
    $receiverAmount = array("300.00", "100.00");
    $primaryReceiver = array("false", "false");
    $_SESSION['facilty_provider'] = array("AirGo Airline's Test Store", "MyCar Car Company's Test Store");
} elseif ($_POST['booking'] == 'hc') {
    $receiverEmail = array("hotel@outlook.com", "car-merchants@outlook.com");
    $receiverAmount = array("200.00", "100.00");
    $primaryReceiver = array("false", "false");
    $_SESSION['facilty_provider'] = array("Hotel TheCompany's Test Store", "MyCar Car Company's Test Store");
} elseif ($_POST['booking'] == 'fhc') {
    $receiverEmail = array("airline@outlook.com", "hotel@outlook.com", "car-merchants@outlook.com");
    $receiverAmount = array("295.00", "195.00", "95.00");
    $primaryReceiver = array("false", "false", "false");
    $_SESSION['facilty_provider'] = array("AirGo Airline's Test Store", "Hotel TheCompany's Test Store", "MyCar Car Company's Test Store");
} else {
    $receiverEmail = array("airline@outlook.com");
    $receiverAmount = array("300.00");
    $primaryReceiver = array("false");
    $_SESSION['facilty_provider'] = array("AirGo Airline's Test Store");
}
if (isset($receiverEmail)) {
    $receiver = array();
    /*
     * A receiver's email address 
     */
    for ($i = 0; $i < count($receiverEmail); $i++) {
        $receiver[$i] = new Receiver();

        $receiver[$i]->email = $receiverEmail[$i];
        /*
         *  	Amount to be credited to the receiver's account 
         */

        $receiver[$i]->amount = $receiverAmount[$i];
        /*
         * Set to true to indicate a chained payment; only one receiver can be a primary receiver. Omit this field, or set it to false for simple and parallel payments. 
         */
        $receiver[$i]->primary = $primaryReceiver[$i];
    }
    $receiverList = new ReceiverList($receiver);
}


/*
 * The action for this request. Possible values are:

  PAY � Use this option if you are not using the Pay request in combination with ExecutePayment.
  CREATE � Use this option to set up the payment instructions with SetPaymentOptions and then execute the payment at a later time with the ExecutePayment.
  PAY_PRIMARY � For chained payments only, specify this value to delay payments to the secondary receivers; only the payment to the primary receiver is processed.

 */
/*
 * The code for the currency in which the payment is made; you can specify only one currency, regardless of the number of receivers 
 */
/*
 * URL to redirect the sender's browser to after canceling the approval for a payment; it is always required but only used for payments that require approval (explicit payments) 
 */
/*
 * URL to redirect the sender's browser to after the sender has logged into PayPal and approved a payment; it is always required but only used if a payment requires explicit approval 
 */
$payRequest = new PayRequest(new RequestEnvelope("en_US"), $actionType, $cancelUrl, $currencyCode, $receiverList, $returnUrl);
// Add optional params

if ($memo != "") {
    $payRequest->memo = $memo;
}


/*
 * 	 ## Creating service wrapper object
  Creating service wrapper object to make API call and loading
  Configuration::getAcctAndConfig() returns array that contains credential and config parameters
 */
$service = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
try {
    /* wrap API method calls on the service object with a try catch */
    $response = $service->Pay($payRequest);
    $ack = strtoupper($response->responseEnvelope->ack);
    if ($ack == "SUCCESS") {
        $_SESSION['pay_key'] = $payKey = $response->payKey;
        $payKey = $response->payKey;
        $payPalURL = PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $payKey;
        header('Location: ' . $payPalURL);
    }
} catch (Exception $ex) {
    require_once '../Common/Error.php';
    exit;
}

