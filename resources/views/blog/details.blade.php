<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Isabekoff_blog</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="{{ asset('assets/img/luffy2.jpeg') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <style>
    button {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    color: inherit; /* Keeps the text/icon color */
}

button:hover {
    color: #007bff; /* Optional: Add hover color */
    text-decoration: underline; /* Optional: Add underline on hover */
}
  </style>
</head>

<body class="blog-details-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">


        <a href="/" class="logo d-flex align-items-center">
            <h1 class="sitename" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">Isabekoff_blog</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
              <li>
                @auth
                  <div class="user-name">
                    <a href="#">{{ Auth::user()->name }}</a>
                  </div>
                @else
                    <!-- Display login link if not logged in -->
                    <a href="{{ route('loginPage') }}">Login</a>
                @endauth
              </li>
              @foreach($categories as $category)
                <li>
                  <a href="#">{{$category->name}}</a>
                </li>
              @endforeach
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>

    </div>
  </header>

  <main class="main">
   <!-- Page Title -->
   <div class="page-title dark-background">
    <div class="container position-relative">
      <h1>Blog</h1>
      <p>This is my brend new portfolie blog website hope this will be usefull for you </p>
      <nav class="breadcrumbs">
        {{-- <ol>
          <li><a href="/category">Home</a></li>
          <li class="current">Blog</li>
        </ol> --}}
      </nav>
    </div>
  </div><!-- End Page Title -->

    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article" >
                
                <div class="post-img" align="center" >
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid"  >
                </div>

                <h2 class="title">{{$post->title}}</h2>
                <div class="meta-top">
                    <ul>
                      <p class="post-date">
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                          <time datetime="">{{ $post->created_at->format('d:m:Y') }}</time> | {{ $post->views }} views
                        </p>
                      </li>
                      
                      <li class="d-flex align-items-center"><i class="bi bi-folder"></i> 
                        <a href="#">{{ $post->category->name }}</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <form action="{{ route('post.like', $post->id) }}" method="POST" 
                          @guest onsubmit="return showLoginError();" @endguest>
                        @csrf
                        <input type="hidden" name="is_like" value="1">
                        <button type="submit" class="btn">
                            <i class="bi bi-hand-thumbs-up"></i> ({{ $post->likeCount() }})
                        </button>
                    </form>
                
                    <form action="{{ route('post.like', $post->id) }}" method="POST" 
                          @guest onsubmit="return showLoginError();" @endguest>
                        @csrf
                        <input type="hidden" name="is_like" value="0">
                        <button type="submit" class="btn">
                            <i class="bi bi-hand-thumbs-down"></i> ({{ $post->dislikeCount() }})
                        </button>
                    </form>
                </div>
                
                <script>
                    function showLoginError() {
                        alert('You need to log in to like or dislike posts.');
                        return false; // Prevent the form from being submitted
                    }
                </script>
                
                
                

                <div class="content">
                    <blockquote>
                      <p>
                        {{$post->description}}
                      </p>
                    </blockquote>
                  <p>
                    {{$post->text}}
                  </p>

                </div><!-- End post content -->
              </article>

            </div>
          </section><!-- /Blog Details Section -->

          <!-- Blog Comments Section -->
          <section id="blog-comments" class="blog-comments section">
            <div class="container">
                <h4 class="comments-count">Comments ({{ $post->comments->count() }})</h4>
        
                <!-- Loop through comments -->
                <ul class="comments-list">
                    @foreach ($post->comments as $comment)
                        <li>
                            <div class="comment">
                                <p><strong>{{ $comment->user->name }}</strong></p>
                                <p>{{ $comment->comment }}</p>
                                <p><small>{{ $comment->created_at->format('d:m:Y H:i') }}</small></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        


          <section id="comment-form" class="comment-form section">
            <div class="container">
        
                @auth
                    <form action="{{ route('comment.store', $post->id) }}" method="POST">
                        @csrf
                        <h4>Post Comment</h4>
                        <p>Do not worry about your comment, I will keep it secret</p>
        
                        <div class="row">
                            <div class="col form-group">
                                <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                            </div>
                        </div>
        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </div>
                    </form>
                @else
                    <p>You need to <a href="{{ route('loginPage') }}">log in</a> to post a comment.</p>
                @endauth
        
            </div>
        </section>
        

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

          </div>

        </div>

      </div>
    </div>

  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container">
      <h4 class="sitename">Welcome to my blog post websyte you can read my personal views and enjoy from little games </h4>
      <p>I am working on adding new features to enjoy you in this site</p>
      <div class="social-links d-flex justify-content-center">
        <a href="https://t.me/isabekoff_coder"><i class="bi bi-telegram"></i></a>
        <a href="https://github.com/isabekoviskandar"><i class="bi bi-github"></i></a>
        <a href="https://www.instagram.com/wbu.zayd/"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/in/iskandar-isabekov-60745229b/"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  
</body>

</html>