
@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    // dd($job);
@endphp

<source>
    <publisher>http://www.talenttube.org</publisher>    
    {{-- <publisherurl>http://www.talenttube.org</publisherurl> --}}

     <lastBuildDate>2018-12-04 00:00:00 UTC</lastBuildDate>
    {{-- <lastBuildDate>{{ $job->title }}</lastBuildDate> --}}
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
        {{-- <sourcename><![CDATA[ABC Medical Group]]></sourcename> --}}
        <city><![CDATA[ {{ $job->city }} ]]></city>
        <state><![CDATA[ {{ $job->state }} ]]></state>
        <country><![CDATA[ {{ $job->country }} ]]></country>
        {{-- <postalcode><![CDATA[85003]]></postalcode> --}}
        {{-- <email><![CDATA[example@abccorp.com]]></email> --}}
        <description>
            <![CDATA[ {{ $job->description }} ]]>
        </description>
        <salary><![CDATA[ {{ $job->salary }} ]]></salary>
        {{-- <education><![CDATA[Bachelors]]></education> --}}
        <jobtype><![CDATA[ {{ $job->type  }} ]]></jobtype>
        {{-- <category><![CDATA[Category1, Category2, CategoryN]]></category> --}}
        <experience><![CDATA[ {{ $job->experience  }} ]]></experience>       
    </job>
</source>

