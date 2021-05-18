 <!-- Header -->
 <header id="js-header" class="u-header u-header--sticky-top u-header--toggle-section u-header--change-appearance"
     data-header-fix-moment="300">
     <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10"
         data-header-fix-moment-exclude="g-py-10" data-header-fix-moment-classes="u-shadow-v18 g-py-0">
         <nav class="navbar navbar-expand-lg">
             <div class="container">
                 <!-- Responsive Toggle Button -->
                 <button
                     class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0"
                     type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar"
                     data-toggle="collapse" data-target="#navBar">
                     <span class="hamburger hamburger--slider">
                         <span class="hamburger-box">
                             <span class="hamburger-inner"></span>
                         </span>
                     </span>
                 </button>
                 <!-- End Responsive Toggle Button -->

                 <!-- Logo -->
                 <a href="{{ route('home') }}" class="navbar-brand">
                     @if (isset($settings['logo']) && isset($settings['website-name']))
                         <img src="{{ $settings['logo'] }}" alt="{{ $settings['website-name'] }}">
                     @endif
                     @if (isset($settings['dark-logo']) && isset($settings['website-name']))
                         <img src="{{ $settings['dark-logo'] }}" alt="{{ $settings['website-name'] }}">
                     @endif
                 </a>
                 <!-- End Logo -->

                 <!-- Navigation -->
                 <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
                     <ul class="navbar-nav text-uppercase g-font-weight-600 ml-auto">
                         @foreach ($categories as $c)
                             <li class="nav-item g-mx-20--lg {{ $c->child ? '[WIP]insert-some-class' : '' }}">
                                 <a href="{{ $c->url }}" class="nav-link px-0">{{ $c->title }}
                                 </a>
                                 @if($c->child)
                                 <!-- complete how sub menu looks -->
                                 @endif
                             </li>
                         @endforeach
                     </ul>
                 </div>
                 <!-- End Navigation -->
             </div>
         </nav>
     </div>
 </header>
 <!-- End Header -->
