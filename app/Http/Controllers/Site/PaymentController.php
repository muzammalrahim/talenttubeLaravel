<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Product;
use App\Payment;
use App\TestLog;
use App\User;

class PaymentController extends Controller {


    public function payment(Request $request){
        //   $product = Product::find($request->id);
        //   return view('payment',compact('product'));
    }

    public function paymentReturn(Request $request){
        // $user = Auth::user();
        // $data['user'] = $user;
        $data['title'] = 'Payment Succesfully';
        $data['classes_body'] = 'empStep2';
        // $data['content'] = 'this is page content';
        return view('site.credit.return', $data);
    }

    public function notifyPayment(Request $request){
        // dump('  notifyPayment ');

        $log = new TestLog();
        $log->log = json_encode( $request->toArray(), true );
        $log->save();

        dump($request->toArray());
        $verifyIPN = $this->verifyIPN($request);

        if ( $verifyIPN ){
            // dump( 'Completed' );
                $txn_id = $request->txn_id;
                $payment_exist = Payment::where('transaction_id',$txn_id)->first();
                if (empty($payment_exist)){
                    $user_id = (int) $request->item_number;
                    $amount  = (int) $request->payment_gross;
                    $payment = new Payment;
                    $payment->transaction_id = $txn_id;
                    $payment->currency_code = $request->mc_currency;
                    $payment->payment_status = $request->payment_status;
                    $payment->user_id = $request->item_number;
                    $payment->amount = $amount;
                    $payment->save();
                    $payment_id = $payment->id;

                    // dd(  $payment );

                    $user = User::find($user_id);
                    if(!empty($user)){
                            $credit = 0;
                            if($amount == 1){
                                $credit = 100;
                            }else if($amount == 5){
                                $credit = 550;
                            }else if($amount == 10){
                                $credit = 1250;
                            }else if($amount == 20){
                                $credit = 2750;
                            }
                            $user->credit = $user->credit + $credit;
                            $user->save();
                    }
                }
        }
    }



    function verifyIPN($request){
        $verifyIPN = false;
        $myPost = $request->all();

        $req = 'cmd=_notify-validate';
        // if(function_exists('get_magic_quotes_gpc')) {
        //     $get_magic_quotes_exists = true;
        // }
        foreach ($myPost as $key => $value) {
            // if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            //     $value = urlencode(stripslashes($value));
            // } else {
            //     $value = urlencode($value);
            // }
            $value = urlencode($value);
            $req .= "&$key=$value";
        }


        if(env('PAYPAL_MODE', 'sandbox') == 'sandbox') {
            $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
        }
        $ch = curl_init($paypal_url);
        if ($ch == FALSE) { return FALSE; }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        // if(DEBUG == true) {
        //     curl_setopt($ch, CURLOPT_HEADER, 1);
        //     curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        // }
        // CONFIG: Optional proxy configuration
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        // CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
        // of the certificate as shown below. Ensure the file is readable by the webserver.
        // This is mandatory for some environments.
        //$cert = __DIR__ . "./cacert.pem";
        //curl_setopt($ch, CURLOPT_CAINFO, $cert);
        $res = curl_exec($ch);
        if (curl_errno($ch) != 0) // cURL error
        {
            // if(DEBUG == true) {
            //     error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
            // }
            curl_close($ch);
            exit;
        } else {
            // Log the entire HTTP response if debug is switched on.
            // if(DEBUG == true) {
			//     error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			//     error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
            // }
            curl_close($ch);
        }

        // Inspect IPN validation result and act accordingly
        // Split response headers and payload, a better way for strcmp
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));
        if (strcmp ($res, "VERIFIED") == 0) {
            // assign posted variables to local variables
            // $item_name = $request->item_name;
            // $item_number    = $request->item_number;
            $payment_status = $request->payment_status;
            // $payment_amount = $request->mc_gross;
            // $payment_currency = $request->mc_currency;
            // $txn_id = $request->txn_id;
            // $receiver_email = $request->receiver_email;
            // $payer_email = $request->payer_email;


            // check whether the payment_status is Completed
            $isPaymentCompleted = false;
            if($payment_status == "Completed") {
                $isPaymentCompleted = true;
                $verifyIPN = true;
            }



            ///
            // $isUniqueTxnId = false;
            // $param_type="s";
            // $param_value_array = array($txn_id);
            // $result = $db->runQuery("SELECT * FROM payment WHERE txn_id = ?",$param_type,$param_value_array);
            // if(empty($result)) {
            //     $isUniqueTxnId = true;
            // }
            // check that receiver_email is your PayPal email
            // check that payment_amount/payment_currency are correct
            // if($isPaymentCompleted) {
            //     $param_type = "sssdss";
            //     $param_value_array = array($item_number, $item_name, $payment_status, $payment_amount, $payment_currency, $txn_id);
            //     $payment_id = $db->insert("INSERT INTO payment(item_number, item_name, payment_status, payment_amount, payment_currency, txn_id) VALUES(?, ?, ?, ?, ?, ?)", $param_type, $param_value_array);

            // }
            // process payment and mark item as paid.


            // if(DEBUG == true) {
            //     error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
            // }

        }
        // else if (strcmp ($res, "INVALID") == 0) {
        //     // log for manual investigation
        //     // Add business logic here which deals with invalid IPN messages
        //     // if(DEBUG == true) {
        //     //     error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
        //     // }
        // }

        return  $verifyIPN;

    }






    public function paymentInfo(Request $request){
        if($request->tx){
            if($payment = Payment::where('transaction_id',$request->tx)->first()){
                $payment_id = $payment->id;
            }else{
                $payment = new Payment;
                $payment->transaction_id = $request->tx;
                $payment->currency_code = $request->cc;
                $payment->payment_status = $request->st;
                $payment->user_id = $request->item_number;

                $payment->save();
                $payment_id = $payment->id;
            }
            dump($request);
        return 'Pyament has been done and your payment id is : '.$payment_id;

        }else{
            return 'Payment has failed';
        }
    }
}
