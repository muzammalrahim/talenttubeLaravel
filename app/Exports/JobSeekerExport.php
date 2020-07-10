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
            'ID','Name','Surname','Email','Username','Phone','Country','State','City','About Me','Interested In','Recent Job','Salary Range'
        ];
    }


    public function collection()
    {
        // return User::whereIn('id', $this->ids)->get();
         $users = User::select('id', 'name','surname','email','username','phone','country','state','city','about_me','interested_in','recentJob','salaryRange')
         		->whereIn('id', $this->ids)->get();

         	// dd($users); 
         		return $users; 

    }
}
