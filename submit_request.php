<?php
	use PHPMailer\PHPMailer\PHPMailer;
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    function validate($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
    }
    
    if (!isset($_POST['submit'])) {
        echo 'error';
    } else {
        $projName = validate($_POST['projName']);
        $projDur = validate($_POST['projDur']);
        $email = validate($_POST['email']);
        $cusName = validate($_POST['cusName']);
        $orgName = validate($_POST['orgName']);
        $scope = validate($_POST['scope']);
        $highObj = validate($_POST['highObj']);
        $lowObj = validate($_POST['lowObj']);

         //Sending Mail to Client.
        $defaultpath = '<img src="http://www.lixir.com.ng/assets/images/lixir_logo.png" width="50px" height="50px">';

        $mail->setFrom("noreply@lixir.com.ng", "Lixir");
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = "Lixir Project Request";
        $mail->Body = "
            <html style='height: 100%;'>
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
                                        Dear ".$cusName.",<br><br> Your request for a project has been acknowledged, we shall get back to you as soon as possible.</b>
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
            </html>
        ";

        $mail->send();

        $mail2 = new PHPMailer();
        $mail2->setFrom($email, $cusName);

        if(!empty($_FILES['projFile'])) {
            $permited = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
		  	$file_name = $_FILES['projFile']['name'];
            $file_temp = $_FILES['projFile']['tmp_name'];
            
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
              
            if (in_array($file_ext, $permited) === false) {
                header("Location: project-request.php?status=file-error");
                die();
            }  else {
                $attachment = $file_temp;
                
                $mail->addAttachment($attachment, "Project Attachment");
            }
        }

        $mail2->addAddress("biz@lixir.com.ng", "Project Manager");
        $mail2->isHTML(true);
        $mail2->Subject = "New Project Request Alert";
        $mail2->Body = "
            Dear Project Manager, you have a new project request. Please find the client's details below:<br><br><b>Name:</b>  ".$cusName."<br><b>Email:</b>  ".$email."<br><b>Project Name:</b>  ".$projName."<br><b>Project Duration:</b>  ".$projDur."<br><b>Organisation Name:<b>  ".$orgName."<br><b>Project Description:</b> ".$scope."<br><b>Project High-level Objectives:</b>  ".$highObj."<br><b>Project Low-level Objectives:</b>  ".$lowObj;

        $mail2->send();

        if ($mail && $mail2) {
            header("Location: project-request.php?status=sent");
        } else {
            header("Location: project-request.php?status=failed");
        }
    }
?>