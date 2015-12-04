<!DOCTYPE html>
<html>
    
<head>
    <title>@yield('title')</title>
    <link media="all" type="text/css" rel="stylesheet" href="css/normalize.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/style.css">
    
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>
    
<body class="short">
    
    <div id="loginModal">
        <div id="loginBlock">
            <div id="closeModalBtn" class="loginButton closed"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></div>
            <a href="/customers"><button id="custBtn">Customer Login</button></a>
            <br/>
            <a href="/employees"><button>Employee Login</button></a>
        </div>
    </div>
    
    <nav>
        <div class="row decorativeBar">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
        </div>
        
        <div id="navItems" class="row">
            <div class="col-lg-2 col-md-2">
                <a href="/"><img src="images/dci_logo.png" alt="DCI Logo" title="DCI Logo" /></a>
            </div>
            
            <div id="navLinks" class="col-lg-10 col-md-10">
                <div class="navLink">
                    About &amp;<br/>Contact
                </div>
                <div class="navLink">
                    Products<br/>&amp; Services
                </div>
                <div class="navLink">
                    Quote<br/>Request
                </div>
                <div class="navLink">
                    Online<br/>Order
                </div>
                <div class="navLink">
                    Bldg. Dept.<br/>Quick Links
                </div>
                <div class="navLink">
                    Create<br/>Account
                </div>
                <div class="navLink">
                    <button class="loginButton closed">Login</button>
                </div>
            </div>
        </div>
        
        <div class="row decorativeBar">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
        </div>
    </nav>
    
    <div id="container">
        @yield('content')
    </div>
    
    <footer class="short">
        
        <div class="row decorativeBar">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
        </div>
        
        <div id="footerInfo">
            
            <div class="footPanel">
                <a href="/"><img id="footLogo" src="images/dci_logo.png" alt="DCI Logo" title="DCI Logo" /></a>   
            </div>
            
            <div class="footPanel">
                <a href="#"><p>About &amp; Contact</p></a>
                <a href="#"><p>Products &amp; Services</p></a>
                <a href="#"><p>Partners</p></a>
            </div>
            
            <div class="footPanel">
                <a href="#"><p>Quote Request</p></a>
                <a href="#"><p>Online Order</p></a>
                <a href="#"><p>Frequently Asked Questions</p></a>
            </div>
            
            <div class="footPanel">
                <a href="#"><p>Building Department Quick Links</p></a>
            </div>
            
            <div class="footPanel">
                <a href="#" class="loginButton"><p>Login</p></a>
                <a href="#"><p>Create Account</p></a>
                <a href="#"><p>Employee Portal</p></a>
            </div>
        </div>
        
        <p id="copyright">&copy; 2009-2015 D.C.I. Printing &amp; Graphics and Jes&#8226;Her&#8226;Art Designs, All Rights Reserved.</p>
        
        <div class="row decorativeBar">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
        </div>
        
    </footer>
    
    
    <!--jQuery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/color/jquery.color-2.1.2.js"></script>
    
    <!--Bootstrap-->
    <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="js/main.js"></script>
</body>
    
</html>