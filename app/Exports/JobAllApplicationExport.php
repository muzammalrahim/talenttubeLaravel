<?php

namespace App\Exports;

use App\User;
use App\JobsApplication;
use App\JobsQuestions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobAllApplicationExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $id;

    public function __construct($id) 
    {
        $this->id = $id;
    }


    public function headings(): array {

        // return [
        //     'Job ID','Job Title','Type','Experience','Expiration','Application Id','Applicant Name','Surname','Email','Phone','City','State','Country','Salary Range', 'Recent Job'
        // ];

         $header   = array(); 
         $header[] = 'Job ID'; 
         $header[] = 'Job Title';
         $header[] = 'Type';
         $header[] = 'Experience';
         $header[] = 'Expiration';
         $header[] = 'Application Id';
         $header[] = 'Applicant Name';
         $header[] = 'Surname';
         $header[] = 'Email';
         $header[] = 'Phone';
         $header[] = 'City';
         $header[] = 'State';
         $header[] = 'Country';
         $header[] = 'Salary Range'; 
         $header[] = 'Recent Job';

        $jobQuestions = JobsQuestions::where('job_id', $this->id)->get(); 
        if(!empty($jobQuestions)){
            foreach ($jobQuestions as $question) {
                 $header[] =  $question->title;
            }
        }
        // dd($jobQuestions);
        return $header; 


    }


    public function collection(){

        $applications = JobsApplication::with([
                    'jobseeker:id,name,surname,email,phone,city,state,country,salaryRange,recentJob',
                    'job:id,title,type,experience,expiration',
                    'answers'
                ])->where('job_id', $this->id)->get();    

        // dd($applications);

        $collectionData = []; 
        if(!empty($applications)){
            foreach ($applications as $application) {
            // dd( $application );
             $collRow = []; 
             $collRow['job_id'] = $application->job->id; 
             $collRow['title'] = $application->job->title; 
             $collRow['type'] = $application->job->type;
             $collRow['experience'] = $application->job->experience; 
             $collRow['expiration'] = $application->job->expiration;
             $collRow['app_id'] = $application->id; 
             $collRow['name'] = $application->jobseeker->name; 
             $collRow['surname'] = $application->jobseeker->surname; 
             $collRow['email'] = $application->jobseeker->email; 
             $collRow['phone'] = $application->jobseeker->phone; 
             $collRow['city'] = $application->jobseeker->city; 
             $collRow['state'] = $application->jobseeker->state; 
             $collRow['country'] = $application->jobseeker->country; 
             $collRow['salaryRange'] = $application->jobseeker->salaryRange; 
             $collRow['recentJob'] = $application->jobseeker->recentJob;    

             if(!empty($application->answers)){
                foreach ($application->answers as $akey => $answer) {
                    $collRow['answer_'.$answer->question_id] = $answer->answer; 
                }
             }

             $collectionData[] =  $collRow; 
            }
        }

        // dd( $collectionData); 

        $collection = collect($collectionData);
        return $collection; 
    }


    
}
