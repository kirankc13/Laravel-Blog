<div class="widget-simple-sm-statistic">
    <div class="number">{{$todays_data['ga:pageviews']}}</div>
    <div class="caption color-purple">Page views today</div>
</div>
<div class="widget-simple-sm-bottom statistic">
    @if($views_percent_change > 0)
    <span class="arrow color-green">↑</span> {{abs($views_percent_change)}}% increase <strong><span class="hint-circle" data-toggle="tooltip" data-placement="top" title="Page views increased by {{abs($views_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:pageviews']}})" data-original-title="Page views increased by {{abs($views_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:pageviews']}})">?</span></strong>
    @else
    <span class="arrow color-red">↓</span> {{abs($views_percent_change)}}% decrease <strong><span class="hint-circle" data-toggle="tooltip" data-placement="top" title="Page views decreased by {{abs($views_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:pageviews']}})" data-original-title="Page views decreased by {{$views_percent_change}}% compared to yesterday ({{$yesterdays_data['ga:pageviews']}})">?</span></strong>
    @endif
</div>