<?php

namespace App\Http\Controllers\Mobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Interview;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Jenssegers\Agent\Agent;
use URL;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\referenceEmail;
use App\Mail\referenceEmailtoEmployer;
use App\crossreference;
use App\Mail\declineRefereeEmail;
use App\Mail\refSubmitConfirmation;
// use App\testEmail12;

class MobileReferenceController extends Controller
{
    
    public function MsendEmailReferee(Request $request){
    	$data = $request->all();
      // dd($data); 
      $rules = array( "name" => "required|string|max:255", "mobile" => "required|digits:10|numeric","email"  => "email|required|string", );
         $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }

        else{

          // dd($request->ip());
      // ================================================= For sending Email To Employer =================================================
      if ($request->employerNotification != 0) {
      $user = User::where('id',$request->employerNotification)->first();
      Mail::to($user->email)->send(new referenceEmailtoEmployer($user->name,$request->username));
      // return response()->json([
      //       'status' => 1,
      //       'message' => 'Email sent to Employer successfully',
      //   ]);
      }

      // ================================================= For sending Email To Employer =================================================

      // ================================================= For sending Email To Referee =================================================

      // $data = $request->all();
      // dd($data); 

      $agent = new Agent();
      $browser = $agent->browser();
      $platform = $agent->platform();
      // dd($browser);
      $crossreference = new crossreference();
      $crossreference->refType =$data['refType'];
      $crossreference->jobseekerId =$data['userId'];
      $crossreference->userName =$data['username'];
      $crossreference->jsIP =$request->ip();
      $crossreference->jsBrowser = $browser;
      $crossreference->jsSysyem = $platform;
      $crossreference->refName =$data['name'];
      $crossreference->refEmail =$data['email'];
      $crossreference->refPhone =$data['mobile'];
      $crossreference->refStatus ='Awaiting Response';
      $crossreference->uniqueDigits = rand(10000,99999);
      $crossreference->refURL = generateRandomString();
      $crossreference->save();
      $request->session()->put('refurl',$crossreference->refURL);
        // dd($crossreference->refURL);

      Mail::to($data['email'])->send(new referenceEmail($data['name'],$data['username'],$request->referenceName,$data['userId'],$crossreference->refURL));
      return response()->json([
            'status' => 1,
            'message' => 'Email sent to referee successfully',
        ]);

      // ================================================= For sending Email To Referee End  =================================================

        }

    }

    public function Mcrosssreference(Request $request){
         // dd($request->url);


        if (!empty( $request->url )){
            $crossreference = crossreference::where('refURL',$request->url)->first();
          }
       // $data['user'] = $user;
       $data['crossreference'] = $crossreference;
       $data['title'] = 'Cross Reference';
       $data['classes_body'] = 'Reference';
       if ($crossreference->refType == "Work Reference" ) {
          return view('site.user.reference.workReference', $data);  // site/user/reference/workReference   
       }
       elseif ($crossreference->refType == "Personal Reference" ) {
          return view('site.user.reference.personalReference', $data);  // site/user/reference/personalReference   
       }
       else{
          return view('site.user.reference.educationalReference', $data);  // site/user/reference/educationalReference   
  
       }
   }

  // ================================================ Saving Work Reference Start Here ================================================


   public function sendReferenceW(Request $request){

        $data = $request->all();
        // dd($data);
        // dd($request->ip());
        // ======================================= saving referee browser ======================================= 

        $agent = new Agent();
        // dd($agent->platform());
        $browser = $agent->browser();
        $platform = $agent->platform();
        // dd($browser);
        // ======================================= saving referee browser ======================================= 

        // dd($data['refTypeHidden']);
        // dd($request);
        $rules = array(
            "refereeName" => "required|string|max:255",
            "refereePhone" => "required|digits:10|numeric",
            "refereeEmail"  => "required|string",
        );

         $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }

       else{

        // replace the refID with random generated code. 

       $crossreference = crossreference::where('id', $data['refID'])->first();

       // check reference status. 
       // if not already completed then 
       // if already submitted/saved/completed then show error.

       $refname =  $data['refereeName'];
       $jsname =  $crossreference->jsdata->name;
       $crossreference->refereeName = $data['refereeName'];
       $crossreference->refereePhone = $data['refereePhone'];
       $crossreference->refereeIP = $request->ip();
       $crossreference->refereeBrowser = $browser;
       $crossreference->refSystem = $platform;
       $crossreference->refereeEmail = $data['refereeEmail'];
       $crossreference->refereeOrganization = $data['refereeOrganization'];
       $crossreference->refereeDates = $data['refereeDates'];
       $crossreference->refereeOrganizationTitle = $data['refereeOrganizationTitle'];
       $crossreference->refereeReport = $data['refereeReport'];
       $crossreference->refereePerformance = $data['refereePerformance'];
       $crossreference->refereeRequirements = $data['refereeRequirements'];
       $crossreference->refereeBehaviours = $data['refereeBehaviours'];
       $crossreference->refereeManagementr = $data['refereeManagementr'];
       $crossreference->refereeProspective = $data['refereeProspective'];
       $crossreference->refereePotentially = $data['refereePotentially'];
       $crossreference->refereeComments = $data['refereeComments'];
       $crossreference->candidateTitle = $data['candidateTitle'];
       $crossreference->refereeLeaving = $data['refereeLeaving'];
       $crossreference->refereeTeamplayer = $data['refereeTeamplayer'];
       $crossreference->ddText1 = $data['ddText1'];
       $crossreference->ddText2 = $data['ddText2'];
       $crossreference->ddText3 = $data['ddText3'];
       $crossreference->ddText4 = $data['ddText4'];

       if($crossreference->jsIP == $request->ip()){
          $crossreference->refStatus = 'Reference Fraud';
       }
       else{ 
          $crossreference->refStatus = 'Reference Completed';
       }
       
       $crossreference->save();
       Mail::to($crossreference->jsdata->email)->send(new refSubmitConfirmation($jsname, $refname));
       return response()->json([
            'status' => 1,
            'message' => 'Work Reference added and email sent successfully',]);
 
       }

  }

  // ================================================ Saving Work Reference End Here ================================================

  // ================================================ Saving Personal Reference ================================================

  public function sendReferenceP(Request $request){

        $data = $request->all();
        // dd($data);
        // ======================================= saving referee browser ======================================= 

        $agent = new Agent();
        // dd($agent->platform());
        $browser = $agent->browser();
        $platform = $agent->platform();
        // dd($browser);
        // ======================================= saving referee browser ======================================= 

        $rules = array(
            "refereeName" => "required|string|max:255",
            "refereePhone" => "required|digits:10|numeric",
            "refereeEmail"  => "required|string", );
         $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray() ]);
        }

       else{
        $crossreference = crossreference::where('id', $data['refID'])->first();
        // dd($crossreference->jsdata->email);
        $refname =  $data['refereeName'];
        $jsname =  $crossreference->jsdata->name;
       $crossreference->refereeName = $data['refereeName'];
       $crossreference->refereeIP = $request->ip();
       $crossreference->refereeBrowser = $browser;
       $crossreference->refereePhone = $data['refereePhone'];
       $crossreference->refereeEmail = $data['refereeEmail'];
       $crossreference->refereeKnowing = $data['refereeKnowing'];
       $crossreference->refereeMeet = $data['refereeMeet'];
       $crossreference->refereeParticularIns = $data['refereeParticularIns'];
       $crossreference->refereeInteractions = $data['refereeInteractions'];
       $crossreference->refereePunctual = $data['refereePunctual'];
       $crossreference->refereeCommunication = $data['refereeCommunication'];
       $crossreference->refereeMotivation = $data['refereeMotivation'];
       $crossreference->refereeRelatively = $data['refereeRelatively'];
       $crossreference->refereeBasedExp = $data['refereeBasedExp'];
       $crossreference->refereeProspective = $data['refereeProspective'];
       $crossreference->refereeComments = $data['refereeComments'];
       $crossreference->ddText1 = $data['ddText1'];
       $crossreference->ddText2 = $data['ddText2'];
       $crossreference->ddText3 = $data['ddText3'];
       $crossreference->ddText4 = $data['ddText4'];
       $crossreference->ddText5 = $data['ddText5'];
       if($crossreference->jsIP == $request->ip()){

          $crossreference->refStatus = 'Reference Fraud';
       }
       else{ 
          $crossreference->refStatus = 'Reference Completed';
        }
       $crossreference->save();
       Mail::to($crossreference->jsdata->email)->send(new refSubmitConfirmation($jsname, $refname));
       return response()->json([
            'status' => 1,
            'message' => 'Personal Reference added and email sent successfully', ]);
 
       }

  }

  // ================================================ Saving Personal Reference End Here ================================================


  // ================================================ Saving Educationa Reference Start Here ================================================

  public function sendReferenceE(Request $request){


        $data = $request->all();
        // dd($data);
        // ======================================= saving referee browser ======================================= 

        $agent = new Agent();
        // dd($agent->platform());
        $browser = $agent->browser();
        $platform = $agent->platform();
        // dd($browser);
        // ======================================= saving referee browser ======================================= 
        $rules = array(
            "refereeName" => "required|string|max:255",
            "refereePhone" => "required|digits:10|numeric",
            "refereeEmail"  => "required|string",
        );

         $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }

       else
       {

        $crossreference = crossreference::where('id', $data['refID'])->first();
        // dd($crossreference->jsdata->email);
        $refname =  $data['refereeName'];
        $jsname =  $crossreference->jsdata->name;
       // elseif ($data['refTypeHidden'] == 'Educational Reference') {
       $crossreference->refereeName = $data['refereeName'];
       $crossreference->refereeIP = $request->ip();
       $crossreference->refereeBrowser = $browser;
       $crossreference->refereePhone = $data['refereePhone'];
       $crossreference->refereeEmail = $data['refereeEmail'];
       $crossreference->refereeEducational = $data['refereeEducational'];
       $crossreference->refereeDates = $data['refereeDates'];
       $crossreference->refereeParticularClass = $data['refereeParticularClass'];
       $crossreference->refereePunctual = $data['refereePunctual'];
       $crossreference->refereeCommunication = $data['refereeCommunication'];
       $crossreference->refereeInitiative = $data['refereeInitiative'];
       $crossreference->refereeDemonstrate = $data['refereeDemonstrate'];
       $crossreference->refereeLearning = $data['refereeLearning'];
       $crossreference->refereeInteractions = $data['refereeInteractions'];
       $crossreference->refereeManagementr = $data['refereeManagementr'];
       $crossreference->refereeCurricular = $data['refereeCurricular'];
       $crossreference->refereeRelatedProject = $data['refereeRelatedProject'];
       $crossreference->refereeProspective = $data['refereeProspective'];
       $crossreference->refereeCandidateBest = $data['refereeCandidateBest'];
       $crossreference->refereeComments = $data['refereeComments'];
       $crossreference->ddText1 = $data['ddText1'];
       $crossreference->ddText2 = $data['ddText2'];
       $crossreference->ddText3 = $data['ddText3'];
       $crossreference->ddText4 = $data['ddText4'];
       $crossreference->ddText5 = $data['ddText5'];
       $crossreference->ddText5 = $data['ddText6'];
       if($crossreference->jsIP == $request->ip()){

          $crossreference->refStatus = 'Reference Fraud';
       }
       else{ 
          $crossreference->refStatus = 'Reference Completed';
        }
       $crossreference->save();
       Mail::to($crossreference->jsdata->email)->send(new refSubmitConfirmation($jsname, $refname));

       return response()->json([
            'status' => 1,
            'message' => 'Educational Reference added and email sent successfully',]);
       // }
 
       }

  }
  // ================================================ Saving Educationa Reference End Here ================================================


    public function McrossreferenceIndex(Request $request){

        $user = Auth::user();
        $data['user'] = $user;
        // dd($user->id);
        $crossreference = crossreference::where('jobseekerId',$user->id)->get();
        
        // dd($crossreference);            
        
        $data['title'] = 'Cross Reference';
        $data['crossreference'] = $crossreference ;
        $data['classes_body'] = 'Interviews';
        return view('mobile.user.reference.index', $data);   // mobile/user/reference/index
      }

      public function declineReference($id){
        $crossreference = crossreference::where('id',$id)->first();
        // dd($crossreference->refEmail);
        $crossreference->refStatus = 'Referee Declined';
        $crossreference->save();
        Mail::to($crossreference->refEmail)->send(new declineRefereeEmail($crossreference->userName,$crossreference->refName));
        return response()->json([
            'status' => 1,
            'message' => 'Reference Declined Status',
            // 'redirect' => route('')
        ]);
      }


      public function crossReferSubmitted(Request $request){

        // $referenceSession = session('referenceSession');
        // session()->forget('referenceSession');
       
       return view('site.reference.referenceSubmitted');   // site/reference/referenceSubmitted

      }

      public function referenceCompleted(Request $request){

        // $referenceSession = session('referenceSession');
        // session()->forget('referenceSession');
       
       return view('site.reference.referenceCompleted');   // site/reference/referenceCompleted

      }

      public function referenceDeclined(Request $request){

        // $referenceSession = session('referenceSession');
        // session()->forget('referenceSession');
       
       return view('site.reference.referenceDeclined');   // site/reference/referenceCompleted

      }
}
