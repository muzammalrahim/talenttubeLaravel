<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            // dd($query);
        }
        else{
            $query = User::where('type','employer')->Where('step2' , '>=' , '3');
        }
        // $tagsQuery = Tags::get();
        if(!empty($block)){
            // $query = $query->whereNotIn('id', $block);
            $query = $query->whereNotIn('id', $block);
        }
        // dd($query);
        
        $query =  $query->get();
        // dd($data['query'] ); 
        $data['likeUsers'] = $likeUsers;
        $data['title'] = 'Talent Match';
        $data['classes_body'] = 'Talent Match';

        $controlsession = ControlSession::where('user_id', $user->id)->where('admin_id', '1')->get();
        $data['controlsession'] = $controlsession;

        // dd(count($query));
        $talentMatchArray = [];
        if (count($query) > 0) {
            foreach($query as $queryKey=> $js){
                $dist = calculate_distance($js, $user);
                $ind_exp = cal_ind_exp($js,$user);
                $compatibility = compatibility($js, $user); 
                $user_compat = $compatibility*20;
                // ========================= excluded 6th question ========================= 
                $emp_questions = json_decode($js->questions , true);
                $user_questions = json_decode($user->questions , true);
                $emp_resident = '';
                $user_resident = '';
                   
                if ($emp_questions != null && $user_questions != null) {
                    $emp_match = array_slice($emp_questions, 5, 6, true);
                    foreach ($emp_match as $key => $value) {
                        $emp_resident .= $value;
                    }
                    $user_match = array_slice($user_questions, 5, 6, true);
                    foreach ($user_match as $key => $value) {
                        $user_resident .= $value;
                    }
                }
                if ($emp_resident == 'no' && $user_resident == 'no') {
                    $check = false;
                }
                else if($dist < 50 && !empty($ind_exp)) {
                    $check = true;
                    $html = '<h4 class="text-green bold "> Strong Match Potential </h4>';
                    $talentMatchArray[$queryKey]['id'] = $js;
                    $talentMatchArray[$queryKey]['html'] = $html;
                    $talentMatchArray[$queryKey]['user_compat'] = $user_compat;
                }
                else if($dist < 50 ) {
                    $check = true;
                    $html = '<h4 class="text-orange bold "> Moderate Match Potential  </h4>';
                    $talentMatchArray[$queryKey]['id'] = $js;
                    $talentMatchArray[$queryKey]['html'] = $html;
                    $talentMatchArray[$queryKey]['user_compat'] = $user_compat;


                }
                else if(!empty($ind_exp)){
                    $check = true;
                    $html = '<h4 class="text-orange bold "> Moderate Match Potential  </h4>';
                    $talentMatchArray[$queryKey]['id'] = $js;
                    $talentMatchArray[$queryKey]['html'] = $html;
                    $talentMatchArray[$queryKey]['user_compat'] = $user_compat;


                }
                else{
                    $check = false;
                }
            }
        }

        // dd($talentMatchArray);
        // dump(url('/'));
        // $url = url()->current();
        // dd($url);
        $data['query'] = $this->paginate($talentMatchArray);
        $data['query']->withPath(url()->current());
        

        // dd('not in the loop');
       
        // dd($user);

        if(isMobile()){

            // return view('mobile.employer.jobSeekers.index', $data); // mobile/employer/jobSeekers/index
            return view('mobile.talent_matcher.index', $data); // mobile/talent_matcher/index


        }else{
            // dd( ' Coming here ' );
            return view('site.talent_matcher.index', $data); // site/talent_matcher/index
        }


    }


    // Paginate Function

    public function paginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page);
    }



}
