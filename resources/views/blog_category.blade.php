<!DOCTYPE html>
<html lang="zxx">

<head>
@include('includes.head')
</head>

<body class="lifestyle inner-page">

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
        <section class="banner" data-img="/assets/images/categories/{{$category}}.jpg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-text d-flex justify-content-between">
                                <!-- <h3>{{$category}}</h3> -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <!-- <li class="breadcrumb-item"><i class="flaticon-home"></i><a href="/">Home</a></li> -->
                                      <!-- <li class="breadcrumb-item active" aria-current="page">{{$category}}</li> -->
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



    <!-- start main area -->
    <section class="main p-30">
        <div class="container">
            <!-- <div class="row">
                <p style="font-style: italic; font-size:15px;"> {{$categoryText}}</p>
            </div> -->
            <div class="row">
                <!-- start left content area -->
                <div class="col-lg-8 order-lg-0 order-1">
                    <div class="content left-content">
                        <ul class="all-item">
                    <li class="item media align-items-center mt-30">
                        <p style="font-style: italic; font-size:15px;"> {{$categoryText}}</p>
                    </li>

                                @foreach($blogs as $key =>$singleBlog)
                            <li class="item media align-items-center mt-30">
                                <div class="image">
                                    <a href="/blog/{{$singleBlog->mask}}">
                                        <img src="{{$singleBlog->image}}" width="260px" height="220px" alt="Image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="/blog/{{$singleBlog->mask}}"><h3>{{$singleBlog->title}}</h3></a>
                                    <ul class="d-flex">

                                        <li><a href="/blog/{{$singleBlog->mask}}"><p>{{$singleBlog->mon}} {{$singleBlog->day}}, {{$singleBlog->year}} </p></a></li>
                                    </ul>
                                    <p>{{$singleBlog->introduction}} </p>
                                </div>
                            </li>
                                @endforeach


                        </ul>
                        <!-- <div class="pages">
                            <ul class="d-flex justify-content-center">
                                <li><a href="#!"><i class="flaticon-arrowhead-pointing-to-the-right caret-left"></i></a></li>
                                <li><a href="#!" class="active">01</a></li>
                                <li><a href="#!">02</a></li>
                                <li><a href="#!">03</a></li>
                                <li><a href="#!">04</a></li>
                                <li><a href="#!"><i class="flaticon-arrowhead-pointing-to-the-right"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <!-- end left content area -->

                <!-- start right content area -->
                <div class="col-lg-4 col-md-8 offset-md-2 offset-lg-0 order-lg-1 order-0">
                    <div class="content right-content">
                        <!-- topic 1 -->
                            <div class="topic category">
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
                         <!-- topic 1 -->

                        <div class="topic about text-center   mt-30">
                            <div class="image">
                                    <img src="/assets/images/founder.png" alt="Author Image">
                                </div>
                              <a href="!#"><h3>Hello, I'm Prisca Patience</h3></a>
                                    <p> Ama Dziedzorm Gyamwodie officially known as Prisca Patience Gyamwodie, a Public Relations Expert/Strategic Communications by training, however, currently practicing International Relations and diplomacy by profession.  </p>

                        </div>
                        <!-- topic 2 -->





                    </div>
                </div>
                <!-- end right content area -->
            </div>
        </div>
    </section>
    <!-- end main area -->

    <!-- start footer area -->
   @include('includes.footer')

</body>
</html>
