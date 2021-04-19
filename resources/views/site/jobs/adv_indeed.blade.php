
@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp

<source>
    <publisher>Talenttube</publisher>    
    <publisherurl>http://www.creativedev22.xyz</publisherurl>
    {{-- <lastBuildDate>{{ $job->title }}</lastBuildDate> --}}
    <job>
        <title><![CDATA[{{ $job->title }}]]></title>
        <date><![CDATA[ {{ $job->created_at }} ]]></date>    
        <referencenumber><![CDATA[ {{ $job->code }} ]]></referencenumber>
        <url>
            <![CDATA[http://www.examplesite.com/viewjob.cfm?jobid=unique123131&source=Indeed]]>
        </url>
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

