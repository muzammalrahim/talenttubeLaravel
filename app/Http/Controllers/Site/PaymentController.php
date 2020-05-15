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

								// dd($request->toArray());
        if ( $request->payment_status == 'Completed' ){
                $user_id = (int) $request->item_number;

                $amount  = (int) $request->payment_gross;
                $user = User::find($user_id);
                if(!empty($user)){
                        $credit = 0;
                        if($amount == 1){
                            $credit = 100;
                        }else if($amount == 5){
                            $credit = 500;
                        }else if($amount == 10){
                            $credit = 1000;
                        }else if($amount == 20){
                            $credit = 2000;
                        }

                        $user->credit = $user->credit + 	$credit;
                        $user->save();


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
