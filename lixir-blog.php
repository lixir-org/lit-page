<?php
    include 'helpers/Format.php';   
    include 'classes/Blog.php';
    include 'classes/Advert.php';

    $fm = new Format();
    $blog = new Blog();
    $ads = new Advert();

    date_default_timezone_set('Africa/Lagos');

    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | Lixir</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel='icon' href='./images/brand_logo.png' type='image/x-icon'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/lixir-blog.css">

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
        <section class="blog-header">
            <h1>News Update</h1>
        </section>
        <section class="blog-body">
            <section class="blog-body_content">
                <?php 
                    $getPosts = $blog->selectAllBlogPost();
                    if (!$getPosts->num_rows > 0) {
                        echo "<h1 style='color: red;'>No Blog Posts On This Page Yet!!!</h1>";
                    } else {
                        while ($row = $getPosts->fetch_assoc()) {
                ?>
                <article class="blog-post">
                    <div class="blog-post_image">
                        <img src="lit/<?= $row['image']; ?>" alt="<?= $row['title']; ?>-image">
                    </div>
                    <div class="blog-post_text">
                        <h3 class="article-title"><?= $row['title']; ?></h3>
                        <span class="post-date"><?= $fm->formatDate($row['date']); ?></span>
                        <a href="#" class="poster"><?= $row['author']; ?></a>
                        <p class="article-content">
                            <?= htmlspecialchars_decode(stripslashes($fm->textShorten($row['body']))); ?>
                        </p>
                        <a href="article/<?= $row['id']; ?>/<?= $fm->rewriteText($row['title']); ?>" class="read_more">>> Read more</a>
                    </div>
                </article>
                <?php } } ?>
            </section>

            
            <aside class="blog-body_aside">
                <section class="search-blog">
                    <!-- <form action="">
                        <input name="paramter" type="text" placeholder="Search blog...">
                        <button><i class="fa fa-search"></i></button>
                    </form> -->
                </section>

                <?php
                    $getAds = $ads->getAllAdverts();
                    if ($getAds) {
                        while ($row = $getAds->fetch_assoc()) {
                ?>
                    <section class="advert-container">
                        <article class="advert-container_post">
                            <img src="lit/<?php echo $row['image']; ?>" width="250px" height="250px" alt="site-advert">
                        </article>
                    </section>
                <?php } } ?>
            </aside>

        </section>
    </main>
    <?php require_once "./Fragments/footer.php" ?>
</body>
<script src="js/popper.min.js"></script>
<script src="./js/lixir-blog.js"></script>

</html>