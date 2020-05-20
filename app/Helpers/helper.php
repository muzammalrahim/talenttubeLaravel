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


function hasBlockYou($me, $user){

    $hasBlock = true;
    if ( empty($me) || empty($user) ){ return $hasBlock; }
    $userBlock = App\BlockUser::where('user_id',$me->id)->where('block',$user->id)->first();
    if ($userBlock === null){ $hasBlock = false; }
    return $hasBlock;

}

function get_Geo_Country(){
    $countries = DB::table('geo_country')->get();
    return $countries;
}


function get_Geo_State($country){
    $states = DB::table('geo_state')->where('country_id', $country)->get();
    return $states;
}

function get_Geo_City($country, $state){
    $cities = DB::table('geo_city')->where('country_id', $country)->where('state_id', $state)->get();
    return $cities;
}


if (! function_exists('str_random')) {
    function str_random($length = 16) { return Str::random($length); }
}

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
        "1"	=>	'English',
        "2"	=>	'Deutsch',
        "3"	=>	'Français',
        "4"	=>	'Español',
        "5"	=>	'Italiano',
        "6"	=>	'‏עברית‏',
        "7"	=>	'中文(简体)',
        "8"	=>	'Qafar',
        "9"	=>	'Afrikaans',
        "10"	=>	'اردو',
        "11"	=>	'العربية',
        "12"	=>	'Азәрбајҹан',
        "13"	=>	'Беларуская',
        "14"	=>	'Български',
        "15"	=>	'Català',
        "16"	=>	'Čeština',
        "17"	=>	'Dansk',
        "18"	=>	'Ελληνικά',
        "19"	=>	'Eesti',
        "20"	=>	'فارسی',
        "21"	=>	'Suomi',
        "22"	=>	'Gaeilge',
        "23"	=>	'हिंदी',
        "24"	=>	'Hrvatski',
        "25"	=>	'Magyar',
        "26"	=>	'Հայերէն',
        "27"	=>	'日本語',
        "28"	=>	'ქართული',
        "29"	=>	'Қазақ',
        "30"	=>	'Lietuvių',
        "31"	=>	'Latviešu',
        "32"	=>	'Nederlands',
        "33"	=>	'Polski',
        "34"	=>	'Português',
        "35"	=>	'Română',
        "36"	=>	'Русский',
        "37"	=>	'Slovenský',
        "38"	=>	'Slovenščina',
        "39"	=>	'Shqipe',
        "40"	=>	'Српски',
        "41"	=>	'Svenska',
        "42"	=>	'Türkçe',
        "43"	=>	'Татар',
        "44"	=>	'Українська',
        "45"	=>	'Ўзбек',
        "46"	=>	'অসমীয়া',
        "47"	=>	'বাংলা',
        "48"	=>	'Cymraeg',
        "49"	=>	'ދިވެހިބަސް',
        "50"	=>	'Esperanto',
        "51"	=>	'Euskara',
        "52"	=>	'Føroyskt',
        "53"	=>	'Galego',
        "54"	=>	'ગુજરાતી',
        "55"	=>	'Gaelg',
        "56"	=>	'ʻōlelo Hawaiʻi',
        "57"	=>	'Bahasa Indonesia',
        "58"	=>	'Íslenska',
        "59"	=>	'Kalaallisut',
        "60"	=>	'한국어',
        "61"	=>	'कोंकणी',
        "62"	=>	'Кыргыз',
        "63"	=>	'Kernewek',
        "64"	=>	'Македонски',
        "65"	=>	'Монгол хэл',
        "66"	=>	'मराठी',
        "67"	=>	'Bahasa Melayu',
        "68"	=>	'Malti',
        "69"	=>	'Norsk bokmål',
        "70"	=>	'Norsk nynorsk',
        "71"	=>	'Oromoo',
        "72"	=>	'ਪੰਜਾਬੀ',
        "73"	=>	'پښتو',
        "74"	=>	'संस्कृत',
        "75"	=>	'Sidaamu Afo',
        "76"	=>	'Soomaali',
        "77"	=>	'Kiswahili',
        "78"	=>	'தமிழ்',
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




function my_sanitize_number($number) {
    return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
}

function my_sanitize_decimal($decimal) {
    return filter_var($decimal, FILTER_SANITIZE_NUMBER_FLOAT);
}

function my_sanitize_string($string) {
    $string = strip_tags($string);
    $string = addslashes($string);
    return filter_var($string, FILTER_SANITIZE_STRING);
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
