<tr>
@if(setting('admin-logo'))
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<img src="{{setting('admin-logo')}}" class="logo" alt="{{setting('admin-area-website-title')}}">
@else
{{ $slot }}
@endif
</a>
</td>
@endif
</tr>
