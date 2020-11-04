<div id="colfix_l_bl" class="col left to_show move">
    <div class="bl_logo">
        <a href="{{route('homepage')}}" class="logo"><img src="{{asset('/images/site/logo_inner.png')}}" style="max-width:183px; max-height: 60px;" alt="" /></a>
    </div>
    <div id="colfix_l" class="cont col_fix">
        <ul class="nav leftmenu">

            @if(!@empty($interview))
                <li><a href="{{route('interviewconcierge')}}" class="column_narrow_search_results {{(request()->is('interviewconcierge*'))?'active':''}}"><span class="icon"></span>Interview Concierge</a></li>
            @endif

        </ul>

        <div id="bl_banner_l_empty" class="bl_banner_empty"></div>
    </div>
</div>

<style>
    #colfix_l, .colfix_r_bg, .colfix_r_bg_head {
        background-color: #142d69;
    }
</style>
