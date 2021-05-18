<!-- Footer -->
<footer class="container g-pt-80 g-pb-40">
  <div class="row justify-content-between">
    <div class="col-lg-3 g-mb-30">
      <a class="d-inline-block mb-3" href="">
        <img src="{{asset('assets_unify/img/logo/103x15.png')}}" alt="Image Description" class="mCS_img_loaded">
      </a>

      <p class="g-color-gray-dark-v4 g-font-size-12 mb-0">&copy; 2020 Template by Htmlstream.
        <br>All Rights Reserved.</p>
    </div>

    <div class="col-sm-6 col-lg-2 ml-auto g-mb-30">
      <h3 class="h6 g-color-black g-font-weight-600 text-uppercase mb-4">Quick Links</h3>

      <!-- Links -->
      <ul class="list-unstyled g-color-gray-dark-v4 g-font-size-13 mb-0">
        <li class="my-2"><i class="mr-2 fa fa-angle-right"></i>
          <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="https://htmlstream.com/contact-us">Contact Us</a>
        </li>
        <li class="my-2"><i class="mr-2 fa fa-angle-right"></i>
          <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="http://support.wrapbootstrap.com/knowledge_base/topics/usage-licenses">License</a>
        </li>
      </ul>
      <!-- End Links -->
    </div>

    <div class="col-sm-6 col-lg-3 g-mb-30">
      <h3 class="h6 g-color-black g-font-weight-600 text-uppercase mb-4">Follow Us</h3>

      <!-- Social Icons -->
      <ul class="list-inline mb-0">
        <li class="list-inline-item g-mx-2">
          <a class="u-icon-v1 u-icon-size--sm u-icon-slide-up--hover g-color-blue g-bg-blue-opacity-0_1 g-color-blue--hover rounded-circle" target="_blank" href="https://www.facebook.com/htmlstream">
            <i class="g-font-size-default g-line-height-1 u-icon__elem-regular fa fa-facebook"></i>
            <i class="g-font-size-default g-line-height-0_8 u-icon__elem-hover fa fa-facebook"></i>
          </a>
        </li>
        <li class="list-inline-item g-mx-2">
          <a class="u-icon-v1 u-icon-size--sm u-icon-slide-up--hover g-color-cyan g-bg-cyan-opacity-0_1 g-color-cyan--hover rounded-circle" target="_blank" href="https://twitter.com/htmlstream">
            <i class="g-font-size-default g-line-height-1 u-icon__elem-regular fa fa-twitter"></i>
            <i class="g-font-size-default g-line-height-0_8 u-icon__elem-hover fa fa-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item g-mx-2">
          <a class="u-icon-v1 u-icon-size--sm u-icon-slide-up--hover g-color-red g-bg-red-opacity-0_1 g-color-red--hover rounded-circle" target="_blank" href="https://dribbble.com/htmlstream">
            <i class="g-font-size-default g-line-height-1 u-icon__elem-regular fa fa-dribbble"></i>
            <i class="g-font-size-default g-line-height-0_8 u-icon__elem-hover fa fa-dribbble"></i>
          </a>
        </li>
        <li class="list-inline-item g-mx-2">
          <a class="u-icon-v1 u-icon-size--sm u-icon-slide-up--hover g-color-indigo g-bg-indigo-opacity-0_1 g-color-indigo--hover rounded-circle" target="_blank" href="https://www.instagram.com/htmlstream/">
            <i class="g-font-size-default g-line-height-1 u-icon__elem-regular fa fa-instagram"></i>
            <i class="g-font-size-default g-line-height-0_8 u-icon__elem-hover fa fa-instagram"></i>
          </a>
        </li>
        <li class="list-inline-item g-mx-2">
          <a class="u-icon-v1 u-icon-size--sm u-icon-slide-up--hover g-color-bluegray g-bg-bluegray-opacity-0_1 g-color-bluegray--hover rounded-circle" target="_blank" href="https://github.com/htmlstreamofficial">
            <i class="g-font-size-default g-line-height-1 u-icon__elem-regular fa fa-github"></i>
            <i class="g-font-size-default g-line-height-0_8 u-icon__elem-hover fa fa-github"></i>
          </a>
        </li>
      </ul>
      <!-- End Social Icons -->
    </div>
  </div>
</footer>
<!-- End Footer -->

<a class="js-go-to u-go-to-v1" href="#" data-type="fixed" data-position='{
 "bottom": 15,
 "right": 15
}' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
  <i class="hs-icon hs-icon-arrow-top"></i>
</a>
</main>

<!-- JS Global Compulsory -->
<script src="{{asset('assets_unify/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets_unify/vendor/jquery-migrate/jquery-migrate.min.js')}}"></script>
<script src="{{asset('assets_unify/vendor/popper.js/popper.min.js')}}"></script>
<script src="{{asset('assets_unify/vendor/bootstrap/bootstrap.min.js')}}"></script>



<!-- JS Implementing Plugins -->

<script src="{{asset('assets_unify/vendor/masonry/dist/masonry.pkgd.min.js')}}"></script>


<!-- JS Unify -->
<script src="{{asset('assets_unify/js/hs.core.js')}}"></script>

<script src="{{asset('assets_unify/js/components/hs.header-side.js')}}"></script>

<script src="{{asset('assets_unify/js/components/hs.go-to.js')}}"></script>

<!-- JS Custom -->
<script src="{{asset('assets_unify/js/custom.js')}}"></script>



<!-- JS Plugins Init. -->
<script>

  $(document).on('ready', function () {
    // initialization of go to
    $.HSCore.components.HSGoTo.init('.js-go-to');


  });

  $(window).on('load', function () {
    // initialization of header
    $.HSCore.components.HSHeaderSide.init($('#js-header'));
  });

      // initialization of masonry

      let $grid = $('.masonry-grid').masonry({
        columnWidth: '.masonry-grid-sizer',
        itemSelector: '.masonry-grid-item',
        percentPosition: true
      });


    let msnry = $grid.data('masonry');
    $('.overlay').fadeOut(800);

</script>

@yield('scripts')

</body>

</html>
