<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
  <div class="col-lg-12">
    <h4 class="page-header">
      Edit Blog Post
    </h4>
    <div class="col-md-8">
        <div class="card">
          <div class="content" style="background-color: #000; color: #fff;">
            <?php
  						if (!isset($_GET['postId']) || $_GET['postId'] == NULL) {
  							echo "<script>window.location = 'postlist.php';</script>";
  							//header("Location: postlist.php");
  						} else {
  							$postid = $_GET['postId'];
                $viewPost = $blog->getBlogPostById($postid);
  					  }
  						
  						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  							echo "<script>window.location = 'postlist.php';</script>";
  						}	
  					?>
            <?php
              if ($viewPost) {
                while($row = $viewPost->fetch_assoc()){
  					?>
              <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
    							<label class="control-label col-sm-2" for="title">Title:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly class="form-control" value="<?php echo $row['title']; ?>">
    							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="price">Views:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly value="<?php echo $row['views']; ?>" class="form-control">
    							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="image">Image</label>
    							<div class="col-sm-10">
      								<img src="<?php echo $row['image']; ?>" class="img-responsive">
      							</div>
  							</div>
  							<div class="form-group">
	  							<div style="overflow-x: auto;">
								  	<label class="control-label col-sm-2"  for="content">Content:</label>
								  	<div class="col-sm-10">
								  		<textarea name="body" class="form-control" id="elm1" readonly style="max-width: 100%;"><?php echo $row['body']; ?></textarea>
								  	</div>
								</div>
							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="author">Author:</label>
    							<div class="col-sm-10">
	      							<input type="text" readonly value="<?php echo $row['author']; ?>" class="form-control">
    							</div>
  							</div>
							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-success btn-md">Ok</button>
							    </div>
							</div>
                        </form>
            <?php } } ?>
<?php include 'includes/footer.php'; ?>
