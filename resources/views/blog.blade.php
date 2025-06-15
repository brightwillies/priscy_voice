<!DOCTYPE html>
<html lang="zxx">


<head>
@include('includes.head')
</head>

<body class="blog-left inner-page">

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
        <!-- start top-menu area -->
        <section class="top-menu">
            <div class="container">
                <div class="row align-items-center position-static">
                    <!-- left-part -->
                    <div class="col-lg-4 col-md-4">
                        <div class="left-part">
                            <ul class="d-flex">
                                <li><a href="#!"><i class="flaticon-facebook-2"></i></a></li>
                                <li><a href="#!" class="active"><i class="flaticon-twitter-1"></i></a></li>
                                <li><a href="#!"><i class="flaticon-skype"></i></a></li>
                                <li><a href="#!"><i class="flaticon-instagram-2"></i></a></li>
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

                                <li><button class="sidemenu-btn"><i class="flaticon-menu"></i></button></li>
                                       </ul>
                            <!-- Modal -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end top-menu area -->

        <!-- start menubar area -->
        <section class="menubar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        @include('includes.nav')
                    </div>
                </div>
            </div>
        </section>
        <!-- end menubar area -->

        <!-- start banner area -->
        <section class="banner" data-img="/assets/images/author/banner.jpg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-text d-flex justify-content-between">
                                <h3>{{$blog->title}}</h3>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><i class="flaticon-home"></i><a href="/">Home</a></li>
                                      <!-- <li class="breadcrumb-item active" aria-current="page">1</li> -->
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
    <div class="side-menu">
        <!-- close button -->
        <button class="sidemenu-close">
            <i class="flaticon-plus"></i>
        </button>
        <!-- topic 1 -->
        <div class="topic category">
            <div class="single-item">
                <div class="title">
                    <h3>hot topics</h3>
                </div>
                <ul>
                    <li>
                        <a href="category.html" class="d-flex justify-content-between">
                            <p>activity</p>
                            <p>07</p>
                        </a>
                    </li>
                    <li>
                        <a href="category.html" class="d-flex justify-content-between">
                            <p>foody</p>
                            <p>17</p>
                        </a>
                    </li>
                    <li>
                        <a href="category.html" class="d-flex justify-content-between">
                            <p>crazy</p>
                            <p>07</p>
                        </a>
                    </li>
                    <li>
                        <a href="category.html" class="d-flex justify-content-between">
                            <p>gaming</p>
                            <p>12</p>
                        </a>
                    </li>
                    <li>
                        <a href="category.html" class="d-flex justify-content-between">
                            <p>business</p>
                            <p>20</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- topic 3 -->
        <div class="topic feed mt-30">
            <div class="single-item">
                <div class="title">
                    <h3>news feed</h3>
                </div>
                <ul class="small-item">
                    <li class="media align-items-sm-center">
                        <a href="blog-left.html">
                            <img src="assets/images/author/fashion/img1.jpg" alt="News Image">
                        </a>
                        <div class="media-body">
                            <a href="blog-right.html"><h6>This Place is Really Good for Reading</h6></a>
                            <a href="#!" class="d-flex align-items-center"><p><i class="flaticon-calendar"></i>july 24, 2021</p></a>
                        </div>
                    </li>
                    <li class="media mt-30 align-items-sm-center">
                        <a href="blog-left.html">
                            <img src="assets/images/author/fashion/img2.jpg" alt="News Image">
                        </a>
                        <div class="media-body">
                            <a href="blog-right.html"><h6>Two Wheels are Best Than Four</h6></a>
                            <a href="#!" class="d-flex align-items-center"><p><i class="flaticon-calendar"></i>july 24, 2021</p></a>
                        </div>
                    </li>
                    <li class="media mt-30 align-items-sm-center">
                        <a href="blog-left.html">
                            <img src="assets/images/author/fashion/img3.jpg" alt="News Image">
                        </a>
                        <div class="media-body">
                            <a href="blog-right.html"><h6>Put Yourself in Your Customers Shoe</h6></a>
                            <a href="#!" class="d-flex align-items-center"><p><i class="flaticon-calendar"></i>july 24, 2021</p></a>
                        </div>
                    </li>
                    <li class="media mt-30 align-items-sm-center">
                        <a href="blog-left.html">
                            <img src="assets/images/home1/recipe/rec5.jpg" alt="News Image">
                        </a>
                        <div class="media-body">
                            <a href="blog-right.html"><h6>Helpful Tips for Work from Home </h6></a>
                            <a href="#!" class="d-flex align-items-center"><p><i class="flaticon-calendar"></i>july 24, 2021</p></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- topic 4 -->
        <div class="topic feed mt-30">
            <a href="#!" class="ad">
                <img src="assets/images/author/ad/ad.jpg" alt="Advertise Image">
            </a>
        </div>
    </div>
    <!-- end side-menu area -->

    <!-- start main area -->
    <section class="main p-80">
        <div class="container">
            <div class="row">
                <!-- start left content area -->
                <div class="col-lg-8 order-lg-0 order-1">
                    <div class="content left-content">
                        <!-- blog image -->
                        <div class="blog-image">
                            <img src="{{$blog->image}}" class="img-fluid" alt="Blog Image">
                            <!-- blog date -->
                            <ul class="blog-date d-flex">
                                <li><a href="#!"><p><i class="flaticon-date"></i>{{$blog->mon}} {{$blog->day}}, {{$blog->year}}</p></a></li>
                                <!-- <li><a href="#!"><p><i class="flaticon-chat"></i>comments (03)</p></a></li>
                                <li><a href="#!"><p><i class="flaticon-like"></i>2 likes</p></a></li> -->
                            </ul>
                        </div>
                        <h3>{{$blog->title}} </h3>
                        <p class="desc">{!!$blog->summary !!}  </p>



                        <!-- <div class="share-blog d-flex justify-content-between">
                            <div class="left-part media">
                                <span>share : </span>
                                <div class="media-body">
                                    <ul class="social d-flex">
                                        <li><a href="#!"><i class="flaticon-facebook-2"></i></a></li>
                                        <li><a href="#!"><i class="flaticon-twitter-1"></i></a></li>
                                        <li><a href="#!"><i class="flaticon-skype"></i></a></li>
                                        <li><a href="#!"><i class="flaticon-instagram-2"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="comment">
                            <div class="title">
                                <h3>Rrecent comments</h3>
                            </div>

                            <div class="title leave">
                                <h3>Leave a comment</h3>
                            </div>
                            <form action="#!">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" placeholder="name*" required class="input-field">
                                    </div>
                                    <div class="col-lg-6 col-md-6 mt-sm-30">
                                        <input type="email" placeholder="email*" required class="input-field">
                                    </div>
                                    <div class="col-lg-12 mt-30">
                                        <textarea placeholder="your comments*" required class="input-field"></textarea>
                                    </div>
                                    <div class="col-lg-12 mt-30">
                                        <button type="submit">post comment</button>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
                <!-- end left content area -->

                <!-- start right content area -->
                <div class="col-lg-4 col-md-8 offset-md-2 offset-lg-0 order-lg-1 order-0">
                    <div class="content right-content">
                        <!-- topic 1 -->
                        <div class="topic about text-center">
                            <div class="image">
                                    <img src="/assets/images/founder.png" alt="Author Image">
                                </div>
                             <a href=""><h3>Hello, I'm Prisca Patience</h3></a>
                         <p> Ama Dziedzorm Gyamwodie officially known as Prisca Patience Gyamwodie, a Public Relations Expert/Strategic Communications by training, however, currently practicing International Relations and diplomacy by profession.  </p>

                        </div>
                        <!-- topic 2 -->

                        <!-- topic 3 -->
                        <div class="topic category mt-30">
                            <div class="title text-center">
                                <h3>categories</h3>
                            </div>
                            <ul>



                                 @foreach($categories as $key =>$singleCategory)
                                <li>
                                    <a href="/categories/{{$singleCategory->mask}}" class="d-flex justify-content-between">
                                        <p>{{$singleCategory->name}}</p>
                                        <p> {{$singleCategory->count}}</p>
                                    </a>
                                </li>

                                @endforeach



                            </ul>
                        </div>
                        <!-- topic 4 -->



                    </div>
                </div>
                <!-- end right content area -->
            </div>
        </div>
    </section>
    <!-- end main area -->

   @include('includes.footer')
</body>
</html>
