<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use DB;
use App\User;
use App\BlockUser;
use App\LikeUser;
use App\ControlSession;



class TalentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function talent_matcher(){
        $user = Auth::user();
        $data['user'] = $user;
        // dd($user);
        // $data['user'] = $user;

        $likeUsers = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        if (isEmployer()) {
            $query = User::with('profileImage','user_tags')->where('type','user')->Where('step2' , '>=' , '7');
        }
        else{
            $query = User::where('type','employer')->Where('step2' , '>=' , '3');
        }
        // $tagsQuery = Tags::get();
        if(!empty($block)){
            // $query = $query->whereNotIn('id', $block);
            $query = $query->whereNotIn('id', $block);
        }
        
        $data['query'] =  $query->get();
        //dd($data['query'] );       
        $data['likeUsers'] = $likeUsers;
        $data['title'] = 'Talent Match';
        $data['classes_body'] = 'Talent Match';

        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;
       
        // dd($user);

        if(isMobile()){

            // return view('mobile.employer.jobSeekers.index', $data); // mobile/employer/jobSeekers/index
            return view('mobile.talent_matcher.index', $data); // mobile/talent_matcher/index


        }else{
            return view('site.talent_matcher.index', $data); // site/talent_matcher/index
        }


    }
}
