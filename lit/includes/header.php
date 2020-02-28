<?php
    include '../lib/Session.php';
    include '../helpers/Format.php';  
    include '../classes/Blog.php';    
    include '../classes/Contact.php'; 
    include '../classes/Advert.php';
    include '../classes/Portfolio.php';
    Session::checkSession();

    $fm = new Format();
    $blog = new Blog();
    $msg = new Contact();
    $ads = new Advert();
    $folio = new Portfolio();

    date_default_timezone_set('Africa/Lagos');

    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");

?>

<!DOCTYPE html>
<html lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Asifat Kazeem Adeniyi">
    <link rel="icon" type="image/png" href="images/fav.png">
    <title>CEO - Lixir Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

 <script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: "textarea#elm1",
      theme: "modern",
      width: 500,
      height: 300,
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
      ],
      //content_css: "css/content.css",
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bulllist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
      style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: 
        {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: 
        {color: '#ff0000'}},
        {title: 'Example1', inline: 'span', classes: 'example1'},
        {title: 'Example2', inline: 'span', classes: 'example2'},
        {title: 'Tablestyles'},
        {title: 'Table row1', selector: 'tr', classes: 'tablerow1'}
      ]

    });
  </script>
    <style type="text/css">
    .success{
            color: green; font-size: 18px;
        }
        .error {
            color: red; font-size: 18px;
        }
        .edit {
            color: #777;
            font-weight: bold;
        }
        .edit:hover {
            text-decoration: underline;
            color: darkslategray;
        }
        .card {
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);
            background-color: #FFFFFF;
            margin-bottom: 30px;
        }
        .card .image {
            width: 100%;
            overflow: hidden;
            height: 260px;
            border-radius: 4px 4px 0 0;
            position: relative;
            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            transform-style: preserve-3d; 
        }
        .card .image img {
            width: 100%; 
        }
        .card .content {
            padding: 15px 15px 10px 15px; 
        }
        .card .header {
            padding: 15px 15px 0; 
        }
        .card .title {
            margin: 0;
            color: #333333;
            font-weight: 300;
        }
        .card .avatar {
            width: 30px;
            height: 30px;
            overflow: hidden;
            border-radius: 50%;
            margin-right: 5px; 
        }
        .card .description {
            font-size: 14px;
            color: #333; 
        }
        .card-user .image {
            height: 110px; 
        }
        .card-user .author {
          text-align: center;
          text-transform: none;
          margin-top: -70px;
        }
        
  .card-user .avatar {
  width: 124px;
  height: 124px;
  border: 5px solid #FFFFFF;
  position: relative;
  margin-bottom: 15px; }
  }
  .card-user .avatar.border-gray {
    border-color: #EEEEEE; }
.card-user .title {
  line-height: 24px; }
.card-user .content {
  min-height: 240px; }
.navbar .nav .notification{
    background-color: #FB404B;
    text-align: center;
    border-radius: 10px;
    min-width: 18px;
    padding: 0 5px;
    height: 18px;
    font-size: 12px;
    color: #FFFFFF;
    font-weight: bold;
    line-height: 18px;            
    top: 0px;
    left: 7px;
}
    </style>
</head>
<body>
    <?php
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            Session::destroy();
        }
    ?>  
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php"><img src="../images/brand_logo.png"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">             
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                            $getContact = $msg->getAllContact();
                            if ($getContact) {
                               $count = mysqli_num_rows($getContact);
                                echo "<span class='notification'>".$count."</span>";
                            } else {
                                echo "<span class='notification'>0</span>";
                            }   
                        ?>
                 <i class="fa fa-envelope"></i> Contacts <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php
                            if ($getContact){
                                while($row = $getContact->fetch_assoc()){
                        ?>
                        <li class="message-preview">
                            <a href="viewmsg.php?msgid=<?php echo $row['id'];?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="images/default.png" width="50" height="50"" alt="">
                                    </span>
                                    <div class="media-body">
                                    <!--Notification for new message here-->
                                        <h5 class="media-heading"><strong><?php $row['name']; ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $fm->formatDate($row['date']); ?></p>
                                        <p><?php echo substr($row['body'], 0, 30)."..."; ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php } } ?>
                        
                        <li class="message-footer">
                            <a href="inbox.php">View All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="dashboard.php" class="dropdown-toggle" data-toggle="dropdown"><img src="images/ceo.jpg" width="30" height="30" class="img-circle"> <i class="fa fa-user"></i> Hello <?php echo Session::get("username"); ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="inbox.php"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="?action=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>