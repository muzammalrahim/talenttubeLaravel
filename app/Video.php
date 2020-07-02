<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

class Video extends Model{

	protected $casts = [
        'thumbs' => 'array',
    ];

    //

function generateThumbs(){
	// dd(' generateThumbs ', $this );

	// private media file 
	if ($this->status == 2){
		
		$exists = Storage::disk('privateMedia')->exists($this->file);
		if($exists){

			$privateMedia 	= Storage::disk('privateMedia');
			$video_file = FFMpeg::fromFilesystem($privateMedia)->open($this->file);

			$duration = $video_file->getDurationInSeconds(); 
			$thumbnailIntervalTimeArr = $this->getThumbnailIntervalTimeArr($duration); 

			// dd($thumbnailIntervalTimeArr); 
			$thumbs = array(); 

			if (!empty($thumbnailIntervalTimeArr) && count($thumbnailIntervalTimeArr) > 0){
				 $counter = 1;
	       foreach ($thumbnailIntervalTimeArr as $interval){
	       			$internal_format = str_replace('.', '-', $interval);
	            $image = $video_file->getFrameFromSeconds($interval)->export()->save($this->user_id .'/videos/thumbs/'.$this->id.'/FramAt'.$internal_format.'.png');   
	            $thumbs[] = 'FramAt'.$internal_format.'.png';
	            $counter++;

	       }
	       // $this->thumbs = json_encode($thumbs);
	       $this->thumbs = $thumbs;
	       $this->save();
			}
			 

		}
	}
}




 	private function getThumbnailIntervalTimeArr($duration){ 
    $durationInSec = intval($duration); 
    $intervalArr = range(0,$duration, $duration/5); 
    return array_slice($intervalArr, 1, -1); 
  }



function deleteFiles(){
		$disk = ($this->status == 2)?('privateMedia'):('publicMedia');
	  
	  $exists = Storage::disk($disk)->exists($this->file);
		if($exists){ Storage::disk($disk)->delete($this->file);  }

		// delete thumbs
		$thumb_folder = $this->user_id .'/videos/thumbs/'.$this->id; 
	 
		$exists = Storage::disk($disk)->exists($thumb_folder);
		if($exists){ 
			$th_files =   Storage::disk($disk)->allFiles($thumb_folder);
			if(!empty($th_files)){ Storage::disk($disk)->delete($th_files);	 }

			// delte thumb folder 
			Storage::disk($disk)->deleteDirectory($thumb_folder);  
		}
		


}



}
