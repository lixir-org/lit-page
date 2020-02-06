<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel='icon' href='./images/brand_logo.png' type='image/x-icon'/>
    <link rel="stylesheet" href="./css/contact-us.css">
</head>
<body>
<?php require_once "./Fragments/header.php" ?>
    <main>
    <form class="form" action="send_contact.php" method="post">
        <section class="form-container">
            <h1 class="text-center">Send us a message</h1>
            <?php
                $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if(strpos($url, 'sent') !== false){
                    echo "<div style='color: green; font-size: 18px; font-weight: bold; padding: 20px;'>Message Sent Successfully!!!.</div>";
                }
                if(strpos($url, 'failed') !== false){
                    echo "<div style='color: red; font-size: 18px; font-weight: bold; padding: 20px;'>Message Not Sent!!!<br> Please Try Again Later.</div>";
                }
            ?>
            <div class="form-group">
                <label for="name">Fullname: </label>
                <input type="text" placeholder="Enter your fullname" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address: </label>
                <input type="email" name="email" id="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
                <label for="num">Phone Number: </label>
                <input type="tel" name="phone" id="num" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject: </label>
                <input type="text" name="subject" id="subject" placeholder="Enter message subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message: </label>
                <textarea name="message" id="message" placeholder="Enter your message here" cols="30" rows="5" required></textarea>
            </div>

            <button class="submit" name="submit" type="submit">Send message</button>
        </section>
    </form>

<?php require_once "./Fragments/footer.php" ?>
</body>
</html>