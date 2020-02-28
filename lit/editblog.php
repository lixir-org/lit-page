<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Edit Post
        </h4>
            <div class="col-md-8">
                <div class="card">
                    <div class="content" style="background-color: #000; color: #fff;">
                    <?php
						if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
							echo "<script>window.location = 'postlist.php';</script>";
							//header("Location: postlist.php");
						} else {
							$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['postid']);
				    	}

				    	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
					        $updatePost = $blog->updateBlogPost($_POST, $_FILES, $id);
					    }
					?>
					
					<?php
	        			if (isset($updatePost)) {
	        				echo $updatePost;
	        			}
		            ?>
					
                    <?php
						$getpost = $blog->getBlogPostById($id);
		            	if ($getpost) {
		            		while ($value = $getpost->fetch_assoc()) {
		            ?>
                        <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                        	<div class="form-group">
    							<label class="control-label col-sm-2" for="title">Title:</label>
    							<div class="col-sm-10">
      								<input type="text" name="title" class="form-control" value="<?php echo $value['title']; ?>">
    							</div>
  							</div> 
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="image">Upload Image</label>
    							<div class="col-sm-10">
      								<img src="<?php echo $value['image']; ?>" class="img-responsive"><br>
    								<input type="file" name="image" class="form-control">
    							</div>
  							</div>
  							<div class="form-group">
	  							<div style="overflow-x: auto;">
								  	<label class="control-label col-sm-2"  for="content">Content:</label>
								  	<div class="col-sm-10">
								  		<textarea name="body" class="form-control" style="max-width: 100%;"><?php echo $value['body']; ?></textarea>
								  	</div>
								</div>
							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="author">Author:</label>
    							<div class="col-sm-10">
	      							<input type="text" name="author" value="<?php echo $value['author']; ?>" class="form-control">
	      						</div>
  							</div>
							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" name="submit" class="btn btn-success btn-md">Save</button>
							    </div>
							</div>
                        </form>
                        <?php } } ?>
<?php include 'includes/footer.php'; ?>
