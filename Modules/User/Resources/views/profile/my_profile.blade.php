@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{asset('admin/css/separate/pages/profile-2.min.css')}}">
@endsection
@section('content')

<div class="page-content">
		<div class="container-fluid">
        <header class="section-header">
			<div class="tbl">
				<h3><i class="font-icon font-icon-user"></i> Profile</h3>
				<ol class="breadcrumb breadcrumb-simple">
					<li><a href="{{URL::to('/')}}">Dashboard</a></li>
					<li class="active">Profile Settings</li>
				</ol>
			</div>
		</header>
        @include('admin.components.messages')
			<div class="row">
				<div class="col-xl-3 col-lg-4">
					<aside class="profile-side">
						<section class="box-typical profile-side-user">
							<button type="button" class="avatar-preview avatar-preview-128">
								<img src="{{auth()->user()->image ? render(auth()->user()->image) : asset('admin/img/avatar-1-256.png')}}" alt="{{auth()->user()->name}}">
							</button>
							<div class="profile-card-name">{{auth()->user()->name}}</div>
                            <div class="profile-card-status">
                            {!!auth()->user()->roles->map(function($role) {
                    return '<span class="label label-pill label-primary">'.ucwords($role->name).'</span>';
                })->implode('<br>')!!}
                            </div>
						</section>
                        @if(auth()->user()->about != null)
						<section class="box-typical">
							<header class="box-typical-header-sm bordered">About</header>
							<div class="box-typical-inner">
								<p>{{auth()->user()->about}}</p>
							</div>
						</section>
                        @endif
					</aside>
				</div>

				<div class="col-xl-9 col-lg-8">
					<section class="tabs-section">
						<div class="tabs-section-nav tabs-section-nav-left">
							<ul class="nav" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="#tabs-2-tab-2" role="tab" data-toggle="tab" aria-expanded="false">
										<span class="nav-link-in">Activity</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#tabs-2-tab-3" role="tab" data-toggle="tab" aria-expanded="false">
										<span class="nav-link-in">Change Password</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#tabs-2-tab-4" role="tab" data-toggle="tab" aria-expanded="true">
										<span class="nav-link-in">About</span>
									</a>
								</li>
							</ul>
						</div>

						<div class="tab-content no-styled profile-tabs">
							<div role="tabpanel" class="tab-pane active" id="tabs-2-tab-2" aria-expanded="false">
								<section class="box-typical box-typical-padding">
									<section class="widget widget-activity">
                                        <header class="widget-header">
                                            My Latest Activities
                                        </header>
                                        <div>
                                        @forelse($activities as $activity)
                                            <div class="widget-tasks-item">
                                                <div class="user-card-row">
                                                    <div class="tbl-row">
                                                        <div class="tbl-cell">
                                                            <p class="user-card-row-name">{{$activity->description}}</p>
                                                            <p class="color-blue-grey-lighter">{{$activity->created_at->diffForHumans()}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        <div class="widget-tasks-item">
                                            <div class="text-center user-card-row">
                                                <div class="tbl-row">
                                                    <h3 style="padding-top:10px;">No Activities Yet</h3>
                                                </div>
                                            </div>
                                        </div>
                                        @endforelse
                                        </div>
                                    </section>
								</section>
							</div>
							<div role="tabpanel" class="tab-pane" id="tabs-2-tab-3" aria-expanded="false">
								<section class="box-typical profile-settings">
									<section class="box-typical-section">
                                    {!! Form::model(Auth::user(), ['method' => 'POST','route' => ['profile.change_password', auth()->user()->id]]) !!}
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">Current Password*</label>
                                        </div>
                                        <div class="col-xl-4">
                                            {!! Form::password('current_password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                        </div>
									</div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">New Password*</label>
                                        </div>
                                        <div class="col-xl-4">
                                            {!! Form::password('new_password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                        </div>
									</div>
                                    <div class="form-group row">
                                        <div class="col-xl-2">
                                            <label class="form-label">Confirm Password*</label>
                                        </div>
                                        <div class="col-xl-4">
                                            {!! Form::password('new_confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                        </div>
									</div>
									</section>
									<section class="box-typical-section profile-settings-btns">
										<button type="submit" class="btn btn-rounded">Change Password</button>
									</section>
                                    {!! Form::close() !!}
								</section>
							</div>
							<div role="tabpanel" class="tab-pane" id="tabs-2-tab-4" aria-expanded="true">
								<section class="box-typical profile-settings">

									<section class="box-typical-section">
                                    {!! Form::model(Auth::user(), ['method' => 'POST','enctype' => 'multipart/form-data','route' => ['update.profile', auth()->user()->id]]) !!}
										<div class="form-group row">
											<div class="col-xl-2">
												<label class="form-label">Name*</label>
											</div>
											<div class="col-xl-4">
												<input class="form-control" type="text" name="name" value="{{auth()->user()->name}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-xl-2">
												<label class="form-label">Display Name</label>
											</div>
											<div class="col-xl-4">
												<input class="form-control" type="text" name="display_name" value="{{auth()->user()->display_name}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-xl-2">
												<label class="form-label">Username</label>
											</div>
											<div class="col-xl-4">
												<input class="form-control" type="text" name="username" value="{{auth()->user()->username}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-xl-2">
												<label class="form-label">About</label>
											</div>
											<div class="col-xl-6">
												<textarea rows="4" name="about" class="form-control">{{auth()->user()->about}}</textarea>
											</div>
										</div>
                                        <div class="form-group row">
											<div class="col-xl-2">
												<label class="form-label">Image</label>
											</div>
											<div class="col-xl-6">
												<input type="file" class="form-control-file" name="image"/>
											</div>
										</div>
									</section>
									<section class="box-typical-section profile-settings-btns">
										<button type="submit" class="btn btn-rounded">Save Changes</button>
									</section>
                                {!! Form::close() !!}
								</section>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>

@endsection