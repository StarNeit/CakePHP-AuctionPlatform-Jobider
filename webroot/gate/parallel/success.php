<?php
require_once('../PPBootStrap.php');
session_start();
/*
 *  # PaymentDetails API
  Use the PaymentDetails API operation to obtain information about a payment. You can identify the payment by your tracking ID, the PayPal transaction ID in an IPN message, or the pay key associated with the payment.
  This sample code uses AdaptivePayments PHP SDK to make API call
 */
/*
 * 
  PaymentDetailsRequest which takes,
  `Request Envelope` - Information common to each API operation, such
  as the language in which an error message is returned.
 */
$requestEnvelope = new RequestEnvelope("en_US");
/*
 * 		 PaymentDetailsRequest which takes,
  `Request Envelope` - Information common to each API operation, such
  as the language in which an error message is returned.
 */
$paymentDetailsReq = new PaymentDetailsRequest($requestEnvelope);
/*
 * 		 You must specify either,

 * `Pay Key` - The pay key that identifies the payment for which you want to retrieve details. This is the pay key returned in the PayResponse message.
 * `Transaction ID` - The PayPal transaction ID associated with the payment. The IPN message associated with the payment contains the transaction ID.
  `paymentDetailsRequest.setTransactionId(transactionId)`
 * `Tracking ID` - The tracking ID that was specified for this payment in the PayRequest message.
  `paymentDetailsRequest.setTrackingId(trackingId)`
 */
if ($_SESSION['pay_key'] != "") {
    $paymentDetailsReq->payKey = $_SESSION['pay_key'];
}
/*
 * 	 ## Creating service wrapper object
  Creating service wrapper object to make API call and loading
  Configuration::getAcctAndConfig() returns array that contains credential and config parameters
 */
$service = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
try {
    /* wrap API method calls on the service object with a try catch */
    $response = $service->PaymentDetails($paymentDetailsReq);
    ?>
    <html>
        <head>
            <title>Paypal Parallel Payments Using PHP</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <meta name="robots" content="noindex, nofollow">
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-43981329-1']);
                _gaq.push(['_trackPageview']);
                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>
        </head>
        <body>
            <div id="main">
                <div class="success_main_heading"> 
                    <center><h1>Paypal Parallel Payments Using PHP</h1></center>
                </div>
                <div id="return">
                    <h2>Payment Status</h2>
                    <hr/>
                    <?php
                    //Rechecking the product price and currency details
                    /*
                     * 			 The status of the payment. Possible values are:

                     * CREATED - The payment request was received; funds will be
                      transferred once the payment is approved
                     * COMPLETED - The payment was successful
                     * INCOMPLETE - Some transfers succeeded and some failed for a
                      parallel payment or, for a delayed chained payment, secondary
                      receivers have not been paid
                     * ERROR - The payment failed and all attempted transfers failed
                      or all completed transfers were successfully reversed
                     * REVERSALERROR - One or more transfers failed when attempting
                      to reverse a payment
                     * PROCESSING - The payment is in progress
                     * PENDING - The payment is awaiting processing
                     */
                    if ($response->status == 'COMPLETED') {
                        echo "<h3 id='success'>Payment Successful</h3>";
                        $amount = 0;
                        ?>
                        <table id="results" >
                            <thead>
                                <tr class="head">
                                    <th>Facility Provider</th>
                                    <th>Status</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($response->paymentInfoList->paymentInfo); $i++) { ?>
                                    <tr>
                                        <td>
                                            <b><p style="color: rgb(77, 125, 179);"><?php echo $_SESSION['facilty_provider'][$i]; ?></p></b>
                                            <p>Transaction Id: <?php echo $response->paymentInfoList->paymentInfo[$i]->transactionId; ?></p>
                                            <p>Amount: <?php
                                                echo $response->paymentInfoList->paymentInfo[$i]->receiver->amount;
                                                $amount = $amount + $response->paymentInfoList->paymentInfo[$i]->receiver->amount;
                                                ?></p>
                                        </td>
                                        <td>
                                            <b><p style="color: rgb(77, 125, 179);"><?php echo $response->paymentInfoList->paymentInfo[$i]->transactionStatus; ?></p></b>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td><b>Total Amount</b></td>
                                    <td><b>$<?php echo $amount ?> USD</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class='back_btn'><a  href='index.php' id= 'btn'><< Back</a></div>
                        <?php
                    } else if ($response->status == 'INCOMPLETE') {
                        echo "<h3 id='fail'>Payment - Failed</h3>";
                        echo '<p><center>Error msg :- This transaction cannot be processed.</center></p>';
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back</a></div>";
                    } else if ($response->status == 'ERROR') {
                        echo "<h3 id='fail'>Payment - Failed</h3>";
                        echo '<p><center>Error msg :- The payment failed and all attempted transfers failed</center></p>';
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back</a></div>";
                    } else if ($response->status == 'PENDING') {
                        echo "<h3 id='fail'>Payment - PENDING</h3>";
                        echo '<p><center>Error msg :- The payment is awaiting processing</center></p>';
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back</a></div>";
                    } else if ($response->status == 'CREATED') {
                        echo "<h3 id='fail'>Payment - CREATED</h3>";
                        echo '<p><center>Error msg :- The payment request was received; funds will be transferred once the payment is approved</center></p>';
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back</a></div>";
                    } else {
                        echo "<h3 id='fail'>Payment - Failed</h3>";
                        echo '<p><center>Error msg :- This transaction cannot be processed.</center></p>';
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back</a></div>";
                    }
                    session_unset();
                    session_destroy();
                    ?>
                </div>
                <!-- Right side div -->
                <div class="fr"id="formget">
                    <a href=http://www.formget.com/app><img style="margin-left: 12%;" src="images/formget.jpg" alt="Online Form Builder"/></a>
                </div>
            </div>
        </body>
    </html><?php
} catch (Exception $ex) {
    require_once '../Common/Error.php';
    exit;
}
        

