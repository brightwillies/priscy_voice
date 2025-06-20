<!DOCTYPE html>
<html lang="en">


<head>
@include('includes.head')
</head>
<body class="contact-page inner-page">

    <!-- start template -->

    <!-- start preloader area -->
    <div class="preloader">
        <div class="clock"></div>
    </div>
    <!-- end preloader area -->

    <!-- start top-tp button area -->
    <button class="top-btn">
        <i class="flaticon-up-arrow"></i>
    </button>
    <!-- end top-tp button area -->

    <!-- start header area -->
    <header>

     <section class="top-menu">
            <div class="container">
                <div class="row align-items-center position-static">
                    <!-- left-part -->
                    <div class="col-lg-4 col-md-4">
                        <div class="left-part">
                            <ul class="d-flex">


                                    <li><a href="https://x.com/pgyamwodie?s=11&t=lFn-0hFagGari_mtzvAp6A"><i class="flaticon-twitter-1"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/prisca-patience-gyamwodie-36353799?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="flaticon-linkedin"></i></a></li>
                                    <li><a href="https://www.instagram.com/dziedzormfranks?igsh=MWc4dW1mOTV6M3hpdw%3D%3D&utm_source=qr"><i class="flaticon-instagram-2"></i></a></li>

                            </ul>
                        </div>
                    </div>
                    <!-- logo-part -->
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center mid-part">
                        <!-- <div class="logo">
                            <a href="index.html"><img src="assets/images/author/logo.png" alt="Logo"></a>
                        </div> -->
                    </div>
                    <!-- right-part -->
                    <div class="col-lg-4 col-md-4 col-sm-6 position-static">
                        <div class="right-part position-static">
                            <ul class="d-flex justify-content-end position-static align-items-center">

                                <!-- <li><button class="sidemenu-btn"><i class="flaticon-menu"></i></button></li> -->
                            </ul>
                            <!-- Modal -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- start menubar area -->
        <section class="menubar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar p-0">
                             <a class="navbar-brand p-0" href="/">
                                <img src="/assets/images/prissy_logo.png" width="83px" alt="Logo" />
                            </a>
                            <div class="header-menu m-auto position-static">
                              <ul class="menu">
                                   <li  class="{{(request()->is('/')) ? 'active' : '' }}"><a href="/">Home </a></li>
                                   <li  class="{{(request()->is('categories/public-relations')) ? 'active' : '' }}"><a href="/categories/public-relations">Public Relations </a></li>
                                   <!-- <li class="{{(request()->is('categories/story-telling')) ? 'active' : '' }}"><a href="/categories/story-telling">⁠Story telling</a></li> -->
                                   <li class="{{(request()->is('categories/voix-global-communications')) ? 'active' : '' }}"><a href="/categories/voix-global-communications">⁠ Voix Global Communications</a></li>
                                   <li class="{{(request()->is('/categories/learn-a-language')) ? 'active' : '' }}" ><a href="/categories/learn-a-language">⁠Learn a new language</a></li>


                                       <li class="{{(request()->is('categories/voix-global-communications')) ? 'active' : '' }}"><a href="#!">More</a>
                                        <ul>
                                            <li class="{{(request()->is('categories/story-telling')) ? 'active' : '' }}"><a href="/categories/story-telling">⁠Story telling</a></li>
                                            <li class="{{(request()->is('categories/globe-trotter')) ? 'active' : '' }}"><a href="/categories/globe-trotter">⁠Globe trotter</a></li>
                                            <li class="{{(request()->is('categories/trends-insight')) ? 'active' : '' }}"><a href="/categories/trends-insight">⁠⁠Trends & Insight</a></li>
                                            <li><a href="/categories/others">⁠Others</a></li>
                                        </ul>
                                    </li>


                                    <li class="{{(request()->is('contact-us')) ? 'active' : '' }}"><a href="/contact-us">Contact Us</a></li>
                                </ul>
                            </div>

                            <div class="right-part">



                                <!-- Modal -->

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- end menubar area -->

        <!-- start banner area -->
        <section class="banner" data-img="assets/images/author/banner.jpg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-text d-flex justify-content-between">
                                <h3>contact page</h3>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><i class="flaticon-home"></i><a href="index.html">Home</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">contact</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end banner area -->
    </header>
    <!-- end header area -->

    <!-- start side-menu area -->
    <div class="side-menu-overlay"></div>
   
    <!-- end side-menu area -->

    <!-- start map area -->
    <section class="location">
        <div class="google-map-wrapper" data-latitude='40.7656561' data-longitude='-73.7691858' data-zoom='11' data-marker='assets/images/map-marker.png'></div>
        <div id="">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.0689130369137!2d-0.20457972431165417!3d5.556803794423625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf90994cb62ddf%3A0x6bc450dd4c9f3cfe!2sAfrica%20Trade%20House!5e0!3m2!1sen!2sca!4v1749995517532!5m2!1sen!2sca" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <!-- end map area -->

    <!-- start address area -->
    <section class="all-address">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="item text-center">
                                <i class="flaticon-placeholder"></i>
                                <h3>Our Office</h3>
                                <p>Africa Trade House, Ambassadorial Enclave, <br> Liberia Road, West Ridge</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mt-sm-30">
                            <div class="item text-center">
                                <i class="flaticon-phone"></i>
                                <h3>call us</h3>
                                <p>+233 (0)247014737</p>
                                <p>+233 (0)209225830</p>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mt-md-30">
                            <div class="item text-center">
                                <i class="flaticon-gmail"></i>
                                <h3>email address</h3>
                                <p>pgyamwodie@yahoo.com </p>
                                <p>info@prissysvoice.com</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end address area -->

    <!-- start message area -->
    <section class="message p-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg text-center">
                        <h2>Leave a Message</h2>
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="name" class="inputs">
                                </div>
                                <div class="col-lg-6 mt-md-30">
                                    <input type="email" placeholder="email" class="inputs">
                                </div>
                                <div class="col-lg-6 mt-30">
                                    <input type="text" placeholder="location" class="inputs">
                                </div>
                                <div class="col-lg-6 mt-30">
                                    <input type="tel" placeholder="your phone" class="inputs">
                                </div>
                                <div class="col-lg-12 mt-30">
                                    <textarea placeholder="write your comments" class="inputs"></textarea>
                                </div>
                                <div class="col-lg-12 mt-30">
                                    <button type="submit">send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end message area -->

    <!-- start footer area -->

    @include('includes.footer')
    <!-- end footer area -->

    <!-- vendor js files -->

    <!--==== jquery min js ====-->
    <script src="assets/plugins/jquery-3.5.1.min.js"></script>

    <!--==== bootstrap min js ====-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!--==== menu js ====-->
    <script src="assets/plugins/menu.min.js"></script>

    <!--==== menu js ====-->
    <script src="assets/plugins/parallax.js"></script>

    <!--==== select js ====-->
    <script src="assets/plugins/select2.min.js"></script>

    <!--==== swiper slider js ====-->
    <script src="assets/plugins/swiper-bundle.min.js"></script>

    <!--==== venobox js ====-->
    <script src="assets/plugins/venobox.min.js"></script>

    <!--==== magnific popup js ====-->
    <script src="assets/plugins/jquery.magnific-popup.min.js"></script>

    <!--==== wave surfer js ====-->
    <script src="assets/plugins/wavesurfer.js"></script>

    <!--=== Google map ===-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjkssBA3hMeFtClgslO2clWFR6bRraGz0"></script>

    <!--==== packrry js ====-->
    <script src="assets/plugins/packery.pkgd.min.js"></script>

    <!--==== range slider js ====-->
    <script src="assets/plugins/jquery-ui.min.js"></script>

    <!--==== script js ====-->
    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from patrika-taupe.vercel.app/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 May 2025 00:55:46 GMT -->
</html>
