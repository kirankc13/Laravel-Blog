@extends('admin.layouts.master')
@section('css')
<style>
	.icn-spinner {
  animation: spin-animation 0.5s infinite;
  display: inline-block;
}
@keyframes spin-animation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(359deg);
  }
}
#embed-api-auth-container{
	text-align:center;
	padding:20px;
}
.gapi-analytics-data-chart{
	padding:15px;
}
.Chartjs-legend {
    list-style: none;
    margin: 0;
    padding: 1em 0 0;
    text-align: center;
}
.Chartjs-figure {
    height: 250px;
	padding:20px;
}
.Chartjs-legend>li {
    display: inline-block;
    padding: .25em .5em;
	font-size:12px;
}
.Chartjs-legend>li>i {
    display: inline-block;
    height: 1em;
    margin-right: .5em;
    vertical-align: -.1em;
    width: 1em;
}

</style>
@endsection
@section("content")
	<div class="page-content">
		@include('admin.components.messages')
		@can('analytics-widgets')
		<div class="analytics-container">
			@if(setting('analytics-client-id') == null)
		<div class="alert alert-info alert-icon alert-close alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<i class="font-icon font-icon-warning"></i>
			In order for Analytics widget to work, make sure you add your service account credentials to <pre>yourproject/app/analytics/service-account-credentials.json file</pre> this path. Also make sure you add your Analytics Client ID in configuration. The provided information must be correct inorder for the widgets to work!
		</div>
	@endif
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-3">
				<section class="widget widget-simple-sm">
				<div id="users-today">
					<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
				</div>
				</section>
			</div>
			<div class="col-xl-3">
				<section class="widget widget-simple-sm">
					<div id="page-views-today">
						<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
					</div>
				</section>
			</div>
			<div class="col-xl-3">
				<section class="widget widget-simple-sm">
					<div id="sessions-today">
						<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
					</div>
				</section>
			</div>
			<div class="col-xl-3">
				<section class="widget widget-simple-sm">
					<div id="active-users">
						<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
					</div>
				</section>
			</div>
		</div>
	</div>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                    <header class="widget-header">
							Top referrers (Last 30 Days)
						</header>
						<div id="top-referrers">
							<div class="text-center">
								<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
							</div>
						</div>
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                     <header class="widget-header">
							Most Visited Page (Today)
						</header>
						<div id="most-visited-page">
							<div class="text-center">
								<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
							</div>
						</div>
	                </section>
	            </div><!--.col-->
	        </div>
	    </div>
		<!--.container-fluid-->
		<!-- Embedded Analytics Container -->
		<div class="container-fluid">
	        <div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                    <header class="widget-header">
							This Week vs Last Week (by sessions)
						</header>
						<div id="chart-1-container-loader" class="text-center">
							<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
							<br>
							<small class="text-muted">Access Google Anlaytics to View this widget</small>
						</div>
						<div class="Chartjs">
							<figure class="Chartjs-figure" id="chart-1-container" height="400" width="500"></figure>
							<ol class="Chartjs-legend" id="legend-1-container"></ol>
						</div>
	                </section><!--.box-typical-dashboard-->
	            </div>
				<div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                    <header class="widget-header">
							This Year vs Last Year (by users)
						</header>
						<div id="chart-2-container-loader" class="text-center">
							<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
							<br>
							<small class="text-muted">Access Google Anlaytics to View this widget</small>
						</div>
						<div class="Chartjs">
							<figure class="Chartjs-figure" id="chart-2-container"></figure>
							<ol class="Chartjs-legend" id="legend-2-container"></ol>
						</div>
	                </section><!--.box-typical-dashboard-->
	            </div>
				<div class="col-xl-12 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                    <header class="widget-header">
							Sessions
						</header>
						<div id="session-container">
								<div id="session-container-loader" class="text-center">
									<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
									<br>
									<small class="text-muted">Access Google Anlaytics to View this widget</small>
								</div>
						</div>
	                </section>
	            </div>
				<div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                    <header class="widget-header">
							Top Browsers (by pageview)
						</header>
						<div id="chart-3-container-loader" class="text-center">
							<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
							<br>
							<small class="text-muted">Access Google Anlaytics to View this widget</small>
						</div>
						<div class="Chartjs">
										<figure class="Chartjs-figure" id="chart-3-container"></figure>
							<ol class="Chartjs-legend" id="legend-3-container"></ol>
						</div>
	                </section>
	            </div>
				<div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable widget widget-activity">
	                    <header class="widget-header">
							Top Countries (by sessions)
						</header>
						<div id="chart-4-container-loader" class="text-center">
							<img src="{{setting('loader-gif')}}" class="dashboard-widget-loader"/>
							<br>
							<small class="text-muted">Access Google Anlaytics to View this widget</small>
						</div>
						<div class="Chartjs">
							<figure class="Chartjs-figure" id="chart-4-container"></figure>
							<ol class="Chartjs-legend" id="legend-4-container"></ol>
						</div>
	                </section>
	            </div>
	        </div>
		</div>
		@endcan
	</div>
	@can('analytics-widgets')
		 <div class="analytics-container">
		 	<header>
				<div id="embed-api-auth-container"></div>
				<div id="view-selector-container" style="display:none;"></div>
			</header>
		 </div>
	@endcan
		 <!-- End Embedded Analytics Container -->

@endsection
@section('js')
	@include("system::dashboard.components.dashboard_scripts")
@endsection


