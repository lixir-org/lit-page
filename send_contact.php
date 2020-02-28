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
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $phone = validate($_POST['phone']);
        $subject = validate($_POST['subject']);
        $message = validate($_POST['message']);

         //Sending Mail to Client.
        $defaultpath = '<img src="http://www.lixir.com.ng/assets/images/lixir_logo.png" width="50px" height="50px">';

        $mail->setFrom("noreply@info.lixir@gmail.com", "Lixir");
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = "Message received";
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
            </html>
        ";

        $mail->send();

        $mail2 = new PHPMailer();
        $mail2->setFrom($email, $name);
        $mail2->addAddress("info.lixir@gmail.com", "Project Manager");
        $mail2->isHTML(true);
        $mail2->Subject = $subject;
        $mail2->Body = "
            Dear CEO Lixir, you have a contact message. Please find the details below:<br><br><b>Name:</b>  ".$name."<br><b>Phone number:</b>  ".$phone."<br><b>Message:</b>  ".$message;

        $mail2->send();

        if ($mail && $mail2) {
            header("Location: contact-us.php?sent");
        } else {
            header("Location: contact-us.php?failed");
        }
    }
?>