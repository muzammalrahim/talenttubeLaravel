{{-- @extends('site.user.usertemplate') --}}

@extends('web.user.usermaster')

@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop

@section('content')

{{-- html for block user page --}}

{{-- @dd('coming') --}}

<section class="row">
    <div class="col-md-12">
        <div class="profile profile-section">
            <h2>Block Users Lists</h2>
            <div class="row">
                @if ($blockUsers->count() > 0)
                @foreach ($blockUsers as $blockuser)
                @php
                $js = $blockuser->user;
                @endphp                   
                <div class="col-sm-12 col-md-12 remjs_{{ $js->id }}">
                    <div class="job-box-info block-box clearfix">
                        <div class="box-head">
                            <h4>No Match potential</h4>                          
                        </div>
                        <div class="row Block-user-wrapper">
                            <div class="col-md-2 user-images">
                                <div class="block-user-img ">
                                    @php
                                    $profile_image  = asset('images/site/icons/nophoto.jpg');
                                    $profile_image_gallery    = $js->profileImage()->first();
                                    // dump($profile_image_gallery);
                                    if ($profile_image_gallery) {
                                        // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                                        $profile_image   = assetGallery2($profile_image_gallery,'small');
                                        // dump($profile_image);
                                    }
                                    @endphp
                                    <img src="{{$profile_image}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-10 user-details">
                                <div class="row blocked-user-about">
                                    <h6 class="p-0">About me:</h6>
                                    <p>{{$js->about_me}}</p>
                                </div>
                                <div class="row blocked-user-about">
                                    <h6 class="p-0">Intrested In:</h6>
                                    <p>{{$js->interested_in}}</p>
                                </div>
                                <div class="row blocked-user-about">
                                    <h6 class="p-0">Location:</h6>
                                    <p>{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                                </div>
                                <div class="row blocked-user-experience">
                                    <h6 class="p-0">Industory Experience:</h6>
                                    @if(isset($js->industry_experience))
                                    @foreach ($js->industry_experience as $ind)
                                    <ul class="indsutrySelect p-0">
                                        <li> <p>{{getIndustryName($ind)}}</p></li>
                                    </ul>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <button class="unblock-btn" onclick="unblockEmployer('{{ $js->id }}')"  data-toggle="modal" data-target="#unblockUserModal"><i class="fas fa-ban"  ></i>UnBlock</button>
                          
                        </div>
                        
                    </div>
                </div>

                @endforeach
                @else
                @if (!isEmployer())
                    <h3>You have not blocked any Employers</h3>
                    {{-- expr --}}

                    @else
                    <h3>You have not blocked any Jobseekers</h3>

                @endif
                @endif 
            </div>
        </div>
    </div>
</section>


{{-- modal for unblock user of block page --}}

<!-- ====================================================================================Modal -->

@include('web.modals.unblockEmployer')

{{-- end html for block user page --}}

@stop

@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
<script src="{{ asset('js/web/profile.js') }}"></script>

@stop

