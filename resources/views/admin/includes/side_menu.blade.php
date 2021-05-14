<nav class="side-menu">
	    <ul class="side-menu-list">
            <li class="red {{\Request::routeIs('dashboard.*') ? 'opened' : ''}}">
	            <a href="{{route('dashboard.index')}}">
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Dashboard</span>
	            </a>
	        </li>
            @if (auth()->user()->hasAnyPermission(['role-list', 'users-list', 'permissions-list']))
	        <li class="blue with-sub {{\Request::routeIs('roles.*') || \Request::routeIs('users.*') || \Request::routeIs('permissions.*')  ? 'opened' : ''}}">
	            <span>
	                <i class="font-icon font-icon-user"></i>
	                <span class="lbl">User Management</span>
	            </span>
	            <ul>
				@can('role-list')
	                <li class="{{\Request::routeIs('roles.*') ? 'active' : ''}}"><a href="{{route('roles.index')}}"><span class="lbl">Roles</span></a></li>
				@endcan
				@can('user-list')
	                <li class="{{\Request::routeIs('users.*') ? 'active' : ''}}"><a href="{{route('users.index')}}"><span class="lbl">Users</span></a></li>
				@endcan
				@can('permission-list')
					<li class="{{\Request::routeIs('permissions.*') ? 'active' : ''}}"><a href="{{route('permissions.index')}}"><span class="lbl">Permissions</span></a></li>
				@endcan
	            </ul>
	        </li>
			@endif
            @if (auth()->user()->hasAnyPermission(['configuration-fields-list', 'configuration-update-list']))
	        <li class="orange-red with-sub {{\Request::routeIs('configuration-fields.*') || \Request::routeIs('configuration-update.*') ? 'opened' : ''}}">
	            <span>
	                <i class="font-icon font-icon-cogwheel"></i>
	                <span class="lbl">System</span>
	            </span>
	            <ul>
				@can('configuration-fields-list')
	                <li class="{{\Request::routeIs('configuration-fields.*') ? 'active' : ''}}"><a href="{{route('configuration-fields.index')}}"><span class="lbl">Configuration Fields</span></a></li>
				@endcan
				@can('configuration-update-list')
	                <li class="{{\Request::routeIs('configuration-update.*') ? 'active' : ''}}"><a href="{{route('configuration-update.index')}}"><span class="lbl">Update Configuration</span></a></li>
				@endcan
				@can('error-logs')
					<li class="{{\Request::routeIs('error.logs.*') ? 'active' : ''}}">
						<a href="{{route('error.logs')}}">
							<span class="lbl">
							<span class="lbl">System Logs</span>
							</span>
						</a>
					</li>
				@endcan
	            </ul>
	        </li>
			@endif
			@can('pages-list')
			<li class="black {{\Request::routeIs('pages.*') ? 'opened' : ''}}">
	            <a href="{{route('pages.index')}}">
	                <i class="glyphicon glyphicon-duplicate"></i>
	                <span class="lbl">Pages</span>
	            </a>
	        </li>
			@endcan
			@can('activity-list')
			<li class="pink-red {{\Request::routeIs('activity.*') ? 'opened' : ''}}">
	            <a href="{{route('activity.index')}}">
	                <i class="font-icon font-icon-zigzag"></i>
	                <span class="lbl">Activity</span>
	            </a>
	        </li>
			@endcan
			@can('categories-list')
			<li class="black {{\Request::routeIs('categories.*') ? 'opened' : ''}}">
	           	<a href="{{route('categories.index')}}">
			   		<span>
	                <i class="font-icon font-icon-list-square"></i>
	                <span class="lbl">Categories</span>
	            </span>
			   	</a>
	        </li>
			@endcan
			@can('tags-list')
			<li class="blue {{\Request::routeIs('tags.*') ? 'opened' : ''}}">
	           	<a href="{{route('tags.index')}}">
			   		<i class="glyphicon glyphicon-tag"></i>
			   		<span class="lbl">Tags</span>
			   	</a>
	        </li>
			@endcan
			@can('posts-list')
			<li class="pink-red {{\Request::routeIs('post-tasks.*') ? 'opened' : ''}}">
	           	<a href="{{route('post-tasks.index')}}">
			   		<span>
	                <i class="font-icon font-icon-post"></i>
	                <span class="lbl">Post</span>
	            </span>
			   	</a>
	        </li>
			@endcan
			@can('published-posts-list')
			<li class="pink-red {{\Request::routeIs('posts.*') ? 'opened' : ''}}">
	           	<a href="{{route('posts.index')}}">
			   		<span>
	                <i class="font-icon font-icon-check-circle"></i>
	                <span class="lbl">Published Posts</span>
	            	</span>
			   	</a>
	        </li>
			@endcan
			@can('messages-list')
			<li class="blue {{\Request::routeIs('messages.*') ? 'opened' : ''}}">
	           	<a href="{{route('messages.index')}}">
			   		<span>
					<i class="font-icon font-icon-mail"></i>
	                <span class="lbl">Messages</span>
					@php
						$contact_count = count($contact_messages->where('is_seen',0));
					@endphp
					@if($contact_count > 0)
		            <span class="label label-custom label-pill label-danger">{{$contact_count}}</span>
					@endif
	            	</span>
			   	</a>
	        </li>
			@endcan
			@can('newsletter-list')
			<li class="black {{\Request::routeIs('newsletter.*') ? 'opened' : ''}}">
	           	<a href="{{route('newsletter.index')}}">
			   		<span>
					<i class="font-icon font-icon-contacts"></i>
	                <span class="lbl">Newsletter</span>
	            	</span>
			   	</a>
	        </li>
			@endcan
	    </ul>

	    <section>
	        <header class="side-menu-title">Quick Access</header>
	        <ul class="side-menu-list">
                @can('posts-create')
	            <li>
	                <a href="{{route('post-tasks.create')}}">
	                    <i class="tag-color green"></i>
	                    <span class="lbl">Create Post</span>
	                </a>
	            </li>
                @endcan
                <li>
	                <a href="{{route('my.profile')}}">
	                    <i class="tag-color red"></i>
	                    <span class="lbl">View Profile</span>
	                </a>
	            </li>
	        </ul>
	    </section>
	</nav>
