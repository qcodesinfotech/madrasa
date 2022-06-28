
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Madarasa</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/koran.png')}}"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{ URL::asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ URL::asset('assets/css/portal.css')}}">
    <style>
    label{
         color:#FF4500;
  font-family: Courier New;

    }
    
    select option{
        text-align:center;
    }
    
     h1{
      text-decoration:underline;
       text-transform: uppercase;
       }

     * {
            text-transform: capitalize;
             font-family: Slabo;
        }

        .cell,th,td{
            text-align: center;
      
        }
    </style>
    
</head> 
<body class="app">   
<header class="app-header fixed-top">
        <!-- Sidebar -->
        @include('common.header')
        
                <!-- Topbar -->
                @include('common.sidebar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->           
            @include('common.footer')
    <!-- Javascript -->          
    <script src="{{ URL::asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>  

    <!-- Charts JS -->
    <script src="{{ URL::asset('assets/plugins/chart.js/chart.min.js')}}"></script> 
    <script src="{{ URL::asset('assets/js/index-charts.js')}}"></script> 
    
    <!-- Page Specific JS -->
    <script src="{{ URL::asset('assets/js/app.js')}}"></script> 

</body>
</html> 