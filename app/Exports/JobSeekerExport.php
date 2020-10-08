<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobSeekerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }


    public function headings(): array
    {
        return [
            'ID','Name','Surname','Email','Username','Phone','Country','State','City','About Me','Interested In','Recent Job','Salary Range','industry experience', 'qualification', 'questions'
        ];
    }


    public function collection()
    {
        // return User::whereIn('id', $this->ids)->get();
         $users = User::select('id', 'name','surname','email','username','phone','country','state','city','about_me','interested_in','recentJob','salaryRange', 'industry_experience', 'qualification','questions')
         		->whereIn('id', $this->ids)->get();

         	// dd($users);

                 $collectionData = [];
                 if(!empty($users)){
                    foreach ($users as $user) {
                    // dd( $application );
                    $collRow = [];
                    $collRow['id'] = $user->id;
                    $collRow['name'] = $user->name;
                    $collRow['surname'] = $user->surname;
                    $collRow['email'] = $user->email;
                    $collRow['username'] = $user->username;
                    $collRow['phone'] = $user->phone;
                    $collRow['country'] = $user->country;
                    $collRow['state'] = $user->state;
                    $collRow['city'] = $user->city;
                    $collRow['about_me'] = $user->about_me;
                    $collRow['interested_in'] = $user->interested_in;
                    $collRow['recentJob'] = $user->recentJob;
                    $collRow['salaryRange'] = $user->salaryRange;

                    $industries = "";
                    foreach($user->industry_experience as $indus)
                    $industries = $industries."\r\n ".getIndustryName($indus);
                    $collRow['industry_experience'] = $industries;


                    $qualifications = "";
                    $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
                    foreach($qualificationsData as $qualification){
                        $qualifications= $qualifications.$qualification['title']." \r\n ";
                    }

                    $collRow['qualification'] = $qualifications;


                    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array());
                    $empquestion = getUserRegisterQuestions();

                    $questions = "";
                    foreach ($empquestion as $qk => $empq)
                    {
                        $questions = $questions. " ".$empq." ".$userQuestions[$qk]." \r\n";

                    }

                      $collRow['questions'] = $questions;
                      $collectionData[] =  $collRow;
                     }
                 }

                 // dd( $collectionData);

                 $collection = collect($collectionData);
                 return $collection;

    }
}
