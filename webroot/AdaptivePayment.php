<?php

class Paypal_AdaptivePayments {

    private $requestEnvelope;
    private $username;
    private $password;
    private $signature;
    private $currentUrl;
    private $cancelUrl;
    private $returnUrl;
    private $paypalURL;
    private $currency = "USD";
    private $feesPayer;
    private $preapprovalDays;
    private $applicationId;
    private $maxTotalAmountOfAllPayments;
    private $reverseAllParallelPaymentsOnError;

    public function __construct() {

        $this->requestEnvelope = new RequestEnvelope("en_US");

//        $this->sellerId = 'seller1@nomail.com';

        $settings = Paypal_Model_Settings::getSettings();

        $this->username = $settings['paypal_username'];

        $this->password = $settings['paypal_password'];

        $this->signature = $settings['paypal_signature'];

        $this->currency = $settings['paypal_currency'];

        $this->feesPayer = $settings['paypal_fees_payer'];

        $this->preapprovalDays = $settings['paypal_key_days'];

        $this->applicationId = $settings['paypal_app_id'];

        $this->reverseAllParallelPaymentsOnError = false;

        if (empty($settings['paypal_max_amount'])) {

            $this->maxTotalAmountOfAllPayments = null;
        } else {

            $this->maxTotalAmountOfAllPayments = WM_Currency::convert($settings['paypal_max_amount'], 'USD', $this->currency, 0);
        }



        if ($settings['paypal_production']) {

            $useSandbox = false;
        } else {

            $useSandbox = true;
        }



        $this->currentUrl = $this->getRequest()->getFullUrl();



        $this->cancelUrl = $this->currentUrl . "?status=cancel";

        $this->returnUrl = $this->currentUrl . "?status=continue";



        if ($useSandbox) {

            if (!defined('PP_CONFIG_PATH')) {

                define('PP_CONFIG_PATH', __DIR__ . '/config/sandbox');
            }

            $this->paypalURL = "https://www.sandbox.paypal.com/webscr&";

//            $this->paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";
        } else {

            if (!defined('PP_CONFIG_PATH')) {

                define('PP_CONFIG_PATH', __DIR__ . '/config/production');
            }

            $this->paypalURL = "https://www.paypal.com/webscr&";

//            $this->paypalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=";
        }

        set_time_limit(60);
    }

    /**

     * @return APICredentialsType

     */
    public function paytest() {
//        require 'AdaptivePayment.php';
//turn php errors on
        ini_set("track_errors", true);

//set PayPal Endpoint to sandbox
        $url = trim("https://svcs.sandbox.paypal.com/AdaptivePayments/Pay");

        $api_appid = 'APP-80W284485P519543T';   // para sandbox
//PayPal API Credentials
        $API_UserName = "swaranpnf-facilitator_api1.gmail.com"; //TODO
        $API_Password = "HKG8DA39MZT6NE6H"; //TODO
        $API_Signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31A.zMaqvQtzO6pUwL3pdFfnZavhoB"; //TODO
        $receiver_email = "swaranpnf@gmail.com"; //TODO
        $amount = 25; //TODO
//Default App ID for Sandbox    
        $API_AppID = "APP-80W284485P519543T";

        $API_RequestFormat = "NV";
        $API_ResponseFormat = "NV";


//Create request payload with minimum required parameters
        $bodyparams = array("requestEnvelope.errorLanguage" => "en_US",
            "actionType" => "PAY",
            "cancelUrl" => "http://cancelUrl",
            "returnUrl" => "http://returnUrl",
            "currencyCode" => "EUR",
            "receiverList.receiver.email" => $receiver_email,
            "receiverList.receiver.amount" => $amount
        );

// convert payload array into url encoded query string
        $body_data = http_build_query($bodyparams, "", chr(38));


        try {

//create request and add headers
            $params = array("http" => array(
                    "method" => "POST",
                    "content" => $body_data,
                    "header" => "X-PAYPAL-SECURITY-USERID: " . $API_UserName . "\r\n" .
                    "X-PAYPAL-SECURITY-SIGNATURE: " . $API_Signature . "\r\n" .
                    "X-PAYPAL-SECURITY-PASSWORD: " . $API_Password . "\r\n" .
                    "X-PAYPAL-APPLICATION-ID: " . $API_AppID . "\r\n" .
                    "X-PAYPAL-REQUEST-DATA-FORMAT: " . $API_RequestFormat . "\r\n" .
                    "X-PAYPAL-RESPONSE-DATA-FORMAT: " . $API_ResponseFormat . "\r\n"
            ));


//create stream context
            $ctx = stream_context_create($params);


//open the stream and send request
            $fp = @fopen($url, "r", false, $ctx);

//get response
            $response = stream_get_contents($fp);
// echo '<pre>';
//$Result= json_decode($response,true);
//check to see if stream is open
            if ($response === false) {
                throw new Exception("php error message = " . "$php_errormsg");
            }

//close the stream
            fclose($fp);

//parse the ap key from the response

            $keyArray = explode("&", $response);

            foreach ($keyArray as $rVal) {
                list($qKey, $qVal) = explode("=", $rVal);
                $kArray[$qKey] = $qVal;
            }
//pr($kArray);
//die;
//print the response to screen for testing purposes
            If ($kArray["responseEnvelope.ack"] == "Success") {

                foreach ($kArray as $key => $value) {
                    echo $key . ": " . $value . "<br/>";
                }

                $requestEnvelope = new RequestEnvelope("en_US");
//                $requestEnvelope = new RequestEnvelope("en_US");
                $paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
                $paymentDetailsRequest->payKey = $kArray['payKey'];

                $sdkConfig = array(
                    "mode" => "sandbox",
                    "acct1.UserName" => $API_UserName,
                    "acct1.Password" => $API_Password,
                    "acct1.Signature" => $API_Signature,
                    "acct1.AppId" => $API_AppID);
                $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
                $paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
                echo 'sdhjsa';
                pr($paymentDetailsResponse);
                die;
            } else {
                echo 'ERROR Code: ' . $kArray["error(0).errorId"] . " <br/>";
                echo 'ERROR Message: ' . urldecode($kArray["error(0).message"]) . " <br/>";
            }
        } catch (Exception $e) {
            echo "Message: ||" . $e->getMessage() . "||";
        }
    }

    private function getAPICredentials() {

        try {

            $apiCredentials = new PPSignatureCredential($this->username, $this->password, $this->signature);
        } catch (PPMissingCredentialException $exc) {

            JO_Session::set('error', 'Missing PayPal API credentials');

            $this->redirect($this->getRequest()->getServer('HTTP_REFERER'));
        }



        $apiCredentials->setApplicationId($this->applicationId);



        return $apiCredentials;
    }

    /**

     * @return InvoiceItem

     */
    private function getItemDetail(Paypal_Model_Item $item) {

        $paypalItem = new InvoiceItem();



        $paypalItem->name = trim($item->getName());

        $paypalItem->itemCount = $item->getQuantity();

        $paypalItem->itemPrice = $item->getAmount();

        $paypalItem->price = $item->getAmount() * $item->getQuantity();



        return $paypalItem;
    }

    public function setCurrency($currency) {

        $this->currency = $currency;
    }

    /**

     * Paypal redirect url

     * @param type $paypalUrl 

     */
    public function setPaypalUrl($paypalUrl) {

        $this->paypalURL = $paypalUrl;
    }

    /**

     * 

     * @param Paypal_Model_Command $command

     * @return PreapprovalResponse

     */
    public function PreApproval(Paypal_Model_Command $command) {

        $preapprovalRequest = new PreapprovalRequest();



        $preapprovalRequest->requestEnvelope = $this->requestEnvelope;

        $preapprovalRequest->cancelUrl = $this->cancelUrl;

        $preapprovalRequest->returnUrl = $this->returnUrl;

        $preapprovalRequest->currencyCode = $this->currency;

        $preapprovalRequest->startingDate = date('Y-m-d');

        $preapprovalRequest->endingDate = date('Y-m-d', strtotime(date("Y-m-d", time()) .
                        " + {$this->preapprovalDays} days"));

        $preapprovalRequest->senderEmail = $command->getSenderEmail();

        $preapprovalRequest->feesPayer = $this->feesPayer;

        $preapprovalRequest->maxTotalAmountOfAllPayments = $this->maxTotalAmountOfAllPayments;



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->Preapproval($preapprovalRequest, $this->getAPICredentials());
    }

    /**

     * 

     * @param Paypal_Model_Command $command

     * @return PreapprovalDetailsResponse

     */
    public function PreApprovalDetails(Paypal_Model_Command $command) {

        $preapprovalRequest = new PreapprovalDetailsRequest();



        $preapprovalRequest->requestEnvelope = $this->requestEnvelope;

        $preapprovalRequest->preapprovalKey = $command->getPreapprovalKey();



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->PreapprovalDetails($preapprovalRequest, $this->getAPICredentials());
    }

    /**

     * @param Paypal_Model_Command $command

     * @return Paypal_Model_Result : result of adaptive payment operations

     */
    public function doPreApproval(Paypal_Model_Command $command) {

        $this->setPaypalUrl($this->paypalURL . 'cmd=_ap-preapproval&preapprovalkey=');

        $this->returnUrl .= '&preapprovalkey=${preapprovalkey}';

        $this->cancelUrl .= '&preapprovalkey=${preapprovalkey}';



        $preapprovalKey = $command->getPreapprovalKey();



        $result = new Paypal_Model_Result();

        $result->setPreapprovalKey($preapprovalKey);



        if (!$preapprovalKey) {

            try {

                $response = $this->PreApproval($command);



                $result->setCommandData($response);

                $result->setPreapprovalKey($response->preapprovalKey);



                if ($response->responseEnvelope->ack == 'Success') {

                    $result->setStatus(Paypal_Model_Result::STATUS_IN_PROGRESS);

                    $result->setHttpResponse($this->paypalURL . $response->preapprovalKey);
                } else {

                    $result->setStatus(Paypal_Model_Result::STATUS_ERROR);
                }
            } catch (\Exception $e) {

//                $this->logger->err('Command PAYPAL-AP PreApproval error : ' . $e->getCode() . " - " . $e->getMessage());

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);

                throw $e;
            }
        } else {

            try {

                $response = $this->PreApprovalDetails($command);

                $result->setCommandData($response);

                // Set status to ERROR, if it is not set later, this will be the final result

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);



                if ($response->responseEnvelope->ack == 'Success') {

                    if ($response->approved == 'true' && $response->status == 'ACTIVE') {

                        $result->setStatus(Paypal_Model_Result::STATUS_SUCCESS);
                    }

                    if ($response->approved == 'false' && $response->status == 'ACTIVE') {

                        $result->setStatus(Paypal_Model_Result::STATUS_PENDING);

                        $result->setHttpResponse($this->paypalURL . $result->getPreapprovalKey());
                    }

                    if ($response->status == 'CANCELED' || $response->status == 'DEACTIVATED') {

                        $result->setStatus(Paypal_Model_Result::STATUS_CANCELED);
                    }
                }
            } catch (\Exception $e) {

//                $this->logger->err('Command PAYPAL-AP PreApprovalDetails error : ' . $e->getCode() . " - " . $e->getMessage());

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);

                throw $e;
            }
        }



        return $result;
    }

    /**

     * @param Paypal_Model_Command $command

     * @return Paypal_Model_Result : result of adaptive payment operations

     */
    public function checkPreApproval(Paypal_Model_Command $command) {

        $result = new Paypal_Model_Result();

        $result->setPreapprovalKey($command->getPreapprovalKey());



        try {

            $response = $this->PreApprovalDetails($command);

            $result->setCommandData($response);

            // Set status to ERROR, if it is not set later, this will be the final result

            $result->setStatus(Paypal_Model_Result::STATUS_ERROR);



            if ($response->responseEnvelope->ack == 'Success') {

                if ($response->approved == 'true' && $response->status == 'ACTIVE') {

                    if (strtotime($response->endingDate) < time()) {

                        // Expired

                        $result->setStatus(Paypal_Model_Result::STATUS_CANCELED);
                    } else {

                        $result->setStatus(Paypal_Model_Result::STATUS_SUCCESS);
                    }
                }

                if ($response->approved == 'false' && $response->status == 'ACTIVE') {

                    $result->setStatus(Paypal_Model_Result::STATUS_PENDING);
                }

                if ($response->status == 'CANCELED' || $response->status == 'DEACTIVATED') {

                    $result->setStatus(Paypal_Model_Result::STATUS_CANCELED);
                }
            }
        } catch (\Exception $e) {

//            $this->logger->err('Command PAYPAL-AP PreApprovalDetails error : ' . $e->getCode() . " - " . $e->getMessage());

            $result->setStatus(Paypal_Model_Result::STATUS_ERROR);

            throw $e;
        }



        return $result;
    }

    /**

     * 

     * @param Paypal_Model_Command $command

     * @return CancelPreapprovalResponse

     */
    public function CancelPreApproval(Paypal_Model_Command $command) {

        $preapprovalRequest = new CancelPreapprovalRequest();



        $preapprovalRequest->requestEnvelope = $this->requestEnvelope;

        $preapprovalRequest->preapprovalKey = $command->getPreapprovalKey();



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->CancelPreapproval($preapprovalRequest, $this->getAPICredentials());
    }

    /**

     * 

     * @param Paypal_Model_Command $command

     * @param string $paykey Paykey received by Pay API call

     * @return SetPaymentOptionsResponse

     */
    public function SetPaymentOptions(Paypal_Model_Command $command, $paykey) {

        $payRequest = new SetPaymentOptionsRequest();

        $payRequest->requestEnvelope = $this->requestEnvelope;

        $payRequest->payKey = $paykey;



        $receivers = $command->getReceiverList();

        foreach ($receivers as $receiver) {

            $receiverOptions = new ReceiverOptions();

            $receiverOptions->receiver = new ReceiverIdentifier();

            $receiverOptions->receiver->email = $receiver->getEmail();

            $receiverOptions->invoiceData = new InvoiceData();

            foreach ($receiver->getItems() as $item) {

                $receiverOptions->invoiceData->item[] = $this->getItemDetail($item);
            }

            $receiverOptions->invoiceData->totalShipping = $receiver->getItemsTotalShipping();

            $receiverOptions->invoiceData->totalTax = $receiver->getItemsTotalTax();

            $payRequest->receiverOptions[] = $receiverOptions;
        }



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->SetPaymentOptions($payRequest, $this->getAPICredentials());
    }

    /**

     * @param string $paykey Paykey received by Pay API call

     * @return ExecutePaymentResponse

     */
    public function ExecutePayment($paykey) {

        $payRequest = new ExecutePaymentRequest();

        $payRequest->requestEnvelope = $this->requestEnvelope;

        $payRequest->payKey = $paykey;



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->ExecutePayment($payRequest, $this->getAPICredentials());
    }

    /**

     * @param string $paykey Paykey received by Pay API call

     * @return PaymentDetailsResponse

     */
    public function PaymentDetails($paykey) {

        $payRequest = new PaymentDetailsRequest();

        $payRequest->requestEnvelope = $this->requestEnvelope;

        $payRequest->payKey = $paykey;



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->PaymentDetails($payRequest, $this->getAPICredentials());
    }

    /**

     * 

     * @param Paypal_Model_Command $command

     * @param string $action PAY or CREATE

     * @return PayResponse

     */
    public function Pay(Paypal_Model_Command $command, $action = 'PAY') {

        $payRequest = new PayRequest();



        $payRequest->requestEnvelope = $this->requestEnvelope;

        $payRequest->actionType = $action;

        $payRequest->cancelUrl = $this->cancelUrl;

        $payRequest->currencyCode = $this->currency;

        $payRequest->receiverList = $this->getReceiverList($command);

        $payRequest->returnUrl = $this->returnUrl;

        $payRequest->senderEmail = $command->getSenderEmail();

        $payRequest->preapprovalKey = $command->getPreapprovalKey();

        $payRequest->feesPayer = $this->feesPayer;

        $payRequest->reverseAllParallelPaymentsOnError = $this->reverseAllParallelPaymentsOnError;



        $paypalService = new AdaptivePaymentsService();



        return $paypalService->Pay($payRequest, $this->getAPICredentials());
    }

    /**

     * @param Paypal_Model_Command $command

     * @return ReceiverList

     */
    private function getReceiverList(Paypal_Model_Command $command) {

        $list = $command->getReceiverList();

        $receiver = array();



        for ($i = 0; $i < count($list); $i++) {

            $receiver[$i] = new Receiver();

            $receiver[$i]->email = $list[$i]->getEmail();

            $receiver[$i]->amount = round($list[$i]->getAmount(), 2);

            $receiver[$i]->primary = $list[$i]->isPrimary();

            $receiver[$i]->invoiceId = $list[$i]->getInvoiceId();

            $receiver[$i]->paymentType = $list[$i]->getPaymentType();
        }



        return new ReceiverList($receiver);
    }

    /**

     * @param Paypal_Model_Command $command

     * @return Paypal_Model_Result : result of adaptive payment operations

     */
    public function doPreapprovedAdaptivePayment(Paypal_Model_Command $command) {

        $this->setPaypalUrl($this->paypalURL . 'cmd=_ap-payment&paykey=');



        $result = new Paypal_Model_Result();



        try {

            $response = $this->Pay($command, 'CREATE');

            $result->setPaykey($response->payKey);

            $result->setCommandData($response);

            // Set status to ERROR, if it is not set later, this will be the final result

            $result->setStatus(Paypal_Model_Result::STATUS_ERROR);



            if ($response->responseEnvelope->ack == 'Success') {

                if ($response->paymentExecStatus == 'CREATED') {

                    $response = $this->SetPaymentOptions($command, $result->getPaykey());

                    $result->setCommandData($response);

                    if ($response->responseEnvelope->ack == 'Success') {

                        $response = $this->ExecutePayment($result->getPaykey());

                        $result->setCommandData($response);

                        if ($response->responseEnvelope->ack == 'Success' &&
                                $response->paymentExecStatus == 'COMPLETED') {

                            $response = $this->PaymentDetails($result->getPaykey());

                            $result->setCommandData($response);

                            if ($response->responseEnvelope->ack == 'Success' &&
                                    $response->status == 'COMPLETED') {

                                $result->setStatus(Paypal_Model_Result::STATUS_SUCCESS);
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {

//            $this->logger->err('Command PAYPAL-AP PAY error : ' . $e->getCode() . " - " . $e->getMessage());

            $result->setStatus(Paypal_Model_Result::STATUS_ERROR);

            throw $e;
        }



        return $result;
    }

    /**

     * @param Paypal_Model_Command $command

     * @return Paypal_Model_Result : result of adaptive payment operations

     */
    public function doChainedAdaptivePayment(Paypal_Model_Command $command) {

        $this->setPaypalUrl($this->paypalURL . 'cmd=_ap-payment&paykey=');

        $this->returnUrl .= '&paykey=${paykey}';

        $this->cancelUrl .= '&paykey=${paykey}';

        $this->feesPayer = 'EACHRECEIVER';

        $this->reverseAllParallelPaymentsOnError = true;



        $payKey = $command->getPayKey();



        $result = new Paypal_Model_Result();

        $result->setPaykey($payKey);



        if (!$payKey) {

            try {

                $response = $this->Pay($command);

                $result->setPaykey($response->payKey);

                $result->setCommandData($response);

                // Set status to ERROR, if it is not set later, this will be the final result

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);



                if ($response->responseEnvelope->ack == 'Success') {

                    if ($response->paymentExecStatus == 'CREATED') {

                        $response = $this->SetPaymentOptions($command, $result->getPaykey());

                        $result->setCommandData($response);

                        if ($response->responseEnvelope->ack == 'Success') {

                            $result->setStatus(Paypal_Model_Result::STATUS_IN_PROGRESS);

                            $result->setHttpResponse($this->paypalURL . $result->getPaykey());
                        }
                    }
                }
            } catch (\Exception $e) {

//            $this->logger->err('Command PAYPAL-AP PAY error : ' . $e->getCode() . " - " . $e->getMessage());

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);

                throw $e;
            }
        } else {

            try {

                // Set status to ERROR, if it is not set later, this will be the final result

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);



                $response = $this->PaymentDetails($result->getPaykey());

                $result->setCommandData($response);

                if ($response->responseEnvelope->ack == 'Success' &&
                        $response->status == 'COMPLETED') {

                    $result->setStatus(Paypal_Model_Result::STATUS_SUCCESS);
                }
            } catch (\Exception $e) {

//                $this->logger->err('Command PAYPAL-AP PreApprovalDetails error : ' . $e->getCode() . " - " . $e->getMessage());

                $result->setStatus(Paypal_Model_Result::STATUS_ERROR);

                throw $e;
            }
        }



        return $result;
    }

}