<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
           Your Blog Posts List
        </h4>
            <div class="col-md-4" style="margin-bottom: 25px;">
                <form class="form-inline" action="reportsearch.php" method="get">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control pull-righ" placeholder="Search Post" style="background-color: #000; color: #fff;">
                    </div>
                    <button type="submit" class="btn btn-default" style="background-color: #000; color: #fff;">Search</button>
                </form>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <?php
                        if (isset($_GET['delpost'])) {
                            $delid = $_GET['delpost'];
                            $deleteblog = $blog->deletePostById($delid);
                        }
                        if (isset($deleteblog)) {
                            echo $deleteblog;
                        }
                    ?>
                    <div class="content">
                        <div style="overflow-x: auto;">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Image</th>
                                        <th>Views</th>
                                        <th>Date Posted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $post = $blog->selectAllBlogPost();
                                if ($post) {
                                    $i = 0;
                                    while ($row = $post->fetch_assoc()) {
                                        $i++;
                            ?>
                                <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td class="text-center"><?php echo $row['author']; ?></td>
                                        <td><?php echo substr($row['body'], 0, 60)."..."; ?></td>
                                        <td><img src="<?php echo $row['image']; ?>" height="60px" width="80px"></td>
                                        <td><?php echo $row['views']; ?></td>
                                        <td><?php echo $fm->formatDate($row['date']); ?></td>
                                <td>
                                            <a class="edit" href="viewblog.php?postId=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-eye-open"></span> View</a> 
                                
                                    ||
                                    <a class="edit" href="editblog.php?postid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                    ||
                                     <a onClick="return confirm('Are you sure you want to Delete?');" class="edit" href="?delpost=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                                    
                                </td>
                                    </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    
<?php include 'includes/footer.php'; ?>
                    