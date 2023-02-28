<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;



class AdminEmployerController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }


    // ========================================= Iteration-10+ =========================================

    public function makeEmployerPaid(Request $request) {
    	
    	// dd($request->all());

    	$user = User::where('id', $request->id)->where('type', 'employer')->first();
    	if ($user) {
    		$user->employerStatus = 'paid';
	    	$user->emp_status_exp = $request->date;
	    	$user->save();
	    	return response()->json([
    			'status' => 1,
    			'message' => 'Status updated successfully'
    		]);
    	}
    	else{
    		return response()->json([
    			'status' => 0,
    			'message' => 'Something went wrong'
    		]);
    	}
    }

    // ========================================= Iteration-10+ cancel employer's subscription =========================================

    public function makeEmployerUnPaid(Request $request) {
        
        // dd($request->all());

        $user = User::where('id', $request->id)->where('type', 'employer')->first();
        if ($user) {

            $currentDate = \Carbon\Carbon::yesterday();
            $datetime2 = new \DateTime($currentDate);
            $user->employerStatus = 'unpaid';
            $user->emp_status_exp = $datetime2;
            $user->save();
            return response()->json([
                'status' => 1,
                'message' => 'Status updated successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => 'Something went wrong'
            ]);
        }
    }














}
