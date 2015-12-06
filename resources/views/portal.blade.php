<!DOCTYPE html>
<html>
    
<head>
    <title>@yield('title')</title>
    <link media="all" type="text/css" rel="stylesheet" href="css/normalize.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/portal_style.css">
    
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
    
<body>
    
    <nav>
        <div id="navContent">
            <div id="dciIcon">
                <img src="images/dci_Icon.png" alt="DCI Icon" title="DCI Icon" />
            </div>

            <div id="menu">

                <a href="#">
                    <div id="invoices" class="menuBtn tooltipColor" data-toggle="tooltip" data-placement="right" title="Invoices">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    </div>
                </a>
                
                <a href="#">
                    <div id="customers" class="menuBtn tooltipColor" data-toggle="tooltip" data-placement="right" title="Customers">
                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                    </div>
                </a>
                
                <a href="#">
                    <div id="settings" class="menuBtn tooltipColor" data-toggle="tooltip" data-placement="right" title="My Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </div>
                </a>
                
                <a href="#">
                    <div id="timesheet" class="menuBtn tooltipColor" data-toggle="tooltip" data-placement="right" title="Timesheet">
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    </div>
                </a>
                
                @yield('extraLink')
                
                <a href="/auth/logout">
                    <div id="logout" class="menuBtn tooltipColor" data-toggle="tooltip" data-placement="right" title="Log Out">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                    </div>
                </a>
            </div>
        </div>
    </nav>
    
    <div id="container">
        
        <div id="employee">@yield('empName')</div>
        
        @yield('content')
        
        <footer>
            <p id="copyright">&copy; 2009-2015 D.C.I. Printing &amp; Graphics and Jes&#8226;Her&#8226;Art Designs, All Rights Reserved.</p>
        </footer>
    </div>
    
    <!--jQuery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/color/jquery.color-2.1.2.js"></script>
    
    <!--Bootstrap-->
    <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="js/main.js"></script>
    
    @yield('activeLink')
</body>
    
</html>