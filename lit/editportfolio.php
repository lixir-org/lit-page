<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Edit Portfolio
        </h4>
            <div class="col-md-8">
                <div class="card">
                    <div class="content" style="background-color: #000; color: #fff;">
                    <?php
						if (!isset($_GET['folioid']) || $_GET['folioid'] == NULL) {
							echo "<script>window.location = 'portfolio.php';</script>";
							//header("Location: sliderlist.php");
						} else {
							$folioid = $_GET['folioid'];
				    	}

				    	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
							$updatePortfolio = $folio->updatePortfolio($_FILES, $_POST, $folioid);
						}
					?>
				    <?php
				    	if (isset($updatePortfolio)) {
				    		echo $updatePortfolio;
				    	}
					?>
                    <?php
						$sql6 = "SELECT * FROM tbl_folio WHERE id = '$folioid' ORDER BY id DESC";

						$portfolio = $folio->getPortfolioById($folioid);
                        if ($portfolio){
                            $i = 0;
                            while($row = $portfolio->fetch_assoc()){
                                $i++;
					?>
                        <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                        	<div class="form-group">
    							<label class="control-label col-sm-2" for="Title">Title:</label>
    							<div class="col-sm-10">
      								<input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
    							</div>
  							</div> 
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="link">Link:</label>
    							<div class="col-sm-10">
      								<input type="text" name="link" class="form-control" value="<?php echo $row['link']; ?>">
    							</div>
  							</div> 
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
