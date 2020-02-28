<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Page Heading text-right-->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Welcome
            <small><?php echo Session::get("username"); ?></small>
        </h1>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                </div>
                <div class="content">
                    <div class="author">
                         <a href="dashboard.php">
                        <img class="avatar border-gray" src="images/Ceo.gif" alt="..."/>

                          <h4 class="title"><?php echo Session::get("username"); ?><br />
                             <small><?php echo Session::get("username"); ?></small>
                          </h4>
                        </a>
                    </div>
                    <p class="description text-center"> "Explore the Pages <br>
                        Update your Posts <br>
                        I'm so loving this"
                    </p>
                
<!-- /.row -->

<?php include 'includes/footer.php'; ?>