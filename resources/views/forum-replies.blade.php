<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PATANI</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo_square.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo_square.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header" class="header-fix">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        {{-- <h1><a href="#intro" class="scrollto">PATANI</a></h1> --}}
        <!-- Uncomment below if you prefer to use an image logo -->
         <a href="{{ url('/') }}#intro"><img src="{{ asset('assets/img/footer-logo.png') }}" alt="" title="" style="width: 50%" /></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="{{ url('/') }}#intro">Home</a></li>
          <li><a href="{{ url('/') }}#about">About Us</a></li>
          <li><a href="{{ url('/') }}#services">Services</a></li>
          <li><a href="{{ url('/') }}#wf">Weather Forecasting</a></li>
          <li><a href="{{ url('/') }}#contact">Contact</a></li>
          <li class="menu-active"><a href="{{ url('forum') }}">Forum</a></li>
          @if (!Session::has('id'))
            <li><a href="{{ url('login') }}">Login</a></li>
          @else
            <li><a href="{{ url('/do-logout') }}">Hai, {{ Session::get('nama') }}!</a></li>
          @endif
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <main id="main">
    <!--==========================
      About Us Section
    ============================-->
    <section id="about" style="padding-top: 100px;">
      <div class="container">
        <a href="{{ url('/forum') }}">Forum</a> > {{ $forum->nama_forum }}
        <hr>
        <p>
          <i class="fa fa-tag" aria-hidden="true"></i>
          Category:&nbsp;<a href="#">{{ $forum->kategori_forum }}</a>
        </p>
         <table width="100%" id="table-replies">
           <thead>
             <tr style="border-bottom: 1px solid rgba(0,0,0,.1);">
               <td width="20%" align="center">Author</td>
               <td align="left">Post</td>
             </tr>
           </thead>
           <tbody>
            @foreach($isi as $i)
             <tr>
               <td align="center">{{ date('d M, Y \a\t H:i') }}</td>
               <td align="right">#{{ $i->id_isi }}</td>
             </tr>
             <tr>
               <td align="center" class="author-col">
                <img src="{{ asset('assets/img/team-'.mt_rand(1, 4).'.jpg') }}" class="img-circle">
                <p>{{ $i->nama }}</p>
               </td>
               <td style="vertical-align: top;">
                  <div class="reply-content">
                    <p>{{ $i->isi }}</p>
                  </div>
               </td>
             </tr>
             @endforeach
           </tbody>
         </table>
         <span id="#last"></span>

          @if (!Session::has('id'))
          <div class="template-notice">
            You must be logged in to reply to this topic.
          </div>
          
          <div class="login-first">
            <form action="{{ url('do-login') }}" method="post" class="form">
              @csrf
              <input type="hidden" name="redirect_back" value="true">
              <div class="row">
                <div class="col-md-6">
                  <h3>Login</h3>
                  <div class="form-group">
                    <input class="form-control" type="text" name="username" placeholder="Username">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <button type="submit">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
          @else
          <span id="#login"></span>
          <div class="login-first">
            <form action="{{ url('forum/reply') }}" method="post" class="form">
              @csrf
              <input type="hidden" name="f_id" value="{{ $forum->id_forum }}">
              <div class="row">
                <div class="col-md-6">
                  <h3>Reply To:&nbsp;{{ $forum->nama_forum }}</h3>
                  <div class="form-group">
                    <textarea class="form-control" name="reply" rows="5"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <button type="submit">Reply</button>
                </div>
              </div>
            </form>
          </div>
          @endif
      </div>
    </section><!-- #about -->
  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <a href="#intro"><img src="{{ asset('assets/img/footer-logo.png') }}" alt="" title="" style="width: 50%" /></a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>BizPage</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('assets/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{ asset('assets/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/lib/isotope/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
  <script src="{{ asset('assets/lib/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('assets/contactform/contactform.js') }}"></script>

  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script type="text/javascript">
      @if (session('status'))
          alert("{{ session('status') }}");
      @endif
  </script>
</body>
</html>
