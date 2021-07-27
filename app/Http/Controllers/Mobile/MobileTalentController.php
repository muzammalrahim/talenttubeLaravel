<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use DB;

use App\User;
use App\BlockUser;
use App\LikeUser;

use Illuminate\Http\Request;

class MobileTalentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function mTalent_matcher(){
        $user = Auth::user();
        $data['user'] = $user;
        // $data['user'] = $user;

        $likeUsers = LikeUser::where('user_id',$user->id)->pluck('like')->toArray();
        $block = BlockUser::where('user_id', $user->id)->pluck('block')->toArray();
        
        // $query = User::with('profileImage','user_tags')->where('type','user')->Where('step2' , '>=' , '7');

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
        // dd($user);
        return view('mobile.talent_matcher.index', $data); // mobile/talent_matcher/index

    }


}



