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

    if (!isset($_GET['post']) || $_GET['post'] == NULL) {
        echo "<script>window.location = 'lixir-blog.php';</script>";
        //header("Location: 404.php");
    } else {
        $id = $_GET['post'];
        $url = $_SERVER['REQUEST_URI'];

        $getSinglePost = $blog->getBlogPostById($id);

        $head = $getSinglePost->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | <?= $head['title']; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel='icon' href='./images/brand_logo.png' type='image/x-icon' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="./css/lixir-blog.css"> -->
    <link rel="stylesheet" href="./css/article.css">

    <meta name="keywords" content="<?= $head['title']; ?>">
	<meta name="description" content="<?= $fm->textShorten($head['body']); ?>">

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="http://lixir.com.ng/images/brand_logo.png" sizes="180x180">
	<link rel="icon" href="http://lixir.com.ng/images/brand_logo.png" sizes="32x32" type="image/png">
	<link rel="icon" href="http://lixir.com.ng/images/brand_logo.png" sizes="16x16" type="image/png">

	<!-- Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="<?= $url; ?>">
	<meta name="twitter:creator" content="Lixir">
	<meta name="twitter:title" content="<?= $head['title']; ?>">
	<meta name="twitter:description" content="<?= $fm->textShorten($head['body']); ?>">
	<meta name="twitter:image" content="http://lixir.com.ng/lit/<?= $head['image']; ?>">

	<!-- Facebook & Whatsapp -->
	<meta property="og:title" content="<?= $head['title']; ?>">
	<meta property="og:url" content="<?= $url; ?>">
	<meta property="og:description" content="<?= $fm->textShorten($head['body']); ?>">
	<meta property="og:image" content="http://lixir.com.ng/lit/<?= $head['image']; ?>">
	<meta property="og:image:secure_url" content="http://lixir.com.ng/lit/<?= $head['image']; ?>">
	<meta property="og:image:width" content="300">
	<meta property="og:image:height" content="200">
	<meta property="og:image:alt" content="Article-image">
    <meta property="og:type" content="website">
    
    <!--For Clean Url to Detect CSS or JS styles on the website we make use of the BASE HREF BELOW
    <base href="http://lixir.com.ng/">-->
</head>

<body>
    <?php require_once "./Fragments/header.php" ?>
    <main>
        <section class="article-body">
            <aside class="side_bar">
                <section class="search-blog">
                    <!-- <form action="">
                        <input name="paramter" type="text" placeholder="Search blog...">
                        <button><i class="fa fa-search"></i></button>
                    </form> -->
                </section>
            </aside>
            <section class="article-body_content">
                <article class="blog-post">
                    <?php 
                        $getPost = $blog->getBlogPostById($id);
                        if (!$getPost > 0) {
                            echo "<h1 style='color: red; text-align: center; font-size: 40px;'>Error 404</h1>";
                        } else {                      
                            $row = $getPost->fetch_assoc();
                    ?>
                    <div class="lead">
                        <h1><?= $row['title']; ?></h1>
                        <a><?= $row['author']; ?></a>
                        <span><?= $fm->formatDate($row['date']); ?></span>
                    </div>

                    <div class="article_image">
                        <img src="lit/<?php echo $row['image']; ?>" class="article-image" alt="post picture" >
                    </div>
                    <div class="article_text">
                        <p class="article-content">
                            <?= htmlspecialchars_decode(stripslashes($row['body'])); ?>

                        </p>
                    </div>

                    <div style="margin-top: 20px;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url; ?>" target="_blank"><img src="images/facebook_share.jpg" style="width: 150px;" alt="facebook-share"></a> &nbsp;&nbsp;&nbsp; <a href="http://www.twitter.com/intent/tweet?url=<?= $url; ?>&text=<?= $fm->rewriteText($row['title']); ?>" target="_blank"><img src="images/twitter_share.jpg" alt="twitter-share" style="width: 150px;"></a>
                    </div>
                    <?php } ?>
                </article>
            </section>
            <aside class="side_bar">
                <section class="advert-container">
                    <articcle class="advert-container_post">
                        <h1>Advert here</h1>
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
                    </articcle>
                </section>
            </aside>
        </section>
    </main>
    <?php require_once "./Fragments/footer.php" ?>
</body>
<script src="js/popper.min.js"></script>
<script src="./js/lixir-blog.js"></script>

</html>
<?php } ?>