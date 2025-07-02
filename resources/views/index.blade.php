<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
@include('includes.head')
</head>
<body class="home2">

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

    <!-- start headre area -->
    <header>
        <!-- start menubar area -->
        <section class="menubar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @include('includes.nav')
                    </div>
                </div>
            </div>
        </section>
        <!-- end menubar area -->

        <!-- start banner area -->
        <section class="banner" data-img="assets/images/home2/banner/banner.jpg">
            <div class="banner-main-slider swiper-container">
                <div class="swiper-wrapper">
                    <!-- slider 1 -->

                    <div class="item item1 swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 col-sm-6">
                                    <div class="banner-text">
                                        <!-- <h4> Public Relations</h4> -->
                                        <h1>OWN YOUR VOICE</h1>
                                        <p> It is your trump card to credibility, uniqueness, authenticity, integrity , reputation and brand image.
                                            Own your voice today !</p>
                                        <ul class="buttons d-flex">
                                            <li>
                                                <a href="/contact-us" class="btn-style">Contact Us</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-image">
                                        <img src="assets/images/home2/banner/person1.png" alt="Person Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slider 2 -->
                    <div class="item item2 swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 col-sm-6">
                                    <div class="banner-text">
                                        <!-- <h4>Storytelling</h4>
                                        <h1>Every brand </h1>
                                       <p>every journey, every moment has a story—let’s explore how to tell yours in the most compelling way.</p> -->

                                        <h1>OWN YOUR VOICE</h1>
                                        <p> It is your trump card to credibility, uniqueness, authenticity, integrity , reputation and brand image.
                                            Own your voice today !</p>
                                        <ul class="buttons d-flex">
                                            <li>
                                                <a href="/contact-us" class="btn-style">Contact Us</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-image">
                                        <img src="assets/images/home2/banner/person2.png" alt="Person Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slider 3 -->
                    <div class="item item3 swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 col-sm-6">
                                    <div class="banner-text">
                                       <!-- <h4>Learn A Language</h4>
                                        <h1>Unlock new cultures,</h1>
                                        <p>  opportunities, and connections by mastering the beauty of languages."</p> -->

                                         <h1>OWN YOUR VOICE</h1>
                                        <p> It is your trump card to credibility, uniqueness, authenticity, integrity , reputation and brand image.
                                            Own your voice today !</p>
                                        <ul class="buttons d-flex">
                                            <li>
                                                <a href="/contact-us" class="btn-style">Contact Us</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-image">
                                        <img src="assets/images/home2/banner/person3.png" alt="Person Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-part">
                <div class="banner-slide swiper-container">
                    <div class="swiper-wrapper">
                         @if($latestBlogs->count() > 0)
                    @foreach($latestBlogs as $key =>$singleBlog)
                        <div class="item swiper-slide">
                            <div class="media align-items-center">
                                <a href="blog-simple.html">
                                    <img src="{{$singleBlog->image}}" alt="Fashion Image">
                                </a>

                                <div class="media-body">
                                    <a href="!#" class="cat-sm">{{$singleBlog->category}}</a>
                                    <a href="/blog/{{$singleBlog->mask}}"><h5>{{$singleBlog->title}}</h5></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif


                    </div>
                </div>
                <div class="btns">
                    <button class="btn-up"><i class="flaticon-up-arrow"></i></button>
                    <button class="btn-down"><i class="flaticon-down-arrow"></i></button>
                </div>
            </div>
        </section>
        <!-- end banner area -->
    </header>
    <!-- end header area -->

    <!-- start news area -->
    <section class="news p-80">
        <div class="container">

          @if($findCategories->count() > 0)
                        @foreach($findCategories as $key =>$singleCategory)

            <!-- <div class="row justify-content-center"> -->
            <div class="row">
                <div class="col-lg-12">
                <div class="send">
                    <div class="content">
                     <div class="topic">
                     <div class="title">

                                <h5>{{$singleCategory->name}}</h5>
                            </div>
                            </div>
                            </div>
                            </div>
                </div>

                    @foreach($singleCategory['blogs'] as $key =>$singleBlog)
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <div class="image">
                            <a href="/blog/{{$singleBlog->mask}}" class="main-img">
                                <img src="{{$singleBlog->image}}" alt="News Image">
                            </a>

                        </div>
                        <div class="text-part">
                            <a href="" class="cat"><p>{{$singleBlog->category}}</p></a>
                            <a href="/blog/{{$singleBlog->mask}}"><h4>{{$singleBlog->title}}</h4></a>
                            <ul class="d-flex">
                                <li><a href="#!"><p>{{$singleBlog->mon}} {{$singleBlog->day}} {{$singleBlog->year}}</p></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                  @endforeach

            </div>
            @endforeach
            @endif


        </div>
    </section>
    <!-- end news area -->

    <!-- start main-content area -->
    <section class="main pb-80">
        <div class="container">
            <div class="row">
                <!-- start left-news area -->
                <div class="col-lg-8 order-lg-0 order-1 mt-md-60">
                    <div class="content left-content">



                    </div>
                </div>
                <!-- end left-news area -->

                <!-- start right-news area -->
                <div class="col-lg-4 col-md-8 offset-md-2 offset-lg-0 order-lg-1 order-0">
                    <div class="content right-content">
                        <!-- topic 1 -->
                        <div class="topic author text-center">
                            <div class="single-item">
                                <div class="image">
                                    <img src="/assets/images/founder.png" alt="Author Image">
                                </div>
                                <div class="text-part">
                                    <a href=""><h3>Hello, I'm Prisca Patience</h3></a>
                                    <p> Ama Dziedzorm Gyamwodie officially known as Prisca Patience Gyamwodie, a Public Relations Expert/Strategic Communications by training, however, currently practicing International Relations and diplomacy by profession.  </p>

                                    <!-- <p>On this blog, I share my journey in life, my thoughts on various aspects of public relations, telling stories, my experience as a young diplomat (globe trotter) my French journey and the benefits of learning a foreign language, explore the latest trends and insights about issues around us. With a few years in international relations and public relations, I’m excited to connect with like-minded individuals</p> -->
                                    <ul class="social d-flex justify-content-center">

                                    <li><a href="https://x.com/pgyamwodie?s=11&t=lFn-0hFagGari_mtzvAp6A"><i class="flaticon-twitter-1"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/prisca-patience-gyamwodie-36353799?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="flaticon-linkedin"></i></a></li>
                                    <li><a href="https://www.instagram.com/dziedzormfranks?igsh=MWc4dW1mOTV6M3hpdw%3D%3D&utm_source=qr"><i class="flaticon-instagram-2"></i></a></li>

                       </ul>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="topic category mt-30">
                            <div class="single-item">
                                <div class="title text-center">
                                    <h3>categories</h3>
                                </div>
                                <ul>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>book review</p>
                                            <p>(07)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>weddings</p>
                                            <p>(17)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>concerts</p>
                                            <p>(07)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>promotional</p>
                                            <p>(12)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>help & support</p>
                                            <p>(20)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>intrview</p>
                                            <p>(20)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="category.html" class="d-flex justify-content-between">
                                            <p>reportage</p>
                                            <p>(20)</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->


                    </div>
                </div>
            </div>
            <!-- end right-news area -->
        </div>
    </section>
    <!-- start main-content area -->


    <!-- end video area -->


@include('includes.footer')
</body>
</html>
