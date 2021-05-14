<body class="with-side-menu control-panel control-panel-compact {{\Request::routeIs('post-tasks.create') || \Request::routeIs('post-tasks.edit') ? agent()->isDesktop() ? 'sidebar-hidden' : '' : '' }}">
	<header class="site-header">
	    <div class="container-fluid">
	        <a href="{{route('dashboard.index')}}" class="site-logo">
				@if(isset($_COOKIE['dark_mode']))
				<img class="hidden-md-down" id="logo_area" src="{{setting('admin-dark-logo') ? setting('admin-dark-logo') : ''}}" alt="{{setting('admin-area-website-title')}}" width="170">
	            <img class="hidden-lg-up" id="mini_logo_area" src="{{setting('admin-mini-dark-logo') ? setting('admin-mini-dark-logo') : ''}}" alt="{{setting('admin-area-website-title')}}">
				@else
				<img class="hidden-md-down" id="logo_area" src="{{setting('admin-logo') ? setting('admin-logo') : ''}}" alt="{{setting('admin-area-website-title')}}" width="170">
	            <img class="hidden-lg-up" id="mini_logo_area" src="{{setting('admin-mini-logo') ? setting('admin-mini-logo') : ''}}" alt="{{setting('admin-area-website-title')}}">
				@endif
	        </a>
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
			@php
				$contact_count = count($contact_messages->where('is_seen',0));
			@endphp
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
						@can('messages-list')
						<div class="dropdown dropdown-notification messages">
	                        <a href="#" class="header-alarm {{$contact_count > 0 ? 'active' : ''}}" id="dd-messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <i class="font-icon-mail"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-messages" aria-labelledby="dd-messages">
	                            <div class="dropdown-menu-messages-header">
	                                <ul class="nav" role="tablist">
	                                    <li class="nav-item">
	                                        <a class="nav-link active" data-toggle="tab" href="#tab-incoming" role="tab" aria-expanded="true">
	                                            Inbox
												@if($contact_count > 0)
		                                            <span class="label label-pill label-danger">{{$contact_count}}</span>
												@endif
	                                        </a>
	                                    </li>
	                                </ul>
	                            </div>
	                            <div class="tab-content">
									<style>
										.dot{
											display: inline-block;
											vertical-align: middle;
											width: 6px;
											height: 6px;
											margin: 0 0 6px;
											-webkit-border-radius: 50%;
											border-radius: 50%;
											background: #fa424a;
											position: relative;
											top: 2px;
											padding:2px;
										}
										</style>
	                                <div class="tab-pane active" id="tab-incoming" role="tabpanel"><div class="dropdown-menu-messages-list">
										@if($contact_count > 0)
										@foreach($contact_messages as $c)
	                                        <a href="{{route('messages.show',$c->id)}}" class="mess-item">
	                                            <span class="mess-item-name">@if($c->is_seen == 0) <div class="dot"></div> @endif {{$c->name}}</span>
	                                            <span class="mess-item-txt">{{$c->subject}}</span>
	                                        </a>
										@endforeach
										@else
											<div style="padding:20px;" class="text-center">
												<h4>No Messages</h4>
											</div>
										@endif
	                                    </div>
									</div>
	                            </div>
	                            <div class="dropdown-menu-notif-more">
	                                <a href="{{route('messages.index')}}">See more</a>
	                            </div>
	                        </div>
	                    </div>
						@endcan
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="{{auth()->user()->image ? render(auth()->user()->image) : asset('admin/img/avatar-2-64.png')}}" alt="{{auth()->user()->name}}">
								<span>{{auth()->user()->name}}</span>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="{{route('my.profile')}}"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
	                            <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
	                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>

	<div class="mobile-menu-left-overlay"></div>
