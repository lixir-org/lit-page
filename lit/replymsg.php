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
	                <div class="content" style="background-color: #000; color: #fff;">
	                <!--Code to insert New Posts into the database-->
						<?php
							if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                                $sendmsg = $msg->replyMessage($_POST);
                            }
                        ?>
                        <?php
                        	if (isset($sendmsg)) {
                        		echo $sendmsg;
                        	}
                        ?>
						
						<form class="form-horizontal" role="form" action="" method="post">
						<?php
							$replymsg = $msg->getContactWithId($id);
						    if ($replymsg){
						    	$i = 0;
								while($book = $replymsg->fetch_assoc()){
									$i++;
						?>
							<div class="form-group">
    							<label class="control-label col-sm-2" for="email">To:</label>
    							<div class="col-sm-10">
      								<input type="text" name="toEmail" readonly class="form-control" value="<?php echo $book['email']; ?>">
    							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="email">From:</label>
    							<div class="col-sm-10">
      								<input type="text" name="fromEmail" class="form-control" placeholder="Enter Your Email Address" value="biz@lixir.com.ng" readonly>
    							</div>
  							</div>
  							<div class="form-group">
    							<label class="control-label col-sm-2" for="email">Subject:</label>
    							<div class="col-sm-10">
      								<input type="text" name="subject" value="Re: <?php echo $book['subject']; ?>" class="form-control" placeholder="Enter Your Subject" readonly>
    							</div>
  							</div>
  							<div class="form-group">
	  							<div style="overflow-x: auto;">
								  	<label class="control-label col-sm-2"  for="message">Message:</label>
								  	<div class="col-sm-10">
								  		<textarea name="message" class="form-control" id="elm1" style="max-width: 100%;"></textarea>
								  	</div>
								</div>
							</div>
  							<div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" name="submit" class="btn btn-success btn-md">Send</button>
							    </div>
							</div>
						<?php } } ?>
						</form>
					
	                	
<?php include 'includes/footer.php'; ?>