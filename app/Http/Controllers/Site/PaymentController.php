<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Product;
use App\Payment;
use App\TestLog;

class PaymentController extends Controller {


    public function payment(Request $request){
        //   $product = Product::find($request->id);
        //   return view('payment',compact('product'));
    }

    public function paymentReturn(Request $request){
        dump('  paymentReturn ');
        dd($request->toArray());
    }

    public function notifyPayment(Request $request){
        dump('  notifyPayment ');

        $log = new TestLog();
        $log->log = json_encode( $request->toArray(), true );
        $log->save();

        dd($request->toArray());
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
