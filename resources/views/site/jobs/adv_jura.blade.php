
@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    // dd($job);
@endphp

<source>
    <publisher>http://www.talenttube.org</publisher>    
     <lastBuildDate>2018-12-04 00:00:00 UTC</lastBuildDate>
    <job>
        <title><![CDATA[{{ $job->title }}]]></title>
        <date><![CDATA[ {{ $job->created_at }} ]]></date>    
        <referencenumber><![CDATA[ {{ $job->code }} ]]></referencenumber>
        <url>
            <![CDATA[http://talenttube.org/jobs/{{ $id }}]]>
        </url>

        <listed_date>
            <![CDATA[ {{ $job->created_at }} ]]>
        </listed_date>

        <closing_date>
            <![CDATA[ {{ $job->expiration }} ]]>
        </closing_date>

        <company><![CDATA[ {{ $job->jobEmployer->company }} ]]></company>
        <city><![CDATA[ {{ $job->city }} ]]></city>
        <state><![CDATA[ {{ $job->state }} ]]></state>
        <country><![CDATA[ {{ $job->country }} ]]></country>
        <description>
            <![CDATA[ {{ $job->description }} ]]>
        </description>
        <salary><![CDATA[ {{ $job->salary }} ]]></salary>
        <jobtype><![CDATA[ {{ $job->type  }} ]]></jobtype>
        <url><![CDATA[ {{ route('jobDetail',['id' => $job->id]) }} ]]></url>
        <experience><![CDATA[ {{ $job->experience  }} ]]></experience>       
    </job>
</source>

