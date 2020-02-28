<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class Contact{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function sendMessage($data){
			$name = $this->fm->validation($data['name']);
			$email = $this->fm->validation($data['email']);
			$phone = $this->fm->validation($data['phone']);
			$subject = $this->fm->validation($data['subject']);
			$message = $this->fm->validation($data['message']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			$subject = mysqli_real_escape_string($this->db->link, $subject);
			$message = mysqli_real_escape_string($this->db->link, $message);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $msg = "<span style='color: red; font-size: 18px; font-weight: bold; padding: 20px;'>Invalid email format!!!.</span>";
	  			return $msg;
			}			
			else {
				$query =  "INSERT INTO tbl_contact (name, email, phone, subject, body) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
				$result = $this->db->insert($query);

				$defaultpath = 'img src="http://www.lixir.com.ng/assets/images/lixir_logo.png" alt="lixir-logo" width="50px" height="50px">';
				$to = $email;
				$from = "noreply@lixir.com.ng";
				$headers = "From: $from\n";
		        $headers .= 'MIME-Version: 1.0' . "\r\n";
		        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$msgsubject = "Message received";
				$messageContent = "<html style='height: 100%;'>
                <head><meta name='viewport' content='width=device-width, initial-scale=1'></head>
                <body style='height: 100%; background-color: #f5f5f5;'>
                    <div style='min-height: 100%; height: auto !important; height: 100%; margin: 0 auto -63px;'>
                        <div style='min-height: 20px; padding: 19px; margin-bottom: 20px; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); width: 100%;'>
                            <center>".$defaultpath."</center>
                        </div>
                        <div class='visitorMessage'>
                            <table style='width: 90%; background-color: #ffffff; margin: 0 auto;'>
                                <tr>
                                    <td style='font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;'>
                                        Dear ".$name.",<br><br> Your message has been received, we shall get back to you as soon as possible.</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;'>
                                        <strong>This is an automatic generated email, do not reply.</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>                                  
                </body>
            </html>";	
				$sendmail = mail($to, $msgsubject, $messageContent, $headers);

				$sender = $email;
				$recipient = "info.lixir@gmail.com";
				$heads = "From: $sender\n";
		        $heads .= 'MIME-Version: 1.0' . "\r\n";
		        $heads .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$sub = $subject;
				$content = '<html style="height: 100%;">
							<head><meta name="viewport" content="width=device-width, initial-scale=1"></head>
							<body style="height: 100%; background-color: #f5f5f5;">
								<div style="min-height: 100%; height: auto !important; height: 100%; margin: 0 auto -63px;">
									<div style="min-height: 20px; padding: 19px; margin-bottom: 20px; border: 1px solid #e3e3e3; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); width: 100%;">
										<center>'.$defaultpath.'</center>
									</div>
									<div class="visitorMessage">
										<table style="width: 90%; background-color: #ffffff; margin: 0 auto;">
											<tr>
												<td style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;">
													You have new message from <b>'.$name.'</b> whose email is:<b> '.$email.'</b> and phone number is: <b> '.$phone.'<br><br>Please find his/her subject and message below:<br><br><br><b>Subject</b>: ".$subject." <br><br><b>Message</b>:<br> '.$message.'<br>
												</td>
											</tr>
										</table>
									</div>
								</div>	
							</body>
							</html>';
				$replysendmail = mail($recipient, $sub, $content, $heads);

				if ($result && $sendmail && $replysendmail) {
		  			$msg = "<div style='color: green; font-size: 18px; font-weight: bold; padding: 20px;'>Message Sent Successfully!!!.</div>";
		  			return $msg;
		  		} else {
		  			$msg = "<div class='alert alert-danger'>Message Not Sent!!!<br> Please Try Again Later.</div><div style='color: red; font-size: 18px; font-weight: bold; padding: 20px;'>Message Not Sent. Please Try Again Later!</div>";
		  			return $msg;
		  		}
		  	}
	  	}

	  	public function getAllContact(){
	  		$query = "SELECT * FROM tbl_contact WHERE status = '0'";
	  		$result = $this->db->select($query);
	  		return $result;
	  	}

	  	public function getMessageById($id) {
	  		$query = "SELECT * FROM tbl_contact WHERE id = '$id'";
	  		$result = $this->db->select($query);
	  		return $result;
	  	}

	  	public function getAllContactWithStatus(){
	  		$query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
	  		$result = $this->db->select($query);
	  		return $result;
	  	}

	  	public function setContactAsSeen($id){
            $query = "UPDATE tbl_contact SET status = '1' WHERE id = '$id'";
	  		$result = $this->db->update($query);
	  		return $result;
	  	}

	  	public function deleteMessage($id){
            $query = "DELETE FROM tbl_contact WHERE id = '$id'";
	  		$result = $this->db->delete($query);
	  		return $result;
	  	}

	  	public function getContactWithId($id){
			$query = "SELECT * FROM tbl_contact WHERE id = '$id'";
	  		$result = $this->db->select($query);
	  		return $result;
	  	}

	  	public function replyMessage($data){
			$to = $this->fm->validation($data['toEmail']);
			$from = $this->fm->validation($data['fromEmail']);
			$subject = $this->fm->validation($data['subject']);
			$message = $this->fm->validation($data['message']);

			$to = mysqli_real_escape_string($this->db->link, $to);
			$from = mysqli_real_escape_string($this->db->link, $from);
			$subject = mysqli_real_escape_string($this->db->link, $subject);
			$message = mysqli_real_escape_string($this->db->link, $message);

			$defaultpath = '<img src="http://www.lixir.com.ng/assets/images/lixir_logo.png" width="50px" height="50px">';
			$recipient = $to;
			$sender = $from;
			$headers = "From: $from\n";
	        $headers .= 'MIME-Version: 1.0' . "\r\n";
	        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$msgsubject = $subject;
			$messageContent = '<html style="height: 100%;">
							<head><meta name="viewport" content="width=device-width, initial-scale=1"></head>
							<body style="height: 100%; background-color: #f5f5f5;">
								<div style="min-height: 100%; height: auto !important; height: 100%; margin: 0 auto -63px;">
									<div style="min-height: 20px; padding: 19px; margin-bottom: 20px; border: 1px solid #e3e3e3; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); width: 100%;">
										<center>'.$defaultpath.'</center>
										</div>
									<div class="visitorMessage">
										<table style="width: 90%; background-color: #ffffff; margin: 0 auto;">
											<tr>
												<td style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;">'.$message.'<br>
												</td>
											</tr>
											<tr>
												<td style=" font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;">
													<span style="color: brown;">Click on the link below to go to the website.</span></b><br> <a href="http://www.lixir.com.ng">http://www.lixir.com.ng</a>
												</td>
											</tr>
										</table>
									</div>
								</div>	
							</body>
							</html>';	
			$sendmail = mail($recipient, $msgsubject, $messageContent, $headers);

			$receiver = "biz@lixir.com.ng";
			$self = "noreply@biz@lixir.com.ng";
			$heads = "From: $sender\n";
	        $heads .= 'MIME-Version: 1.0' . "\r\n";
	        $heads .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$sub = "New Asphaltech Message";
			$content = '<html style="height: 100%;">
						<head><meta name="viewport" content="width=device-width, initial-scale=1"></head>
						<body style="height: 100%; background-color: #f5f5f5;">
							<div style="min-height: 100%; height: auto !important; height: 100%; margin: 0 auto -63px;">
								<div style="min-height: 20px; padding: 19px; margin-bottom: 20px; border: 1px solid #e3e3e3; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); box-shadow: inset 0 1px 1px rgba(0,0,0,0.05); width: 100%;">
									<center>'.$defaultpath.'</center>
								</div>
								<div class="visitorMessage">
									<table style="width: 90%; background-color: #ffffff; margin: 0 auto;">
										<tr>
											<td style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;">
												You sent a new message to a Customer just now .This is the copy of the message below:<br><br>'.$message.'<br>
											</td>
										</tr>
											<td style=" font-family: Helvetica, Arial, sans-serif; font-size: 14px; padding: 10px;">
												<strong>This is an automatic generated email, do not reply.</strong>
											</td>
										</tr>
									</table>
								</div>
							</div>	
						</body>
						</html>';
			$replysendmail = mail($recipient, $sub, $content, $heads);

			if ($sendmail && $replysendmail) {
	  			$msg = "<div class='alert alert-success'>Message Sent Successfully!!!.</div>";
	  			return $msg;
	  		} else {
	  			$msg = "<div class='alert alert-danger'>Message Not Sent!!! Please Try Again Later.</div>";
	  			return $msg;
	  		}
	  	}
	}
?>