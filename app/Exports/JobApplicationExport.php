<?php

namespace App\Exports;

use App\User;
use App\JobsApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobApplicationExport implements FromCollection, WithHeadings
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
            'Job ID','Job Title','Type','Experience','Expiration','Application Id','Applicant Name','Surname','Email','Phone','City','State','Country','Salary Range', 'Recent Job'
        ];
    }


    public function collection(){

         $applications = JobsApplication::with([
                    'jobseeker:id,name,questions,industry_experience,surname,email,phone,city,state,country,salaryRange,recentJob',
                    'job:id,title,type,experience,expiration'
                ])->whereIn('id', $this->ids)->get();

        $collectionData = [];
        if(!empty($applications)){
            foreach ($applications as $application) {
             $collRow = [];
             $collRow['job_id'] = $application->job->id;
             $collRow['title'] = $application->job->title;
             $collRow['type'] = $application->job->type;
             $industries = "";
            if(!empty($application->jobseeker->industry_experience)){
                foreach( $application->jobseeker->industry_experience as $indus)
                $industries = $industries."\r\n ".getIndustryName($indus);
            }


             $collRow['experience'] = $industries;
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




            //    $collectionData[] =  $collRow;

             $collectionData[] =  $collRow;
            }
        }
        $collection = collect($collectionData);
        return $collection;
    }



}
