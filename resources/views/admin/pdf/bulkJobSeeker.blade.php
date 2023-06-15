@extends('admin.pdf.pdfmaster')

@section('header_css')
<style type="text/css">
 @page {
    margin: 20px !important;
    padding: 20px 10px !important;
 }
/*body{ border:1px solid black;  position: relative; }*/

/*.left_info *{ border: 1px solid red;  }*/
.center{ text-align: center; }
a.contactBtn {
    background: #384171;
    color: white;
    padding: 6px 10px;
    border-radius: 4px;
    border: 0px;
    font-size: 12px;
    text-decoration: none;
    display: inline-block;
    display: block;
    margin: 0 auto;
    width: 80px;
    cursor:pointer;
}
.name_title {
    font-size: 18px;
    font-weight: 700;
}
td.updf_detai .label { font-weight: 700; margin-right: 5px;}
.updf_row{ padding: 10px;  }
tr.updf_row td {
    border-bottom: 1px solid #FF9800;
    padding: 6px;
    font-size: 12px;
}
.updf_detail { margin: 8px; }
.updf_thumb {
    overflow: hidden;
    display: inline-block;
    border-radius: 50%;
    text-align: center;
    display: block;
    margin: 0px;
    margin-bottom: 4px;
}
.updf_thumb img{  border-radius: 50%; }
.updf_detailbtn{ display: table; }
td.center.left_info {
    text-align: center;
}
</style>
@stop

@section('content')

{{-- @dd($users) --}}

{{-- <div style="border: 2px solid red; padding: 20px; width: 700px;"></div> --}}

<table width="100%" style="width:100%" border="0" cellpadding="0" cellspacing="0" >
    @php
        $audio_base_url = asset('media/public/audio');
        // dd($audio_base_url .'/' .$users['0']->vidoes()->first()->audio_path);
    @endphp
    @foreach ($users as $user)

 {{--   @dump($user->profileImage) --}}
  <tr class="updf_row">
    <td width="20%" class="center left_info">
    	<div class="updf_thumb">
            <img src="{{asset('images/site/icons/nophoto.jpg')}}">
    		  {{-- @if($user->profileImage)
					<img src="{{assetGallery2($user->profileImage,'small')}}">
				@else
					<img src="{{asset('images/site/icons/nophoto.jpg')}}">
				@endif --}}
			</div>
            {{-- <audio controls>
                <source src="{{ $audio_base_url .'/' .$user->vidoes()->first()->audio_path }}" type="audio/mpeg">     
            </audio> --}}
			<a class="contactBtn" target="”_blank”" href="{{ $audio_base_url .'/' .$user->vidoes()->first()->audio_path }}" {{-- onclick="pdfVideo('{{ $audio_base_url .'/' .$user->vidoes()->first()->audio_path }}')" --}}> Audio Preview</a>
		</td>

    <td width="80%" class="updf_detai">
    		<div class="name_title">{{$user->username}}</div>
    		<div class="updf_recent_job">{{$user->recentJob}} {{-- at {{$user->organHeldTitle}} --}} </div>
    		<div class="updf_intrested"><span class="label">Interested In:</span> {{$user->interested_in}}</div>
    		<div class="updf_salary_exp"><span class="label">Salary Expectation:</span> {{getSalariesRangeLavel($user->salaryRange)}}</div>
    		<div class="updf_location"><span class="label">Location:</span>{{userLocation($user)}}</div>
    		@php 
               $jsQualification = ''; 
               if ($user->qualificationType == "post_degree") {
                  $userQualification = 'post graduate degree';
               }else{
                  $userQualification = $user->qualificationType;
               }
            @endphp            
            <div class="updf_location">
                <span class="label">Qualification Type:</span>
                {{remove_underscode($userQualification)}}
            </div>
            <div class="updf_qualification">
    				<span class="label">Qualification:</span>
    				@if($user->qualification)
    					@foreach (getQualificationNames($user->qualification) as $qualification)
    						<span>{{$qualification}}</span>
    					@endforeach
    				@endif
    		</div>
    		<div class="updf_industryexp">
    			<span class="label">Industry Experience:</span>
    				@if($user->industry_experience)
    					@foreach ($user->industry_experience as $exp)
    						<span>{{getIndustryName($exp)}}</span>
    					@endforeach
    				@endif
    		</div>
    		<div class="updf_aboutme">
    			<span class="label">About:</span>
    			{{$user->about_me}}
    		</div>
            <div class="updf_aboutme">
                <span class="label">Skills:</span>
                @foreach($user->tags as $tag)
                    {{$tag->title}}{{!$loop->last? ',':''}}
                @endforeach
            </div>
    </td>
  </tr>
  @endforeach
</table>


{{-- <div class="userList">
	@foreach ($users as $user)
	<div class="userPdfBox">
		<div class="updf_left">
			<div class="updf_thumb">
				<img src="https://s.mustakbil.com/users/3ca089b499d44692bc550712fd9bd075.jpg" alt="undefined"  class="ng-star-inserted">
			</div>
			<div class="updf_detailbtn"></div>
		</div>
		<div class="updf_right"></div>
	</div>
	@endforeach
</div> --}}

@stop

<script type="text/javascript">
    this.pdfVideo = function(url){
        window.open(url,'popUpWindow','height=420,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }
    
</script>