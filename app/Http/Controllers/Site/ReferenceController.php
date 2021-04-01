<?php

namespace App\Http\Controllers\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\fbremacc;
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
use App\ControlSession;
use App\History;


class ReferenceController extends Controller
{
    
    public function sendEmailReferee(Request $request){
    	$data = $request->all();
    	dd($data);	
      $rules = array( "name" => "required|string|max:255", "mobile" => "required|digits:10|numeric", "email"  => "required|string", );
         $validator = Validator::make( $data , $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'validator' =>  $validator->getMessageBag()->toArray()
            ]);
        }

        else{

      // ================================================= sending Email To Employer Start =================================================
      if ($request->employerNotification != 0) {
      $user = User::where('id',$request->employerNotification)->first();
      Mail::to($user->email)->send(new referenceEmailtoEmployer($user->name,$request->username));
      // return response()->json([
      //       'status' => 1,
      //       'message' => 'Email sent to Employer successfully',
      //   ]);
      }

      // ================================================= sending Email To Employer End =================================================

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
      // dd($crossreference->jobseekerId);

      $history = new History;
      $history->user_id = $crossreference->jobseekerId; 
      $history->type = 'refernce_sent'; 
      $history->reference_id = $crossreference->id; 
      $history->save();

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

    // ================================================= Referee URL Start  =================================================

    public function crosssreference(Request $request){
    // dd($request->url);
      if (!empty( $request->url )){
        $crossreference = crossreference::where('refURL',$request->url)->first();
      }
      if ($crossreference->refStatus == 'Awaiting Response' ) 
      {
        $data['crossreference'] = $crossreference;
        $data['title'] = 'Cross Reference';
        $data['classes_body'] = 'Reference';
        if ($crossreference->refType == "Work Reference" ) {
          if(isMobile()){
          return view('mobile.reference.workReference', $data);  // mobile/reference/workReference   
        }
        else{
              return view('site.user.reference.workReference', $data);  // site/user/reference/workReference   
            }
          }elseif ($crossreference->refType == "Personal Reference" ) {
          if(isMobile()) {
            return view('mobile.reference.personalReference', $data);  // mobile/user/reference/personalReference   
          }else{
            return view('site.user.reference.personalReference', $data);  // site/user/reference/personalReference   
          }
         }else{
          if(isMobile()){
          return view('mobile.reference.educationalReference', $data);  // mobile/reference/educationalReference   
        }else{
                  return view('site.user.reference.educationalReference', $data);  // site/user/reference/educationalReference   
                }
              }
      }
      else{
        if(isMobile()){
          return view('mobile.reference.alreadySubmittedReference');  // mobile/reference/alreadySubmittedReference   
        }
        else{
            return view('site.user.reference.alreadySubmittedReference');  // site/user/reference/personalReference   
        }
      }
     
    }
  
  // ================================================= Referee URL End  =================================================


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

       $crossreference = crossreference::where('id', $data['refID'])->first();
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

      // dd($crossreference->id);

      $crossreference->save();

      // dd($crossreference->jsdata->id);

      // if ($crossreference->refStatus == 'Reference Completed') {
        $history = new History;
        $history->user_id = $crossreference->jsdata->id;
        $history->type = 'Refernce Completed'; 
        $history->reference_id = $crossreference->id; 
        $history->save();
      // }


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
       // $crossreference->refereeParticularIns = $data['refereeParticularIns'];
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

      // if ($crossreference->refStatus == 'Reference Completed') {
        $history = new History;
        $history->user_id = $crossreference->jsdata->id;
        $history->type = 'Refernce Completed'; 
        $history->reference_id = $crossreference->id; 
        $history->save();
      // }

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

       // if ($crossreference->refStatus == 'Reference Completed') {
        $history = new History;
        $history->user_id = $crossreference->jsdata->id;
        $history->type = 'Refernce Completed'; 
        $history->reference_id = $crossreference->id; 
        $history->save();
      // }
      
       Mail::to($crossreference->jsdata->email)->send(new refSubmitConfirmation($jsname, $refname));

       return response()->json([
            'status' => 1,
            'message' => 'Educational Reference added and email sent successfully',]);
       // }
 
       }

  }
  // ================================================ Saving Educationa Reference End Here ================================================


    public function crossreferenceIndex(Request $request){

        $user = Auth::user();
        $data['user'] = $user;
        // dd($user->id);
        $crossreference = crossreference::where('jobseekerId',$user->id)->get();
        
        // dd($crossreference); 
        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;           
        
        $data['title'] = 'Cross Reference';
        $data['crossreference'] = $crossreference ;
        $data['classes_body'] = 'Interviews';
        return view('site.user.reference.index', $data);   // site/user/reference/index
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
          if(isMobile()){

            return view('mobile.reference.submittedReference');   // mobile/user/reference/allCompletedReferences

          }
          else{
                return view('site.reference.referenceCompleted');   // site/reference/referenceCompleted

          }
        // $referenceSession = session('referenceSession');
        // session()->forget('referenceSession');
       

      }

      public function referenceDeclined(Request $request){

        // $referenceSession = session('referenceSession');
        // session()->forget('referenceSession');
       
       return view('site.reference.referenceDeclined');   // site/reference/referenceCompleted

      }


      //  All the completed references for all uses anyone can seee
    
      public function completedReferenceAll($id,$name){
        // dd($name);
        $crossreference = crossreference::where('refStatus','Reference Completed')->where('jobseekerId', $id)->get();
        
        // dd($crossreference);            
      
        $data['title'] = 'Cross Reference';
        $data['crossreference'] = $crossreference ;
        $data['jsName'] = $name;
        // $data['classes_body'] = 'Interviews';
        if(isMobile()){
            return view('mobile.reference.allCompletedReferenceM', $data);   // mobile/reference/allCompletedReferenceM
        }else{
            return view('site.user.reference.allCompletedReferences', $data);   // site/user/reference/allCompletedReferences
        }
      }

       // 
}
