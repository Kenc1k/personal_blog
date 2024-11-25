<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Isabekoff_blog</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="{{ asset('assets/img/luffy.jpeg') }}" rel="icon">
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
    .user-name a {
        font-size: 16px;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        padding: 5px 10px;
        /* border: 1px solid #6c7bff; */
        border-radius: 20%;
        transition: background-color 0.3s, color 0.3s;
    }

    .user-name a:hover {
        background-color: #6c7bff;
        color: white;
        border-radius: 20px;
    }
    /* Container styling */
  .logout-container {
      display: flex;
      justify-content: center; /* Center the button horizontally */
      align-items: center; /* Center the button vertically */
      margin-top: 3px;
      margin-left: 7px;
  }

  /* Button styling */
  .btn-logout {
      background-color: #2E1B2F; 
      color: white; /* White text */
      border: none;
      padding: 10px 20px; /* Padding for better size */
      font-size: 16px; /* Adjust font size */
      border-radius: 25px; /* Rounded corners */
      cursor: pointer; /* Show pointer cursor on hover */
      transition: background-color 0.3s; /* Smooth transition for hover effect */
  }

  /* Hover effect */
  .btn-logout:hover {
      background-color: #482b49; /* Darker red when hovered */
  
  }

  </style>

</head>

<body class="blog-page">

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
        @auth
        @if(auth()->user()->role === 'admin')
            <li><a href="/category">Admin</a></li>
        @endif
      @endauth
          @foreach($categories as $category)
            <li>
              <a href="#">{{$category->name}}</a>
            </li>
          @endforeach
          <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        
        
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
        <p>This is my brend new portfolio blog website hope this will be usefull for you </p>
        {{-- <nav class="breadcrumbs">
          <ol>
            <li><a href="category">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav> --}}
      </div>
    </div><!-- End Page Title -->

    <section id="blog-posts" class="blog-posts section">
      <div class="container">
        <div class="row gy-4">
          @if($posts->isEmpty())
            <p>No posts found for this category.</p>
          @endif

          <h2 class="text-center">
            {{ isset($category) ? $category->name . ' Posts' : 'All Posts' }}
          </h2>
    
          @foreach ($posts as $post)
          <div class="col-lg-4">
            <article>
              <div class="post-img">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
              </div>
              <p class="post-category">{{ $post->category->name }}</p>
              <h2 class="title">
                <a href="{{ route('blog.details', $post->id) }}">{{ $post->title }}</a>
              </h2>
              
              <p style="font-family: 'Arial', sans-serif; font-size: 16px; color: #333;">
                {{ $post->description }}
              </p>
              <br>
              <p class="post-date">
                <time datetime="">{{ $post->created_at->format('d:m:Y') }}</time>
              </p>
            </article>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    

    <section id="blog-pagination" class="blog-pagination section">
      <div class="container">
          <div class="d-flex justify-content-center">
              {{ $posts->links('pagination::bootstrap-5') }}
          </div>
      </div>
  </section>
  
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

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>