<?php 
    include 'helpers/Format.php';
    include 'classes/Contact.php';
    
    $msg = new Contact(); 
    $fm = new Format();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/contact-us.css">

    <meta name="keywords" content="<?= KEYWORDS; ?>">
	<meta name="description" content="<?= DESCRIPTION; ?>">

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="http://lixir.com.ng/images/brand_logo.png" sizes="180x180">
	<link rel="icon" href="http://lixir.com.ng/images/brand_logo.png" sizes="32x32" type="image/png">
	<link rel="icon" href="http://lixir.com.ng/images/brand_logo.png" sizes="16x16" type="image/png">

	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="http://lixir.com.ng">
	<meta name="twitter:creator" content="Lixir">
	<meta name="twitter:title" content="<?= $fm->title(); ?>">
	<meta name="twitter:description" content="<?= DESCRIPTION; ?>">
	<meta name="twitter:image" content="http://lixir.com.ng/images/brand_logo.png">

	<!-- Facebook & Whatsapp -->
	<meta property="og:title" content="<?= $fm->title(); ?>">
	<meta property="og:url" content="http://lixir.com.ng">
	<meta property="og:description" content="<?= DESCRIPTION; ?>">
	<meta property="og:image" content="http://lixir.com.ng/images/brand_logo.png">
	<meta property="og:image:secure_url" content="http://lixir.com.ng/images/brand_logo.png">
	<meta property="og:image:width" content="300">
	<meta property="og:image:height" content="200">
	<meta property="og:image:alt" content="site-logo">
	<meta property="og:type" content="website">
</head>
<body>
<?php require_once "./Fragments/header.php" ?>
    <main>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $sendmsg = $msg->sendMessage($_POST);
        }
    ?>
    <form class="form" action="" method="post">
        <section class="form-container">
            <h1 class="text-center">Send us a message</h1>
            <?php
                if (isset($sendmsg)) {
                    echo $sendmsg;
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