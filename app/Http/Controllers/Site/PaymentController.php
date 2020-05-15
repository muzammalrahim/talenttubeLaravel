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

        if ( $request->payment_status == 'Completed' ){

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
                        // dump( 'user exist ' );
                        // dump( $user  );
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

                            // dump( 'credit' );
                            // dump( $credit );
                    }

                }






        }
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
