<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Add New Post
        </h4>
        <?php
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		        $insertPost = $blog->addNewBlogPost($_POST, $_FILES);
		    }
		?>
	        <div class="col-md-8">
	            <div class="card">
	                <div class="content" style="background-color: #000; color: #fff;">
	                <!--Code to insert New Posts into the database-->
						
	                		<?php
				        		if (isset($insertPost)) {
				        			echo $insertPost;
				        		}
				            ?>
						<form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
    							<label class="control-label col-sm-2" for="title">Title:</label>
    							<div class="col-sm-10">
      								<input type="text" name="title" class="form-control" placeholder="Enter Post Title">
    							</div>
  							</div>
							<div class="form-group">
    							<label class="control-label col-sm-2" for="author">Author:</label>
    							<div class="col-sm-10">
      								<input type="text" name="author" placeholder="Author" class="form-control">
      							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="image">Upload Image</label>
    							<div class="col-sm-10">
    								<input type="file" name="image" class="form-control">
    							</div>
  							</div>
  							<div class="form-group">
	  							<div style="overflow-x: auto;">
								  	<label class="control-label col-sm-2"  for="content">Content:</label>
								  	<div class="col-sm-10">
										  <!--  id="elm1" -->
								  		<textarea name="body" class="form-control" style="max-width: 100%;"></textarea>
								  	</div>
								</div>
							</div>
  							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" name="submit" class="btn btn-success btn-md">Add Post</button>
							    </div>
							</div>
						</form>
	                	
<?php include 'includes/footer.php'; ?>