
	<div id="page-loader">
        <div class="loader-wrapper">
            <img src="{{setting('loader-gif')}}" class="loader-image"/>
        </div>
    </div>

	<button class="darkmode-toggle" data-toggle="tooltip" data-placement="left" data-original-title="{{isset($_COOKIE['dark_mode']) ? 'Turn Off Dark Mode' : 'Turn on dark mode! It is easy on the eyes!'}}" aria-label="Activate dark mode" aria-checked="false" role="checkbox" style="{{isset($_COOKIE['dark_mode']) ? 'background-color:#100f2c;' : 'background-color:#9c99e2;'}}">🌓</button>
    <script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('admin/js/lib/html5-form-validation/jquery.validation.min.js')}}"></script>
	<script>
	$(function() {
		$('#validate-form').validate({
			 	ignore: "",
				submit: {
					settings: {
						inputContainer: '.form-group'
					}
				}
			});
	});

       $(window).load(function() {
          $('#page-loader').hide();
       });


	</script>
	<script src="{{asset('admin/js/app.js')}}"></script>
	<script src="{{asset('admin/js/lib/tether/tether.min.js')}}"></script>
	<script src="{{asset('admin/js/lib/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/js/plugins.js')}}"></script>
	<script type="text/javascript" src="{{asset('admin/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('admin/js/lib/lobipanel/lobipanel.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('admin/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
	<script src="{{asset('admin/js/lib/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('admin/js/sweetalert.js')}}"></script>
	<script>
		$(document).ready(function(){
            $('.darkmode-toggle').click(function(){
				$('[data-toggle="tooltip"]').tooltip("hide");
				var darkmodelogo = "{{setting('admin-dark-logo')}}";
				var darkmodeminilogo = "{{setting('admin-mini-dark-logo')}}";
				var logo = "{{setting('admin-logo')}}";
				var minilogo = "{{setting('admin-mini-logo')}}";
                if($('link#styles').attr('href') == "{{asset('admin/css/main.css')}}"){
                    $('link#styles').attr('href',"{{asset('admin/css/dark-theme.css')}}");
					$(".darkmode-toggle").css({"backgroundColor":"#100f2c"});
					$('#logo_area').attr('src',darkmodelogo);
					$('#mini_logo_area').attr('src',darkmodeminilogo);
					$(this).attr('data-original-title','Turn Off Dark Mode')
                    var now = new Date();
                    var expires = new Date(now.setTime(now.getTime() + 3600 * 1000 * 24 * 365 )); //Expire in one year
                    document.cookie = 'dark_mode=1;path=/;expires='+expires.toGMTString()+';';
                 }
                else
                {
					$('[data-toggle="tooltip"]').tooltip("hide");
                    $('link#styles').attr('href',"{{asset('admin/css/main.css')}}");
					$(".darkmode-toggle").css({"backgroundColor":"#9c99e2"});
					$('#logo_area').attr('src',logo);
					$('#mini_logo_area').attr('src',minilogo);
					$(this).attr('data-original-title','Turn on dark mode! It is easy on the eyes!')
                    document.cookie = "dark_mode=0; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                }
            })
        });
	</script>

	@yield('js')
</body>
</html>
