<?php

use Illuminate\Support\Str;

function checkRole($roles){
    echo "test helper working ";
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



if (! function_exists('str_random')) {
    function str_random($length = 16) { return Str::random($length); }
}


//====================================================================================================================================//
// Static DropDown
//====================================================================================================================================//
function getMonths(){
	return array(
			1		=> 'January',
			2		=> 'February',
			3		=> 'March',
			4		=> 'April',
			5		=> 'May',
			6		=> 'June',
			7		=> 'July',
			8		=> 'August',
			9		=> 'September',
			10		=> 'October',
			11		=> 'November',
			12		=> 'December',
	);

}

function getLanguages(){

    $language_array = array(
        "0"	=>	'Please Choose',
        "1"	=>	'English',           "2"	=>	'Deutsch',           "3"	=>	'Français',      "4"	=>	'Español',
        "5"	=>	'Italiano',          "6"	=>	'‏עברית‏',             "7"	=>	'中文(简体)',         "8"	=>	'Qafar',
        "9"	=>	'Afrikaans',         "10"	=>	'اردو',               "11"	=>	'العربية',       "12"	=>	'Азәрбајҹан',
        "13"	=>	'Беларуская',    "14"	=>	'Български',         "15"	=>	'Català',        "16"	=>	'Čeština',
        "17"	=>	'Dansk',         "18"	=>	'Ελληνικά',          "19"	=>	'Eesti',         "20"	=>	'فارسی',
        "21"	=>	'Suomi',         "22"	=>	'Gaeilge',           "23"	=>	'हिंदी',           "24"	=>	'Hrvatski',
        "25"	=>	'Magyar',        "26"	=>	'Հայերէն',           "27"	=>	'日本語',         "28"	=>	'ქართული',
        "29"	=>	'Қазақ',         "30"	=>	'Lietuvių',          "31"	=>	'Latviešu',      "32"	=>	'Nederlands',
        "33"	=>	'Polski',        "34"	=>	'Português',         "35"	=>	'Română',        "36"	=>	'Русский',
        "37"	=>	'Slovenský',     "38"	=>	'Slovenščina',       "39"	=>	'Shqipe',        "40"	=>	'Српски',
        "41"	=>	'Svenska',       "42"	=>	'Türkçe',            "43"	=>	'Татар',         "44"	=>	'Українська',
        "45"	=>	'Ўзбек',         "46"	=>	'অসমীয়া',            "47"	=>	'বাংলা',          "48"	=>	'Cymraeg',
        "49"	=>	'ދިވެހިބަސް',        "50"	=>	'Esperanto',         "51"	=>	'Euskara',       "52"	=>	'Føroyskt',
        "53"	=>	'Galego',        "54"	=>	'ગુજરાતી',            "55"	=>	'Gaelg',         "56"	=>	'ʻōlelo Hawaiʻi',
        "57"	=>	'Bahasa Indonesia',"58"	=>	'Íslenska',          "59"	=>	'Kalaallisut',   "60"	=>	'한국어',
        "61"	=>	'कोंकणी',        "62"	=>	'Кыргыз',            "63"	=>	'Kernewek',      "64"	=>	'Македонски',
        "65"	=>	'Монгол хэл',    "66"	=>	'मराठी',              "67"	=>	'Bahasa Melayu', "68"	=>	'Malti',
        "69"	=>	'Norsk bokmål',  "70"	=>	'Norsk nynorsk',     "71"	=>	'Oromoo',        "72"	=>	'ਪੰਜਾਬੀ',
        "73"	=>	'پښتو',        "74"	=>	'संस्कृत',             "75"	=>	'Sidaamu Afo',   "76"	=>	'Soomaali',
        "77"	=>	'Kiswahili',     "78"	=>	'தமிழ்'
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

function getFontAwesomeIconList(){

    // return array('fa-glass','fa-music','fa-search','fa-envelope-o','fa-heart','fa-star','fa-star-o','fa-user','fa-film','fa-th-large','fa-th','fa-th-list','fa-check','fa-times','fa-search-plus','fa-search-minus','fa-power-off','fa-signal','fa-cog','fa-trash-o','fa-home','fa-file-o','fa-clock-o','fa-road','fa-download','fa-arrow-circle-o-down','fa-arrow-circle-o-up','fa-inbox','fa-play-circle-o','fa-repeat','fa-refresh','fa-list-alt','fa-lock','fa-flag','fa-headphones','fa-volume-off','fa-volume-down','fa-volume-up','fa-qrcode','fa-barcode','fa-tag','fa-tags','fa-book','fa-bookmark','fa-print','fa-camera','fa-font','fa-bold','fa-italic','fa-text-height','fa-text-width','fa-align-left','fa-align-center','fa-align-right','fa-align-justify','fa-list','fa-outdent','fa-indent','fa-video-camera','fa-picture-o','fa-pencil','fa-map-marker','fa-adjust','fa-tint','fa-pencil-square-o','fa-share-square-o','fa-check-square-o','fa-arrows','fa-step-backward','fa-fast-backward','fa-backward','fa-play','fa-pause','fa-stop','fa-forward','fa-fast-forward','fa-step-forward','fa-eject','fa-chevron-left','fa-chevron-right','fa-plus-circle','fa-minus-circle','fa-times-circle','fa-check-circle','fa-question-circle','fa-info-circle','fa-crosshairs','fa-times-circle-o','fa-check-circle-o','fa-ban','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrow-down','fa-share','fa-expand','fa-compress','fa-plus','fa-minus','fa-asterisk','fa-exclamation-circle','fa-gift','fa-leaf','fa-fire','fa-eye','fa-eye-slash','fa-exclamation-triangle','fa-plane','fa-calendar','fa-random','fa-comment','fa-magnet','fa-chevron-up','fa-chevron-down','fa-retweet','fa-shopping-cart','fa-folder','fa-folder-open','fa-arrows-v','fa-arrows-h','fa-bar-chart','fa-twitter-square','fa-facebook-square','fa-camera-retro','fa-key','fa-cogs','fa-comments','fa-thumbs-o-up','fa-thumbs-o-down','fa-star-half','fa-heart-o','fa-sign-out','fa-linkedin-square','fa-thumb-tack','fa-external-link','fa-sign-in','fa-trophy','fa-github-square','fa-upload','fa-lemon-o','fa-phone','fa-square-o','fa-bookmark-o','fa-phone-square','fa-twitter','fa-facebook','fa-github','fa-unlock','fa-credit-card','fa-rss','fa-hdd-o','fa-bullhorn','fa-bell','fa-certificate','fa-hand-o-right','fa-hand-o-left','fa-hand-o-up','fa-hand-o-down','fa-arrow-circle-left','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-circle-down','fa-globe','fa-wrench','fa-tasks','fa-filter','fa-briefcase','fa-arrows-alt','fa-users','fa-link','fa-cloud','fa-flask','fa-scissors','fa-files-o','fa-paperclip','fa-floppy-o','fa-square','fa-bars','fa-list-ul','fa-list-ol','fa-strikethrough','fa-underline','fa-table','fa-magic','fa-truck','fa-pinterest','fa-pinterest-square','fa-google-plus-square','fa-google-plus','fa-money','fa-caret-down','fa-caret-up','fa-caret-left','fa-caret-right','fa-columns','fa-sort','fa-sort-desc','fa-sort-asc','fa-envelope','fa-linkedin','fa-undo','fa-gavel','fa-tachometer','fa-comment-o','fa-comments-o','fa-bolt','fa-sitemap','fa-umbrella','fa-clipboard','fa-lightbulb-o','fa-exchange','fa-cloud-download','fa-cloud-upload','fa-user-md','fa-stethoscope','fa-suitcase','fa-bell-o','fa-coffee','fa-cutlery','fa-file-text-o','fa-building-o','fa-hospital-o','fa-ambulance','fa-medkit','fa-fighter-jet','fa-beer','fa-h-square','fa-plus-square','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-double-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-angle-down','fa-desktop','fa-laptop','fa-tablet','fa-mobile','fa-circle-o','fa-quote-left','fa-quote-right','fa-spinner','fa-circle','fa-reply','fa-github-alt','fa-folder-o','fa-folder-open-o','fa-smile-o','fa-frown-o','fa-meh-o','fa-gamepad','fa-keyboard-o','fa-flag-o','fa-flag-checkered','fa-terminal','fa-code','fa-reply-all','fa-star-half-o','fa-location-arrow','fa-crop','fa-code-fork','fa-chain-broken','fa-question','fa-info','fa-exclamation','fa-superscript','fa-subscript','fa-eraser','fa-puzzle-piece','fa-microphone','fa-microphone-slash','fa-shield','fa-calendar-o','fa-fire-extinguisher','fa-rocket','fa-maxcdn','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-circle-down','fa-html5','fa-css3','fa-anchor','fa-unlock-alt','fa-bullseye','fa-ellipsis-h','fa-ellipsis-v','fa-rss-square','fa-play-circle','fa-ticket','fa-minus-square','fa-minus-square-o','fa-level-up','fa-level-down','fa-check-square','fa-pencil-square','fa-external-link-square','fa-share-square','fa-compass','fa-caret-square-o-down','fa-caret-square-o-up','fa-caret-square-o-right','fa-eur','fa-gbp','fa-usd','fa-inr','fa-jpy','fa-rub','fa-krw','fa-btc','fa-file','fa-file-text','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-thumbs-up','fa-thumbs-down','fa-youtube-square','fa-youtube','fa-xing','fa-xing-square','fa-youtube-play','fa-dropbox','fa-stack-overflow','fa-instagram','fa-flickr','fa-adn','fa-bitbucket','fa-bitbucket-square','fa-tumblr','fa-tumblr-square','fa-long-arrow-down','fa-long-arrow-up','fa-long-arrow-left','fa-long-arrow-right','fa-apple','fa-windows','fa-android','fa-linux','fa-dribbble','fa-skype','fa-foursquare','fa-trello','fa-female','fa-male','fa-gratipay','fa-sun-o','fa-moon-o','fa-archive','fa-bug','fa-vk','fa-weibo','fa-renren','fa-pagelines','fa-stack-exchange','fa-arrow-circle-o-right','fa-arrow-circle-o-left','fa-caret-square-o-left','fa-dot-circle-o','fa-wheelchair','fa-vimeo-square','fa-try','fa-plus-square-o','fa-space-shuttle','fa-slack','fa-envelope-square','fa-wordpress','fa-openid','fa-university','fa-graduation-cap','fa-yahoo','fa-google','fa-reddit','fa-reddit-square','fa-stumbleupon-circle','fa-stumbleupon','fa-delicious','fa-digg','fa-pied-piper','fa-pied-piper-alt','fa-drupal','fa-joomla','fa-language','fa-fax','fa-building','fa-child','fa-paw','fa-spoon','fa-cube','fa-cubes','fa-behance','fa-behance-square','fa-steam','fa-steam-square','fa-recycle','fa-car','fa-taxi','fa-tree','fa-spotify','fa-deviantart','fa-soundcloud','fa-database','fa-file-pdf-o','fa-file-word-o','fa-file-excel-o','fa-file-powerpoint-o','fa-file-image-o','fa-file-archive-o','fa-file-audio-o','fa-file-video-o','fa-file-code-o','fa-vine','fa-codepen','fa-jsfiddle','fa-life-ring','fa-circle-o-notch','fa-rebel','fa-empire','fa-git-square','fa-git','fa-hacker-news','fa-tencent-weibo','fa-qq','fa-weixin','fa-paper-plane','fa-paper-plane-o','fa-history','fa-circle-thin','fa-header','fa-paragraph','fa-sliders','fa-share-alt','fa-share-alt-square','fa-bomb','fa-futbol-o','fa-tty','fa-binoculars','fa-plug','fa-slideshare','fa-twitch','fa-yelp','fa-newspaper-o','fa-wifi','fa-calculator','fa-paypal','fa-google-wallet','fa-cc-visa','fa-cc-mastercard','fa-cc-discover','fa-cc-amex','fa-cc-paypal','fa-cc-stripe','fa-bell-slash','fa-bell-slash-o','fa-trash','fa-copyright','fa-at','fa-eyedropper','fa-paint-brush','fa-birthday-cake','fa-area-chart','fa-pie-chart','fa-line-chart','fa-lastfm','fa-lastfm-square','fa-toggle-off','fa-toggle-on','fa-bicycle','fa-bus','fa-ioxhost','fa-angellist','fa-cc','fa-ils','fa-meanpath','fa-buysellads','fa-connectdevelop','fa-dashcube','fa-forumbee','fa-leanpub','fa-sellsy','fa-shirtsinbulk','fa-simplybuilt','fa-skyatlas','fa-cart-plus','fa-cart-arrow-down','fa-diamond','fa-ship','fa-user-secret','fa-motorcycle','fa-street-view','fa-heartbeat','fa-venus','fa-mars','fa-mercury','fa-transgender','fa-transgender-alt','fa-venus-double','fa-mars-double','fa-venus-mars','fa-mars-stroke','fa-mars-stroke-v','fa-mars-stroke-h','fa-neuter','fa-genderless','fa-facebook-official','fa-pinterest-p','fa-whatsapp','fa-server','fa-user-plus','fa-user-times','fa-bed','fa-viacoin','fa-train','fa-subway','fa-medium','fa-y-combinator','fa-optin-monster','fa-opencart','fa-expeditedssl','fa-battery-full','fa-battery-three-quarters','fa-battery-half','fa-battery-quarter','fa-battery-empty','fa-mouse-pointer','fa-i-cursor','fa-object-group','fa-object-ungroup','fa-sticky-note','fa-sticky-note-o','fa-cc-jcb','fa-cc-diners-club','fa-clone','fa-balance-scale','fa-hourglass-o','fa-hourglass-start','fa-hourglass-half','fa-hourglass-end','fa-hourglass','fa-hand-rock-o','fa-hand-paper-o','fa-hand-scissors-o','fa-hand-lizard-o','fa-hand-spock-o','fa-hand-pointer-o','fa-hand-peace-o','fa-trademark','fa-registered','fa-creative-commons','fa-gg','fa-gg-circle','fa-tripadvisor','fa-odnoklassniki','fa-odnoklassniki-square','fa-get-pocket','fa-wikipedia-w','fa-safari','fa-chrome','fa-firefox','fa-opera','fa-internet-explorer','fa-television','fa-contao','fa-500px','fa-amazon','fa-calendar-plus-o','fa-calendar-minus-o','fa-calendar-times-o','fa-calendar-check-o','fa-industry','fa-map-pin','fa-map-signs','fa-map-o','fa-map','fa-commenting','fa-commenting-o','fa-houzz','fa-vimeo','fa-black-tie','fa-fonticons');

return array(
        array( 'id' => '0', 'name' => '500px', 'icon' => 'fab fa-500px'),
        array( 'id' => '1', 'name' => 'Accessible Icon', 'icon' => 'fab fa-accessible-icon'),
        array( 'id' => '2', 'name' => 'Accusoft', 'icon' => 'fab fa-accusoft'),
        array( 'id' => '3', 'name' => 'Acquisitions Incorporated', 'icon' => 'fab fa-acquisitions-incorporated'),
        array( 'id' => '4', 'name' => 'Ad', 'icon' => 'fas fa-ad'),
        array( 'id' => '5', 'name' => 'Address Book', 'icon' => 'fas fa-address-book'),
        array( 'id' => '6', 'name' => 'Address Card', 'icon' => 'fas fa-address-card'),
        array( 'id' => '7', 'name' => 'adjust', 'icon' => 'fas fa-adjust'),
        array( 'id' => '8', 'name' => 'App.net', 'icon' => 'fab fa-adn'),
        array( 'id' => '9', 'name' => 'Adobe', 'icon' => 'fab fa-adobe'),
        array( 'id' => '10', 'name' => 'Adversal', 'icon' => 'fab fa-adversal'),
        array( 'id' => '11', 'name' => 'affiliatetheme', 'icon' => 'fab fa-affiliatetheme'),
        array( 'id' => '12', 'name' => 'Air Freshener', 'icon' => 'fas fa-air-freshener'),
        array( 'id' => '13', 'name' => 'Airbnb', 'icon' => 'fab fa-airbnb'),
        array( 'id' => '14', 'name' => 'Algolia', 'icon' => 'fab fa-algolia'),
        array( 'id' => '15', 'name' => 'align-center', 'icon' => 'fas fa-align-center'),
        array( 'id' => '16', 'name' => 'align-justify', 'icon' => 'fas fa-align-justify'),
        array( 'id' => '17', 'name' => 'align-left', 'icon' => 'fas fa-align-left'),
        array( 'id' => '18', 'name' => 'align-right', 'icon' => 'fas fa-align-right'),
        array( 'id' => '19', 'name' => 'Alipay', 'icon' => 'fab fa-alipay'),
        array( 'id' => '20', 'name' => 'Allergies', 'icon' => 'fas fa-allergies'),
        array( 'id' => '21', 'name' => 'Amazon', 'icon' => 'fab fa-amazon'),
        array( 'id' => '22', 'name' => 'Amazon Pay', 'icon' => 'fab fa-amazon-pay'),
        array( 'id' => '23', 'name' => 'ambulance', 'icon' => 'fas fa-ambulance'),
        array( 'id' => '24', 'name' => 'American Sign Language Interpreting', 'icon' => 'fas fa-american-sign-language-interpreting'),
        array( 'id' => '25', 'name' => 'Amilia', 'icon' => 'fab fa-amilia'),
        array( 'id' => '26', 'name' => 'Anchor', 'icon' => 'fas fa-anchor'),
        array( 'id' => '27', 'name' => 'Android', 'icon' => 'fab fa-android'),
        array( 'id' => '28', 'name' => 'AngelList', 'icon' => 'fab fa-angellist'),
        array( 'id' => '29', 'name' => 'Angle Double Down', 'icon' => 'fas fa-angle-double-down'),
        array( 'id' => '30', 'name' => 'Angle Double Left', 'icon' => 'fas fa-angle-double-left'),
        array( 'id' => '31', 'name' => 'Angle Double Right', 'icon' => 'fas fa-angle-double-right'),
        array( 'id' => '32', 'name' => 'Angle Double Up', 'icon' => 'fas fa-angle-double-up'),
        array( 'id' => '33', 'name' => 'angle-down', 'icon' => 'fas fa-angle-down'),
        array( 'id' => '34', 'name' => 'angle-left', 'icon' => 'fas fa-angle-left'),
        array( 'id' => '35', 'name' => 'angle-right', 'icon' => 'fas fa-angle-right'),
        array( 'id' => '36', 'name' => 'angle-up', 'icon' => 'fas fa-angle-up'),
        array( 'id' => '37', 'name' => 'Angry Face', 'icon' => 'fas fa-angry'),
        array( 'id' => '38', 'name' => 'Angry Creative', 'icon' => 'fab fa-angrycreative'),
        array( 'id' => '39', 'name' => 'Angular', 'icon' => 'fab fa-angular'),
        array( 'id' => '40', 'name' => 'Ankh', 'icon' => 'fas fa-ankh'),
        array( 'id' => '41', 'name' => 'App Store', 'icon' => 'fab fa-app-store'),
        array( 'id' => '42', 'name' => 'iOS App Store', 'icon' => 'fab fa-app-store-ios'),
        array( 'id' => '43', 'name' => 'Apper Systems AB', 'icon' => 'fab fa-apper'),
        array( 'id' => '44', 'name' => 'Apple', 'icon' => 'fab fa-apple'),
        array( 'id' => '45', 'name' => 'Fruit Apple', 'icon' => 'fas fa-apple-alt'),
        array( 'id' => '46', 'name' => 'Apple Pay', 'icon' => 'fab fa-apple-pay'),
        array( 'id' => '47', 'name' => 'Archive', 'icon' => 'fas fa-archive'),
        array( 'id' => '48', 'name' => 'Archway', 'icon' => 'fas fa-archway'),
        array( 'id' => '49', 'name' => 'Alternate Arrow Circle Down', 'icon' => 'fas fa-arrow-alt-circle-down'),
        array( 'id' => '50', 'name' => 'Alternate Arrow Circle Left', 'icon' => 'fas fa-arrow-alt-circle-left'),
        array( 'id' => '51', 'name' => 'Alternate Arrow Circle Right', 'icon' => 'fas fa-arrow-alt-circle-right'),
        array( 'id' => '52', 'name' => 'Alternate Arrow Circle Up', 'icon' => 'fas fa-arrow-alt-circle-up'),
        array( 'id' => '53', 'name' => 'Arrow Circle Down', 'icon' => 'fas fa-arrow-circle-down'),
        array( 'id' => '54', 'name' => 'Arrow Circle Left', 'icon' => 'fas fa-arrow-circle-left'),
        array( 'id' => '55', 'name' => 'Arrow Circle Right', 'icon' => 'fas fa-arrow-circle-right'),
        array( 'id' => '56', 'name' => 'Arrow Circle Up', 'icon' => 'fas fa-arrow-circle-up'),
        array( 'id' => '57', 'name' => 'arrow-down', 'icon' => 'fas fa-arrow-down'),
        array( 'id' => '58', 'name' => 'arrow-left', 'icon' => 'fas fa-arrow-left'),
        array( 'id' => '59', 'name' => 'arrow-right', 'icon' => 'fas fa-arrow-right'),
        array( 'id' => '60', 'name' => 'arrow-up', 'icon' => 'fas fa-arrow-up'),
        array( 'id' => '61', 'name' => 'Alternate Arrows', 'icon' => 'fas fa-arrows-alt'),
        array( 'id' => '62', 'name' => 'Alternate Arrows Horizontal', 'icon' => 'fas fa-arrows-alt-h'),
        array( 'id' => '63', 'name' => 'Alternate Arrows Vertical', 'icon' => 'fas fa-arrows-alt-v'),
        array( 'id' => '64', 'name' => 'Artstation', 'icon' => 'fab fa-artstation'),
        array( 'id' => '65', 'name' => 'Assistive Listening Systems', 'icon' => 'fas fa-assistive-listening-systems'),
        array( 'id' => '66', 'name' => 'asterisk', 'icon' => 'fas fa-asterisk'),
        array( 'id' => '67', 'name' => 'Asymmetrik, Ltd.', 'icon' => 'fab fa-asymmetrik'),
        array( 'id' => '68', 'name' => 'At', 'icon' => 'fas fa-at'),
        array( 'id' => '69', 'name' => 'Atlas', 'icon' => 'fas fa-atlas'),
        array( 'id' => '70', 'name' => 'Atlassian', 'icon' => 'fab fa-atlassian'),
        array( 'id' => '71', 'name' => 'Atom', 'icon' => 'fas fa-atom'),
        array( 'id' => '72', 'name' => 'Audible', 'icon' => 'fab fa-audible'),
        array( 'id' => '73', 'name' => 'Audio Description', 'icon' => 'fas fa-audio-description'),
        array( 'id' => '74', 'name' => 'Autoprefixer', 'icon' => 'fab fa-autoprefixer'),
        array( 'id' => '75', 'name' => 'avianex', 'icon' => 'fab fa-avianex'),
        array( 'id' => '76', 'name' => 'Aviato', 'icon' => 'fab fa-aviato'),
        array( 'id' => '77', 'name' => 'Award', 'icon' => 'fas fa-award'),
        array( 'id' => '78', 'name' => 'Amazon Web Services (AWS)', 'icon' => 'fab fa-aws'),
        array( 'id' => '79', 'name' => 'Baby', 'icon' => 'fas fa-baby'),
        array( 'id' => '80', 'name' => 'Baby Carriage', 'icon' => 'fas fa-baby-carriage'),
        array( 'id' => '81', 'name' => 'Backspace', 'icon' => 'fas fa-backspace'),
        array( 'id' => '82', 'name' => 'backward', 'icon' => 'fas fa-backward'),
        array( 'id' => '83', 'name' => 'Bacon', 'icon' => 'fas fa-bacon'),
        array( 'id' => '84', 'name' => 'Balance Scale', 'icon' => 'fas fa-balance-scale'),
        array( 'id' => '85', 'name' => 'Balance Scale (Left-Weighted)', 'icon' => 'fas fa-balance-scale-left'),
        array( 'id' => '86', 'name' => 'Balance Scale (Right-Weighted)', 'icon' => 'fas fa-balance-scale-right'),
        array( 'id' => '87', 'name' => 'ban', 'icon' => 'fas fa-ban'),
        array( 'id' => '88', 'name' => 'Band-Aid', 'icon' => 'fas fa-band-aid'),
        array( 'id' => '89', 'name' => 'Bandcamp', 'icon' => 'fab fa-bandcamp'),
        array( 'id' => '90', 'name' => 'barcode', 'icon' => 'fas fa-barcode'),
        array( 'id' => '91', 'name' => 'Bars', 'icon' => 'fas fa-bars'),
        array( 'id' => '92', 'name' => 'Baseball Ball', 'icon' => 'fas fa-baseball-ball'),
        array( 'id' => '93', 'name' => 'Basketball Ball', 'icon' => 'fas fa-basketball-ball'),
        array( 'id' => '94', 'name' => 'Bath', 'icon' => 'fas fa-bath'),
        array( 'id' => '95', 'name' => 'Battery Empty', 'icon' => 'fas fa-battery-empty'),
        array( 'id' => '96', 'name' => 'Battery Full', 'icon' => 'fas fa-battery-full'),
        array( 'id' => '97', 'name' => 'Battery 1/2 Full', 'icon' => 'fas fa-battery-half'),
        array( 'id' => '98', 'name' => 'Battery 1/4 Full', 'icon' => 'fas fa-battery-quarter'),
        array( 'id' => '99', 'name' => 'Battery 3/4 Full', 'icon' => 'fas fa-battery-three-quarters'),
        array( 'id' => '100', 'name' => 'Battle.net', 'icon' => 'fab fa-battle-net'),
        array( 'id' => '101', 'name' => 'Bed', 'icon' => 'fas fa-bed'),
        array( 'id' => '102', 'name' => 'beer', 'icon' => 'fas fa-beer'),
        array( 'id' => '103', 'name' => 'Behance', 'icon' => 'fab fa-behance'),
        array( 'id' => '104', 'name' => 'Behance Square', 'icon' => 'fab fa-behance-square'),
        array( 'id' => '105', 'name' => 'bell', 'icon' => 'fas fa-bell'),
        array( 'id' => '106', 'name' => 'Bell Slash', 'icon' => 'fas fa-bell-slash'),
        array( 'id' => '107', 'name' => 'Bezier Curve', 'icon' => 'fas fa-bezier-curve'),
        array( 'id' => '108', 'name' => 'Bible', 'icon' => 'fas fa-bible'),
        array( 'id' => '109', 'name' => 'Bicycle', 'icon' => 'fas fa-bicycle'),
        array( 'id' => '110', 'name' => 'Biking', 'icon' => 'fas fa-biking'),
        array( 'id' => '111', 'name' => 'BIMobject', 'icon' => 'fab fa-bimobject'),
        array( 'id' => '112', 'name' => 'Binoculars', 'icon' => 'fas fa-binoculars'),
        array( 'id' => '113', 'name' => 'Biohazard', 'icon' => 'fas fa-biohazard'),
        array( 'id' => '114', 'name' => 'Birthday Cake', 'icon' => 'fas fa-birthday-cake'),
        array( 'id' => '115', 'name' => 'Bitbucket', 'icon' => 'fab fa-bitbucket'),
        array( 'id' => '116', 'name' => 'Bitcoin', 'icon' => 'fab fa-bitcoin'),
        array( 'id' => '117', 'name' => 'Bity', 'icon' => 'fab fa-bity'),
        array( 'id' => '118', 'name' => 'Font Awesome Black Tie', 'icon' => 'fab fa-black-tie'),
        array( 'id' => '119', 'name' => 'BlackBerry', 'icon' => 'fab fa-blackberry'),
        array( 'id' => '120', 'name' => 'Blender', 'icon' => 'fas fa-blender'),
        array( 'id' => '121', 'name' => 'Blender Phone', 'icon' => 'fas fa-blender-phone'),
        array( 'id' => '122', 'name' => 'Blind', 'icon' => 'fas fa-blind'),
        array( 'id' => '123', 'name' => 'Blog', 'icon' => 'fas fa-blog'),
        array( 'id' => '124', 'name' => 'Blogger', 'icon' => 'fab fa-blogger'),
        array( 'id' => '125', 'name' => 'Blogger B', 'icon' => 'fab fa-blogger-b'),
        array( 'id' => '126', 'name' => 'Bluetooth', 'icon' => 'fab fa-bluetooth'),
        array( 'id' => '127', 'name' => 'Bluetooth', 'icon' => 'fab fa-bluetooth-b'),
        array( 'id' => '128', 'name' => 'bold', 'icon' => 'fas fa-bold'),
        array( 'id' => '129', 'name' => 'Lightning Bolt', 'icon' => 'fas fa-bolt'),
        array( 'id' => '130', 'name' => 'Bomb', 'icon' => 'fas fa-bomb'),
        array( 'id' => '131', 'name' => 'Bone', 'icon' => 'fas fa-bone'),
        array( 'id' => '132', 'name' => 'Bong', 'icon' => 'fas fa-bong'),
        array( 'id' => '133', 'name' => 'book', 'icon' => 'fas fa-book'),
        array( 'id' => '134', 'name' => 'Book of the Dead', 'icon' => 'fas fa-book-dead'),
        array( 'id' => '135', 'name' => 'Medical Book', 'icon' => 'fas fa-book-medical'),
        array( 'id' => '136', 'name' => 'Book Open', 'icon' => 'fas fa-book-open'),
        array( 'id' => '137', 'name' => 'Book Reader', 'icon' => 'fas fa-book-reader'),
        array( 'id' => '138', 'name' => 'bookmark', 'icon' => 'fas fa-bookmark'),
        array( 'id' => '139', 'name' => 'Bootstrap', 'icon' => 'fab fa-bootstrap'),
        array( 'id' => '140', 'name' => 'Border All', 'icon' => 'fas fa-border-all'),
        array( 'id' => '141', 'name' => 'Border None', 'icon' => 'fas fa-border-none'),
        array( 'id' => '142', 'name' => 'Border Style', 'icon' => 'fas fa-border-style'),
        array( 'id' => '143', 'name' => 'Bowling Ball', 'icon' => 'fas fa-bowling-ball'),
        array( 'id' => '144', 'name' => 'Box', 'icon' => 'fas fa-box'),
        array( 'id' => '145', 'name' => 'Box Open', 'icon' => 'fas fa-box-open'),
        array( 'id' => '146', 'name' => 'Boxes', 'icon' => 'fas fa-boxes'),
        array( 'id' => '147', 'name' => 'Braille', 'icon' => 'fas fa-braille'),
        array( 'id' => '148', 'name' => 'Brain', 'icon' => 'fas fa-brain'),
        array( 'id' => '149', 'name' => 'Bread Slice', 'icon' => 'fas fa-bread-slice'),
        array( 'id' => '150', 'name' => 'Briefcase', 'icon' => 'fas fa-briefcase'),
        array( 'id' => '151', 'name' => 'Medical Briefcase', 'icon' => 'fas fa-briefcase-medical'),
        array( 'id' => '152', 'name' => 'Broadcast Tower', 'icon' => 'fas fa-broadcast-tower'),
        array( 'id' => '153', 'name' => 'Broom', 'icon' => 'fas fa-broom'),
        array( 'id' => '154', 'name' => 'Brush', 'icon' => 'fas fa-brush'),
        array( 'id' => '155', 'name' => 'BTC', 'icon' => 'fab fa-btc'),
        array( 'id' => '156', 'name' => 'Buffer', 'icon' => 'fab fa-buffer'),
        array( 'id' => '157', 'name' => 'Bug', 'icon' => 'fas fa-bug'),
        array( 'id' => '158', 'name' => 'Building', 'icon' => 'fas fa-building'),
        array( 'id' => '159', 'name' => 'bullhorn', 'icon' => 'fas fa-bullhorn'),
        array( 'id' => '160', 'name' => 'Bullseye', 'icon' => 'fas fa-bullseye'),
        array( 'id' => '161', 'name' => 'Burn', 'icon' => 'fas fa-burn'),
        array( 'id' => '162', 'name' => 'Büromöbel-Experte GmbH & Co. KG.', 'icon' => 'fab fa-buromobelexperte'),
        array( 'id' => '163', 'name' => 'Bus', 'icon' => 'fas fa-bus'),
        array( 'id' => '164', 'name' => 'Bus Alt', 'icon' => 'fas fa-bus-alt'),
        array( 'id' => '165', 'name' => 'Business Time', 'icon' => 'fas fa-business-time'),
        array( 'id' => '166', 'name' => 'BuySellAds', 'icon' => 'fab fa-buysellads'),
        array( 'id' => '167', 'name' => 'Calculator', 'icon' => 'fas fa-calculator'),
        array( 'id' => '168', 'name' => 'Calendar', 'icon' => 'fas fa-calendar'),
        array( 'id' => '169', 'name' => 'Alternate Calendar', 'icon' => 'fas fa-calendar-alt'),
        array( 'id' => '170', 'name' => 'Calendar Check', 'icon' => 'fas fa-calendar-check'),
        array( 'id' => '171', 'name' => 'Calendar with Day Focus', 'icon' => 'fas fa-calendar-day'),
        array( 'id' => '172', 'name' => 'Calendar Minus', 'icon' => 'fas fa-calendar-minus'),
        array( 'id' => '173', 'name' => 'Calendar Plus', 'icon' => 'fas fa-calendar-plus'),
        array( 'id' => '174', 'name' => 'Calendar Times', 'icon' => 'fas fa-calendar-times'),
        array( 'id' => '175', 'name' => 'Calendar with Week Focus', 'icon' => 'fas fa-calendar-week'),
        array( 'id' => '176', 'name' => 'camera', 'icon' => 'fas fa-camera'),
        array( 'id' => '177', 'name' => 'Retro Camera', 'icon' => 'fas fa-camera-retro'),
        array( 'id' => '178', 'name' => 'Campground', 'icon' => 'fas fa-campground'),
        array( 'id' => '179', 'name' => 'Canadian Maple Leaf', 'icon' => 'fab fa-canadian-maple-leaf'),
        array( 'id' => '180', 'name' => 'Candy Cane', 'icon' => 'fas fa-candy-cane'),
        array( 'id' => '181', 'name' => 'Cannabis', 'icon' => 'fas fa-cannabis'),
        array( 'id' => '182', 'name' => 'Capsules', 'icon' => 'fas fa-capsules'),
        array( 'id' => '183', 'name' => 'Car', 'icon' => 'fas fa-car'),
        array( 'id' => '184', 'name' => 'Alternate Car', 'icon' => 'fas fa-car-alt'),
        array( 'id' => '185', 'name' => 'Car Battery', 'icon' => 'fas fa-car-battery'),
        array( 'id' => '186', 'name' => 'Car Crash', 'icon' => 'fas fa-car-crash'),
        array( 'id' => '187', 'name' => 'Car Side', 'icon' => 'fas fa-car-side'),
        array( 'id' => '188', 'name' => 'Caret Down', 'icon' => 'fas fa-caret-down'),
        array( 'id' => '189', 'name' => 'Caret Left', 'icon' => 'fas fa-caret-left'),
        array( 'id' => '190', 'name' => 'Caret Right', 'icon' => 'fas fa-caret-right'),
        array( 'id' => '191', 'name' => 'Caret Square Down', 'icon' => 'fas fa-caret-square-down'),
        array( 'id' => '192', 'name' => 'Caret Square Left', 'icon' => 'fas fa-caret-square-left'),
        array( 'id' => '193', 'name' => 'Caret Square Right', 'icon' => 'fas fa-caret-square-right'),
        array( 'id' => '194', 'name' => 'Caret Square Up', 'icon' => 'fas fa-caret-square-up'),
        array( 'id' => '195', 'name' => 'Caret Up', 'icon' => 'fas fa-caret-up'),
        array( 'id' => '196', 'name' => 'Carrot', 'icon' => 'fas fa-carrot'),
        array( 'id' => '197', 'name' => 'Shopping Cart Arrow Down', 'icon' => 'fas fa-cart-arrow-down'),
        array( 'id' => '198', 'name' => 'Add to Shopping Cart', 'icon' => 'fas fa-cart-plus'),
        array( 'id' => '199', 'name' => 'Cash Register', 'icon' => 'fas fa-cash-register'),
        array( 'id' => '200', 'name' => 'Cat', 'icon' => 'fas fa-cat'),
        array( 'id' => '201', 'name' => 'Amazon Pay Credit Card', 'icon' => 'fab fa-cc-amazon-pay'),
        array( 'id' => '202', 'name' => 'American Express Credit Card', 'icon' => 'fab fa-cc-amex'),
        array( 'id' => '203', 'name' => 'Apple Pay Credit Card', 'icon' => 'fab fa-cc-apple-pay'),
        array( 'id' => '204', 'name' => 'Diners Club Credit Card', 'icon' => 'fab fa-cc-diners-club'),
        array( 'id' => '205', 'name' => 'Discover Credit Card', 'icon' => 'fab fa-cc-discover'),
        array( 'id' => '206', 'name' => 'JCB Credit Card', 'icon' => 'fab fa-cc-jcb'),
        array( 'id' => '207', 'name' => 'MasterCard Credit Card', 'icon' => 'fab fa-cc-mastercard'),
        array( 'id' => '208', 'name' => 'Paypal Credit Card', 'icon' => 'fab fa-cc-paypal'),
        array( 'id' => '209', 'name' => 'Stripe Credit Card', 'icon' => 'fab fa-cc-stripe'),
        array( 'id' => '210', 'name' => 'Visa Credit Card', 'icon' => 'fab fa-cc-visa'),
        array( 'id' => '211', 'name' => 'Centercode', 'icon' => 'fab fa-centercode'),
        array( 'id' => '212', 'name' => 'Centos', 'icon' => 'fab fa-centos'),
        array( 'id' => '213', 'name' => 'certificate', 'icon' => 'fas fa-certificate'),
        array( 'id' => '214', 'name' => 'Chair', 'icon' => 'fas fa-chair'),
        array( 'id' => '215', 'name' => 'Chalkboard', 'icon' => 'fas fa-chalkboard'),
        array( 'id' => '216', 'name' => 'Chalkboard Teacher', 'icon' => 'fas fa-chalkboard-teacher'),
        array( 'id' => '217', 'name' => 'Charging Station', 'icon' => 'fas fa-charging-station'),
        array( 'id' => '218', 'name' => 'Area Chart', 'icon' => 'fas fa-chart-area'),
        array( 'id' => '219', 'name' => 'Bar Chart', 'icon' => 'fas fa-chart-bar'),
        array( 'id' => '220', 'name' => 'Line Chart', 'icon' => 'fas fa-chart-line'),
        array( 'id' => '221', 'name' => 'Pie Chart', 'icon' => 'fas fa-chart-pie'),
        array( 'id' => '222', 'name' => 'Check', 'icon' => 'fas fa-check'),
        array( 'id' => '223', 'name' => 'Check Circle', 'icon' => 'fas fa-check-circle'),
        array( 'id' => '224', 'name' => 'Double Check', 'icon' => 'fas fa-check-double'),
        array( 'id' => '225', 'name' => 'Check Square', 'icon' => 'fas fa-check-square'),
        array( 'id' => '226', 'name' => 'Cheese', 'icon' => 'fas fa-cheese'),
        array( 'id' => '227', 'name' => 'Chess', 'icon' => 'fas fa-chess'),
        array( 'id' => '228', 'name' => 'Chess Bishop', 'icon' => 'fas fa-chess-bishop'),
        array( 'id' => '229', 'name' => 'Chess Board', 'icon' => 'fas fa-chess-board'),
        array( 'id' => '230', 'name' => 'Chess King', 'icon' => 'fas fa-chess-king'),
        array( 'id' => '231', 'name' => 'Chess Knight', 'icon' => 'fas fa-chess-knight'),
        array( 'id' => '232', 'name' => 'Chess Pawn', 'icon' => 'fas fa-chess-pawn'),
        array( 'id' => '233', 'name' => 'Chess Queen', 'icon' => 'fas fa-chess-queen'),
        array( 'id' => '234', 'name' => 'Chess Rook', 'icon' => 'fas fa-chess-rook'),
        array( 'id' => '235', 'name' => 'Chevron Circle Down', 'icon' => 'fas fa-chevron-circle-down'),
        array( 'id' => '236', 'name' => 'Chevron Circle Left', 'icon' => 'fas fa-chevron-circle-left'),
        array( 'id' => '237', 'name' => 'Chevron Circle Right', 'icon' => 'fas fa-chevron-circle-right'),
        array( 'id' => '238', 'name' => 'Chevron Circle Up', 'icon' => 'fas fa-chevron-circle-up'),
        array( 'id' => '239', 'name' => 'chevron-down', 'icon' => 'fas fa-chevron-down'),
        array( 'id' => '240', 'name' => 'chevron-left', 'icon' => 'fas fa-chevron-left'),
        array( 'id' => '241', 'name' => 'chevron-right', 'icon' => 'fas fa-chevron-right'),
        array( 'id' => '242', 'name' => 'chevron-up', 'icon' => 'fas fa-chevron-up'),
        array( 'id' => '243', 'name' => 'Child', 'icon' => 'fas fa-child'),
        array( 'id' => '244', 'name' => 'Chrome', 'icon' => 'fab fa-chrome'),
        array( 'id' => '245', 'name' => 'Chromecast', 'icon' => 'fab fa-chromecast'),
        array( 'id' => '246', 'name' => 'Church', 'icon' => 'fas fa-church'),
        array( 'id' => '247', 'name' => 'Circle', 'icon' => 'fas fa-circle'),
        array( 'id' => '248', 'name' => 'Circle Notched', 'icon' => 'fas fa-circle-notch'),
        array( 'id' => '249', 'name' => 'City', 'icon' => 'fas fa-city'),
        array( 'id' => '250', 'name' => 'Medical Clinic', 'icon' => 'fas fa-clinic-medical'),
        array( 'id' => '251', 'name' => 'Clipboard', 'icon' => 'fas fa-clipboard'),
        array( 'id' => '252', 'name' => 'Clipboard with Check', 'icon' => 'fas fa-clipboard-check'),
        array( 'id' => '253', 'name' => 'Clipboard List', 'icon' => 'fas fa-clipboard-list'),
        array( 'id' => '254', 'name' => 'Clock', 'icon' => 'fas fa-clock'),
        array( 'id' => '255', 'name' => 'Clone', 'icon' => 'fas fa-clone'),
        array( 'id' => '256', 'name' => 'Closed Captioning', 'icon' => 'fas fa-closed-captioning'),
        array( 'id' => '257', 'name' => 'Cloud', 'icon' => 'fas fa-cloud'),
        array( 'id' => '258', 'name' => 'Alternate Cloud Download', 'icon' => 'fas fa-cloud-download-alt'),
        array( 'id' => '259', 'name' => 'Cloud with (a chance of) Meatball', 'icon' => 'fas fa-cloud-meatball'),
        array( 'id' => '260', 'name' => 'Cloud with Moon', 'icon' => 'fas fa-cloud-moon'),
        array( 'id' => '261', 'name' => 'Cloud with Moon and Rain', 'icon' => 'fas fa-cloud-moon-rain'),
        array( 'id' => '262', 'name' => 'Cloud with Rain', 'icon' => 'fas fa-cloud-rain'),
        array( 'id' => '263', 'name' => 'Cloud with Heavy Showers', 'icon' => 'fas fa-cloud-showers-heavy'),
        array( 'id' => '264', 'name' => 'Cloud with Sun', 'icon' => 'fas fa-cloud-sun'),
        array( 'id' => '265', 'name' => 'Cloud with Sun and Rain', 'icon' => 'fas fa-cloud-sun-rain'),
        array( 'id' => '266', 'name' => 'Alternate Cloud Upload', 'icon' => 'fas fa-cloud-upload-alt'),
        array( 'id' => '267', 'name' => 'cloudscale.ch', 'icon' => 'fab fa-cloudscale'),
        array( 'id' => '268', 'name' => 'Cloudsmith', 'icon' => 'fab fa-cloudsmith'),
        array( 'id' => '269', 'name' => 'cloudversify', 'icon' => 'fab fa-cloudversify'),
        array( 'id' => '270', 'name' => 'Cocktail', 'icon' => 'fas fa-cocktail'),
        array( 'id' => '271', 'name' => 'Code', 'icon' => 'fas fa-code'),
        array( 'id' => '272', 'name' => 'Code Branch', 'icon' => 'fas fa-code-branch'),
        array( 'id' => '273', 'name' => 'Codepen', 'icon' => 'fab fa-codepen'),
        array( 'id' => '274', 'name' => 'Codie Pie', 'icon' => 'fab fa-codiepie'),
        array( 'id' => '275', 'name' => 'Coffee', 'icon' => 'fas fa-coffee'),
        array( 'id' => '276', 'name' => 'cog', 'icon' => 'fas fa-cog'),
        array( 'id' => '277', 'name' => 'cogs', 'icon' => 'fas fa-cogs'),
        array( 'id' => '278', 'name' => 'Coins', 'icon' => 'fas fa-coins'),
        array( 'id' => '279', 'name' => 'Columns', 'icon' => 'fas fa-columns'),
        array( 'id' => '280', 'name' => 'comment', 'icon' => 'fas fa-comment'),
        array( 'id' => '281', 'name' => 'Alternate Comment', 'icon' => 'fas fa-comment-alt'),
        array( 'id' => '282', 'name' => 'Comment Dollar', 'icon' => 'fas fa-comment-dollar'),
        array( 'id' => '283', 'name' => 'Comment Dots', 'icon' => 'fas fa-comment-dots'),
        array( 'id' => '284', 'name' => 'Alternate Medical Chat', 'icon' => 'fas fa-comment-medical'),
        array( 'id' => '285', 'name' => 'Comment Slash', 'icon' => 'fas fa-comment-slash'),
        array( 'id' => '286', 'name' => 'comments', 'icon' => 'fas fa-comments'),
        array( 'id' => '287', 'name' => 'Comments Dollar', 'icon' => 'fas fa-comments-dollar'),
        array( 'id' => '288', 'name' => 'Compact Disc', 'icon' => 'fas fa-compact-disc'),
        array( 'id' => '289', 'name' => 'Compass', 'icon' => 'fas fa-compass'),
        array( 'id' => '290', 'name' => 'Compress', 'icon' => 'fas fa-compress'),
        array( 'id' => '291', 'name' => 'Alternate Compress Arrows', 'icon' => 'fas fa-compress-arrows-alt'),
        array( 'id' => '292', 'name' => 'Concierge Bell', 'icon' => 'fas fa-concierge-bell'),
        array( 'id' => '293', 'name' => 'Confluence', 'icon' => 'fab fa-confluence'),
        array( 'id' => '294', 'name' => 'Connect Develop', 'icon' => 'fab fa-connectdevelop'),
        array( 'id' => '295', 'name' => 'Contao', 'icon' => 'fab fa-contao'),
        array( 'id' => '296', 'name' => 'Cookie', 'icon' => 'fas fa-cookie'),
        array( 'id' => '297', 'name' => 'Cookie Bite', 'icon' => 'fas fa-cookie-bite'),
        array( 'id' => '298', 'name' => 'Copy', 'icon' => 'fas fa-copy'),
        array( 'id' => '299', 'name' => 'Copyright', 'icon' => 'fas fa-copyright'),
        array( 'id' => '300', 'name' => 'Cotton Bureau', 'icon' => 'fab fa-cotton-bureau'),
        array( 'id' => '301', 'name' => 'Couch', 'icon' => 'fas fa-couch'),
        array( 'id' => '302', 'name' => 'cPanel', 'icon' => 'fab fa-cpanel'),
        array( 'id' => '303', 'name' => 'Creative Commons', 'icon' => 'fab fa-creative-commons'),
        array( 'id' => '304', 'name' => 'Creative Commons Attribution', 'icon' => 'fab fa-creative-commons-by'),
        array( 'id' => '305', 'name' => 'Creative Commons Noncommercial', 'icon' => 'fab fa-creative-commons-nc'),
        array( 'id' => '306', 'name' => 'Creative Commons Noncommercial (Euro Sign)', 'icon' => 'fab fa-creative-commons-nc-eu'),
        array( 'id' => '307', 'name' => 'Creative Commons Noncommercial (Yen Sign)', 'icon' => 'fab fa-creative-commons-nc-jp'),
        array( 'id' => '308', 'name' => 'Creative Commons No Derivative Works', 'icon' => 'fab fa-creative-commons-nd'),
        array( 'id' => '309', 'name' => 'Creative Commons Public Domain', 'icon' => 'fab fa-creative-commons-pd'),
        array( 'id' => '310', 'name' => 'Alternate Creative Commons Public Domain', 'icon' => 'fab fa-creative-commons-pd-alt'),
        array( 'id' => '311', 'name' => 'Creative Commons Remix', 'icon' => 'fab fa-creative-commons-remix'),
        array( 'id' => '312', 'name' => 'Creative Commons Share Alike', 'icon' => 'fab fa-creative-commons-sa'),
        array( 'id' => '313', 'name' => 'Creative Commons Sampling', 'icon' => 'fab fa-creative-commons-sampling'),
        array( 'id' => '314', 'name' => 'Creative Commons Sampling +', 'icon' => 'fab fa-creative-commons-sampling-plus'),
        array( 'id' => '315', 'name' => 'Creative Commons Share', 'icon' => 'fab fa-creative-commons-share'),
        array( 'id' => '316', 'name' => 'Creative Commons CC0', 'icon' => 'fab fa-creative-commons-zero'),
        array( 'id' => '317', 'name' => 'Credit Card', 'icon' => 'fas fa-credit-card'),
        array( 'id' => '318', 'name' => 'Critical Role', 'icon' => 'fab fa-critical-role'),
        array( 'id' => '319', 'name' => 'crop', 'icon' => 'fas fa-crop'),
        array( 'id' => '320', 'name' => 'Alternate Crop', 'icon' => 'fas fa-crop-alt'),
        array( 'id' => '321', 'name' => 'Cross', 'icon' => 'fas fa-cross'),
        array( 'id' => '322', 'name' => 'Crosshairs', 'icon' => 'fas fa-crosshairs'),
        array( 'id' => '323', 'name' => 'Crow', 'icon' => 'fas fa-crow'),
        array( 'id' => '324', 'name' => 'Crown', 'icon' => 'fas fa-crown'),
        array( 'id' => '325', 'name' => 'Crutch', 'icon' => 'fas fa-crutch'),
        array( 'id' => '326', 'name' => 'CSS 3 Logo', 'icon' => 'fab fa-css3'),
        array( 'id' => '327', 'name' => 'Alternate CSS3 Logo', 'icon' => 'fab fa-css3-alt'),
        array( 'id' => '328', 'name' => 'Cube', 'icon' => 'fas fa-cube'),
        array( 'id' => '329', 'name' => 'Cubes', 'icon' => 'fas fa-cubes'),
        array( 'id' => '330', 'name' => 'Cut', 'icon' => 'fas fa-cut'),
        array( 'id' => '331', 'name' => 'Cuttlefish', 'icon' => 'fab fa-cuttlefish'),
        array( 'id' => '332', 'name' => 'Dungeons & Dragons', 'icon' => 'fab fa-d-and-d'),
        array( 'id' => '333', 'name' => 'D&D Beyond', 'icon' => 'fab fa-d-and-d-beyond'),
        array( 'id' => '334', 'name' => 'DashCube', 'icon' => 'fab fa-dashcube'),
        array( 'id' => '335', 'name' => 'Database', 'icon' => 'fas fa-database'),
        array( 'id' => '336', 'name' => 'Deaf', 'icon' => 'fas fa-deaf'),
        array( 'id' => '337', 'name' => 'Delicious', 'icon' => 'fab fa-delicious'),
        array( 'id' => '338', 'name' => 'Democrat', 'icon' => 'fas fa-democrat'),
        array( 'id' => '339', 'name' => 'deploy.dog', 'icon' => 'fab fa-deploydog'),
        array( 'id' => '340', 'name' => 'Deskpro', 'icon' => 'fab fa-deskpro'),
        array( 'id' => '341', 'name' => 'Desktop', 'icon' => 'fas fa-desktop'),
        array( 'id' => '342', 'name' => 'DEV', 'icon' => 'fab fa-dev'),
        array( 'id' => '343', 'name' => 'deviantART', 'icon' => 'fab fa-deviantart'),
        array( 'id' => '344', 'name' => 'Dharmachakra', 'icon' => 'fas fa-dharmachakra'),
        array( 'id' => '345', 'name' => 'DHL', 'icon' => 'fab fa-dhl'),
        array( 'id' => '346', 'name' => 'Diagnoses', 'icon' => 'fas fa-diagnoses'),
        array( 'id' => '347', 'name' => 'Diaspora', 'icon' => 'fab fa-diaspora'),
        array( 'id' => '348', 'name' => 'Dice', 'icon' => 'fas fa-dice'),
        array( 'id' => '349', 'name' => 'Dice D20', 'icon' => 'fas fa-dice-d20'),
        array( 'id' => '350', 'name' => 'Dice D6', 'icon' => 'fas fa-dice-d6'),
        array( 'id' => '351', 'name' => 'Dice Five', 'icon' => 'fas fa-dice-five'),
        array( 'id' => '352', 'name' => 'Dice Four', 'icon' => 'fas fa-dice-four'),
        array( 'id' => '353', 'name' => 'Dice One', 'icon' => 'fas fa-dice-one'),
        array( 'id' => '354', 'name' => 'Dice Six', 'icon' => 'fas fa-dice-six'),
        array( 'id' => '355', 'name' => 'Dice Three', 'icon' => 'fas fa-dice-three'),
        array( 'id' => '356', 'name' => 'Dice Two', 'icon' => 'fas fa-dice-two'),
        array( 'id' => '357', 'name' => 'Digg Logo', 'icon' => 'fab fa-digg'),
        array( 'id' => '358', 'name' => 'Digital Ocean', 'icon' => 'fab fa-digital-ocean'),
        array( 'id' => '359', 'name' => 'Digital Tachograph', 'icon' => 'fas fa-digital-tachograph'),
        array( 'id' => '360', 'name' => 'Directions', 'icon' => 'fas fa-directions'),
        array( 'id' => '361', 'name' => 'Discord', 'icon' => 'fab fa-discord'),
        array( 'id' => '362', 'name' => 'Discourse', 'icon' => 'fab fa-discourse'),
        array( 'id' => '363', 'name' => 'Divide', 'icon' => 'fas fa-divide'),
        array( 'id' => '364', 'name' => 'Dizzy Face', 'icon' => 'fas fa-dizzy'),
        array( 'id' => '365', 'name' => 'DNA', 'icon' => 'fas fa-dna'),
        array( 'id' => '366', 'name' => 'DocHub', 'icon' => 'fab fa-dochub'),
        array( 'id' => '367', 'name' => 'Docker', 'icon' => 'fab fa-docker'),
        array( 'id' => '368', 'name' => 'Dog', 'icon' => 'fas fa-dog'),
        array( 'id' => '369', 'name' => 'Dollar Sign', 'icon' => 'fas fa-dollar-sign'),
        array( 'id' => '370', 'name' => 'Dolly', 'icon' => 'fas fa-dolly'),
        array( 'id' => '371', 'name' => 'Dolly Flatbed', 'icon' => 'fas fa-dolly-flatbed'),
        array( 'id' => '372', 'name' => 'Donate', 'icon' => 'fas fa-donate'),
        array( 'id' => '373', 'name' => 'Door Closed', 'icon' => 'fas fa-door-closed'),
        array( 'id' => '374', 'name' => 'Door Open', 'icon' => 'fas fa-door-open'),
        array( 'id' => '375', 'name' => 'Dot Circle', 'icon' => 'fas fa-dot-circle'),
        array( 'id' => '376', 'name' => 'Dove', 'icon' => 'fas fa-dove'),
        array( 'id' => '377', 'name' => 'Download', 'icon' => 'fas fa-download'),
        array( 'id' => '378', 'name' => 'Draft2digital', 'icon' => 'fab fa-draft2digital'),
        array( 'id' => '379', 'name' => 'Drafting Compass', 'icon' => 'fas fa-drafting-compass'),
        array( 'id' => '380', 'name' => 'Dragon', 'icon' => 'fas fa-dragon'),
        array( 'id' => '381', 'name' => 'Draw Polygon', 'icon' => 'fas fa-draw-polygon'),
        array( 'id' => '382', 'name' => 'Dribbble', 'icon' => 'fab fa-dribbble'),
        array( 'id' => '383', 'name' => 'Dribbble Square', 'icon' => 'fab fa-dribbble-square'),
        array( 'id' => '384', 'name' => 'Dropbox', 'icon' => 'fab fa-dropbox'),
        array( 'id' => '385', 'name' => 'Drum', 'icon' => 'fas fa-drum'),
        array( 'id' => '386', 'name' => 'Drum Steelpan', 'icon' => 'fas fa-drum-steelpan'),
        array( 'id' => '387', 'name' => 'Drumstick with Bite Taken Out', 'icon' => 'fas fa-drumstick-bite'),
        array( 'id' => '388', 'name' => 'Drupal Logo', 'icon' => 'fab fa-drupal'),
        array( 'id' => '389', 'name' => 'Dumbbell', 'icon' => 'fas fa-dumbbell'),
        array( 'id' => '390', 'name' => 'Dumpster', 'icon' => 'fas fa-dumpster'),
        array( 'id' => '391', 'name' => 'Dumpster Fire', 'icon' => 'fas fa-dumpster-fire'),
        array( 'id' => '392', 'name' => 'Dungeon', 'icon' => 'fas fa-dungeon'),
        array( 'id' => '393', 'name' => 'Dyalog', 'icon' => 'fab fa-dyalog'),
        array( 'id' => '394', 'name' => 'Earlybirds', 'icon' => 'fab fa-earlybirds'),
        array( 'id' => '395', 'name' => 'eBay', 'icon' => 'fab fa-ebay'),
        array( 'id' => '396', 'name' => 'Edge Browser', 'icon' => 'fab fa-edge'),
        array( 'id' => '397', 'name' => 'Edit', 'icon' => 'fas fa-edit'),
        array( 'id' => '398', 'name' => 'Egg', 'icon' => 'fas fa-egg'),
        array( 'id' => '399', 'name' => 'eject', 'icon' => 'fas fa-eject'),
        array( 'id' => '400', 'name' => 'Elementor', 'icon' => 'fab fa-elementor'),
        array( 'id' => '401', 'name' => 'Horizontal Ellipsis', 'icon' => 'fas fa-ellipsis-h'),
        array( 'id' => '402', 'name' => 'Vertical Ellipsis', 'icon' => 'fas fa-ellipsis-v'),
        array( 'id' => '403', 'name' => 'Ello', 'icon' => 'fab fa-ello'),
        array( 'id' => '404', 'name' => 'Ember', 'icon' => 'fab fa-ember'),
        array( 'id' => '405', 'name' => 'Galactic Empire', 'icon' => 'fab fa-empire'),
        array( 'id' => '406', 'name' => 'Envelope', 'icon' => 'fas fa-envelope'),
        array( 'id' => '407', 'name' => 'Envelope Open', 'icon' => 'fas fa-envelope-open'),
        array( 'id' => '408', 'name' => 'Envelope Open-text', 'icon' => 'fas fa-envelope-open-text'),
        array( 'id' => '409', 'name' => 'Envelope Square', 'icon' => 'fas fa-envelope-square'),
        array( 'id' => '410', 'name' => 'Envira Gallery', 'icon' => 'fab fa-envira'),
        array( 'id' => '411', 'name' => 'Equals', 'icon' => 'fas fa-equals'),
        array( 'id' => '412', 'name' => 'eraser', 'icon' => 'fas fa-eraser'),
        array( 'id' => '413', 'name' => 'Erlang', 'icon' => 'fab fa-erlang'),
        array( 'id' => '414', 'name' => 'Ethereum', 'icon' => 'fab fa-ethereum'),
        array( 'id' => '415', 'name' => 'Ethernet', 'icon' => 'fas fa-ethernet'),
        array( 'id' => '416', 'name' => 'Etsy', 'icon' => 'fab fa-etsy'),
        array( 'id' => '417', 'name' => 'Euro Sign', 'icon' => 'fas fa-euro-sign'),
        array( 'id' => '418', 'name' => 'Evernote', 'icon' => 'fab fa-evernote'),
        array( 'id' => '419', 'name' => 'Alternate Exchange', 'icon' => 'fas fa-exchange-alt'),
        array( 'id' => '420', 'name' => 'exclamation', 'icon' => 'fas fa-exclamation'),
        array( 'id' => '421', 'name' => 'Exclamation Circle', 'icon' => 'fas fa-exclamation-circle'),
        array( 'id' => '422', 'name' => 'Exclamation Triangle', 'icon' => 'fas fa-exclamation-triangle'),
        array( 'id' => '423', 'name' => 'Expand', 'icon' => 'fas fa-expand'),
        array( 'id' => '424', 'name' => 'Alternate Expand Arrows', 'icon' => 'fas fa-expand-arrows-alt'),
        array( 'id' => '425', 'name' => 'ExpeditedSSL', 'icon' => 'fab fa-expeditedssl'),
        array( 'id' => '426', 'name' => 'Alternate External Link', 'icon' => 'fas fa-external-link-alt'),
        array( 'id' => '427', 'name' => 'Alternate External Link Square', 'icon' => 'fas fa-external-link-square-alt'),
        array( 'id' => '428', 'name' => 'Eye', 'icon' => 'fas fa-eye'),
        array( 'id' => '429', 'name' => 'Eye Dropper', 'icon' => 'fas fa-eye-dropper'),
        array( 'id' => '430', 'name' => 'Eye Slash', 'icon' => 'fas fa-eye-slash'),
        array( 'id' => '431', 'name' => 'Facebook', 'icon' => 'fab fa-facebook'),
        array( 'id' => '432', 'name' => 'Facebook F', 'icon' => 'fab fa-facebook-f'),
        array( 'id' => '433', 'name' => 'Facebook Messenger', 'icon' => 'fab fa-facebook-messenger'),
        array( 'id' => '434', 'name' => 'Facebook Square', 'icon' => 'fab fa-facebook-square'),
        array( 'id' => '435', 'name' => 'Fan', 'icon' => 'fas fa-fan'),
        array( 'id' => '436', 'name' => 'Fantasy Flight-games', 'icon' => 'fab fa-fantasy-flight-games'),
        array( 'id' => '437', 'name' => 'fast-backward', 'icon' => 'fas fa-fast-backward'),
        array( 'id' => '438', 'name' => 'fast-forward', 'icon' => 'fas fa-fast-forward'),
        array( 'id' => '439', 'name' => 'Fax', 'icon' => 'fas fa-fax'),
        array( 'id' => '440', 'name' => 'Feather', 'icon' => 'fas fa-feather'),
        array( 'id' => '441', 'name' => 'Alternate Feather', 'icon' => 'fas fa-feather-alt'),
        array( 'id' => '442', 'name' => 'FedEx', 'icon' => 'fab fa-fedex'),
        array( 'id' => '443', 'name' => 'Fedora', 'icon' => 'fab fa-fedora'),
        array( 'id' => '444', 'name' => 'Female', 'icon' => 'fas fa-female'),
        array( 'id' => '445', 'name' => 'fighter-jet', 'icon' => 'fas fa-fighter-jet'),
        array( 'id' => '446', 'name' => 'Figma', 'icon' => 'fab fa-figma'),
        array( 'id' => '447', 'name' => 'File', 'icon' => 'fas fa-file'),
        array( 'id' => '448', 'name' => 'Alternate File', 'icon' => 'fas fa-file-alt'),
        array( 'id' => '449', 'name' => 'Archive File', 'icon' => 'fas fa-file-archive'),
        array( 'id' => '450', 'name' => 'Audio File', 'icon' => 'fas fa-file-audio'),
        array( 'id' => '451', 'name' => 'Code File', 'icon' => 'fas fa-file-code'),
        array( 'id' => '452', 'name' => 'File Contract', 'icon' => 'fas fa-file-contract'),
        array( 'id' => '453', 'name' => 'File CSV', 'icon' => 'fas fa-file-csv'),
        array( 'id' => '454', 'name' => 'File Download', 'icon' => 'fas fa-file-download'),
        array( 'id' => '455', 'name' => 'Excel File', 'icon' => 'fas fa-file-excel'),
        array( 'id' => '456', 'name' => 'File Export', 'icon' => 'fas fa-file-export'),
        array( 'id' => '457', 'name' => 'Image File', 'icon' => 'fas fa-file-image'),
        array( 'id' => '458', 'name' => 'File Import', 'icon' => 'fas fa-file-import'),
        array( 'id' => '459', 'name' => 'File Invoice', 'icon' => 'fas fa-file-invoice'),
        array( 'id' => '460', 'name' => 'File Invoice with US Dollar', 'icon' => 'fas fa-file-invoice-dollar'),
        array( 'id' => '461', 'name' => 'Medical File', 'icon' => 'fas fa-file-medical'),
        array( 'id' => '462', 'name' => 'Alternate Medical File', 'icon' => 'fas fa-file-medical-alt'),
        array( 'id' => '463', 'name' => 'PDF File', 'icon' => 'fas fa-file-pdf'),
        array( 'id' => '464', 'name' => 'Powerpoint File', 'icon' => 'fas fa-file-powerpoint'),
        array( 'id' => '465', 'name' => 'File Prescription', 'icon' => 'fas fa-file-prescription'),
        array( 'id' => '466', 'name' => 'File Signature', 'icon' => 'fas fa-file-signature'),
        array( 'id' => '467', 'name' => 'File Upload', 'icon' => 'fas fa-file-upload'),
        array( 'id' => '468', 'name' => 'Video File', 'icon' => 'fas fa-file-video'),
        array( 'id' => '469', 'name' => 'Word File', 'icon' => 'fas fa-file-word'),
        array( 'id' => '470', 'name' => 'Fill', 'icon' => 'fas fa-fill'),
        array( 'id' => '471', 'name' => 'Fill Drip', 'icon' => 'fas fa-fill-drip'),
        array( 'id' => '472', 'name' => 'Film', 'icon' => 'fas fa-film'),
        array( 'id' => '473', 'name' => 'Filter', 'icon' => 'fas fa-filter'),
        array( 'id' => '474', 'name' => 'Fingerprint', 'icon' => 'fas fa-fingerprint'),
        array( 'id' => '475', 'name' => 'fire', 'icon' => 'fas fa-fire'),
        array( 'id' => '476', 'name' => 'Alternate Fire', 'icon' => 'fas fa-fire-alt'),
        array( 'id' => '477', 'name' => 'fire-extinguisher', 'icon' => 'fas fa-fire-extinguisher'),
        array( 'id' => '478', 'name' => 'Firefox', 'icon' => 'fab fa-firefox'),
        array( 'id' => '479', 'name' => 'First Aid', 'icon' => 'fas fa-first-aid'),
        array( 'id' => '480', 'name' => 'First Order', 'icon' => 'fab fa-first-order'),
        array( 'id' => '481', 'name' => 'Alternate First Order', 'icon' => 'fab fa-first-order-alt'),
        array( 'id' => '482', 'name' => 'firstdraft', 'icon' => 'fab fa-firstdraft'),
        array( 'id' => '483', 'name' => 'Fish', 'icon' => 'fas fa-fish'),
        array( 'id' => '484', 'name' => 'Raised Fist', 'icon' => 'fas fa-fist-raised'),
        array( 'id' => '485', 'name' => 'flag', 'icon' => 'fas fa-flag'),
        array( 'id' => '486', 'name' => 'flag-checkered', 'icon' => 'fas fa-flag-checkered'),
        array( 'id' => '487', 'name' => 'United States of America Flag', 'icon' => 'fas fa-flag-usa'),
        array( 'id' => '488', 'name' => 'Flask', 'icon' => 'fas fa-flask'),
        array( 'id' => '489', 'name' => 'Flickr', 'icon' => 'fab fa-flickr'),
        array( 'id' => '490', 'name' => 'Flipboard', 'icon' => 'fab fa-flipboard'),
        array( 'id' => '491', 'name' => 'Flushed Face', 'icon' => 'fas fa-flushed'),
        array( 'id' => '492', 'name' => 'Fly', 'icon' => 'fab fa-fly'),
        array( 'id' => '493', 'name' => 'Folder', 'icon' => 'fas fa-folder'),
        array( 'id' => '494', 'name' => 'Folder Minus', 'icon' => 'fas fa-folder-minus'),
        array( 'id' => '495', 'name' => 'Folder Open', 'icon' => 'fas fa-folder-open'),
        array( 'id' => '496', 'name' => 'Folder Plus', 'icon' => 'fas fa-folder-plus'),
        array( 'id' => '497', 'name' => 'font', 'icon' => 'fas fa-font'),
        array( 'id' => '498', 'name' => 'Font Awesome', 'icon' => 'fab fa-font-awesome'),
        array( 'id' => '499', 'name' => 'Alternate Font Awesome', 'icon' => 'fab fa-font-awesome-alt'),
        array( 'id' => '500', 'name' => 'Font Awesome Flag', 'icon' => 'fab fa-font-awesome-flag'),
        array( 'id' => '501', 'name' => 'Font Awesome Full Logo', 'icon' => 'far fa-font-awesome-logo-full'),
        array( 'id' => '502', 'name' => 'Fonticons', 'icon' => 'fab fa-fonticons'),
        array( 'id' => '503', 'name' => 'Fonticons Fi', 'icon' => 'fab fa-fonticons-fi'),
        array( 'id' => '504', 'name' => 'Football Ball', 'icon' => 'fas fa-football-ball'),
        array( 'id' => '505', 'name' => 'Fort Awesome', 'icon' => 'fab fa-fort-awesome'),
        array( 'id' => '506', 'name' => 'Alternate Fort Awesome', 'icon' => 'fab fa-fort-awesome-alt'),
        array( 'id' => '507', 'name' => 'Forumbee', 'icon' => 'fab fa-forumbee'),
        array( 'id' => '508', 'name' => 'forward', 'icon' => 'fas fa-forward'),
        array( 'id' => '509', 'name' => 'Foursquare', 'icon' => 'fab fa-foursquare'),
        array( 'id' => '510', 'name' => 'Free Code Camp', 'icon' => 'fab fa-free-code-camp'),
        array( 'id' => '511', 'name' => 'FreeBSD', 'icon' => 'fab fa-freebsd'),
        array( 'id' => '512', 'name' => 'Frog', 'icon' => 'fas fa-frog'),
        array( 'id' => '513', 'name' => 'Frowning Face', 'icon' => 'fas fa-frown'),
        array( 'id' => '514', 'name' => 'Frowning Face With Open Mouth', 'icon' => 'fas fa-frown-open'),
        array( 'id' => '515', 'name' => 'Fulcrum', 'icon' => 'fab fa-fulcrum'),
        array( 'id' => '516', 'name' => 'Funnel Dollar', 'icon' => 'fas fa-funnel-dollar'),
        array( 'id' => '517', 'name' => 'Futbol', 'icon' => 'fas fa-futbol'),
        array( 'id' => '518', 'name' => 'Galactic Republic', 'icon' => 'fab fa-galactic-republic'),
        array( 'id' => '519', 'name' => 'Galactic Senate', 'icon' => 'fab fa-galactic-senate'),
        array( 'id' => '520', 'name' => 'Gamepad', 'icon' => 'fas fa-gamepad'),
        array( 'id' => '521', 'name' => 'Gas Pump', 'icon' => 'fas fa-gas-pump'),
        array( 'id' => '522', 'name' => 'Gavel', 'icon' => 'fas fa-gavel'),
        array( 'id' => '523', 'name' => 'Gem', 'icon' => 'fas fa-gem'),
        array( 'id' => '524', 'name' => 'Genderless', 'icon' => 'fas fa-genderless'),
        array( 'id' => '525', 'name' => 'Get Pocket', 'icon' => 'fab fa-get-pocket'),
        array( 'id' => '526', 'name' => 'GG Currency', 'icon' => 'fab fa-gg'),
        array( 'id' => '527', 'name' => 'GG Currency Circle', 'icon' => 'fab fa-gg-circle'),
        array( 'id' => '528', 'name' => 'Ghost', 'icon' => 'fas fa-ghost'),
        array( 'id' => '529', 'name' => 'gift', 'icon' => 'fas fa-gift'),
        array( 'id' => '530', 'name' => 'Gifts', 'icon' => 'fas fa-gifts'),
        array( 'id' => '531', 'name' => 'Git', 'icon' => 'fab fa-git'),
        array( 'id' => '532', 'name' => 'Git Alt', 'icon' => 'fab fa-git-alt'),
        array( 'id' => '533', 'name' => 'Git Square', 'icon' => 'fab fa-git-square'),
        array( 'id' => '534', 'name' => 'GitHub', 'icon' => 'fab fa-github'),
        array( 'id' => '535', 'name' => 'Alternate GitHub', 'icon' => 'fab fa-github-alt'),
        array( 'id' => '536', 'name' => 'GitHub Square', 'icon' => 'fab fa-github-square'),
        array( 'id' => '537', 'name' => 'GitKraken', 'icon' => 'fab fa-gitkraken'),
        array( 'id' => '538', 'name' => 'GitLab', 'icon' => 'fab fa-gitlab'),
        array( 'id' => '539', 'name' => 'Gitter', 'icon' => 'fab fa-gitter'),
        array( 'id' => '540', 'name' => 'Glass Cheers', 'icon' => 'fas fa-glass-cheers'),
        array( 'id' => '541', 'name' => 'Martini Glass', 'icon' => 'fas fa-glass-martini'),
        array( 'id' => '542', 'name' => 'Alternate Glass Martini', 'icon' => 'fas fa-glass-martini-alt'),
        array( 'id' => '543', 'name' => 'Glass Whiskey', 'icon' => 'fas fa-glass-whiskey'),
        array( 'id' => '544', 'name' => 'Glasses', 'icon' => 'fas fa-glasses'),
        array( 'id' => '545', 'name' => 'Glide', 'icon' => 'fab fa-glide'),
        array( 'id' => '546', 'name' => 'Glide G', 'icon' => 'fab fa-glide-g'),
        array( 'id' => '547', 'name' => 'Globe', 'icon' => 'fas fa-globe'),
        array( 'id' => '548', 'name' => 'Globe with Africa shown', 'icon' => 'fas fa-globe-africa'),
        array( 'id' => '549', 'name' => 'Globe with Americas shown', 'icon' => 'fas fa-globe-americas'),
        array( 'id' => '550', 'name' => 'Globe with Asia shown', 'icon' => 'fas fa-globe-asia'),
        array( 'id' => '551', 'name' => 'Globe with Europe shown', 'icon' => 'fas fa-globe-europe'),
        array( 'id' => '552', 'name' => 'Gofore', 'icon' => 'fab fa-gofore'),
        array( 'id' => '553', 'name' => 'Golf Ball', 'icon' => 'fas fa-golf-ball'),
        array( 'id' => '554', 'name' => 'Goodreads', 'icon' => 'fab fa-goodreads'),
        array( 'id' => '555', 'name' => 'Goodreads G', 'icon' => 'fab fa-goodreads-g'),
        array( 'id' => '556', 'name' => 'Google Logo', 'icon' => 'fab fa-google'),
        array( 'id' => '557', 'name' => 'Google Drive', 'icon' => 'fab fa-google-drive'),
        array( 'id' => '558', 'name' => 'Google Play', 'icon' => 'fab fa-google-play'),
        array( 'id' => '559', 'name' => 'Google Plus', 'icon' => 'fab fa-google-plus'),
        array( 'id' => '560', 'name' => 'Google Plus G', 'icon' => 'fab fa-google-plus-g'),
        array( 'id' => '561', 'name' => 'Google Plus Square', 'icon' => 'fab fa-google-plus-square'),
        array( 'id' => '562', 'name' => 'Google Wallet', 'icon' => 'fab fa-google-wallet'),
        array( 'id' => '563', 'name' => 'Gopuram', 'icon' => 'fas fa-gopuram'),
        array( 'id' => '564', 'name' => 'Graduation Cap', 'icon' => 'fas fa-graduation-cap'),
        array( 'id' => '565', 'name' => 'Gratipay (Gittip)', 'icon' => 'fab fa-gratipay'),
        array( 'id' => '566', 'name' => 'Grav', 'icon' => 'fab fa-grav'),
        array( 'id' => '567', 'name' => 'Greater Than', 'icon' => 'fas fa-greater-than'),
        array( 'id' => '568', 'name' => 'Greater Than Equal To', 'icon' => 'fas fa-greater-than-equal'),
        array( 'id' => '569', 'name' => 'Grimacing Face', 'icon' => 'fas fa-grimace'),
        array( 'id' => '570', 'name' => 'Grinning Face', 'icon' => 'fas fa-grin'),
        array( 'id' => '571', 'name' => 'Alternate Grinning Face', 'icon' => 'fas fa-grin-alt'),
        array( 'id' => '572', 'name' => 'Grinning Face With Smiling Eyes', 'icon' => 'fas fa-grin-beam'),
        array( 'id' => '573', 'name' => 'Grinning Face With Sweat', 'icon' => 'fas fa-grin-beam-sweat'),
        array( 'id' => '574', 'name' => 'Smiling Face With Heart-Eyes', 'icon' => 'fas fa-grin-hearts'),
        array( 'id' => '575', 'name' => 'Grinning Squinting Face', 'icon' => 'fas fa-grin-squint'),
        array( 'id' => '576', 'name' => 'Rolling on the Floor Laughing', 'icon' => 'fas fa-grin-squint-tears'),
        array( 'id' => '577', 'name' => 'Star-Struck', 'icon' => 'fas fa-grin-stars'),
        array( 'id' => '578', 'name' => 'Face With Tears of Joy', 'icon' => 'fas fa-grin-tears'),
        array( 'id' => '579', 'name' => 'Face With Tongue', 'icon' => 'fas fa-grin-tongue'),
        array( 'id' => '580', 'name' => 'Squinting Face With Tongue', 'icon' => 'fas fa-grin-tongue-squint'),
        array( 'id' => '581', 'name' => 'Winking Face With Tongue', 'icon' => 'fas fa-grin-tongue-wink'),
        array( 'id' => '582', 'name' => 'Grinning Winking Face', 'icon' => 'fas fa-grin-wink'),
        array( 'id' => '583', 'name' => 'Grip Horizontal', 'icon' => 'fas fa-grip-horizontal'),
        array( 'id' => '584', 'name' => 'Grip Lines', 'icon' => 'fas fa-grip-lines'),
        array( 'id' => '585', 'name' => 'Grip Lines Vertical', 'icon' => 'fas fa-grip-lines-vertical'),
        array( 'id' => '586', 'name' => 'Grip Vertical', 'icon' => 'fas fa-grip-vertical'),
        array( 'id' => '587', 'name' => 'Gripfire, Inc.', 'icon' => 'fab fa-gripfire'),
        array( 'id' => '588', 'name' => 'Grunt', 'icon' => 'fab fa-grunt'),
        array( 'id' => '589', 'name' => 'Guitar', 'icon' => 'fas fa-guitar'),
        array( 'id' => '590', 'name' => 'Gulp', 'icon' => 'fab fa-gulp'),
        array( 'id' => '591', 'name' => 'H Square', 'icon' => 'fas fa-h-square'),
        array( 'id' => '592', 'name' => 'Hacker News', 'icon' => 'fab fa-hacker-news'),
        array( 'id' => '593', 'name' => 'Hacker News Square', 'icon' => 'fab fa-hacker-news-square'),
        array( 'id' => '594', 'name' => 'Hackerrank', 'icon' => 'fab fa-hackerrank'),
        array( 'id' => '595', 'name' => 'Hamburger', 'icon' => 'fas fa-hamburger'),
        array( 'id' => '596', 'name' => 'Hammer', 'icon' => 'fas fa-hammer'),
        array( 'id' => '597', 'name' => 'Hamsa', 'icon' => 'fas fa-hamsa'),
        array( 'id' => '598', 'name' => 'Hand Holding', 'icon' => 'fas fa-hand-holding'),
        array( 'id' => '599', 'name' => 'Hand Holding Heart', 'icon' => 'fas fa-hand-holding-heart'),
        array( 'id' => '600', 'name' => 'Hand Holding US Dollar', 'icon' => 'fas fa-hand-holding-usd'),
        array( 'id' => '601', 'name' => 'Lizard (Hand)', 'icon' => 'fas fa-hand-lizard'),
        array( 'id' => '602', 'name' => 'Hand with Middle Finger Raised', 'icon' => 'fas fa-hand-middle-finger'),
        array( 'id' => '603', 'name' => 'Paper (Hand)', 'icon' => 'fas fa-hand-paper'),
        array( 'id' => '604', 'name' => 'Peace (Hand)', 'icon' => 'fas fa-hand-peace'),
        array( 'id' => '605', 'name' => 'Hand Pointing Down', 'icon' => 'fas fa-hand-point-down'),
        array( 'id' => '606', 'name' => 'Hand Pointing Left', 'icon' => 'fas fa-hand-point-left'),
        array( 'id' => '607', 'name' => 'Hand Pointing Right', 'icon' => 'fas fa-hand-point-right'),
        array( 'id' => '608', 'name' => 'Hand Pointing Up', 'icon' => 'fas fa-hand-point-up'),
        array( 'id' => '609', 'name' => 'Pointer (Hand)', 'icon' => 'fas fa-hand-pointer'),
        array( 'id' => '610', 'name' => 'Rock (Hand)', 'icon' => 'fas fa-hand-rock'),
        array( 'id' => '611', 'name' => 'Scissors (Hand)', 'icon' => 'fas fa-hand-scissors'),
        array( 'id' => '612', 'name' => 'Spock (Hand)', 'icon' => 'fas fa-hand-spock'),
        array( 'id' => '613', 'name' => 'Hands', 'icon' => 'fas fa-hands'),
        array( 'id' => '614', 'name' => 'Helping Hands', 'icon' => 'fas fa-hands-helping'),
        array( 'id' => '615', 'name' => 'Handshake', 'icon' => 'fas fa-handshake'),
        array( 'id' => '616', 'name' => 'Hanukiah', 'icon' => 'fas fa-hanukiah'),
        array( 'id' => '617', 'name' => 'Hard Hat', 'icon' => 'fas fa-hard-hat'),
        array( 'id' => '618', 'name' => 'Hashtag', 'icon' => 'fas fa-hashtag'),
        array( 'id' => '619', 'name' => 'Wizards Hat', 'icon' => 'fas fa-hat-wizard'),
        array( 'id' => '620', 'name' => 'Haykal', 'icon' => 'fas fa-haykal'),
        array( 'id' => '621', 'name' => 'HDD', 'icon' => 'fas fa-hdd'),
        array( 'id' => '622', 'name' => 'heading', 'icon' => 'fas fa-heading'),
        array( 'id' => '623', 'name' => 'headphones', 'icon' => 'fas fa-headphones'),
        array( 'id' => '624', 'name' => 'Alternate Headphones', 'icon' => 'fas fa-headphones-alt'),
        array( 'id' => '625', 'name' => 'Headset', 'icon' => 'fas fa-headset'),
        array( 'id' => '626', 'name' => 'Heart', 'icon' => 'fas fa-heart'),
        array( 'id' => '627', 'name' => 'Heart Broken', 'icon' => 'fas fa-heart-broken'),
        array( 'id' => '628', 'name' => 'Heartbeat', 'icon' => 'fas fa-heartbeat'),
        array( 'id' => '629', 'name' => 'Helicopter', 'icon' => 'fas fa-helicopter'),
        array( 'id' => '630', 'name' => 'Highlighter', 'icon' => 'fas fa-highlighter'),
        array( 'id' => '631', 'name' => 'Hiking', 'icon' => 'fas fa-hiking'),
        array( 'id' => '632', 'name' => 'Hippo', 'icon' => 'fas fa-hippo'),
        array( 'id' => '633', 'name' => 'Hips', 'icon' => 'fab fa-hips'),
        array( 'id' => '634', 'name' => 'HireAHelper', 'icon' => 'fab fa-hire-a-helper'),
        array( 'id' => '635', 'name' => 'History', 'icon' => 'fas fa-history'),
        array( 'id' => '636', 'name' => 'Hockey Puck', 'icon' => 'fas fa-hockey-puck'),
        array( 'id' => '637', 'name' => 'Holly Berry', 'icon' => 'fas fa-holly-berry'),
        array( 'id' => '638', 'name' => 'home', 'icon' => 'fas fa-home'),
        array( 'id' => '639', 'name' => 'Hooli', 'icon' => 'fab fa-hooli'),
        array( 'id' => '640', 'name' => 'Hornbill', 'icon' => 'fab fa-hornbill'),
        array( 'id' => '641', 'name' => 'Horse', 'icon' => 'fas fa-horse'),
        array( 'id' => '642', 'name' => 'Horse Head', 'icon' => 'fas fa-horse-head'),
        array( 'id' => '643', 'name' => 'hospital', 'icon' => 'fas fa-hospital'),
        array( 'id' => '644', 'name' => 'Alternate Hospital', 'icon' => 'fas fa-hospital-alt'),
        array( 'id' => '645', 'name' => 'Hospital Symbol', 'icon' => 'fas fa-hospital-symbol'),
        array( 'id' => '646', 'name' => 'Hot Tub', 'icon' => 'fas fa-hot-tub'),
        array( 'id' => '647', 'name' => 'Hot Dog', 'icon' => 'fas fa-hotdog'),
        array( 'id' => '648', 'name' => 'Hotel', 'icon' => 'fas fa-hotel'),
        array( 'id' => '649', 'name' => 'Hotjar', 'icon' => 'fab fa-hotjar'),
        array( 'id' => '650', 'name' => 'Hourglass', 'icon' => 'fas fa-hourglass'),
        array( 'id' => '651', 'name' => 'Hourglass End', 'icon' => 'fas fa-hourglass-end'),
        array( 'id' => '652', 'name' => 'Hourglass Half', 'icon' => 'fas fa-hourglass-half'),
        array( 'id' => '653', 'name' => 'Hourglass Start', 'icon' => 'fas fa-hourglass-start'),
        array( 'id' => '654', 'name' => 'Damaged House', 'icon' => 'fas fa-house-damage'),
        array( 'id' => '655', 'name' => 'Houzz', 'icon' => 'fab fa-houzz'),
        array( 'id' => '656', 'name' => 'Hryvnia', 'icon' => 'fas fa-hryvnia'),
        array( 'id' => '657', 'name' => 'HTML 5 Logo', 'icon' => 'fab fa-html5'),
        array( 'id' => '658', 'name' => 'HubSpot', 'icon' => 'fab fa-hubspot'),
        array( 'id' => '659', 'name' => 'I Beam Cursor', 'icon' => 'fas fa-i-cursor'),
        array( 'id' => '660', 'name' => 'Ice Cream', 'icon' => 'fas fa-ice-cream'),
        array( 'id' => '661', 'name' => 'Icicles', 'icon' => 'fas fa-icicles'),
        array( 'id' => '662', 'name' => 'Icons', 'icon' => 'fas fa-icons'),
        array( 'id' => '663', 'name' => 'Identification Badge', 'icon' => 'fas fa-id-badge'),
        array( 'id' => '664', 'name' => 'Identification Card', 'icon' => 'fas fa-id-card'),
        array( 'id' => '665', 'name' => 'Alternate Identification Card', 'icon' => 'fas fa-id-card-alt'),
        array( 'id' => '666', 'name' => 'Igloo', 'icon' => 'fas fa-igloo'),
        array( 'id' => '667', 'name' => 'Image', 'icon' => 'fas fa-image'),
        array( 'id' => '668', 'name' => 'Images', 'icon' => 'fas fa-images'),
        array( 'id' => '669', 'name' => 'IMDB', 'icon' => 'fab fa-imdb'),
        array( 'id' => '670', 'name' => 'inbox', 'icon' => 'fas fa-inbox'),
        array( 'id' => '671', 'name' => 'Indent', 'icon' => 'fas fa-indent'),
        array( 'id' => '672', 'name' => 'Industry', 'icon' => 'fas fa-industry'),
        array( 'id' => '673', 'name' => 'Infinity', 'icon' => 'fas fa-infinity'),
        array( 'id' => '674', 'name' => 'Info', 'icon' => 'fas fa-info'),
        array( 'id' => '675', 'name' => 'Info Circle', 'icon' => 'fas fa-info-circle'),
        array( 'id' => '676', 'name' => 'Instagram', 'icon' => 'fab fa-instagram'),
        array( 'id' => '677', 'name' => 'Intercom', 'icon' => 'fab fa-intercom'),
        array( 'id' => '678', 'name' => 'Internet-explorer', 'icon' => 'fab fa-internet-explorer'),
        array( 'id' => '679', 'name' => 'InVision', 'icon' => 'fab fa-invision'),
        array( 'id' => '680', 'name' => 'ioxhost', 'icon' => 'fab fa-ioxhost'),
        array( 'id' => '681', 'name' => 'italic', 'icon' => 'fas fa-italic'),
        array( 'id' => '682', 'name' => 'itch.io', 'icon' => 'fab fa-itch-io'),
        array( 'id' => '683', 'name' => 'iTunes', 'icon' => 'fab fa-itunes'),
        array( 'id' => '684', 'name' => 'Itunes Note', 'icon' => 'fab fa-itunes-note'),
        array( 'id' => '685', 'name' => 'Java', 'icon' => 'fab fa-java'),
        array( 'id' => '686', 'name' => 'Jedi', 'icon' => 'fas fa-jedi'),
        array( 'id' => '687', 'name' => 'Jedi Order', 'icon' => 'fab fa-jedi-order'),
        array( 'id' => '688', 'name' => 'Jenkis', 'icon' => 'fab fa-jenkins'),
        array( 'id' => '689', 'name' => 'Jira', 'icon' => 'fab fa-jira'),
        array( 'id' => '690', 'name' => 'Joget', 'icon' => 'fab fa-joget'),
        array( 'id' => '691', 'name' => 'Joint', 'icon' => 'fas fa-joint'),
        array( 'id' => '692', 'name' => 'Joomla Logo', 'icon' => 'fab fa-joomla'),
        array( 'id' => '693', 'name' => 'Journal of the Whills', 'icon' => 'fas fa-journal-whills'),
        array( 'id' => '694', 'name' => 'JavaScript (JS)', 'icon' => 'fab fa-js'),
        array( 'id' => '695', 'name' => 'JavaScript (JS) Square', 'icon' => 'fab fa-js-square'),
        array( 'id' => '696', 'name' => 'jsFiddle', 'icon' => 'fab fa-jsfiddle'),
        array( 'id' => '697', 'name' => 'Kaaba', 'icon' => 'fas fa-kaaba'),
        array( 'id' => '698', 'name' => 'Kaggle', 'icon' => 'fab fa-kaggle'),
        array( 'id' => '699', 'name' => 'key', 'icon' => 'fas fa-key'),
        array( 'id' => '700', 'name' => 'Keybase', 'icon' => 'fab fa-keybase'),
        array( 'id' => '701', 'name' => 'Keyboard', 'icon' => 'fas fa-keyboard'),
        array( 'id' => '702', 'name' => 'KeyCDN', 'icon' => 'fab fa-keycdn'),
        array( 'id' => '703', 'name' => 'Khanda', 'icon' => 'fas fa-khanda'),
        array( 'id' => '704', 'name' => 'Kickstarter', 'icon' => 'fab fa-kickstarter'),
        array( 'id' => '705', 'name' => 'Kickstarter K', 'icon' => 'fab fa-kickstarter-k'),
        array( 'id' => '706', 'name' => 'Kissing Face', 'icon' => 'fas fa-kiss'),
        array( 'id' => '707', 'name' => 'Kissing Face With Smiling Eyes', 'icon' => 'fas fa-kiss-beam'),
        array( 'id' => '708', 'name' => 'Face Blowing a Kiss', 'icon' => 'fas fa-kiss-wink-heart'),
        array( 'id' => '709', 'name' => 'Kiwi Bird', 'icon' => 'fas fa-kiwi-bird'),
        array( 'id' => '710', 'name' => 'KORVUE', 'icon' => 'fab fa-korvue'),
        array( 'id' => '711', 'name' => 'Landmark', 'icon' => 'fas fa-landmark'),
        array( 'id' => '712', 'name' => 'Language', 'icon' => 'fas fa-language'),
        array( 'id' => '713', 'name' => 'Laptop', 'icon' => 'fas fa-laptop'),
        array( 'id' => '714', 'name' => 'Laptop Code', 'icon' => 'fas fa-laptop-code'),
        array( 'id' => '715', 'name' => 'Laptop Medical', 'icon' => 'fas fa-laptop-medical'),
        array( 'id' => '716', 'name' => 'Laravel', 'icon' => 'fab fa-laravel'),
        array( 'id' => '717', 'name' => 'last.fm', 'icon' => 'fab fa-lastfm'),
        array( 'id' => '718', 'name' => 'last.fm Square', 'icon' => 'fab fa-lastfm-square'),
        array( 'id' => '719', 'name' => 'Grinning Face With Big Eyes', 'icon' => 'fas fa-laugh'),
        array( 'id' => '720', 'name' => 'Laugh Face with Beaming Eyes', 'icon' => 'fas fa-laugh-beam'),
        array( 'id' => '721', 'name' => 'Laughing Squinting Face', 'icon' => 'fas fa-laugh-squint'),
        array( 'id' => '722', 'name' => 'Laughing Winking Face', 'icon' => 'fas fa-laugh-wink'),
        array( 'id' => '723', 'name' => 'Layer Group', 'icon' => 'fas fa-layer-group'),
        array( 'id' => '724', 'name' => 'leaf', 'icon' => 'fas fa-leaf'),
        array( 'id' => '725', 'name' => 'Leanpub', 'icon' => 'fab fa-leanpub'),
        array( 'id' => '726', 'name' => 'Lemon', 'icon' => 'fas fa-lemon'),
        array( 'id' => '727', 'name' => 'Less', 'icon' => 'fab fa-less'),
        array( 'id' => '728', 'name' => 'Less Than', 'icon' => 'fas fa-less-than'),
        array( 'id' => '729', 'name' => 'Less Than Equal To', 'icon' => 'fas fa-less-than-equal'),
        array( 'id' => '730', 'name' => 'Alternate Level Down', 'icon' => 'fas fa-level-down-alt'),
        array( 'id' => '731', 'name' => 'Alternate Level Up', 'icon' => 'fas fa-level-up-alt'),
        array( 'id' => '732', 'name' => 'Life Ring', 'icon' => 'fas fa-life-ring'),
        array( 'id' => '733', 'name' => 'Lightbulb', 'icon' => 'fas fa-lightbulb'),
        array( 'id' => '734', 'name' => 'Line', 'icon' => 'fab fa-line'),
        array( 'id' => '735', 'name' => 'Link', 'icon' => 'fas fa-link'),
        array( 'id' => '736', 'name' => 'LinkedIn', 'icon' => 'fab fa-linkedin'),
        array( 'id' => '737', 'name' => 'LinkedIn In', 'icon' => 'fab fa-linkedin-in'),
        array( 'id' => '738', 'name' => 'Linode', 'icon' => 'fab fa-linode'),
        array( 'id' => '739', 'name' => 'Linux', 'icon' => 'fab fa-linux'),
        array( 'id' => '740', 'name' => 'Turkish Lira Sign', 'icon' => 'fas fa-lira-sign'),
        array( 'id' => '741', 'name' => 'List', 'icon' => 'fas fa-list'),
        array( 'id' => '742', 'name' => 'Alternate List', 'icon' => 'fas fa-list-alt'),
        array( 'id' => '743', 'name' => 'list-ol', 'icon' => 'fas fa-list-ol'),
        array( 'id' => '744', 'name' => 'list-ul', 'icon' => 'fas fa-list-ul'),
        array( 'id' => '745', 'name' => 'location-arrow', 'icon' => 'fas fa-location-arrow'),
        array( 'id' => '746', 'name' => 'lock', 'icon' => 'fas fa-lock'),
        array( 'id' => '747', 'name' => 'Lock Open', 'icon' => 'fas fa-lock-open'),
        array( 'id' => '748', 'name' => 'Alternate Long Arrow Down', 'icon' => 'fas fa-long-arrow-alt-down'),
        array( 'id' => '749', 'name' => 'Alternate Long Arrow Left', 'icon' => 'fas fa-long-arrow-alt-left'),
        array( 'id' => '750', 'name' => 'Alternate Long Arrow Right', 'icon' => 'fas fa-long-arrow-alt-right'),
        array( 'id' => '751', 'name' => 'Alternate Long Arrow Up', 'icon' => 'fas fa-long-arrow-alt-up'),
        array( 'id' => '752', 'name' => 'Low Vision', 'icon' => 'fas fa-low-vision'),
        array( 'id' => '753', 'name' => 'Luggage Cart', 'icon' => 'fas fa-luggage-cart'),
        array( 'id' => '754', 'name' => 'lyft', 'icon' => 'fab fa-lyft'),
        array( 'id' => '755', 'name' => 'Magento', 'icon' => 'fab fa-magento'),
        array( 'id' => '756', 'name' => 'magic', 'icon' => 'fas fa-magic'),
        array( 'id' => '757', 'name' => 'magnet', 'icon' => 'fas fa-magnet'),
        array( 'id' => '758', 'name' => 'Mail Bulk', 'icon' => 'fas fa-mail-bulk'),
        array( 'id' => '759', 'name' => 'Mailchimp', 'icon' => 'fab fa-mailchimp'),
        array( 'id' => '760', 'name' => 'Male', 'icon' => 'fas fa-male'),
        array( 'id' => '761', 'name' => 'Mandalorian', 'icon' => 'fab fa-mandalorian'),
        array( 'id' => '762', 'name' => 'Map', 'icon' => 'fas fa-map'),
        array( 'id' => '763', 'name' => 'Map Marked', 'icon' => 'fas fa-map-marked'),
        array( 'id' => '764', 'name' => 'Alternate Map Marked', 'icon' => 'fas fa-map-marked-alt'),
        array( 'id' => '765', 'name' => 'map-marker', 'icon' => 'fas fa-map-marker'),
        array( 'id' => '766', 'name' => 'Alternate Map Marker', 'icon' => 'fas fa-map-marker-alt'),
        array( 'id' => '767', 'name' => 'Map Pin', 'icon' => 'fas fa-map-pin'),
        array( 'id' => '768', 'name' => 'Map Signs', 'icon' => 'fas fa-map-signs'),
        array( 'id' => '769', 'name' => 'Markdown', 'icon' => 'fab fa-markdown'),
        array( 'id' => '770', 'name' => 'Marker', 'icon' => 'fas fa-marker'),
        array( 'id' => '771', 'name' => 'Mars', 'icon' => 'fas fa-mars'),
        array( 'id' => '772', 'name' => 'Mars Double', 'icon' => 'fas fa-mars-double'),
        array( 'id' => '773', 'name' => 'Mars Stroke', 'icon' => 'fas fa-mars-stroke'),
        array( 'id' => '774', 'name' => 'Mars Stroke Horizontal', 'icon' => 'fas fa-mars-stroke-h'),
        array( 'id' => '775', 'name' => 'Mars Stroke Vertical', 'icon' => 'fas fa-mars-stroke-v'),
        array( 'id' => '776', 'name' => 'Mask', 'icon' => 'fas fa-mask'),
        array( 'id' => '777', 'name' => 'Mastodon', 'icon' => 'fab fa-mastodon'),
        array( 'id' => '778', 'name' => 'MaxCDN', 'icon' => 'fab fa-maxcdn'),
        array( 'id' => '779', 'name' => 'Medal', 'icon' => 'fas fa-medal'),
        array( 'id' => '780', 'name' => 'MedApps', 'icon' => 'fab fa-medapps'),
        array( 'id' => '781', 'name' => 'Medium', 'icon' => 'fab fa-medium'),
        array( 'id' => '782', 'name' => 'Medium M', 'icon' => 'fab fa-medium-m'),
        array( 'id' => '783', 'name' => 'medkit', 'icon' => 'fas fa-medkit'),
        array( 'id' => '784', 'name' => 'MRT', 'icon' => 'fab fa-medrt'),
        array( 'id' => '785', 'name' => 'Meetup', 'icon' => 'fab fa-meetup'),
        array( 'id' => '786', 'name' => 'Megaport', 'icon' => 'fab fa-megaport'),
        array( 'id' => '787', 'name' => 'Neutral Face', 'icon' => 'fas fa-meh'),
        array( 'id' => '788', 'name' => 'Face Without Mouth', 'icon' => 'fas fa-meh-blank'),
        array( 'id' => '789', 'name' => 'Face With Rolling Eyes', 'icon' => 'fas fa-meh-rolling-eyes'),
        array( 'id' => '790', 'name' => 'Memory', 'icon' => 'fas fa-memory'),
        array( 'id' => '791', 'name' => 'Mendeley', 'icon' => 'fab fa-mendeley'),
        array( 'id' => '792', 'name' => 'Menorah', 'icon' => 'fas fa-menorah'),
        array( 'id' => '793', 'name' => 'Mercury', 'icon' => 'fas fa-mercury'),
        array( 'id' => '794', 'name' => 'Meteor', 'icon' => 'fas fa-meteor'),
        array( 'id' => '795', 'name' => 'Microchip', 'icon' => 'fas fa-microchip'),
        array( 'id' => '796', 'name' => 'microphone', 'icon' => 'fas fa-microphone'),
        array( 'id' => '797', 'name' => 'Alternate Microphone', 'icon' => 'fas fa-microphone-alt'),
        array( 'id' => '798', 'name' => 'Alternate Microphone Slash', 'icon' => 'fas fa-microphone-alt-slash'),
        array( 'id' => '799', 'name' => 'Microphone Slash', 'icon' => 'fas fa-microphone-slash'),
        array( 'id' => '800', 'name' => 'Microscope', 'icon' => 'fas fa-microscope'),
        array( 'id' => '801', 'name' => 'Microsoft', 'icon' => 'fab fa-microsoft'),
        array( 'id' => '802', 'name' => 'minus', 'icon' => 'fas fa-minus'),
        array( 'id' => '803', 'name' => 'Minus Circle', 'icon' => 'fas fa-minus-circle'),
        array( 'id' => '804', 'name' => 'Minus Square', 'icon' => 'fas fa-minus-square'),
        array( 'id' => '805', 'name' => 'Mitten', 'icon' => 'fas fa-mitten'),
        array( 'id' => '806', 'name' => 'Mix', 'icon' => 'fab fa-mix'),
        array( 'id' => '807', 'name' => 'Mixcloud', 'icon' => 'fab fa-mixcloud'),
        array( 'id' => '808', 'name' => 'Mizuni', 'icon' => 'fab fa-mizuni'),
        array( 'id' => '809', 'name' => 'Mobile Phone', 'icon' => 'fas fa-mobile'),
        array( 'id' => '810', 'name' => 'Alternate Mobile', 'icon' => 'fas fa-mobile-alt'),
        array( 'id' => '811', 'name' => 'MODX', 'icon' => 'fab fa-modx'),
        array( 'id' => '812', 'name' => 'Monero', 'icon' => 'fab fa-monero'),
        array( 'id' => '813', 'name' => 'Money Bill', 'icon' => 'fas fa-money-bill'),
        array( 'id' => '814', 'name' => 'Alternate Money Bill', 'icon' => 'fas fa-money-bill-alt'),
        array( 'id' => '815', 'name' => 'Wavy Money Bill', 'icon' => 'fas fa-money-bill-wave'),
        array( 'id' => '816', 'name' => 'Alternate Wavy Money Bill', 'icon' => 'fas fa-money-bill-wave-alt'),
        array( 'id' => '817', 'name' => 'Money Check', 'icon' => 'fas fa-money-check'),
        array( 'id' => '818', 'name' => 'Alternate Money Check', 'icon' => 'fas fa-money-check-alt'),
        array( 'id' => '819', 'name' => 'Monument', 'icon' => 'fas fa-monument'),
        array( 'id' => '820', 'name' => 'Moon', 'icon' => 'fas fa-moon'),
        array( 'id' => '821', 'name' => 'Mortar Pestle', 'icon' => 'fas fa-mortar-pestle'),
        array( 'id' => '822', 'name' => 'Mosque', 'icon' => 'fas fa-mosque'),
        array( 'id' => '823', 'name' => 'Motorcycle', 'icon' => 'fas fa-motorcycle'),
        array( 'id' => '824', 'name' => 'Mountain', 'icon' => 'fas fa-mountain'),
        array( 'id' => '825', 'name' => 'Mouse Pointer', 'icon' => 'fas fa-mouse-pointer'),
        array( 'id' => '826', 'name' => 'Mug Hot', 'icon' => 'fas fa-mug-hot'),
        array( 'id' => '827', 'name' => 'Music', 'icon' => 'fas fa-music'),
        array( 'id' => '828', 'name' => 'Napster', 'icon' => 'fab fa-napster'),
        array( 'id' => '829', 'name' => 'Neos', 'icon' => 'fab fa-neos'),
        array( 'id' => '830', 'name' => 'Wired Network', 'icon' => 'fas fa-network-wired'),
        array( 'id' => '831', 'name' => 'Neuter', 'icon' => 'fas fa-neuter'),
        array( 'id' => '832', 'name' => 'Newspaper', 'icon' => 'fas fa-newspaper'),
        array( 'id' => '833', 'name' => 'Nimblr', 'icon' => 'fab fa-nimblr'),
        array( 'id' => '834', 'name' => 'Node.js', 'icon' => 'fab fa-node'),
        array( 'id' => '835', 'name' => 'Node.js JS', 'icon' => 'fab fa-node-js'),
        array( 'id' => '836', 'name' => 'Not Equal', 'icon' => 'fas fa-not-equal'),
        array( 'id' => '837', 'name' => 'Medical Notes', 'icon' => 'fas fa-notes-medical'),
        array( 'id' => '838', 'name' => 'npm', 'icon' => 'fab fa-npm'),
        array( 'id' => '839', 'name' => 'NS8', 'icon' => 'fab fa-ns8'),
        array( 'id' => '840', 'name' => 'Nutritionix', 'icon' => 'fab fa-nutritionix'),
        array( 'id' => '841', 'name' => 'Object Group', 'icon' => 'fas fa-object-group'),
        array( 'id' => '842', 'name' => 'Object Ungroup', 'icon' => 'fas fa-object-ungroup'),
        array( 'id' => '843', 'name' => 'Odnoklassniki', 'icon' => 'fab fa-odnoklassniki'),
        array( 'id' => '844', 'name' => 'Odnoklassniki Square', 'icon' => 'fab fa-odnoklassniki-square'),
        array( 'id' => '845', 'name' => 'Oil Can', 'icon' => 'fas fa-oil-can'),
        array( 'id' => '846', 'name' => 'Old Republic', 'icon' => 'fab fa-old-republic'),
        array( 'id' => '847', 'name' => 'Om', 'icon' => 'fas fa-om'),
        array( 'id' => '848', 'name' => 'OpenCart', 'icon' => 'fab fa-opencart'),
        array( 'id' => '849', 'name' => 'OpenID', 'icon' => 'fab fa-openid'),
        array( 'id' => '850', 'name' => 'Opera', 'icon' => 'fab fa-opera'),
        array( 'id' => '851', 'name' => 'Optin Monster', 'icon' => 'fab fa-optin-monster'),
        array( 'id' => '852', 'name' => 'Open Source Initiative', 'icon' => 'fab fa-osi'),
        array( 'id' => '853', 'name' => 'Otter', 'icon' => 'fas fa-otter'),
        array( 'id' => '854', 'name' => 'Outdent', 'icon' => 'fas fa-outdent'),
        array( 'id' => '855', 'name' => 'page4 Corporation', 'icon' => 'fab fa-page4'),
        array( 'id' => '856', 'name' => 'Pagelines', 'icon' => 'fab fa-pagelines'),
        array( 'id' => '857', 'name' => 'Pager', 'icon' => 'fas fa-pager'),
        array( 'id' => '858', 'name' => 'Paint Brush', 'icon' => 'fas fa-paint-brush'),
        array( 'id' => '859', 'name' => 'Paint Roller', 'icon' => 'fas fa-paint-roller'),
        array( 'id' => '860', 'name' => 'Palette', 'icon' => 'fas fa-palette'),
        array( 'id' => '861', 'name' => 'Palfed', 'icon' => 'fab fa-palfed'),
        array( 'id' => '862', 'name' => 'Pallet', 'icon' => 'fas fa-pallet'),
        array( 'id' => '863', 'name' => 'Paper Plane', 'icon' => 'fas fa-paper-plane'),
        array( 'id' => '864', 'name' => 'Paperclip', 'icon' => 'fas fa-paperclip'),
        array( 'id' => '865', 'name' => 'Parachute Box', 'icon' => 'fas fa-parachute-box'),
        array( 'id' => '866', 'name' => 'paragraph', 'icon' => 'fas fa-paragraph'),
        array( 'id' => '867', 'name' => 'Parking', 'icon' => 'fas fa-parking'),
        array( 'id' => '868', 'name' => 'Passport', 'icon' => 'fas fa-passport'),
        array( 'id' => '869', 'name' => 'Pastafarianism', 'icon' => 'fas fa-pastafarianism'),
        array( 'id' => '870', 'name' => 'Paste', 'icon' => 'fas fa-paste'),
        array( 'id' => '871', 'name' => 'Patreon', 'icon' => 'fab fa-patreon'),
        array( 'id' => '872', 'name' => 'pause', 'icon' => 'fas fa-pause'),
        array( 'id' => '873', 'name' => 'Pause Circle', 'icon' => 'fas fa-pause-circle'),
        array( 'id' => '874', 'name' => 'Paw', 'icon' => 'fas fa-paw'),
        array( 'id' => '875', 'name' => 'Paypal', 'icon' => 'fab fa-paypal'),
        array( 'id' => '876', 'name' => 'Peace', 'icon' => 'fas fa-peace'),
        array( 'id' => '877', 'name' => 'Pen', 'icon' => 'fas fa-pen'),
        array( 'id' => '878', 'name' => 'Alternate Pen', 'icon' => 'fas fa-pen-alt'),
        array( 'id' => '879', 'name' => 'Pen Fancy', 'icon' => 'fas fa-pen-fancy'),
        array( 'id' => '880', 'name' => 'Pen Nib', 'icon' => 'fas fa-pen-nib'),
        array( 'id' => '881', 'name' => 'Pen Square', 'icon' => 'fas fa-pen-square'),
        array( 'id' => '882', 'name' => 'Alternate Pencil', 'icon' => 'fas fa-pencil-alt'),
        array( 'id' => '883', 'name' => 'Pencil Ruler', 'icon' => 'fas fa-pencil-ruler'),
        array( 'id' => '884', 'name' => 'Penny Arcade', 'icon' => 'fab fa-penny-arcade'),
        array( 'id' => '885', 'name' => 'People Carry', 'icon' => 'fas fa-people-carry'),
        array( 'id' => '886', 'name' => 'Hot Pepper', 'icon' => 'fas fa-pepper-hot'),
        array( 'id' => '887', 'name' => 'Percent', 'icon' => 'fas fa-percent'),
        array( 'id' => '888', 'name' => 'Percentage', 'icon' => 'fas fa-percentage'),
        array( 'id' => '889', 'name' => 'Periscope', 'icon' => 'fab fa-periscope'),
        array( 'id' => '890', 'name' => 'Person Entering Booth', 'icon' => 'fas fa-person-booth'),
        array( 'id' => '891', 'name' => 'Phabricator', 'icon' => 'fab fa-phabricator'),
        array( 'id' => '892', 'name' => 'Phoenix Framework', 'icon' => 'fab fa-phoenix-framework'),
        array( 'id' => '893', 'name' => 'Phoenix Squadron', 'icon' => 'fab fa-phoenix-squadron'),
        array( 'id' => '894', 'name' => 'Phone', 'icon' => 'fas fa-phone'),
        array( 'id' => '895', 'name' => 'Alternate Phone', 'icon' => 'fas fa-phone-alt'),
        array( 'id' => '896', 'name' => 'Phone Slash', 'icon' => 'fas fa-phone-slash'),
        array( 'id' => '897', 'name' => 'Phone Square', 'icon' => 'fas fa-phone-square'),
        array( 'id' => '898', 'name' => 'Alternate Phone Square', 'icon' => 'fas fa-phone-square-alt'),
        array( 'id' => '899', 'name' => 'Phone Volume', 'icon' => 'fas fa-phone-volume'),
        array( 'id' => '900', 'name' => 'Photo Video', 'icon' => 'fas fa-photo-video'),
        array( 'id' => '901', 'name' => 'PHP', 'icon' => 'fab fa-php'),
        array( 'id' => '902', 'name' => 'Pied Piper Logo', 'icon' => 'fab fa-pied-piper'),
        array( 'id' => '903', 'name' => 'Alternate Pied Piper Logo', 'icon' => 'fab fa-pied-piper-alt'),
        array( 'id' => '904', 'name' => 'Pied Piper-hat', 'icon' => 'fab fa-pied-piper-hat'),
        array( 'id' => '905', 'name' => 'Pied Piper PP Logo (Old)', 'icon' => 'fab fa-pied-piper-pp'),
        array( 'id' => '906', 'name' => 'Piggy Bank', 'icon' => 'fas fa-piggy-bank'),
        array( 'id' => '907', 'name' => 'Pills', 'icon' => 'fas fa-pills'),
        array( 'id' => '908', 'name' => 'Pinterest', 'icon' => 'fab fa-pinterest'),
        array( 'id' => '909', 'name' => 'Pinterest P', 'icon' => 'fab fa-pinterest-p'),
        array( 'id' => '910', 'name' => 'Pinterest Square', 'icon' => 'fab fa-pinterest-square'),
        array( 'id' => '911', 'name' => 'Pizza Slice', 'icon' => 'fas fa-pizza-slice'),
        array( 'id' => '912', 'name' => 'Place of Worship', 'icon' => 'fas fa-place-of-worship'),
        array( 'id' => '913', 'name' => 'plane', 'icon' => 'fas fa-plane'),
        array( 'id' => '914', 'name' => 'Plane Arrival', 'icon' => 'fas fa-plane-arrival'),
        array( 'id' => '915', 'name' => 'Plane Departure', 'icon' => 'fas fa-plane-departure'),
        array( 'id' => '916', 'name' => 'play', 'icon' => 'fas fa-play'),
        array( 'id' => '917', 'name' => 'Play Circle', 'icon' => 'fas fa-play-circle'),
        array( 'id' => '918', 'name' => 'PlayStation', 'icon' => 'fab fa-playstation'),
        array( 'id' => '919', 'name' => 'Plug', 'icon' => 'fas fa-plug'),
        array( 'id' => '920', 'name' => 'plus', 'icon' => 'fas fa-plus'),
        array( 'id' => '921', 'name' => 'Plus Circle', 'icon' => 'fas fa-plus-circle'),
        array( 'id' => '922', 'name' => 'Plus Square', 'icon' => 'fas fa-plus-square'),
        array( 'id' => '923', 'name' => 'Podcast', 'icon' => 'fas fa-podcast'),
        array( 'id' => '924', 'name' => 'Poll', 'icon' => 'fas fa-poll'),
        array( 'id' => '925', 'name' => 'Poll H', 'icon' => 'fas fa-poll-h'),
        array( 'id' => '926', 'name' => 'Poo', 'icon' => 'fas fa-poo'),
        array( 'id' => '927', 'name' => 'Poo Storm', 'icon' => 'fas fa-poo-storm'),
        array( 'id' => '928', 'name' => 'Poop', 'icon' => 'fas fa-poop'),
        array( 'id' => '929', 'name' => 'Portrait', 'icon' => 'fas fa-portrait'),
        array( 'id' => '930', 'name' => 'Pound Sign', 'icon' => 'fas fa-pound-sign'),
        array( 'id' => '931', 'name' => 'Power Off', 'icon' => 'fas fa-power-off'),
        array( 'id' => '932', 'name' => 'Pray', 'icon' => 'fas fa-pray'),
        array( 'id' => '933', 'name' => 'Praying Hands', 'icon' => 'fas fa-praying-hands'),
        array( 'id' => '934', 'name' => 'Prescription', 'icon' => 'fas fa-prescription'),
        array( 'id' => '935', 'name' => 'Prescription Bottle', 'icon' => 'fas fa-prescription-bottle'),
        array( 'id' => '936', 'name' => 'Alternate Prescription Bottle', 'icon' => 'fas fa-prescription-bottle-alt'),
        array( 'id' => '937', 'name' => 'print', 'icon' => 'fas fa-print'),
        array( 'id' => '938', 'name' => 'Procedures', 'icon' => 'fas fa-procedures'),
        array( 'id' => '939', 'name' => 'Product Hunt', 'icon' => 'fab fa-product-hunt'),
        array( 'id' => '940', 'name' => 'Project Diagram', 'icon' => 'fas fa-project-diagram'),
        array( 'id' => '941', 'name' => 'Pushed', 'icon' => 'fab fa-pushed'),
        array( 'id' => '942', 'name' => 'Puzzle Piece', 'icon' => 'fas fa-puzzle-piece'),
        array( 'id' => '943', 'name' => 'Python', 'icon' => 'fab fa-python'),
        array( 'id' => '944', 'name' => 'QQ', 'icon' => 'fab fa-qq'),
        array( 'id' => '945', 'name' => 'qrcode', 'icon' => 'fas fa-qrcode'),
        array( 'id' => '946', 'name' => 'Question', 'icon' => 'fas fa-question'),
        array( 'id' => '947', 'name' => 'Question Circle', 'icon' => 'fas fa-question-circle'),
        array( 'id' => '948', 'name' => 'Quidditch', 'icon' => 'fas fa-quidditch'),
        array( 'id' => '949', 'name' => 'QuinScape', 'icon' => 'fab fa-quinscape'),
        array( 'id' => '950', 'name' => 'Quora', 'icon' => 'fab fa-quora'),
        array( 'id' => '951', 'name' => 'quote-left', 'icon' => 'fas fa-quote-left'),
        array( 'id' => '952', 'name' => 'quote-right', 'icon' => 'fas fa-quote-right'),
        array( 'id' => '953', 'name' => 'Quran', 'icon' => 'fas fa-quran'),
        array( 'id' => '954', 'name' => 'R Project', 'icon' => 'fab fa-r-project'),
        array( 'id' => '955', 'name' => 'Radiation', 'icon' => 'fas fa-radiation'),
        array( 'id' => '956', 'name' => 'Alternate Radiation', 'icon' => 'fas fa-radiation-alt'),
        array( 'id' => '957', 'name' => 'Rainbow', 'icon' => 'fas fa-rainbow'),
        array( 'id' => '958', 'name' => 'random', 'icon' => 'fas fa-random'),
        array( 'id' => '959', 'name' => 'Raspberry Pi', 'icon' => 'fab fa-raspberry-pi'),
        array( 'id' => '960', 'name' => 'Ravelry', 'icon' => 'fab fa-ravelry'),
        array( 'id' => '961', 'name' => 'React', 'icon' => 'fab fa-react'),
        array( 'id' => '962', 'name' => 'ReactEurope', 'icon' => 'fab fa-reacteurope'),
        array( 'id' => '963', 'name' => 'ReadMe', 'icon' => 'fab fa-readme'),
        array( 'id' => '964', 'name' => 'Rebel Alliance', 'icon' => 'fab fa-rebel'),
        array( 'id' => '965', 'name' => 'Receipt', 'icon' => 'fas fa-receipt'),
        array( 'id' => '966', 'name' => 'Recycle', 'icon' => 'fas fa-recycle'),
        array( 'id' => '967', 'name' => 'red river', 'icon' => 'fab fa-red-river'),
        array( 'id' => '968', 'name' => 'reddit Logo', 'icon' => 'fab fa-reddit'),
        array( 'id' => '969', 'name' => 'reddit Alien', 'icon' => 'fab fa-reddit-alien'),
        array( 'id' => '970', 'name' => 'reddit Square', 'icon' => 'fab fa-reddit-square'),
        array( 'id' => '971', 'name' => 'Redhat', 'icon' => 'fab fa-redhat'),
        array( 'id' => '972', 'name' => 'Redo', 'icon' => 'fas fa-redo'),
        array( 'id' => '973', 'name' => 'Alternate Redo', 'icon' => 'fas fa-redo-alt'),
        array( 'id' => '974', 'name' => 'Registered Trademark', 'icon' => 'fas fa-registered'),
        array( 'id' => '975', 'name' => 'Remove Format', 'icon' => 'fas fa-remove-format'),
        array( 'id' => '976', 'name' => 'Renren', 'icon' => 'fab fa-renren'),
        array( 'id' => '977', 'name' => 'Reply', 'icon' => 'fas fa-reply'),
        array( 'id' => '978', 'name' => 'reply-all', 'icon' => 'fas fa-reply-all'),
        array( 'id' => '979', 'name' => 'replyd', 'icon' => 'fab fa-replyd'),
        array( 'id' => '980', 'name' => 'Republican', 'icon' => 'fas fa-republican'),
        array( 'id' => '981', 'name' => 'Researchgate', 'icon' => 'fab fa-researchgate'),
        array( 'id' => '982', 'name' => 'Resolving', 'icon' => 'fab fa-resolving'),
        array( 'id' => '983', 'name' => 'Restroom', 'icon' => 'fas fa-restroom'),
        array( 'id' => '984', 'name' => 'Retweet', 'icon' => 'fas fa-retweet'),
        array( 'id' => '985', 'name' => 'Rev.io', 'icon' => 'fab fa-rev'),
        array( 'id' => '986', 'name' => 'Ribbon', 'icon' => 'fas fa-ribbon'),
        array( 'id' => '987', 'name' => 'Ring', 'icon' => 'fas fa-ring'),
        array( 'id' => '988', 'name' => 'road', 'icon' => 'fas fa-road'),
        array( 'id' => '989', 'name' => 'Robot', 'icon' => 'fas fa-robot'),
        array( 'id' => '990', 'name' => 'rocket', 'icon' => 'fas fa-rocket'),
        array( 'id' => '991', 'name' => 'Rocket.Chat', 'icon' => 'fab fa-rocketchat'),
        array( 'id' => '992', 'name' => 'Rockrms', 'icon' => 'fab fa-rockrms'),
        array( 'id' => '993', 'name' => 'Route', 'icon' => 'fas fa-route'),
        array( 'id' => '994', 'name' => 'rss', 'icon' => 'fas fa-rss'),
        array( 'id' => '995', 'name' => 'RSS Square', 'icon' => 'fas fa-rss-square'),
        array( 'id' => '996', 'name' => 'Ruble Sign', 'icon' => 'fas fa-ruble-sign'),
        array( 'id' => '997', 'name' => 'Ruler', 'icon' => 'fas fa-ruler'),
        array( 'id' => '998', 'name' => 'Ruler Combined', 'icon' => 'fas fa-ruler-combined'),
        array( 'id' => '999', 'name' => 'Ruler Horizontal', 'icon' => 'fas fa-ruler-horizontal'),
        array( 'id' => '1000', 'name' => 'Ruler Vertical', 'icon' => 'fas fa-ruler-vertical'),
        array( 'id' => '1001', 'name' => 'Running', 'icon' => 'fas fa-running'),
        array( 'id' => '1002', 'name' => 'Indian Rupee Sign', 'icon' => 'fas fa-rupee-sign'),
        array( 'id' => '1003', 'name' => 'Crying Face', 'icon' => 'fas fa-sad-cry'),
        array( 'id' => '1004', 'name' => 'Loudly Crying Face', 'icon' => 'fas fa-sad-tear'),
        array( 'id' => '1005', 'name' => 'Safari', 'icon' => 'fab fa-safari'),
        array( 'id' => '1006', 'name' => 'Salesforce', 'icon' => 'fab fa-salesforce'),
        array( 'id' => '1007', 'name' => 'Sass', 'icon' => 'fab fa-sass'),
        array( 'id' => '1008', 'name' => 'Satellite', 'icon' => 'fas fa-satellite'),
        array( 'id' => '1009', 'name' => 'Satellite Dish', 'icon' => 'fas fa-satellite-dish'),
        array( 'id' => '1010', 'name' => 'Save', 'icon' => 'fas fa-save'),
        array( 'id' => '1011', 'name' => 'SCHLIX', 'icon' => 'fab fa-schlix'),
        array( 'id' => '1012', 'name' => 'School', 'icon' => 'fas fa-school'),
        array( 'id' => '1013', 'name' => 'Screwdriver', 'icon' => 'fas fa-screwdriver'),
        array( 'id' => '1014', 'name' => 'Scribd', 'icon' => 'fab fa-scribd'),
        array( 'id' => '1015', 'name' => 'Scroll', 'icon' => 'fas fa-scroll'),
        array( 'id' => '1016', 'name' => 'Sd Card', 'icon' => 'fas fa-sd-card'),
        array( 'id' => '1017', 'name' => 'Search', 'icon' => 'fas fa-search'),
        array( 'id' => '1018', 'name' => 'Search Dollar', 'icon' => 'fas fa-search-dollar'),
        array( 'id' => '1019', 'name' => 'Search Location', 'icon' => 'fas fa-search-location'),
        array( 'id' => '1020', 'name' => 'Search Minus', 'icon' => 'fas fa-search-minus'),
        array( 'id' => '1021', 'name' => 'Search Plus', 'icon' => 'fas fa-search-plus'),
        array( 'id' => '1022', 'name' => 'Searchengin', 'icon' => 'fab fa-searchengin'),
        array( 'id' => '1023', 'name' => 'Seedling', 'icon' => 'fas fa-seedling'),
        array( 'id' => '1024', 'name' => 'Sellcast', 'icon' => 'fab fa-sellcast'),
        array( 'id' => '1025', 'name' => 'Sellsy', 'icon' => 'fab fa-sellsy'),
        array( 'id' => '1026', 'name' => 'Server', 'icon' => 'fas fa-server'),
        array( 'id' => '1027', 'name' => 'Servicestack', 'icon' => 'fab fa-servicestack'),
        array( 'id' => '1028', 'name' => 'Shapes', 'icon' => 'fas fa-shapes'),
        array( 'id' => '1029', 'name' => 'Share', 'icon' => 'fas fa-share'),
        array( 'id' => '1030', 'name' => 'Alternate Share', 'icon' => 'fas fa-share-alt'),
        array( 'id' => '1031', 'name' => 'Alternate Share Square', 'icon' => 'fas fa-share-alt-square'),
        array( 'id' => '1032', 'name' => 'Share Square', 'icon' => 'fas fa-share-square'),
        array( 'id' => '1033', 'name' => 'Shekel Sign', 'icon' => 'fas fa-shekel-sign'),
        array( 'id' => '1034', 'name' => 'Alternate Shield', 'icon' => 'fas fa-shield-alt'),
        array( 'id' => '1035', 'name' => 'Ship', 'icon' => 'fas fa-ship'),
        array( 'id' => '1036', 'name' => 'Shipping Fast', 'icon' => 'fas fa-shipping-fast'),
        array( 'id' => '1037', 'name' => 'Shirts in Bulk', 'icon' => 'fab fa-shirtsinbulk'),
        array( 'id' => '1038', 'name' => 'Shoe Prints', 'icon' => 'fas fa-shoe-prints'),
        array( 'id' => '1039', 'name' => 'Shopping Bag', 'icon' => 'fas fa-shopping-bag'),
        array( 'id' => '1040', 'name' => 'Shopping Basket', 'icon' => 'fas fa-shopping-basket'),
        array( 'id' => '1041', 'name' => 'shopping-cart', 'icon' => 'fas fa-shopping-cart'),
        array( 'id' => '1042', 'name' => 'Shopware', 'icon' => 'fab fa-shopware'),
        array( 'id' => '1043', 'name' => 'Shower', 'icon' => 'fas fa-shower'),
        array( 'id' => '1044', 'name' => 'Shuttle Van', 'icon' => 'fas fa-shuttle-van'),
        array( 'id' => '1045', 'name' => 'Sign', 'icon' => 'fas fa-sign'),
        array( 'id' => '1046', 'name' => 'Alternate Sign In', 'icon' => 'fas fa-sign-in-alt'),
        array( 'id' => '1047', 'name' => 'Sign Language', 'icon' => 'fas fa-sign-language'),
        array( 'id' => '1048', 'name' => 'Alternate Sign Out', 'icon' => 'fas fa-sign-out-alt'),
        array( 'id' => '1049', 'name' => 'signal', 'icon' => 'fas fa-signal'),
        array( 'id' => '1050', 'name' => 'Signature', 'icon' => 'fas fa-signature'),
        array( 'id' => '1051', 'name' => 'SIM Card', 'icon' => 'fas fa-sim-card'),
        array( 'id' => '1052', 'name' => 'SimplyBuilt', 'icon' => 'fab fa-simplybuilt'),
        array( 'id' => '1053', 'name' => 'SISTRIX', 'icon' => 'fab fa-sistrix'),
        array( 'id' => '1054', 'name' => 'Sitemap', 'icon' => 'fas fa-sitemap'),
        array( 'id' => '1055', 'name' => 'Sith', 'icon' => 'fab fa-sith'),
        array( 'id' => '1056', 'name' => 'Skating', 'icon' => 'fas fa-skating'),
        array( 'id' => '1057', 'name' => 'Sketch', 'icon' => 'fab fa-sketch'),
        array( 'id' => '1058', 'name' => 'Skiing', 'icon' => 'fas fa-skiing'),
        array( 'id' => '1059', 'name' => 'Skiing Nordic', 'icon' => 'fas fa-skiing-nordic'),
        array( 'id' => '1060', 'name' => 'Skull', 'icon' => 'fas fa-skull'),
        array( 'id' => '1061', 'name' => 'Skull & Crossbones', 'icon' => 'fas fa-skull-crossbones'),
        array( 'id' => '1062', 'name' => 'skyatlas', 'icon' => 'fab fa-skyatlas'),
        array( 'id' => '1063', 'name' => 'Skype', 'icon' => 'fab fa-skype'),
        array( 'id' => '1064', 'name' => 'Slack Logo', 'icon' => 'fab fa-slack'),
        array( 'id' => '1065', 'name' => 'Slack Hashtag', 'icon' => 'fab fa-slack-hash'),
        array( 'id' => '1066', 'name' => 'Slash', 'icon' => 'fas fa-slash'),
        array( 'id' => '1067', 'name' => 'Sleigh', 'icon' => 'fas fa-sleigh'),
        array( 'id' => '1068', 'name' => 'Horizontal Sliders', 'icon' => 'fas fa-sliders-h'),
        array( 'id' => '1069', 'name' => 'Slideshare', 'icon' => 'fab fa-slideshare'),
        array( 'id' => '1070', 'name' => 'Smiling Face', 'icon' => 'fas fa-smile'),
        array( 'id' => '1071', 'name' => 'Beaming Face With Smiling Eyes', 'icon' => 'fas fa-smile-beam'),
        array( 'id' => '1072', 'name' => 'Winking Face', 'icon' => 'fas fa-smile-wink'),
        array( 'id' => '1073', 'name' => 'Smog', 'icon' => 'fas fa-smog'),
        array( 'id' => '1074', 'name' => 'Smoking', 'icon' => 'fas fa-smoking'),
        array( 'id' => '1075', 'name' => 'Smoking Ban', 'icon' => 'fas fa-smoking-ban'),
        array( 'id' => '1076', 'name' => 'SMS', 'icon' => 'fas fa-sms'),
        array( 'id' => '1077', 'name' => 'Snapchat', 'icon' => 'fab fa-snapchat'),
        array( 'id' => '1078', 'name' => 'Snapchat Ghost', 'icon' => 'fab fa-snapchat-ghost'),
        array( 'id' => '1079', 'name' => 'Snapchat Square', 'icon' => 'fab fa-snapchat-square'),
        array( 'id' => '1080', 'name' => 'Snowboarding', 'icon' => 'fas fa-snowboarding'),
        array( 'id' => '1081', 'name' => 'Snowflake', 'icon' => 'fas fa-snowflake'),
        array( 'id' => '1082', 'name' => 'Snowman', 'icon' => 'fas fa-snowman'),
        array( 'id' => '1083', 'name' => 'Snowplow', 'icon' => 'fas fa-snowplow'),
        array( 'id' => '1084', 'name' => 'Socks', 'icon' => 'fas fa-socks'),
        array( 'id' => '1085', 'name' => 'Solar Panel', 'icon' => 'fas fa-solar-panel'),
        array( 'id' => '1086', 'name' => 'Sort', 'icon' => 'fas fa-sort'),
        array( 'id' => '1087', 'name' => 'Sort Alphabetical Down', 'icon' => 'fas fa-sort-alpha-down'),
        array( 'id' => '1088', 'name' => 'Alternate Sort Alphabetical Down', 'icon' => 'fas fa-sort-alpha-down-alt'),
        array( 'id' => '1089', 'name' => 'Sort Alphabetical Up', 'icon' => 'fas fa-sort-alpha-up'),
        array( 'id' => '1090', 'name' => 'Alternate Sort Alphabetical Up', 'icon' => 'fas fa-sort-alpha-up-alt'),
        array( 'id' => '1091', 'name' => 'Sort Amount Down', 'icon' => 'fas fa-sort-amount-down'),
        array( 'id' => '1092', 'name' => 'Alternate Sort Amount Down', 'icon' => 'fas fa-sort-amount-down-alt'),
        array( 'id' => '1093', 'name' => 'Sort Amount Up', 'icon' => 'fas fa-sort-amount-up'),
        array( 'id' => '1094', 'name' => 'Alternate Sort Amount Up', 'icon' => 'fas fa-sort-amount-up-alt'),
        array( 'id' => '1095', 'name' => 'Sort Down (Descending)', 'icon' => 'fas fa-sort-down'),
        array( 'id' => '1096', 'name' => 'Sort Numeric Down', 'icon' => 'fas fa-sort-numeric-down'),
        array( 'id' => '1097', 'name' => 'Alternate Sort Numeric Down', 'icon' => 'fas fa-sort-numeric-down-alt'),
        array( 'id' => '1098', 'name' => 'Sort Numeric Up', 'icon' => 'fas fa-sort-numeric-up'),
        array( 'id' => '1099', 'name' => 'Alternate Sort Numeric Up', 'icon' => 'fas fa-sort-numeric-up-alt'),
        array( 'id' => '1100', 'name' => 'Sort Up (Ascending)', 'icon' => 'fas fa-sort-up'),
        array( 'id' => '1101', 'name' => 'SoundCloud', 'icon' => 'fab fa-soundcloud'),
        array( 'id' => '1102', 'name' => 'Sourcetree', 'icon' => 'fab fa-sourcetree'),
        array( 'id' => '1103', 'name' => 'Spa', 'icon' => 'fas fa-spa'),
        array( 'id' => '1104', 'name' => 'Space Shuttle', 'icon' => 'fas fa-space-shuttle'),
        array( 'id' => '1105', 'name' => 'Speakap', 'icon' => 'fab fa-speakap'),
        array( 'id' => '1106', 'name' => 'Speaker Deck', 'icon' => 'fab fa-speaker-deck'),
        array( 'id' => '1107', 'name' => 'Spell Check', 'icon' => 'fas fa-spell-check'),
        array( 'id' => '1108', 'name' => 'Spider', 'icon' => 'fas fa-spider'),
        array( 'id' => '1109', 'name' => 'Spinner', 'icon' => 'fas fa-spinner'),
        array( 'id' => '1110', 'name' => 'Splotch', 'icon' => 'fas fa-splotch'),
        array( 'id' => '1111', 'name' => 'Spotify', 'icon' => 'fab fa-spotify'),
        array( 'id' => '1112', 'name' => 'Spray Can', 'icon' => 'fas fa-spray-can'),
        array( 'id' => '1113', 'name' => 'Square', 'icon' => 'fas fa-square'),
        array( 'id' => '1114', 'name' => 'Square Full', 'icon' => 'fas fa-square-full'),
        array( 'id' => '1115', 'name' => 'Alternate Square Root', 'icon' => 'fas fa-square-root-alt'),
        array( 'id' => '1116', 'name' => 'Squarespace', 'icon' => 'fab fa-squarespace'),
        array( 'id' => '1117', 'name' => 'Stack Exchange', 'icon' => 'fab fa-stack-exchange'),
        array( 'id' => '1118', 'name' => 'Stack Overflow', 'icon' => 'fab fa-stack-overflow'),
        array( 'id' => '1119', 'name' => 'Stackpath', 'icon' => 'fab fa-stackpath'),
        array( 'id' => '1120', 'name' => 'Stamp', 'icon' => 'fas fa-stamp'),
        array( 'id' => '1121', 'name' => 'Star', 'icon' => 'fas fa-star'),
        array( 'id' => '1122', 'name' => 'Star and Crescent', 'icon' => 'fas fa-star-and-crescent'),
        array( 'id' => '1123', 'name' => 'star-half', 'icon' => 'fas fa-star-half'),
        array( 'id' => '1124', 'name' => 'Alternate Star Half', 'icon' => 'fas fa-star-half-alt'),
        array( 'id' => '1125', 'name' => 'Star of David', 'icon' => 'fas fa-star-of-david'),
        array( 'id' => '1126', 'name' => 'Star of Life', 'icon' => 'fas fa-star-of-life'),
        array( 'id' => '1127', 'name' => 'StayLinked', 'icon' => 'fab fa-staylinked'),
        array( 'id' => '1128', 'name' => 'Steam', 'icon' => 'fab fa-steam'),
        array( 'id' => '1129', 'name' => 'Steam Square', 'icon' => 'fab fa-steam-square'),
        array( 'id' => '1130', 'name' => 'Steam Symbol', 'icon' => 'fab fa-steam-symbol'),
        array( 'id' => '1131', 'name' => 'step-backward', 'icon' => 'fas fa-step-backward'),
        array( 'id' => '1132', 'name' => 'step-forward', 'icon' => 'fas fa-step-forward'),
        array( 'id' => '1133', 'name' => 'Stethoscope', 'icon' => 'fas fa-stethoscope'),
        array( 'id' => '1134', 'name' => 'Sticker Mule', 'icon' => 'fab fa-sticker-mule'),
        array( 'id' => '1135', 'name' => 'Sticky Note', 'icon' => 'fas fa-sticky-note'),
        array( 'id' => '1136', 'name' => 'stop', 'icon' => 'fas fa-stop'),
        array( 'id' => '1137', 'name' => 'Stop Circle', 'icon' => 'fas fa-stop-circle'),
        array( 'id' => '1138', 'name' => 'Stopwatch', 'icon' => 'fas fa-stopwatch'),
        array( 'id' => '1139', 'name' => 'Store', 'icon' => 'fas fa-store'),
        array( 'id' => '1140', 'name' => 'Alternate Store', 'icon' => 'fas fa-store-alt'),
        array( 'id' => '1141', 'name' => 'Strava', 'icon' => 'fab fa-strava'),
        array( 'id' => '1142', 'name' => 'Stream', 'icon' => 'fas fa-stream'),
        array( 'id' => '1143', 'name' => 'Street View', 'icon' => 'fas fa-street-view'),
        array( 'id' => '1144', 'name' => 'Strikethrough', 'icon' => 'fas fa-strikethrough'),
        array( 'id' => '1145', 'name' => 'Stripe', 'icon' => 'fab fa-stripe'),
        array( 'id' => '1146', 'name' => 'Stripe S', 'icon' => 'fab fa-stripe-s'),
        array( 'id' => '1147', 'name' => 'Stroopwafel', 'icon' => 'fas fa-stroopwafel'),
        array( 'id' => '1148', 'name' => 'Studio Vinari', 'icon' => 'fab fa-studiovinari'),
        array( 'id' => '1149', 'name' => 'StumbleUpon Logo', 'icon' => 'fab fa-stumbleupon'),
        array( 'id' => '1150', 'name' => 'StumbleUpon Circle', 'icon' => 'fab fa-stumbleupon-circle'),
        array( 'id' => '1151', 'name' => 'subscript', 'icon' => 'fas fa-subscript'),
        array( 'id' => '1152', 'name' => 'Subway', 'icon' => 'fas fa-subway'),
        array( 'id' => '1153', 'name' => 'Suitcase', 'icon' => 'fas fa-suitcase'),
        array( 'id' => '1154', 'name' => 'Suitcase Rolling', 'icon' => 'fas fa-suitcase-rolling'),
        array( 'id' => '1155', 'name' => 'Sun', 'icon' => 'fas fa-sun'),
        array( 'id' => '1156', 'name' => 'Superpowers', 'icon' => 'fab fa-superpowers'),
        array( 'id' => '1157', 'name' => 'superscript', 'icon' => 'fas fa-superscript'),
        array( 'id' => '1158', 'name' => 'Supple', 'icon' => 'fab fa-supple'),
        array( 'id' => '1159', 'name' => 'Hushed Face', 'icon' => 'fas fa-surprise'),
        array( 'id' => '1160', 'name' => 'Suse', 'icon' => 'fab fa-suse'),
        array( 'id' => '1161', 'name' => 'Swatchbook', 'icon' => 'fas fa-swatchbook'),
        array( 'id' => '1162', 'name' => 'Swimmer', 'icon' => 'fas fa-swimmer'),
        array( 'id' => '1163', 'name' => 'Swimming Pool', 'icon' => 'fas fa-swimming-pool'),
        array( 'id' => '1164', 'name' => 'Symfony', 'icon' => 'fab fa-symfony'),
        array( 'id' => '1165', 'name' => 'Synagogue', 'icon' => 'fas fa-synagogue'),
        array( 'id' => '1166', 'name' => 'Sync', 'icon' => 'fas fa-sync'),
        array( 'id' => '1167', 'name' => 'Alternate Sync', 'icon' => 'fas fa-sync-alt'),
        array( 'id' => '1168', 'name' => 'Syringe', 'icon' => 'fas fa-syringe'),
        array( 'id' => '1169', 'name' => 'table', 'icon' => 'fas fa-table'),
        array( 'id' => '1170', 'name' => 'Table Tennis', 'icon' => 'fas fa-table-tennis'),
        array( 'id' => '1171', 'name' => 'tablet', 'icon' => 'fas fa-tablet'),
        array( 'id' => '1172', 'name' => 'Alternate Tablet', 'icon' => 'fas fa-tablet-alt'),
        array( 'id' => '1173', 'name' => 'Tablets', 'icon' => 'fas fa-tablets'),
        array( 'id' => '1174', 'name' => 'Alternate Tachometer', 'icon' => 'fas fa-tachometer-alt'),
        array( 'id' => '1175', 'name' => 'tag', 'icon' => 'fas fa-tag'),
        array( 'id' => '1176', 'name' => 'tags', 'icon' => 'fas fa-tags'),
        array( 'id' => '1177', 'name' => 'Tape', 'icon' => 'fas fa-tape'),
        array( 'id' => '1178', 'name' => 'Tasks', 'icon' => 'fas fa-tasks'),
        array( 'id' => '1179', 'name' => 'Taxi', 'icon' => 'fas fa-taxi'),
        array( 'id' => '1180', 'name' => 'TeamSpeak', 'icon' => 'fab fa-teamspeak'),
        array( 'id' => '1181', 'name' => 'Teeth', 'icon' => 'fas fa-teeth'),
        array( 'id' => '1182', 'name' => 'Teeth Open', 'icon' => 'fas fa-teeth-open'),
        array( 'id' => '1183', 'name' => 'Telegram', 'icon' => 'fab fa-telegram'),
        array( 'id' => '1184', 'name' => 'Telegram Plane', 'icon' => 'fab fa-telegram-plane'),
        array( 'id' => '1185', 'name' => 'High Temperature', 'icon' => 'fas fa-temperature-high'),
        array( 'id' => '1186', 'name' => 'Low Temperature', 'icon' => 'fas fa-temperature-low'),
        array( 'id' => '1187', 'name' => 'Tencent Weibo', 'icon' => 'fab fa-tencent-weibo'),
        array( 'id' => '1188', 'name' => 'Tenge', 'icon' => 'fas fa-tenge'),
        array( 'id' => '1189', 'name' => 'Terminal', 'icon' => 'fas fa-terminal'),
        array( 'id' => '1190', 'name' => 'text-height', 'icon' => 'fas fa-text-height'),
        array( 'id' => '1191', 'name' => 'Text Width', 'icon' => 'fas fa-text-width'),
        array( 'id' => '1192', 'name' => 'th', 'icon' => 'fas fa-th'),
        array( 'id' => '1193', 'name' => 'th-large', 'icon' => 'fas fa-th-large'),
        array( 'id' => '1194', 'name' => 'th-list', 'icon' => 'fas fa-th-list'),
        array( 'id' => '1195', 'name' => 'The Red Yeti', 'icon' => 'fab fa-the-red-yeti'),
        array( 'id' => '1196', 'name' => 'Theater Masks', 'icon' => 'fas fa-theater-masks'),
        array( 'id' => '1197', 'name' => 'Themeco', 'icon' => 'fab fa-themeco'),
        array( 'id' => '1198', 'name' => 'ThemeIsle', 'icon' => 'fab fa-themeisle'),
        array( 'id' => '1199', 'name' => 'Thermometer', 'icon' => 'fas fa-thermometer'),
        array( 'id' => '1200', 'name' => 'Thermometer Empty', 'icon' => 'fas fa-thermometer-empty'),
        array( 'id' => '1201', 'name' => 'Thermometer Full', 'icon' => 'fas fa-thermometer-full'),
        array( 'id' => '1202', 'name' => 'Thermometer 1/2 Full', 'icon' => 'fas fa-thermometer-half'),
        array( 'id' => '1203', 'name' => 'Thermometer 1/4 Full', 'icon' => 'fas fa-thermometer-quarter'),
        array( 'id' => '1204', 'name' => 'Thermometer 3/4 Full', 'icon' => 'fas fa-thermometer-three-quarters'),
        array( 'id' => '1205', 'name' => 'Think Peaks', 'icon' => 'fab fa-think-peaks'),
        array( 'id' => '1206', 'name' => 'thumbs-down', 'icon' => 'fas fa-thumbs-down'),
        array( 'id' => '1207', 'name' => 'thumbs-up', 'icon' => 'fas fa-thumbs-up'),
        array( 'id' => '1208', 'name' => 'Thumbtack', 'icon' => 'fas fa-thumbtack'),
        array( 'id' => '1209', 'name' => 'Alternate Ticket', 'icon' => 'fas fa-ticket-alt'),
        array( 'id' => '1210', 'name' => 'Times', 'icon' => 'fas fa-times'),
        array( 'id' => '1211', 'name' => 'Times Circle', 'icon' => 'fas fa-times-circle'),
        array( 'id' => '1212', 'name' => 'tint', 'icon' => 'fas fa-tint'),
        array( 'id' => '1213', 'name' => 'Tint Slash', 'icon' => 'fas fa-tint-slash'),
        array( 'id' => '1214', 'name' => 'Tired Face', 'icon' => 'fas fa-tired'),
        array( 'id' => '1215', 'name' => 'Toggle Off', 'icon' => 'fas fa-toggle-off'),
        array( 'id' => '1216', 'name' => 'Toggle On', 'icon' => 'fas fa-toggle-on'),
        array( 'id' => '1217', 'name' => 'Toilet', 'icon' => 'fas fa-toilet'),
        array( 'id' => '1218', 'name' => 'Toilet Paper', 'icon' => 'fas fa-toilet-paper'),
        array( 'id' => '1219', 'name' => 'Toolbox', 'icon' => 'fas fa-toolbox'),
        array( 'id' => '1220', 'name' => 'Tools', 'icon' => 'fas fa-tools'),
        array( 'id' => '1221', 'name' => 'Tooth', 'icon' => 'fas fa-tooth'),
        array( 'id' => '1222', 'name' => 'Torah', 'icon' => 'fas fa-torah'),
        array( 'id' => '1223', 'name' => 'Torii Gate', 'icon' => 'fas fa-torii-gate'),
        array( 'id' => '1224', 'name' => 'Tractor', 'icon' => 'fas fa-tractor'),
        array( 'id' => '1225', 'name' => 'Trade Federation', 'icon' => 'fab fa-trade-federation'),
        array( 'id' => '1226', 'name' => 'Trademark', 'icon' => 'fas fa-trademark'),
        array( 'id' => '1227', 'name' => 'Traffic Light', 'icon' => 'fas fa-traffic-light'),
        array( 'id' => '1228', 'name' => 'Train', 'icon' => 'fas fa-train'),
        array( 'id' => '1229', 'name' => 'Tram', 'icon' => 'fas fa-tram'),
        array( 'id' => '1230', 'name' => 'Transgender', 'icon' => 'fas fa-transgender'),
        array( 'id' => '1231', 'name' => 'Alternate Transgender', 'icon' => 'fas fa-transgender-alt'),
        array( 'id' => '1232', 'name' => 'Trash', 'icon' => 'fas fa-trash'),
        array( 'id' => '1233', 'name' => 'Alternate Trash', 'icon' => 'fas fa-trash-alt'),
        array( 'id' => '1234', 'name' => 'Trash Restore', 'icon' => 'fas fa-trash-restore'),
        array( 'id' => '1235', 'name' => 'Alternative Trash Restore', 'icon' => 'fas fa-trash-restore-alt'),
        array( 'id' => '1236', 'name' => 'Tree', 'icon' => 'fas fa-tree'),
        array( 'id' => '1237', 'name' => 'Trello', 'icon' => 'fab fa-trello'),
        array( 'id' => '1238', 'name' => 'TripAdvisor', 'icon' => 'fab fa-tripadvisor'),
        array( 'id' => '1239', 'name' => 'trophy', 'icon' => 'fas fa-trophy'),
        array( 'id' => '1240', 'name' => 'truck', 'icon' => 'fas fa-truck'),
        array( 'id' => '1241', 'name' => 'Truck Loading', 'icon' => 'fas fa-truck-loading'),
        array( 'id' => '1242', 'name' => 'Truck Monster', 'icon' => 'fas fa-truck-monster'),
        array( 'id' => '1243', 'name' => 'Truck Moving', 'icon' => 'fas fa-truck-moving'),
        array( 'id' => '1244', 'name' => 'Truck Side', 'icon' => 'fas fa-truck-pickup'),
        array( 'id' => '1245', 'name' => 'T-Shirt', 'icon' => 'fas fa-tshirt'),
        array( 'id' => '1246', 'name' => 'TTY', 'icon' => 'fas fa-tty'),
        array( 'id' => '1247', 'name' => 'Tumblr', 'icon' => 'fab fa-tumblr'),
        array( 'id' => '1248', 'name' => 'Tumblr Square', 'icon' => 'fab fa-tumblr-square'),
        array( 'id' => '1249', 'name' => 'Television', 'icon' => 'fas fa-tv'),
        array( 'id' => '1250', 'name' => 'Twitch', 'icon' => 'fab fa-twitch'),
        array( 'id' => '1251', 'name' => 'Twitter', 'icon' => 'fab fa-twitter'),
        array( 'id' => '1252', 'name' => 'Twitter Square', 'icon' => 'fab fa-twitter-square'),
        array( 'id' => '1253', 'name' => 'Typo3', 'icon' => 'fab fa-typo3'),
        array( 'id' => '1254', 'name' => 'Uber', 'icon' => 'fab fa-uber'),
        array( 'id' => '1255', 'name' => 'Ubuntu', 'icon' => 'fab fa-ubuntu'),
        array( 'id' => '1256', 'name' => 'UIkit', 'icon' => 'fab fa-uikit'),
        array( 'id' => '1257', 'name' => 'Umbrella', 'icon' => 'fas fa-umbrella'),
        array( 'id' => '1258', 'name' => 'Umbrella Beach', 'icon' => 'fas fa-umbrella-beach'),
        array( 'id' => '1259', 'name' => 'Underline', 'icon' => 'fas fa-underline'),
        array( 'id' => '1260', 'name' => 'Undo', 'icon' => 'fas fa-undo'),
        array( 'id' => '1261', 'name' => 'Alternate Undo', 'icon' => 'fas fa-undo-alt'),
        array( 'id' => '1262', 'name' => 'Uniregistry', 'icon' => 'fab fa-uniregistry'),
        array( 'id' => '1263', 'name' => 'Universal Access', 'icon' => 'fas fa-universal-access'),
        array( 'id' => '1264', 'name' => 'University', 'icon' => 'fas fa-university'),
        array( 'id' => '1265', 'name' => 'unlink', 'icon' => 'fas fa-unlink'),
        array( 'id' => '1266', 'name' => 'unlock', 'icon' => 'fas fa-unlock'),
        array( 'id' => '1267', 'name' => 'Alternate Unlock', 'icon' => 'fas fa-unlock-alt'),
        array( 'id' => '1268', 'name' => 'Untappd', 'icon' => 'fab fa-untappd'),
        array( 'id' => '1269', 'name' => 'Upload', 'icon' => 'fas fa-upload'),
        array( 'id' => '1270', 'name' => 'UPS', 'icon' => 'fab fa-ups'),
        array( 'id' => '1271', 'name' => 'USB', 'icon' => 'fab fa-usb'),
        array( 'id' => '1272', 'name' => 'User', 'icon' => 'fas fa-user'),
        array( 'id' => '1273', 'name' => 'Alternate User', 'icon' => 'fas fa-user-alt'),
        array( 'id' => '1274', 'name' => 'Alternate User Slash', 'icon' => 'fas fa-user-alt-slash'),
        array( 'id' => '1275', 'name' => 'User Astronaut', 'icon' => 'fas fa-user-astronaut'),
        array( 'id' => '1276', 'name' => 'User Check', 'icon' => 'fas fa-user-check'),
        array( 'id' => '1277', 'name' => 'User Circle', 'icon' => 'fas fa-user-circle'),
        array( 'id' => '1278', 'name' => 'User Clock', 'icon' => 'fas fa-user-clock'),
        array( 'id' => '1279', 'name' => 'User Cog', 'icon' => 'fas fa-user-cog'),
        array( 'id' => '1280', 'name' => 'User Edit', 'icon' => 'fas fa-user-edit'),
        array( 'id' => '1281', 'name' => 'User Friends', 'icon' => 'fas fa-user-friends'),
        array( 'id' => '1282', 'name' => 'User Graduate', 'icon' => 'fas fa-user-graduate'),
        array( 'id' => '1283', 'name' => 'User Injured', 'icon' => 'fas fa-user-injured'),
        array( 'id' => '1284', 'name' => 'User Lock', 'icon' => 'fas fa-user-lock'),
        array( 'id' => '1285', 'name' => 'Doctor', 'icon' => 'fas fa-user-md'),
        array( 'id' => '1286', 'name' => 'User Minus', 'icon' => 'fas fa-user-minus'),
        array( 'id' => '1287', 'name' => 'User Ninja', 'icon' => 'fas fa-user-ninja'),
        array( 'id' => '1288', 'name' => 'Nurse', 'icon' => 'fas fa-user-nurse'),
        array( 'id' => '1289', 'name' => 'User Plus', 'icon' => 'fas fa-user-plus'),
        array( 'id' => '1290', 'name' => 'User Secret', 'icon' => 'fas fa-user-secret'),
        array( 'id' => '1291', 'name' => 'User Shield', 'icon' => 'fas fa-user-shield'),
        array( 'id' => '1292', 'name' => 'User Slash', 'icon' => 'fas fa-user-slash'),
        array( 'id' => '1293', 'name' => 'User Tag', 'icon' => 'fas fa-user-tag'),
        array( 'id' => '1294', 'name' => 'User Tie', 'icon' => 'fas fa-user-tie'),
        array( 'id' => '1295', 'name' => 'Remove User', 'icon' => 'fas fa-user-times'),
        array( 'id' => '1296', 'name' => 'Users', 'icon' => 'fas fa-users'),
        array( 'id' => '1297', 'name' => 'Users Cog', 'icon' => 'fas fa-users-cog'),
        array( 'id' => '1298', 'name' => 'United States Postal Service', 'icon' => 'fab fa-usps'),
        array( 'id' => '1299', 'name' => 'us-Sunnah Foundation', 'icon' => 'fab fa-ussunnah'),
        array( 'id' => '1300', 'name' => 'Utensil Spoon', 'icon' => 'fas fa-utensil-spoon'),
        array( 'id' => '1301', 'name' => 'Utensils', 'icon' => 'fas fa-utensils'),
        array( 'id' => '1302', 'name' => 'Vaadin', 'icon' => 'fab fa-vaadin'),
        array( 'id' => '1303', 'name' => 'Vector Square', 'icon' => 'fas fa-vector-square'),
        array( 'id' => '1304', 'name' => 'Venus', 'icon' => 'fas fa-venus'),
        array( 'id' => '1305', 'name' => 'Venus Double', 'icon' => 'fas fa-venus-double'),
        array( 'id' => '1306', 'name' => 'Venus Mars', 'icon' => 'fas fa-venus-mars'),
        array( 'id' => '1307', 'name' => 'Viacoin', 'icon' => 'fab fa-viacoin'),
        array( 'id' => '1308', 'name' => 'Video', 'icon' => 'fab fa-viadeo'),
        array( 'id' => '1309', 'name' => 'Video Square', 'icon' => 'fab fa-viadeo-square'),
        array( 'id' => '1310', 'name' => 'Vial', 'icon' => 'fas fa-vial'),
        array( 'id' => '1311', 'name' => 'Vials', 'icon' => 'fas fa-vials'),
        array( 'id' => '1312', 'name' => 'Viber', 'icon' => 'fab fa-viber'),
        array( 'id' => '1313', 'name' => 'Video', 'icon' => 'fas fa-video'),
        array( 'id' => '1314', 'name' => 'Video Slash', 'icon' => 'fas fa-video-slash'),
        array( 'id' => '1315', 'name' => 'Vihara', 'icon' => 'fas fa-vihara'),
        array( 'id' => '1316', 'name' => 'Vimeo', 'icon' => 'fab fa-vimeo'),
        array( 'id' => '1317', 'name' => 'Vimeo Square', 'icon' => 'fab fa-vimeo-square'),
        array( 'id' => '1318', 'name' => 'Vimeo', 'icon' => 'fab fa-vimeo-v'),
        array( 'id' => '1319', 'name' => 'Vine', 'icon' => 'fab fa-vine'),
        array( 'id' => '1320', 'name' => 'VK', 'icon' => 'fab fa-vk'),
        array( 'id' => '1321', 'name' => 'VNV', 'icon' => 'fab fa-vnv'),
        array( 'id' => '1322', 'name' => 'Voicemail', 'icon' => 'fas fa-voicemail'),
        array( 'id' => '1323', 'name' => 'Volleyball Ball', 'icon' => 'fas fa-volleyball-ball'),
        array( 'id' => '1324', 'name' => 'Volume Down', 'icon' => 'fas fa-volume-down'),
        array( 'id' => '1325', 'name' => 'Volume Mute', 'icon' => 'fas fa-volume-mute'),
        array( 'id' => '1326', 'name' => 'Volume Off', 'icon' => 'fas fa-volume-off'),
        array( 'id' => '1327', 'name' => 'Volume Up', 'icon' => 'fas fa-volume-up'),
        array( 'id' => '1328', 'name' => 'Vote Yea', 'icon' => 'fas fa-vote-yea'),
        array( 'id' => '1329', 'name' => 'Cardboard VR', 'icon' => 'fas fa-vr-cardboard'),
        array( 'id' => '1330', 'name' => 'Vue.js', 'icon' => 'fab fa-vuejs'),
        array( 'id' => '1331', 'name' => 'Walking', 'icon' => 'fas fa-walking'),
        array( 'id' => '1332', 'name' => 'Wallet', 'icon' => 'fas fa-wallet'),
        array( 'id' => '1333', 'name' => 'Warehouse', 'icon' => 'fas fa-warehouse'),
        array( 'id' => '1334', 'name' => 'Water', 'icon' => 'fas fa-water'),
        array( 'id' => '1335', 'name' => 'Square Wave', 'icon' => 'fas fa-wave-square'),
        array( 'id' => '1336', 'name' => 'Waze', 'icon' => 'fab fa-waze'),
        array( 'id' => '1337', 'name' => 'Weebly', 'icon' => 'fab fa-weebly'),
        array( 'id' => '1338', 'name' => 'Weibo', 'icon' => 'fab fa-weibo'),
        array( 'id' => '1339', 'name' => 'Weight', 'icon' => 'fas fa-weight'),
        array( 'id' => '1340', 'name' => 'Hanging Weight', 'icon' => 'fas fa-weight-hanging'),
        array( 'id' => '1341', 'name' => 'Weixin (WeChat)', 'icon' => 'fab fa-weixin'),
        array( 'id' => '1342', 'name' => 'Whats App', 'icon' => 'fab fa-whatsapp'),
        array( 'id' => '1343', 'name' => 'Whats App Square', 'icon' => 'fab fa-whatsapp-square'),
        array( 'id' => '1344', 'name' => 'Wheelchair', 'icon' => 'fas fa-wheelchair'),
        array( 'id' => '1345', 'name' => 'WHMCS', 'icon' => 'fab fa-whmcs'),
        array( 'id' => '1346', 'name' => 'WiFi', 'icon' => 'fas fa-wifi'),
        array( 'id' => '1347', 'name' => 'Wikipedia W', 'icon' => 'fab fa-wikipedia-w'),
        array( 'id' => '1348', 'name' => 'Wind', 'icon' => 'fas fa-wind'),
        array( 'id' => '1349', 'name' => 'Window Close', 'icon' => 'fas fa-window-close'),
        array( 'id' => '1350', 'name' => 'Window Maximize', 'icon' => 'fas fa-window-maximize'),
        array( 'id' => '1351', 'name' => 'Window Minimize', 'icon' => 'fas fa-window-minimize'),
        array( 'id' => '1352', 'name' => 'Window Restore', 'icon' => 'fas fa-window-restore'),
        array( 'id' => '1353', 'name' => 'Windows', 'icon' => 'fab fa-windows'),
        array( 'id' => '1354', 'name' => 'Wine Bottle', 'icon' => 'fas fa-wine-bottle'),
        array( 'id' => '1355', 'name' => 'Wine Glass', 'icon' => 'fas fa-wine-glass'),
        array( 'id' => '1356', 'name' => 'Alternate Wine Glas', 'icon' => 'fas fa-wine-glass-alt'),
        array( 'id' => '1357', 'name' => 'Wix', 'icon' => 'fab fa-wix'),
        array( 'id' => '1358', 'name' => 'Wizards of the Coast', 'icon' => 'fab fa-wizards-of-the-coast'),
        array( 'id' => '1359', 'name' => 'Wolf Pack Battalion', 'icon' => 'fab fa-wolf-pack-battalion'),
        array( 'id' => '1360', 'name' => 'Won Sign', 'icon' => 'fas fa-won-sign'),
        array( 'id' => '1361', 'name' => 'WordPress Logo', 'icon' => 'fab fa-wordpress'),
        array( 'id' => '1362', 'name' => 'Wordpress Simple', 'icon' => 'fab fa-wordpress-simple'),
        array( 'id' => '1363', 'name' => 'WPBeginner', 'icon' => 'fab fa-wpbeginner'),
        array( 'id' => '1364', 'name' => 'WPExplorer', 'icon' => 'fab fa-wpexplorer'),
        array( 'id' => '1365', 'name' => 'WPForms', 'icon' => 'fab fa-wpforms'),
        array( 'id' => '1366', 'name' => 'wpressr', 'icon' => 'fab fa-wpressr'),
        array( 'id' => '1367', 'name' => 'Wrench', 'icon' => 'fas fa-wrench'),
        array( 'id' => '1368', 'name' => 'X-Ray', 'icon' => 'fas fa-x-ray'),
        array( 'id' => '1369', 'name' => 'Xbox', 'icon' => 'fab fa-xbox'),
        array( 'id' => '1370', 'name' => 'Xing', 'icon' => 'fab fa-xing'),
        array( 'id' => '1371', 'name' => 'Xing Square', 'icon' => 'fab fa-xing-square'),
        array( 'id' => '1372', 'name' => 'Y Combinator', 'icon' => 'fab fa-y-combinator'),
        array( 'id' => '1373', 'name' => 'Yahoo Logo', 'icon' => 'fab fa-yahoo'),
        array( 'id' => '1374', 'name' => 'Yammer', 'icon' => 'fab fa-yammer'),
        array( 'id' => '1375', 'name' => 'Yandex', 'icon' => 'fab fa-yandex'),
        array( 'id' => '1376', 'name' => 'Yandex International', 'icon' => 'fab fa-yandex-international'),
        array( 'id' => '1377', 'name' => 'Yarn', 'icon' => 'fab fa-yarn'),
        array( 'id' => '1378', 'name' => 'Yelp', 'icon' => 'fab fa-yelp'),
        array( 'id' => '1379', 'name' => 'Yen Sign', 'icon' => 'fas fa-yen-sign'),
        array( 'id' => '1380', 'name' => 'Yin Yang', 'icon' => 'fas fa-yin-yang'),
        array( 'id' => '1381', 'name' => 'Yoast', 'icon' => 'fab fa-yoast'),
        array( 'id' => '1382', 'name' => 'YouTube', 'icon' => 'fab fa-youtube'),
        array( 'id' => '1383', 'name' => 'YouTube Square', 'icon' => 'fab fa-youtube-square'),
        array( 'id' => '1384', 'name' => 'Zhihu', 'icon' => 'fab fa-zhihu') 
    );

}


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
   $html .= '/>';
   return $html; 
}


function assetVideo($video){
    // $vPath  = ($video->status == 2)?('media/private/'):('media/public/');
    $vPath  = 'stream/';
    $vPath .= $video->file;
    return asset( $vPath );
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

// function getCompany(){
//     $company = array(
//         0 => 'Please Choose',
//         1 => 'BHP Group Limited',
//         2 => 'Westpac Banking Corp',
//         3 => 'National Australia Bank',
//         4 => 'ANZ Banking Group Limited',
//         5 => 'Woolworths Group Limited',

//     ); 
//     return $company;
// }

// Added by Hassan
 
