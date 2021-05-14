@extends('frontend::layouts.optimal')
@section('meta_tags')
    @include('frontend::optimal.meta-data.page')
@endsection
@section('content')
<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row main_content">
            <div class="loop-large-post" id="content">
            {!! $page->description !!}
            </div>
        </div>
    </div>
</div>
@endsection