<?php

use Illuminate\Support\Str;

function checkRole($roles){
    echo "test helper working ";
}

function onlyAdmin(){
    $user = Auth::user(); 
    if (!$user->isAdmin()){
        echo view('unauthorized'); exit;   
    }
}

function isAdmin(){
    $user = Auth::user();
    return ( $user )?($user->isAdmin()):false;
}

function isEmployer($user = null){
    $user = ( $user == null )?(Auth::user()) : $user;
    return ( $user )?($user->isEmployer()):false;
}

function isTypeEmployer($user = null){
    $user = ( $user == null )?(Auth::user()) : $user;
    return ( $user)?(($user->type == 'employer')?true:false):false;
}


function hasBlockYou($me, $user){

    $hasBlock = true;
    if ( empty($me) || empty($user) ){ return $hasBlock; }
    // $userBlock = App\BlockUser::where('user_id',$me->id)->where('block',$user->id)->first();
    $userBlock = App\BlockUser::where('user_id',$user->id)->where('block',$me->id)->first();
    if ($userBlock === null){ $hasBlock = false; }
    return $hasBlock;

}

function get_Geo_Country(){
    $countries = DB::table('geo_country')->get();
    return $countries;
}


function get_Geo_State($country){
    $states = null;
    if(!empty($country)){
       $states = DB::table('geo_state')->where('country_id', $country)->get();
    }
    return $states;
}


function get_Geo_City($country, $state){
    $cities = DB::table('geo_city')->where('country_id', $country)->where('state_id', $state)->get();
    return $cities;
}


function default_Country_id(){ return 14; }
function default_State_id(){ return 129; }



if (! function_exists('str_random')) {
    function str_random($length = 16) { return Str::random($length); }
}


//====================================================================================================================================//
// Static DropDown
//====================================================================================================================================//
function getMonths(){
    return array(
            1       => 'January',
            2       => 'February',
            3       => 'March',
            4       => 'April',
            5       => 'May',
            6       => 'June',
            7       => 'July',
            8       => 'August',
            9       => 'September',
            10      => 'October',
            11      => 'November',
            12      => 'December',
    );

}

function getLanguages(){

    $language_array = array(
        "0" =>  'Please Choose',
        "1" =>  'English',           "2"    =>  'Deutsch',           "3"    =>  'Français',      "4"    =>  'Español',
        "5" =>  'Italiano',          "6"    =>  '‏עברית‏',             "7"  =>  '中文(简体)',         "8"   =>  'Qafar',
        "9" =>  'Afrikaans',         "10"   =>  'اردو',               "11"  =>  'العربية',       "12"   =>  'Азәрбајҹан',
        "13"    =>  'Беларуская',    "14"   =>  'Български',         "15"   =>  'Català',        "16"   =>  'Čeština',
        "17"    =>  'Dansk',         "18"   =>  'Ελληνικά',          "19"   =>  'Eesti',         "20"   =>  'فارسی',
        "21"    =>  'Suomi',         "22"   =>  'Gaeilge',           "23"   =>  'हिंदी',           "24" =>  'Hrvatski',
        "25"    =>  'Magyar',        "26"   =>  'Հայերէն',           "27"   =>  '日本語',         "28" =>  'ქართული',
        "29"    =>  'Қазақ',         "30"   =>  'Lietuvių',          "31"   =>  'Latviešu',      "32"   =>  'Nederlands',
        "33"    =>  'Polski',        "34"   =>  'Português',         "35"   =>  'Română',        "36"   =>  'Русский',
        "37"    =>  'Slovenský',     "38"   =>  'Slovenščina',       "39"   =>  'Shqipe',        "40"   =>  'Српски',
        "41"    =>  'Svenska',       "42"   =>  'Türkçe',            "43"   =>  'Татар',         "44"   =>  'Українська',
        "45"    =>  'Ўзбек',         "46"   =>  'অসমীয়া',            "47"   =>  'বাংলা',          "48"  =>  'Cymraeg',
        "49"    =>  'ދިވެހިބަސް',        "50"   =>  'Esperanto',         "51"   =>  'Euskara',       "52"   =>  'Føroyskt',
        "53"    =>  'Galego',        "54"   =>  'ગુજરાતી',            "55"  =>  'Gaelg',         "56"   =>  'ʻōlelo Hawaiʻi',
        "57"    =>  'Bahasa Indonesia',"58" =>  'Íslenska',          "59"   =>  'Kalaallisut',   "60"   =>  '한국어',
        "61"    =>  'कोंकणी',        "62"   =>  'Кыргыз',            "63"   =>  'Kernewek',      "64"   =>  'Македонски',
        "65"    =>  'Монгол хэл',    "66"   =>  'मराठी',              "67"  =>  'Bahasa Melayu', "68"   =>  'Malti',
        "69"    =>  'Norsk bokmål',  "70"   =>  'Norsk nynorsk',     "71"   =>  'Oromoo',        "72"   =>  'ਪੰਜਾਬੀ',
        "73"    =>  'پښتو',        "74" =>  'संस्कृत',             "75" =>  'Sidaamu Afo',   "76"   =>  'Soomaali',
        "77"    =>  'Kiswahili',     "78"   =>  'தமிழ்'
    ); 
   return $language_array;
}

function getLanguage($lang_id){
    $languages = getLanguages();
    return (isset($languages[$lang_id]) && !empty($languages[$lang_id]))?($languages[$lang_id]):$lang_id;
}

function getHobbies(){
    return  array(
        0  => 'Please Choose',
        1  => 'Sports',
        2  => 'Computer',
        3  => 'Dancing',
        4  => 'Reading',
        5  => 'Cooking',
        6  => 'Drawing',
        7  => 'Languages',
        8  => 'Music',
        9  => 'Cinema',
        10  => 'TV',
        11  => 'Gaming',
        12  => 'Yoga',
        13  => 'Blogging',
        14  => 'Bicycle',
        15  => 'Collection',
        16  => 'Crafts',
        17  => 'Electronics',
        18  => 'Hiking'
    );
}

function getHobby($hobby_id){
        $hobbies = getHobbies();
        if(isset($hobbies[$hobby_id]) && !empty($hobbies[$hobby_id])){
            return $hobbies[$hobby_id];
        }else{
            return $hobby_id;
        }

}

function getFamilyType(){
    return array(
    0 => 'Please Choose',
    1 => 'I want kids',
    2 => 'I do not want kids',
    3 => 'My kids live with me',
    4 => 'My kids live elsewhere',
    5 => 'I do not have kids',
    6 => 'I want more kids',
    7 => 'Open to the idea but unsure');
}

function getEducationDropdown(){
    return array(
        ''                  =>  'Please Choose',
        'high_school'       =>  'High School',
        'college'           =>  'Some College',
        'associate_degree'  =>  'Associate degree',
        'bachelor'          =>  'Bachelor degree',
        'graduate'          =>  'Graduate degree',
        'phd'               =>  'PH.D/Post Doctoral'
    );
}

function getEducationName($education){
    $educationList = getEducationDropdown();
    if (isset($educationList[$education])){ return $educationList[$education]; }
}


function getIndustries(){

    $industries_list = array(
        'accounting_finance'            => 'Accounting and Finance',
        'administration_office_support' => 'Administration and Office support',
        'advertising_arts_media'        => 'Advertising, Arts and Media',
        'automotive'                    => 'Automotive',
        'banking_financial_services'    => 'Banking and Financial Services',
        'call_centre_customer_service'  => 'Call Centre and Customer Service',
        'ceo_general Management'        => 'CEO and General Management',
        'community_services_development'=> 'Community Services and Development',
        'company_directors'             => 'Company Directors',
        'construction'                  => 'Construction',
        'consulting_strategy'           => 'Consulting and Strategy',

        'design_architecture'           => 'Design and Architecture',
        'disputes_complaint_resolution' => 'Disputes and Complaint Resolution',
        'entertainment_event_management'=> 'Entertainment & Event Management',
        'education_training'            => 'Education and Training',
        'engineering'                   => 'Engineering',
        'farming_animals_conservation'  => 'Farming, Animals and Conservation',
        'fast_food'                     => 'Fast Food',
        'government_defence'            => 'Government and Defence',
        'healthcare_medical'            => 'Healthcare and Medical',
        'tourism'                       => 'Tourism',
        'human_resources_recruitment'   => 'Human Resources and Recruitment',
        'information_technology'        => 'Information Technology',
        'insurance'                     => 'Insurance',

        'legal'                         => 'Legal',
        'manufacturing'                 => 'Manufacturing',
        'marketing_communications'      => 'Marketing and Communications',
        'mining_resources_energy'       => 'Mining, Resources and Energy',
        'real_estate_property'          => 'Real Estate and Property',
        'retail_consumer_products'      => 'Retail and Consumer products',
        'sales_business_development'    => 'Sales and Business Development',
        'science_technology'            => 'Science and Technology',
        'sport_recreation'              => 'Sport and Recreation',
        'team_leader_people_management' => 'Team Leader and People Management',
        'telecommunications'            => 'Telecommunications',
        'trades_services'               => 'Trades and Services',
        'transport_logistics'           => 'Transport and Logistics'
    ); 

    return  $industries_list; 
}

function getIndustryName($name){
    $industries = getIndustries();
    if(isset($industries[$name])){ return $industries[$name]; }
}

function getQualificationsList(){
    return 
    array(
        array( 
            'id' => '1',
            'type' => 'degree',
            'title' => 'Agricultural & Agribusiness Studies'
        ),
        array( 
            'id' => '2',
            'type' => 'degree',
            'title' => 'Architecture, Building, Construction'
        ),
        array( 
            'id' => '3',
            'type' => 'degree',
            'title' => 'Arts, Music, Film, Media, Animation & Graphic Design'
        ),
        array( 
            'id' => '4',
            'type' => 'degree',
            'title' => 'Biology, Genetics & Biomedical Science'
        ),
        array( 
            'id' => '5',
            'type' => 'degree',
            'title' => 'Chemistry, Pharmacology, Radiography & Forensic Science'
        ),
        array( 
            'id' => '6',
            'type' => 'degree',
            'title' => 'Economics, Finance, Taxation & Accounting'
        ),
        array( 
            'id' => '7',
            'type' => 'degree',
            'title' => 'Education & Workplace Learning and Assessment'
        ),
        array( 
            'id' => '8',
            'type' => 'degree',
            'title' => 'Emergency Services, Firefighting, EMT & Disaster Management'
        ),
        array( 
            'id' => '9',
            'type' => 'degree',
            'title' => 'Engineering (Chemical & Biomedical'
        ),
        array( 
            'id' => '10',
            'type' => 'degree',
            'title' => 'Engineering (Civil & Structural'
        ),
        array( 
            'id' => '11',
            'type' => 'degree',
            'title' => 'Engineering (Mechanical, Electrical & Mechatronics'
        ),
        array( 
            'id' => '12',
            'type' => 'degree',
            'title' => 'Environment, Land Management & Geoscience studies'
        ),
        array( 
            'id' => '13',
            'type' => 'degree',
            'title' => 'Financial Services (Banking, Insurance, Planning & Advice'
        ),
        array( 
            'id' => '14',
            'type' => 'degree',
            'title' => 'Food Science, Nutrition & Dietetics'
        ),
        array( 
            'id' => '15',
            'type' => 'degree',
            'title' => 'Food/Beverage Processing, Handling & Preparation'
        ),
        array( 
            'id' => '16',
            'type' => 'degree',
            'title' => 'Human Resources & Business/People Management'
        ),
        array( 
            'id' => '17',
            'type' => 'degree',
            'title' => 'Information Technology & Information Systems'
        ),
        array( 
            'id' => '18',
            'type' => 'degree',
            'title' => 'Landscaping, Horticulture, Floristry & Pest Control'
        ),
        array( 
            'id' => '19',
            'type' => 'degree',
            'title' => 'Languages, Literature, Creative Writing & Journalism'
        ),
        array( 
            'id' => '20',
            'type' => 'degree',
            'title' => 'Law, Criminology & Policing'
        ),
        array( 
            'id' => '21',
            'type' => 'degree',
            'title' => 'Medicine & Health Science'
        ),
        array( 
            'id' => '22',
            'type' => 'degree',
            'title' => 'Nursing & Aged Care'
        ),
        array( 
            'id' => '23',
            'type' => 'degree',
            'title' => 'Physics, Mathematics, Actuarial & Statistics'
        ),
        array( 
            'id' => '24',
            'type' => 'degree',
            'title' => 'Physiology & Rehabilitation Therapies'
        ),
        array( 
            'id' => '25',
            'type' => 'degree',
            'title' => 'Politics, Religion & History'
        ),
        array( 
            'id' => '26',
            'type' => 'degree',
            'title' => 'Psychology, Human Studies & Counselling'
        ),
        array( 
            'id' => '27',
            'type' => 'degree',
            'title' => 'Public Relations, Marketing, Social Media & Advertising'
        ),
        array( 
            'id' => '28',
            'type' => 'degree',
            'title' => 'Real Estate & Property Management'
        ),
        array( 
            'id' => '29',
            'type' => 'degree',
            'title' => 'Retail, Sales & Small Business'
        ),
        array( 
            'id' => '30',
            'type' => 'degree',
            'title' => 'Social Welfare & Community Wellbeing'
        ),
        array( 
            'id' => '31',
            'type' => 'degree',
            'title' => 'Sport, Fitness, Coaching & Personal Training'
        ),
        array( 
            'id' => '32',
            'type' => 'degree',
            'title' => 'Tourism, Hospitality & Event Management'
        ),
        array( 
            'id' => '33',
            'type' => 'degree',
            'title' => 'Veterinary Studies & Animal Science'
        ),
        array( 
            'id' => '34',
            'type' => 'degree',
            'title' => 'Workplace Health & Safety'
        ),
         

        array(
            'id'    =>  '36',
            'type' => 'trade',
            'title' => 'Automotive (mechanic, auto-electrician, panel beater etc)'
        ),
        array(
            'id'    =>  '37',
            'type' => 'trade',
            'title' => 'Building and Construction (carpenter, brick layer, plumber, cabinet maker etc)'
        ),
        array(
            'id'    =>  '38',
            'type' => 'trade',
            'title' => 'Design, Printing and Telco (screen printing, printing, and telecommunication networks)'
        ),
        array(
            'id'    =>  '39',
            'type' => 'trade',
            'title' => 'Food & Hospitality (Chef, Butcher, Baker etc)'
        ),
        array(
            'id'    =>  '40',
            'type' => 'trade',
            'title' => 'Forestry (lumber jack, wood machining & saw doctoring)'
        ),
        array(
            'id'    =>  '41',
            'type' => 'trade',
            'title' => 'Furnishing (upholstery, furniture polishing, glass cutting/glazing & floor technology)'
        ),
        array(
            'id'    =>  '42',
            'type' => 'trade',
            'title' => 'Textiles (Clothing and footwear mechanic) '
        ),
        array(
            'id'    =>  '43',
            'type' => 'trade',
            'title' => 'Naval (boat building, farriery, shipwright, maritime engineers and operations) '
        ),
        array(
            'id'    =>  '44',
            'type' => 'trade',
            'title' => 'Engineering (electrical/fabrication and Mechanical)'
        ),
        array(
            'id'    =>  '45',
            'type' => 'trade',
            'title' => 'Aviation (avionics, mechanical and structural aircraft maintenance)  '
        ),
        array(
            'id'    =>  '46',
            'type' => 'trade',
            'title' => 'Light Manufacturing (jeweller and locksmith) '
        ),
        array(
            'id'    =>  '47',
            'type' => 'trade',
            'title' => 'Landscaping (including nursery, green keeping and gardening) '
        ),
        array(
            'id'    =>  '48',
            'type' => 'trade',
            'title' => 'Process Manufacturing (polymer technology)'
        ),
        array(
            'id'    =>  '49',
            'type' => 'trade',
            'title' => 'Hairdressing and Beauty Therapy'
        ),
        array(
            'id'    =>  '50',
            'type' => 'trade',
            'title' => 'Utilities and Electro Technology (electrician, data/cabling, rail systems and communications'
        )
    ); 
}


function getSalariesRange(){
    $salaries = array(
        '50000' => '50,000 and above',
        '60000' => '60,000 and above',
        '70000' => '70,000 and above',
        '80000' => '80,000 and above',
        '90000' => '90,000 and above',
        '100000' => '100,000 and above',
        '120000' => '120,000 and above',
        '150000' => '150,000 and above',
    ); 
    return $salaries;
}

function getSalariesRangeLavel($salary){
    $salaries = getSalariesRange();
    return (isset($salaries[$salary]))?($salaries[$salary]):$salary;
}

function getFontAwesomeIconList(){ }


function my_sanitize_number($number) {
    return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
}

function my_sanitize_array_number($number_array) {
    if(!empty($number_array) && is_array($number_array)){ 
        foreach ($number_array as $key => $number) {
           $number_array[$key] = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
        }
    }
    return $number_array;  
}

function my_sanitize_decimal($decimal) {
    return filter_var($decimal, FILTER_SANITIZE_NUMBER_FLOAT);
}

function my_sanitize_string($string) {
    $string = strip_tags($string);
    $string = addslashes($string);
    return filter_var($string, FILTER_SANITIZE_STRING);
}

function my_sanitize_array_string($array_string) { 
    if(!empty($array_string) && is_array($array_string)){ 
        foreach ($array_string as $key => $string) {
             $string = strip_tags($string);
             $string = addslashes($string);
             $string = filter_var($string, FILTER_SANITIZE_STRING);
             $array_string[$key] = $string;
        }
    }
    return $array_string;
}


function my_sanitize_html($string) {
    $string = strip_tags($string, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot>');
    $string = addslashes($string);
    return filter_var($string, FILTER_SANITIZE_STRING);
}

function my_sanitize_url($url) {
    return filter_var($url, FILTER_SANITIZE_URL);
}

// function my_sanitize_slug($string) {
//     $string = str_slug($string);
//     return filter_var($string, FILTER_SANITIZE_URL);
// }

function my_sanitize_email($string) {
    return filter_var($string, FILTER_SANITIZE_EMAIL);
}

 
function remove_spaces($string) {
    return  str_replace(' ', '', $string);
}


function assetGallery($access,$userId,$type,$file){
    $path = '';
    if ($access == 2){
        $path .= 'media/private/';
    }else{
        $path .= 'media/public/';
    }
    $path .= $userId.'/gallery/'.(($type)?($type.'/'):'').$file;
    return asset( $path );
}   

function assetGallery2($gallery, $type){
    $path = '';
    if ($gallery->access == 2){
        $path .= 'media/private/';
    }else{
        $path .= 'media/public/';
    }
    $path .= $gallery->user_id.'/gallery/'.(($type)?($type.'/'):'').$gallery->image;
    return asset( $path );
}   



function generateVideoThumbs($video){
    $html = '<img class="video_thumb w100" ';
    if (!empty($video->thumbs)){
         // $html .= ' src="'.$video->thumbs[0].'"  ';
        $vBasePath  = ($video->status == 2)?('media/private/'):('media/public/');
        $vBasePath .= $video->user_id.'/videos/thumbs/'.$video->id.'/';
        $vPath      = $vBasePath.$video->thumbs[0];
        
        $html .= ' src="'.asset($vPath).'"'; 

        if(count($video->thumbs) > 1){
            foreach ($video->thumbs as $tkey => $thumb) {
                $tPath = $vBasePath.$thumb;
                $html .= ' data-thumb'.$tkey.'="'.asset($tPath).'"'; 
            }
        }
    }

   if (!empty($video->file)) 
    $html .= ' data-src="'.assetVideo($video).'"'; 

   $html .= '/>';
   return $html; 
}


function assetVideo($video){
    // $vPath  = ($video->status == 2)?('media/private/'):('media/public/');
    $vPath  = 'stream/';
    $vPath .= $video->file;
    return asset( $vPath );
} 

function assetResume($resume){
    if(isset($resume->file))
        return asset('images/user/'.$resume->file); 
} 


function getQualificationNames($qualification_array_json){
    $qualification_names = array();
    $getQualificationsList = getQualificationsList();
    if (!empty($qualification_array_json)){
       $qualification_array =  json_decode($qualification_array_json,true);
       foreach ($getQualificationsList  as $qkey => $qvalue) {
           if(in_array($qvalue['id'], $qualification_array)){
                $qualification_names[] =  $qvalue['title']; 
           }
       }
    }
    // dd($qualification_names);
    return $qualification_names;
}

function getQualificationsData($qualification_array_json){
    $qualification_names = array();
    $getQualificationsList = getQualificationsList();
    if (!empty($qualification_array_json)){
       $qualification_array =  json_decode($qualification_array_json,true);
       foreach ($getQualificationsList  as $qkey => $qvalue) {
           if(in_array($qvalue['id'], $qualification_array)){
                $qualification_names[] = $qvalue; 
           }
       }
    }
    return $qualification_names;
}


// Added by Hassan
function getEyeColor(){
    return array(
        0            =>  'Light Brown',
        1            =>  'Hazel',
        2            =>  'Brown',
        3            =>  'Black',
        4            =>  'Blue',
        5            =>  'Green'
    );
}

function getYears(){
    return array(
            1       => '1996',
            2       => '1997',
            3       => '1998',
            4       => '1999',
            5       => '2000',
            6       => '2001',
            7       => '2002',
            8       => '2003',
            9       => '2004',
            10      => '2005',
            11      => '2006',
            12      => '2007',
    );
}

function getDays(){
    return array(
            1       => '1',
            2       => '2',
            3       => '3',
            4       => '4',
            5       => '5',
            6       => '6',
            7       => '7',
            8       => '8',
            9       => '9',
            10      => '10',
            11      => '11',
            12      => '12',
            13      => '13',
            14      => '14',
            15      => '15',
            16      => '16',
            17      => '17',
            18      => '18',
            19      => '19',
            20      => '20',
            21      => '21',
            22      => '22',
            23      => '23',
            24      => '24',
            25      => '25',
            26      => '26',
            27      => '27',
            28      => '28',
            29      => '29',
            30      => '30',
            31      => '31',

    );
}


function getJobTypes(){
    return array(
    'full_time' => 'Full Time',
    'part_time' => 'Part Time',
    'occassional_time' => 'Occassinal Time',
    );
}

function getUserRegisterQuestions(){
    $userquestion = array(
        'graduate_intern' => 'Are you seeking a Graduate Program or Internship?',
        'part_time' => 'Are you open to Part Time or Casual work?',
        'temporary_contract' => 'Are you open to temporary and contract work?',
        'fulltime' => 'Are you looking for Full Time Employment?',
        'relocation' => 'Are you looking or willing to relocate for your next job opportunity?',
        'resident' => 'Are you a Permanent Resident or Citizen of Australia or New Zealand?',

    ); 
    return $userquestion;
}

function getEmpRegisterQuestions(){
    $empquestion = array(
        'graduate_intern' => 'Does you company hire Graduates or Intern??',
        'part_time' => 'Are you open to Part Time or Casual workers?<',
        'temporary_contract' => 'Does you organisation offer temporary or contract type work?',
        'fulltime' => 'Are you looking for Full Time candidates?',
        'relocation' => 'Are you willing to repay relocation expenses for a strong candidate?',
        'resident' => 'Does your organisation ever hire candidates who are not Permanent Resident or Citizen?',
    ); 
    return $empquestion;
}

function userLocation($user){
    $location = []; 
    if($user->location)
        $location[] =  $user->location; 
    
    if($user->city)
        $location[] =  $user->city; 

    if($user->state)
        $location[] =  $user->state; 

    if($user->country)
        $location[] =  $user->country; 

    return implode(', ', $location);

}


function jobStatusArray(){
    $status_array = array();
    $status_array['applied'] = 'Applied';
    $status_array['review'] = 'In Review';
    $status_array['interview'] = 'Interview';
    $status_array['unsuccessful'] = 'Unsuccessful';
    return $status_array; 
}
 
