<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<?php
	if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
		echo "<script>window.location = 'inbox.php';</script>";
		//header("Location: caltlist.php#tab-5");
	} else {
		$id = $_GET['msgid'];
	}
?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            View Message
        </h4>
	        <div class="col-md-8">
	            <div class="card">
	                <div class="content">
	                <!--Code to insert New Posts into the database-->
						<?php
							if ($_SERVER['REQUEST_METHOD'] == 'POST') {
								echo "<script>window.location = 'inbox.php';</script>";
							}
						?>
						<form class="form-horizontal" role="form" action="" method="post">
						<?php
							$getMsg = $msg->getMessageById($id);
						    if ($getMsg){
						    	while($book = $getMsg->fetch_assoc()){
						?>
							<div class="form-group">
    							<label class="control-label col-sm-2" for="title">Name:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly class="form-control" value="<?php echo $book['name']; ?>">
    							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="email">Email:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly class="form-control" value="<?php echo $book['email']; ?>">
    							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="email">Phone:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly class="form-control" value="<?php echo $book['phone']; ?>">
    							</div>
  							</div>
							<div class="form-group">
    							<label class="control-label col-sm-2" for="date">Date:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly class="form-control" value="<?php echo $fm->formatDate($book['date']); ?>">
    							</div>
  							</div>
							<div class="form-group">
    							<label class="control-label col-sm-2" for="date">Subject:</label>
    							<div class="col-sm-10">
      								<input type="text" readonly class="form-control" value="<?php echo $book['subject']; ?>">
    							</div>
  							</div>
  							<div class="form-group">
							  	<label class="control-label col-sm-2"  for="message">Message:</label>
							  	<div class="col-sm-10">
							  		<textarea class="form-control" readonly rows="8" id="comment"><?php echo $book['body']; ?></textarea>
							  	</div>
							</div>
  							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-success btn-md">OK</button>
							    </div>
							</div>
						<?php } } ?>
						</form>
					
	                	
<?php include 'includes/footer.php'; ?>