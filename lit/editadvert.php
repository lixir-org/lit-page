<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Edit Advert
        </h4>
            <div class="col-md-8">
                <div class="card">
                    <div class="content" style="background-color: #000; color: #fff;">
                    <?php
						if (!isset($_GET['advertid']) || $_GET['advertid'] == NULL) {
							echo "<script>window.location = 'advertlist.php';</script>";
							//header("Location: sliderlist.php");
						} else {
							$advertid = $_GET['advertid'];
				    	}

				    	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
							$updateAdvert = $ads->updateAdvert($_FILES, $advertid);
						}
					?>
				    <?php
				    	if (isset($updateAdvert)) {
				    		echo $updateAdvert;
				    	}
					?>
                    <?php
						$sql6 = "SELECT * FROM tbl_adverts WHERE id = '$advertid' ORDER BY id DESC";

						$advert = $ads->getAdvertById($advertid);
                        if ($advert){
                            $i = 0;
                            while($row = $advert->fetch_assoc()){
                                $i++;
					?>
                        <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                        	<div class="form-group">
    							<label class="control-label col-sm-2" for="image">Upload New Image</label>
    							<div class="col-sm-10">
      								<img src="<?php echo $row['image']; ?>" class="img-responsive"><br>
    								<input type="file" name="image" class="form-control">
    							</div>
  							</div>
							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" name="submit" class="btn btn-success btn-md">Update</button>
							    </div>
							</div>
                        </form>
                        <?php } } ?>
<?php include 'includes/footer.php'; ?>
