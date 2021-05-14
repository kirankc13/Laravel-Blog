<div class="widget-simple-sm-statistic">
    <div class="number">{{$todays_data['ga:sessions']}}</div>
    <div class="caption color-blue">Sessions Today</div>
</div>
<div class="widget-simple-sm-bottom statistic">
    @if($sessions_percent_change > 0)
    <span class="arrow color-green">↑</span> {{abs($sessions_percent_change)}}% increase <strong><span class="hint-circle" data-toggle="tooltip" data-placement="top" title="Sessions increased by {{abs($sessions_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:sessions']}})" data-original-title="Sessions increased by {{$sessions_percent_change}}% compared to yesterday ({{$yesterdays_data['ga:sessions']}})">?</span></strong>
    @else
    <span class="arrow color-red">↓</span> {{abs($sessions_percent_change)}}% decrease <strong><span class="hint-circle" data-toggle="tooltip" data-placement="top" title="Sessions decreased by {{abs($sessions_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:sessions']}})" data-original-title="Sessions decreased by {{$sessions_percent_change}}% compared to yesterday ({{$yesterdays_data['ga:sessions']}})">?</span></strong>
    @endif
</div>