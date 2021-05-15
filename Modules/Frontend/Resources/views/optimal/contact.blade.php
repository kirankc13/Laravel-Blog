@extends('frontend::layouts.optimal')
@section('meta_tags')
    @include('frontend::optimal.meta-data.contact')
@endsection
@section('content')
<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contct-information">
                    <h1>Contact Information</h1>
                    <hr />
                    {!! $page->description !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form-box">
                    <h2>Contact us</h2>
                    <p>If you have any queries, please feel free to contact us.</p>
                    <hr />
                    <form method="post" action="#" target="_top">
                        <div class="form-group">
                            <label for="name">Your Name*</label>
                            <input id="name" name="name" class="form-control" type="text" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email*</label>
                            <input type="email" name="email"  class="form-control" placeholder="Your Email *" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Subject*</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject *" required="" />
                        </div>
                        <div class="form-group">
                            <label for="email">Message*</label>
                            <textarea rows="3" name="message" class="form-control" id="message_required" placeholder="Message" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <p style="font-size: 14px; margin: 0;">
                                By continuing with us, You agree to our <a href="https://sbwebtechnology.com/en/terms-and-conditions" title="Terms and Conditions" target="_blank">Terms and Conditions</a> and
                                <a href="https://sbwebtechnology.com/en/privacy-policy" title="Privacy Policy" target="_blank">Privacy Policy</a>.
                            </p>
                        </div>
                        <input type="submit" id="submit_form" class="btn-primary" value="Submit" />
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection