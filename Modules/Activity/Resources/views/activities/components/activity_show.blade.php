@if($key == 'status')
<tr>
    <th scope="row">{{str_replace('.',' ',str_replace('_',' ',ucwords($key)))}}</th>
    <td>{!!$val ? 'Active' : 'In-active'!!}</td>
</tr>
@elseif($key == 'for_developer' || $key == 'user_configurable')
<tr>
    <th scope="row">{{str_replace('.',' ',str_replace('_',' ',ucwords($key)))}}</th>
    <td>{!!$val ? 'Yes' : 'No'!!}</td>
</tr>
@elseif($key == 'featured_image')
<tr>
    <th scope="row">{{str_replace('.',' ',str_replace('_',' ',ucwords($key)))}}</th>
    <td><img height="150" width="150" src="{!!render($val)!!}"/></td>
</tr>
@else
<tr>
    <th scope="row">{{str_replace('.',' ',str_replace('_',' ',ucwords($key)))}}</th>
    <td>{!!$val!!}</td>
</tr>
@endif