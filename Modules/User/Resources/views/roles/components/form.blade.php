<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="name">Name*</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="permissions">Permissions*</label>            
            <section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
						@foreach($permission_array as $module => $val)
							<li class="nav-item">
								<a class="nav-link {{$loop->index == 0 ? 'active' : ''}}" href="#tab-{{str_replace(' ','-',$module)}}" role="tab" data-toggle="tab" aria-expanded="false">
									<span class="nav-link-in">										
										{{$module}}
										<span class="label label-pill label-info">{{count($val)}}</span>
									</span>									
								</a>
							</li>
						@endforeach													                         
						</ul>
					</div>
				</div>
				<div class="tab-content">
					@foreach($permission_array as $module => $groups)
					<div role="tabpanel" class="tab-pane fade {{$loop->index == 0 ? 'active in' : ''}}" id="tab-{{str_replace(' ','-',$module)}}" aria-expanded="false">
						<div class="row">
							@foreach($groups as $group_name => $roles)
							<div class="col-lg-4 checkbox-groupings" data-group="{{str_replace(' ','-',$group_name)}}">
								<table class="table table-bordered table-xs group-table">								
									<thead>
										<tr>
											<th class="table-check">
												<div class="checkbox checkbox-only">
													<input type="checkbox" id="group-check-{{str_replace(' ','-',$group_name)}}" class="check_all_group" data-group="{{str_replace(' ','-',$group_name)}}">
													<label for="group-check-{{str_replace(' ','-',$group_name)}}"></label>
												</div>
											</th>
											<th>{{ucwords(str_replace('-',' ',$group_name))}}</th>											
										</tr>
									</thead>
									<tbody>
										@foreach($roles as $r)
										<tr>
											<td class="table-check">
											@if(isset($role))
												<div class="checkbox checkbox-only">
													{{ Form::checkbox('permission[]', $r['id'], in_array($r['id'], $rolePermissions) ? true : false, array('id' => 'roles-'.$r['id'],'data-group' => str_replace(' ','-',$group_name),'class'=>"check-roles check_single_".str_replace(' ','-',$r['group']))) }}														
													<label for="roles-{{$r['id']}}"></label>
												</div>
											@else
												<div class="checkbox checkbox-only">
													{{ Form::checkbox('permission[]', $r['id'], false, array('id' => 'roles-'.$r['id'],'data-group' => str_replace(' ','-',$group_name),'class'=>"check-roles check_single_".str_replace(' ','-',$r['group']))) }}														
													<label for="roles-{{$r['id']}}"></label>
												</div>
											@endif													
											</td>
											<td>
												{{ucwords(str_replace('-',' ',$r['name']))}}
												<span class="hint-circle" data-toggle="tooltip" data-placement="top" title="{{$r['description']}}" data-original-title="No description Set">?</span>
											</td>											
										</tr>				
										@endforeach															
									</tbody>
								</table>
							</div>
							@endforeach
						</div>
					</div>
					@endforeach					
				</div>
			</section>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
@section('js')
<script>
	$(".check_all_group").change(function() {
		var group = $(this).attr("data-group");
        if (this.checked) {
            $(".check_single_"+group).each(function() {
                this.checked=true;
            });
        } else {
            $(".check_single_"+group).each(function() {
                this.checked=false;
            });
        }
    });	

	 $(".check-roles").click(function () {
		var group = $(this).attr("data-group");
        if ($(this).is(":checked")) {						
            var isAllChecked = 0;
            $(".check_single_"+group).each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked == 0) {
                $("#group-check-"+group).prop("checked", true);
            }     
        }
        else {
            $("#group-check-"+group).prop("checked", false);
        }
    });

	$('.checkbox-groupings').each(function(){
		var group = $(this).data("group");		
		if ($('.check_single_'+group+':checked').length == $('.check_single_'+group).length) {
			$('#group-check-'+group).attr("checked","true");
    	}
	});

</script>
@endsection



