<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
           Search Posts
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
                <?php
                    if (!isset($_GET['search']) || $_GET['search'] == NULL) {
                        echo "<script>window.location = 'report.php';</script>";
                        //header("Location: postlist.php");
                    } else {
                        $search = $_GET['search'];
                    }
                ?>
                <div class="card">
                    <div class="content">
                        <div style="overflow-x: auto;">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Post Title</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Tags</th>
                                        <th>Image</th>
                                        <th>Views</th>
                                        <th>Date Posted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $sql = "SELECT * FROM tbl_blog WHERE title LIKE '%$search%' LIMIT 1";
                                $result = $conn->query($sql);
                                if (!$result->num_rows > 0){
                                    echo "<b>No Topic Found For the Keyword <font color='red'><q>".$search."</q></font></b>";
                                } else { 
                                    $i = 0;
                                    while($row = $result->fetch_assoc()){
                                        $i++;
                             ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td class="text-center"><?php echo $row['author']; ?></td>
                                        <td><?php echo substr($row['body'], 0, 60)."..."; ?></td>
                                        <td><?php echo $row['tag']; ?></td>
                                        <td><img src="<?php echo $row['image']; ?>" height="60px" width="80px"></td>
                                        <td><?php echo $row['views']; ?></td>
                                        <td><?php echo $fm->formatDate($row['date']); ?></td>
                                <td>
                                            <a class="edit" href="viewblog.php?viewblogid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-eye-open"></span> View</a> 
                                
                                    ||
                                    <a class="edit" href="editblog.php?editblogid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                    ||
                                     <a onClick="return confirm('Are you sure you want to Delete?');" class="edit" href="deleteblog.php?delblogid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                                                    
                                </td>
                                    </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    
<?php include 'includes/footer.php'; ?>
                    