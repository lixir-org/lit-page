<?php
    include '../classes/Adminlogin.php';

    $al = new Adminlogin();

    header("Cache-control: no-store, no-cache, must-revalidate");
    header("Cache-control: pre-check=0, post-check=0, max-age=0");
    header("Pragma: no-cache");
    header("Expires: Mon, 6 Dec 1977 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $loginChk = $al->adminlogin($username, $password);
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Lixir Admin Login Page</title>
    <!-- Meta-Tags -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta property="og:title" content="HTML Class - FCC 2018">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="icon" href="images/favicon.png">

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->

    <!-- Custom Theme files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/mystyle.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet"> <!-- Font-Awesome-Icons-CSS -->
    <!-- //Custom Theme files -->
    
    <!-- web font --> 
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <!-- //web font -->

    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <style type="text/css">
        .success {
            color: green; 
            font-size: 18px;
            padding-bottom: 10px;
        }
        .error, .red {
            color: red; 
            font-size: 18px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
    //Session::checkLogin();
?>
    <div class="main">
        <h1>Admin Login Page</h1>
        <div class="main-w3lsrow">
            <!-- login form -->
            <div class="login-form login-form-left"> 
                <div class="agile-row">
                    <div class="head">
                        <h2>Login to your dashboard</h2>
                        <span class="fa fa-lock"></span>
                    </div>                  
                    <div class="clear"></div>
                    <div class="login-agileits-top"> 
                        <span style="color: red; font-size: 18px;">
                            <?php
                                if (isset($loginChk)) {
                                    echo $loginChk;
                                }
                            ?>
                        </span>   
                        <form action="index.php" method="post"> 
                            <input type="text" class="username" name="username" id="username" Placeholder="Enter Username" required=""/>
                            <input type="password" class="password" name="password" id="password" Placeholder="Enter Password" required=""/>
                            <input type="submit" value="Login" id="loginsubmit"> 
                        </form>     
                    </div> 
                    <div class="login-agileits-bottom"> 
                        <h6>New User? <a href="signup.php">Signup For Free</a></h6>
                    </div> 

                </div>  
            </div>  
        </div>
        <!-- //login form -->
        
        <div class="login-agileits-bottom1"> 
            <h3>or login with</h3>
        </div>
        
        <!-- social icons -->
        <div class="social_icons agileinfo">
            <ul class="top-links">
                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#" class="vimeo"><i class="fa fa-vimeo"></i></a></li>
            </ul>
        </div>
        <!-- //social icons -->
        
        <!-- copyright -->
        <div class="copyright">
            <p>Lixir &copy; <script>document.write(new Date().getFullYear());</script>. All rights reserved</p>
        </div>
        <!-- //copyright --> 
    </div>  
    <!-- //main -->
    
</body>
</html>