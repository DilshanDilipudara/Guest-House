<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin Panel</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="css/themify-icons.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="black" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->
	<title>update room</title>

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="adminIndex.php" class="simple-text">
                    Admin Panel
                </a>
            </div>
            <?php include '../resources/views/includes/navbar.php'?>            

            
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="/updateroom"> Update</a>
                </div>
                
            </div>
        </nav>


        <div class="content">
        <!-- Add content here -->
           <!-- vertical tabs -->
<div class="row">
	<div class="col-md-2 col-sm-4 col-xs-6">
    
        <ul class="nav nav-stacked" role="tablist">
        <li class="active">
               
            </li>
            

       
        </ul>
    </div>
	<div class="col-md-8 col-sm-8 col-xs-6">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="info">

            <div class="row">
            @foreach($data as $value)
            
            <form action="{{url('/updateroom')}}" id="addRoomForm" onsubmit="return(validate());" method="POST" enctype="multipart/form-data"> 
                {{csrf_field()}}
                
                <div class="col-md-6">
                Room ID:
                    <div class="form-group">
                    
                        <input type="number" value="{{$value->Roomid}}" name="id" placeholder="Room ID" required="required"  class="form-control" readonly>
                    </div>
                </div>
                
                <div class="col-md-6">
                Description:
                    <div class="form-group">
                    
                        <input type="text" value="{{$value->description}}" name="desc" placeholder="Description" required="required"  class="form-control" autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                Price(LKR):
                    <div class="form-group">
                        <input type="number" value="{{$value->price}}" name="price"  placeholder="Price" required="required"  pattern="[0-9]" title="Price must be valid number."class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                Size in Sq.Meters:
                    <div class="form-group">
                        <input type="number" value="{{$value->size }}" name="size" placeholder="Size" required="required" pattern="(?=.*\d)" title="Size must be valid number." class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                Bed Type:
                    <div class="form-group">
                    <input type="radio" name="bedtype"  value="{{$value->Bed_Type}}" @if($value->Bed_Type  == "Single Bed") checked @endif> Single Bed<br>
                    <input type="radio" name="bedtype" value="{{$value->Bed_Type}}" @if($value->Bed_Type  == "Double Bed") checked @endif> Double Bed<br>                  </div>
                </div>

                <div class="col-md-6">
                Facilities:
                    <div class="form-group">
                        <input type="text" value="{{$value->Facilities}}"  name= "fac" placeholder="Facilities" required="required"  class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                Image:
                    <div class="form-group">
                      <img src="/uploads/room/{{$value->room_image}}"   alt="no available picture"><br><br>
                    <input type="file" name="select_file" value="/uploads/room/{{$value->room_image}}" required>
            
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <button  type="submit" class="btn btn-primary">Save</button>
                        <button type="button" onclick="clearForm()" class="btn btn-danger">Clear</button>

                    </div>
                </div>
             <p>=======================================================================================================</P>
            </form>
            @endforeach
    	</div>
                
            </div>
            <div class="tab-pane" id="description">
            </div>
           
            <div class="tab-pane" id="support">
            </div>
            <div class="tab-pane" id="extra">
            </div>
        </div>
    </div>
</div> 

        </div>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="js/demo.js"></script>

</html>

<!-- ******************************** jquery *********************************** -->


