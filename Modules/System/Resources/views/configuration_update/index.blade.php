@extends('admin.layouts.master')
@section("content")
<div class="page-content">
	<div class="container-fluid">
        <header class="section-header">
			<div class="tbl">
				<h3>{!!$data['icon']!!} {{$data['panel_name']}}</h3>
				<ol class="breadcrumb breadcrumb-simple">
					<li><a href="{{URL::to('/')}}">Dashboard</a></li>
					<li class="active">{{$data['panel_name']}} List</li>
				</ol>
			</div>
		</header>
        <section class="tabs-section">
            <div class="tabs-section-nav tabs-section-nav-inline">
                <div class="nav-scroller">
                    <ul class="nav" role="tablist">
                        @foreach($field_types as $group => $settings)
                            <li class="nav-item">
                                <a class="nav-link {{$loop->index == 0 ? 'active' : ''}}" href="#tabs-{{str_replace('/','-',str_replace(' ','-',$group))}}" role="tab" data-toggle="tab" aria-expanded="true">
                                    {{$group}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
            @include('admin.components.messages')
                <form action="{{route($data['base_route'].'.update')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="tab-content">
                        @foreach($field_types as $group => $all_settings)
                            <div role="tabpanel" class="tab-pane fade  {{$loop->index == 0 ? 'active in' : ''}}" id="tabs-{{str_replace('/','-',str_replace(' ','-',$group))}}" aria-expanded="true">
                                @include($base_view.'.components.form')
                            </div>
                        @endforeach
                        <fieldset>
                            <div class="col-xs-12 col-sm-12 col-md-12 p-a-0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
