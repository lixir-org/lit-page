<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Add New Portfolio
        </h4>
	        <div class="col-md-8">
	            <div class="card">
	                <div class="content" style="background-color: #000; color: #fff;">
	                <!--Code to insert New Posts into the database-->
						<?php
							if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
								$addPortfolio = $folio->addPortfolio($_FILES, $_POST);
							}
							if (isset($addPortfolio)) {
								echo $addPortfolio;
							}
						?>
						<form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
    							<label class="control-label col-sm-2" for="Title">Title:</label>
    							<div class="col-sm-10">
      								<input type="text" name="title" class="form-control" placeholder="Enter Title">
    							</div>
  							</div> 
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="link">Link:</label>
    							<div class="col-sm-10">
      								<input type="text" name="link" class="form-control" placeholder="Example: www.achievers.com">
    							</div>
  							</div> 
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="image">Upload Image</label>
    							<div class="col-sm-10">
    								<input type="file" name="image" class="form-control">
    							</div>
  							</div>
  							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" name="submit" class="btn btn-success btn-md">Add Slider</button>
							    </div>
							</div>
						</form>
	                	
<?php include 'includes/footer.php'; ?>