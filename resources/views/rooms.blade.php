<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Booking Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">    
    <div class="container">
      <a class="navbar-brand" href="/index">Universty of Jaffna</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item "><a href="/home" class="nav-link">Home</a></li>
           <li class="nav-item active"><a href="/rooms" class="nav-link">Rooms</a></li>
          <li class="nav-item"><a href="/mypdf" class="nav-link">PDF</a></li>
          <li class="nav-item"><a href="/profile" class="nav-link">Profile</a></li>
          <li class="nav-item"><a href="{{ route('logout') }}"  class="nav-link"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
          </li>

         @if(Auth::user()->Position =='Admin')  
          <li class="nav-item"><a href="/confirmlist" class="nav-link">Admin Panel</a></li>
         @endif
      
        </ul>
      </div>

    </div>
  </nav>


  
  <div class="block-30 block-30-sm item" style="background-image: url('images/28.jpg');" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-10">
          <span class="subheading-sm">Rooms</span>
          <h2 class="heading">Rooms &amp; Suites</h2>
        </div>
      </div>
    </div>
  </div>

    </div>

   

    
    <div class="site-section bg-light">
      <div class="col-md-7 section-heading">
            <span class="subheading-sm">Rooms On</span>
            <div class="inner" id="divToHide"> 
            <h2 class="bookbtn-padding"><?php echo date("Y/M/d")?></h2>
            
            </div>
          </div>
          <br><br><br>
<!-- 
       <div class="row">
            <div class="col-md-12">

              <div class="nonloop-block-13 owl-carousel">

                  @foreach($rooms as $room)
                  <div class="item">
                    <div class="block-34">
                      <div class="image">
                        <a href="#"><img src="images/5.jpg" alt="Image placeholder"></a>
                      </div>
                      <div class="text">
                       
                        <div class="price"><sup>Rs</sup><span class="number">{{$room->price}}</span><sub>/per night</sub></div>
                        <ul class="specs">
                          <li><strong>Categories:</strong> Single</li>
                          <li><strong>Facilities:</strong> Closet with hangers, HD flat-screen TV, Telephone</li>
                          <li><strong>Size:</strong> 20m<sup>2</sup></li>
                          <li><strong>Bed Type:</strong> One bed</li>
                         

                        </ul>
                      </div>
                    </div>
                  </div>
                  @endforeach
 
              </div>
    
            </div> 
          </div>

    </div>
    
</div> -->




<div class="row">
            <div class="col-md-12">
              <div class="nonloop-block-13 owl-carousel">

             
              @foreach($rooms as $room)
                 <div class="item">
                    
                    <div class="block-34">
                      <div class="image">
                        <a href="#"><img src="images/5.jpg" alt="Image placeholder"></a>
                      </div>
                      <div class="text">
                        <h2 class="heading"></h2>
                        <div class="price"><sup>Rs : </sup>{{$room->price}}<span class="number"></span><sub> /per night</sub></div>

                        <ul class="specs">
                          <li><strong>Room ID : {{$room->roomID}}</strong></li>
                          <li><strong>Description : {{$room->description}}</strong></li>
                          <li><strong>Facilities  : {{$room->Facilities}} </strong></li>
                          <li><strong>Size        : {{$room->size}}</strong> m<sup>2</sup></li>
                          <li><strong>Bed Type    : {{$room->Bed_Type}}</strong> </li>
                          
                        </ul> 
                       
                      </div>
                    </div>
                    
                  </div>               
            @endforeach 


              </div>
            </div> 
          </div>
      </div>
    </div>



  
    <div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 section-heading">
            <span class="subheading-sm"></span>
            <h2 class="heading"></h2>
          </div>
        </div>



      </div>
    </div>

  
    <footer class="footer">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 col-lg-4">
          <h3 class="heading-section">About Us</h3>
          <p class="mb-5">This web portal is for the use of staff of University of Jaffna, for Non-Acedemic and Acedemic staff. You can book a room in Guest House, by using this web portal other than filling documents.</p>
        </div>
        <div class="col-md-6 col-lg-4">
          <h3 class="heading-section">Blog</h3>
          <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
              <img src="images/25.jpg" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <h3 class="heading"><a href="#">Guest House - Lobby</a></h3>
              <div class="meta">
                
              </div>
            </div>
          </div>

          <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
              <img src="images/16.jpg" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <h3 class="heading"><a href="#">Guest House - Varanda</a></h3>
              <div class="meta">
                <!-- <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div> -->
              </div>
            </div>
          </div>

          <div class="block-21 d-flex mb-4">
            <figure class="mr-3">
              <img src="images/21.jpg" alt="" class="img-fluid">
            </figure>
            <div class="text">
              <h3 class="heading"><a href="#">Guest House - Living Room</a></h3>
              <div class="meta">
                <!-- <div><a href="#"><span class="icon-calendar"></span> May 29, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="block-23">
            <h3 class="heading-section">Contact Info</h3>
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">Matha Road,Narahenpitiya.</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">0112689872</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">ganeshalingam@gmail.com</span></a></li>
                <li><span class="icon icon-clock-o"></span><span class="text">6:00am - 9:00pm</span></li>
              </ul>
            </div>
        </div>
        
        
      </div>
      <div class="row pt-5">
        <div class="col-md-12 text-left">
         
        </div>
      </div>
    </div>
  </footer>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>