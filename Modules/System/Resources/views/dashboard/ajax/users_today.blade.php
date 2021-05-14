<div class="widget-simple-sm-statistic">
    <div class="number">{{$todays_data['ga:users']}}</div>
    <div class="caption color-blue">Users Today</div>
</div>
<div class="widget-simple-sm-bottom statistic">
    @if($users_percent_change > 0)
    <span class="arrow color-green">↑</span> {{abs($users_percent_change)}}% increase <strong><span class="hint-circle" data-toggle="tooltip" data-placement="top" title="Users increased by {{abs($users_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:users']}})" data-original-title="Users increased by {{abs($users_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:users']}})">?</span></strong>
    @else
    <span class="arrow color-red">↓</span> {{abs($users_percent_change)}}% decrease <strong><span class="hint-circle" data-toggle="tooltip" data-placement="top" title="Users decreased by {{abs($users_percent_change)}}% compared to yesterday ({{$yesterdays_data['ga:users']}})" data-original-title="Users decreased by {{$users_percent_change}}% compared to yesterday ({{$yesterdays_data['ga:users']}})">?</span></strong>
    @endif
</div>