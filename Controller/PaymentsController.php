<?php

class PaymentsController extends AppController {
    
   public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('cron_transferAmount'));
    }

    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Paypalpayment');
        $this->paginate = array('limit' => 10);
        $this->Paginator->settings = $this->paginate;
        $record = $this->Paginator->paginate('Paypalpayment');
        $this->set('record', $record);
    }

    public function webadmin_creditcard() {
        $this->layout = 'admin_main';
        $this->loadModel('Creditpayment');
        $this->paginate = array('limit' => 10);
        $this->Paginator->settings = $this->paginate;
        $record = $this->Paginator->paginate('Creditpayment');
        $this->set('record', $record);
    }

    public function webadmin_view_record($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Paypalpayment');
        $Find_payment_record = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.id' => $id)));
//pr($Find_payment_record);
//   die('sdfhgdshfj');
        $this->set('payrecord', $Find_payment_record);
    }

    public function webadmin_delete_record($id = null) {
        $this->autoRender = false;
        $this->loadModel('Paypalpayment');
        $this->Paypalpayment->delete($id);
        $this->Session->setFlash('Record Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'payments', 'action' => 'index'));
    }

    public function webadmin_delete_ccpaymentrecord($id = null) {
        $this->autoRender = false;
        $this->loadModel('Creditpayment');
        $this->Creditpayment->delete($id);
        $this->Session->setFlash('Record Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'payments', 'action' => 'creditcard'));
    }

    public function webadmin_view_ccpaymentrecord($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Creditpayment');
        $find_record_Creditcard = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.id' => $id)));
        $this->set('Result', $find_record_Creditcard);
    }

    public function webadmin_withdrawRequests() {
        $this->layout = 'admin_main';
        $this->loadModel('Withdrawrequest');
        $this->paginate = array('limit' => 10, 'conditions' => array('Withdrawrequest.status' => 1));
        $this->Paginator->settings = $this->paginate;
        $record = $this->Paginator->paginate('Withdrawrequest');
        $this->set('record', $record);
    }

    public function webadmin_view_withdraw($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Withdrawrequest');
        $this->loadModel('Withdrawearning');
        $this->loadModel('Paypalsetting');
        $withdraw = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.id' => $id)));
        $paypalData = $this->Paypalsetting->find('first');
        $this->set('withdraw', $withdraw);
        // pr($withdraw);
//        die;
        if ($this->request->is('post')) {
            //     pr($paypalData);
            require("gate/PPBootStrap.php");
            $payRequest = new PayRequest();
            $receiver = array();
            $receiver[0] = new Receiver();
            $receiver[0]->amount = $withdraw['Withdrawrequest']['withdraw_amount'];
//            $receiver[0]->amount = "5.00";
            $receiver[0]->email = $withdraw['Withdrawrequest']['receiver_email'];
//            $receiver[0]->email = "swaranpnf-buyer@gmail.com";
            $receiverList = new ReceiverList($receiver);
            $payRequest->receiverList = $receiverList;
            $payRequest->senderEmail = $paypalData['Paypalsetting']['username'];
//            $payRequest->senderEmail = "sanjivkumarpnf-facilitator@gmail.com";
            $requestEnvelope = new RequestEnvelope("en_US");
            $payRequest->requestEnvelope = $requestEnvelope;
            $payRequest->actionType = "PAY";
            $payRequest->cancelUrl = "http://www.jobider.com/freelancer/paymentStatus?cancel=true";
            $payRequest->returnUrl = "http://www.jobider.com/freelancer/paymentStatus?success=true";
            $payRequest->currencyCode = "USD";
            $payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";
            $sdkConfig = array(
                "mode" => "sandbox",
                "acct1.UserName" => $paypalData['Paypalsetting']['appusername'],
                "acct1.Password" => $paypalData['Paypalsetting']['password'],
                "acct1.Signature" => $paypalData['Paypalsetting']['signature'],
                "acct1.AppId" => $paypalData['Paypalsetting']['appid']
            );
//            
//             "acct1.UserName" => "sanjivkumarpnf-facilitator_api1.gmail.com",
//            "acct1.Password" => "PMWQSEFM4J98RJH4",
//            "acct1.Signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31AV236IM1svud2aue0AWrBXKnBU3B",
//            "acct1.AppId" => "APP-80W284485P519543T"
            $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
            $payResponse = $adaptivePaymentsService->Pay($payRequest);
            $requestEnvelope = new RequestEnvelope("en_US");
            $paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
            $paymentDetailsRequest->payKey = $payResponse->payKey;
            $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
            $paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
            if (!empty($paymentDetailsResponse)) {
//                pr($paymentDetailsResponse);
//                die;
                $this->request->data['Withdrawearning']['job_id'] = $withdraw['Milestone']['job_id'];
                $this->request->data['Withdrawearning']['freelancer_id'] = $withdraw['User']['id'];
                $this->request->data['Withdrawearning']['client_id'] = $withdraw['Milestone']['client_id'];
                $this->request->data['Withdrawearning']['transactionId'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->transactionId;
                $this->request->data['Withdrawearning']['receiver_amount'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->receiver->amount;
                $this->request->data['Withdrawearning']['receiver_email'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->receiver->email;
                $this->request->data['Withdrawearning']['sender_email'] = $paymentDetailsResponse->senderEmail;
                $this->request->data['Withdrawearning']['trasaction_status'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->transactionStatus;

                if ($this->Withdrawearning->save($this->request->data)) {
                    $saveStatus['Withdrawrequest']['status'] = '0';
                    $this->Withdrawrequest->id = $id;
                    $this->Withdrawrequest->save($saveStatus);
                    $Email = new CakeEmail();
                    $Email->template('approved_withdrawal_request');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $withdraw));
                    $Email->from(array('info@jobider.com' => 'info@jobider.com'));
                    $Email->to($withdraw["User"]['email']);
                    $Email->subject('Request Approved for Withdrawal', 'success');
                    $Email->send();
                    $this->Session->setFlash('Amount has been transfered to Freelancer', 'success');
                    $this->redirect(array('controller' => 'payments', 'action' => 'view_withdraw/' . $id));
                }
            }
        }
    }

    public function webadmin_completedWithdrawRequests() {
        $this->layout = 'admin_main';
        $this->loadModel('Withdrawearning');
        $this->paginate = array(
            'limit' => 10,
            'group' => array('Withdrawearning.job_id')
        );
        $this->Paginator->settings = $this->paginate;
        $record = $this->Paginator->paginate('Withdrawearning');
        $this->set('record', $record);
    }

    public function webadmin_paypal() {
        $this->layout = 'admin_main';
        $this->loadModel('Paypalsetting');
        $paypal = $this->Paypalsetting->find('first');
        if ($this->request->is('put')) {
            $this->Paypalsetting->id = $paypal['Paypalsetting']['id'];
            if ($this->Paypalsetting->save($this->request->data)) {
                $this->Session->setFlash('Data updated successfully.', 'success');
                $this->redirect(array('controller' => 'payments', 'action' => 'paypal/' . $paypal['Paypalsetting']['id']));
            }
        } else {
            $this->request->data = $paypal;
        }
        $this->set('paypal', $paypal);
    }

    public function cron_transferAmount() {
        $this->loadModel('Withdrawrequest');
        $this->loadModel('Withdrawearning');
        $this->loadModel('Paypalsetting');
        require("gate/PPBootStrap.php");
        $withdraws = $this->Withdrawrequest->find('all', array('conditions' => array('Withdrawrequest.request_status' => 'accepted')));
        $paypalData = $this->Paypalsetting->find('first');

        foreach ($withdraws as $key => $withdraw) {
            $payRequest = new PayRequest();
            $receiver = array();
            $receiver[0] = new Receiver();
            $receiver[0]->amount = number_format($withdraw['Withdrawrequest']['withdraw_amount'],0);
            $receiver[0]->email = $withdraw['Withdrawrequest']['receiver_email'];
            $receiverList = new ReceiverList($receiver);
            $payRequest->receiverList = $receiverList;
            $payRequest->senderEmail = $paypalData['Paypalsetting']['username'];
            $requestEnvelope = new RequestEnvelope("en_US");
            $payRequest->requestEnvelope = $requestEnvelope;
            $payRequest->actionType = "PAY";
            $payRequest->cancelUrl = "http://www.jobider.com/freelancer/paymentStatus?cancel=true";
            $payRequest->returnUrl = "http://www.jobider.com/freelancer/paymentStatus?success=true";
            $payRequest->currencyCode = "USD";
            $payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";
            $sdkConfig = array(
                "mode" => "sandbox",
                "acct1.UserName" => $paypalData['Paypalsetting']['appusername'],
                "acct1.Password" => $paypalData['Paypalsetting']['password'],
                "acct1.Signature" => $paypalData['Paypalsetting']['signature'],
                "acct1.AppId" => $paypalData['Paypalsetting']['appid']
            );
            $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
            $payResponse = $adaptivePaymentsService->Pay($payRequest);
            $requestEnvelope = new RequestEnvelope("en_US");
            $paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
            $paymentDetailsRequest->payKey = $payResponse->payKey;
            $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
            $paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
            if (!empty($paymentDetailsResponse)) {
                $this->request->data['Withdrawearning']['job_id'] = $withdraw['Milestone']['job_id'];
                $this->request->data['Withdrawearning']['freelancer_id'] = $withdraw['User']['id'];
                $this->request->data['Withdrawearning']['client_id'] = $withdraw['Milestone']['client_id'];
                $this->request->data['Withdrawearning']['transactionId'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->transactionId;
                $this->request->data['Withdrawearning']['receiver_amount'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->receiver->amount;
                $this->request->data['Withdrawearning']['receiver_email'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->receiver->email;
                $this->request->data['Withdrawearning']['sender_email'] = $paymentDetailsResponse->senderEmail;
                $this->request->data['Withdrawearning']['trasaction_status'] = $paymentDetailsResponse->paymentInfoList->paymentInfo[0]->transactionStatus;
$this->Withdrawearning->create();
                if ($this->Withdrawearning->save($this->request->data)) {
                    $saveStatus['Withdrawrequest']['status'] = 0;
                    $this->Withdrawrequest->id = $withdraw['Withdrawrequest']['id'];
                    $this->Withdrawrequest->save($saveStatus);
                    $Email = new CakeEmail();
                    $Email->template('approved_withdrawal_request');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $withdraw));
                    $Email->from(array('info@jobider.com' => 'info@jobider.com'));
                    $Email->to($withdraw["User"]['email']);
                    $Email->subject('Request Approved for Withdrawal', 'success');
                    $Email->send();
                   
                }
            }
        }
        
        die('Working');
    }

}

?>
