@extends('mobile.user.usermaster')


@section('content')

 <div class="newJobCont">
    <div class="head icon_head_browse_matches">My Jobs</div>

    <div class="add_new_job">
         
        <!-- =============================================================================================================================== -->
            @include('mobile.jobs.filter')
        <!-- =============================================================================================================================== -->
        
        <!-- =============================================================================================================================== -->
         <div class="jobs_list">
            
         </div>
        <!-- =============================================================================================================================== -->

    </div>

    <div class="cl"></div>
</div>
 
 
 


@stop

 
@section('custom_footer_css')
@stop

@section('custom_js')

<script type="text/javascript">
$(document).ready(function(){ })
</script>
@stop

