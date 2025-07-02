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
                           <li>
                              <a href="#!">
                                 <p><i class="flaticon-date"></i>{{$blog->mon}} {{$blog->day}}, {{$blog->year}}</p>
                              </a>
                           </li>
                           <li>
                              <a href="#!">
                                 <p><i class="flaticon-chat"></i>comments ( {{count($blog->comments)}})</p>
                              </a>
                           </li>
                           <li>
                              <form action="{{ route('likes.toggle', $blog->mask) }}" method="POST">
                                 @csrf
                                 <button type="submit" class="btn-like">
                                 <i class="flaticon-like"></i>
                                 <span>{{ $blog->likes->count() }}</span> likes
                                 </button>
                              </form>
                           </li>
                        </ul>
                     </div>
                     <h3>{{$blog->title}} </h3>
                     <p class="desc">{!!$blog->summary !!}  </p>
                     <div class="share-blog d-flex justify-content-between">
                        <div class="left-part media">
                           <span>share : </span>
                           <div class="media-body">
                              <ul class="social d-flex">
                                 <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="flaticon-facebook-2"></i></a></li>
                                 <li><a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url()->current()) }}" target="_blank"><i class="flaticon-twitter-1"></i></a></li>
                                 <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title) }}" target="_blank"><i class="flaticon-linkedin"></i></a></li>
                                 <li><a href="whatsapp://send?text={{ urlencode($blog->title . ' ' . url()->current()) }}" target="_blank"><i class="flaticon-whatsapp"></i></a></li>
                              </ul>
                           </div>
                        </div>
                        <!-- Like button goes here -->
                     </div>
                     <div class="comment">
                        <div class="title">
                           <h3>Recent comments</h3>
                        </div>
                        <ul class="all-comment">
                           @foreach($blog->comments as $comment)
                           <li>
                              <div class="comment-body">
                                 <a href="author.html">
                                    <h4>{{ $comment->name }}</h4>
                                 </a>
                                 <a href="#!">
                                    <p class="time">{{ $comment->created_at->format('F j, Y \a\t g:i a') }}</p>
                                 </a>
                                 <p>{{ $comment->content }}</p>
                              </div>
                           </li>
                           <!--
                              <div class="comment-item media mt-30">
                                  <div class="media-body">
                                      <h6>{{ $comment->name }}</h6>
                                      <p class="text-muted small">{{ $comment->created_at->format('F j, Y \a\t g:i a') }}</p>
                                      <p>{{ $comment->content }}</p>
                                  </div>
                              </div> -->
                           @endforeach
                        </ul>
                        <div class="title leave">
                           <h3>Leave a comment</h3>
                        </div>
                        <form id="commentForm" action="{{ route('comments.store', $blog->mask) }}" method="POST">
                           @csrf
                           <div class="row">
                              @guest
                              <div class="col-lg-6 col-md-6">
                                 <input type="text" id="commentName" name="name" placeholder="name*" required class="input-field">
                              </div>
                              <div class="col-lg-6 col-md-6 mt-sm-30">
                                 <input type="email" id="commentEmail" name="email" placeholder="email*" required class="input-field">
                              </div>
                              @endguest
                              <div class="col-lg-12 mt-30">
                                 <textarea id="commentContent" name="content" placeholder="your comments*" required class="input-field"></textarea>
                              </div>
                              <div class="col-lg-12 mt-30">
                                 <button type="submit" id="commentSubmit">post comment</button>
                              </div>
                           </div>
                        </form>
                     </div>
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

                     <div class="topic about text-center  mt-30">
                        <div class="image">
                           <img src="/assets/images/founder.png" alt="Author Image">
                        </div>
                        <a href="">
                           <h3>Hello, I'm Prisca Patience</h3>
                        </a>
                        <p> Ama Dziedzorm Gyamwodie officially known as Prisca Patience Gyamwodie, a Public Relations Expert/Strategic Communications by training, however, currently practicing International Relations and diplomacy by profession.  </p>
                     </div>
                     <!-- topic 2 -->
                     <!-- topic 3 -->

                     <!-- topic 4 -->
                  </div>
               </div>
               <!-- end right content area -->
            </div>
         </div>
      </section>
      <!-- end main area -->
      <script>
         document.getElementById('commentForm').addEventListener('submit', async function(e) {
         e.preventDefault();


         const submitButton = document.getElementById('commentSubmit');
         const originalButtonText = submitButton.textContent;

         try {
             // Disable button and show loading state
             submitButton.disabled = true;
             submitButton.textContent = 'Posting...';

             // Get form data
             const formData = new FormData(this);

             // Send AJAX request
             const response = await fetch(this.action, {
                 method: 'POST',
                 headers: {
                     'Accept': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                 },
                 body: formData
             });

             const data = await response.json();

             if (data.success) {
                 // Show success message
                 alert('Comment posted successfully!');

                 // Clear form fields
                 this.reset();

                 // Reload the page to show the new comment
                 window.location.reload();
             } else {
                 // Show error message
                 alert(data.message || 'Error posting comment');
             }
         } catch (error) {
             console.error('Error:', error);
             alert('An error occurred while posting your comment');
         } finally {
             // Reset button state
             submitButton.disabled = false;
             submitButton.textContent = originalButtonText;
         }
         });

        document.querySelectorAll('.btn-like').forEach(button => {
        button.addEventListener('click', async function(e) {
        e.preventDefault();
        const form = this.closest('form');

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            });

            const data = await response.json();

            if (data.success) {
                // Update like count
                const likeCountElement = this.querySelector('span');
                if (likeCountElement) {
                    const currentCount = parseInt(likeCountElement.textContent);
                    likeCountElement.textContent = data.count;
                    // likeCountElement.textContent = data.liked ? currentCount + 1 :  currentCount - 1;
                }

                // Show success message
                // alert(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});
      </script>
      @include('includes.footer')
   </body>
</html>
