<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
 
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Adverts List
        </h4>
        <?php
            if (isset($_GET['advertid'])) {
                $advertid = $_GET['advertid'];
                $deleteadvert = $ads->deleteAdvert($advertid);
            }

            if (isset($deleteadvert)) {
                echo $deleteadvert;
            }
        ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <div style="overflow-x: auto;">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Advert Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $adverts = $ads->getAllAdverts();
                                if ($adverts){
                                    $i = 0;
                                    while($row = $adverts->fetch_assoc()){
                                        $i++;
                             ?>
                                    <tr class="text-left">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo $row['image']; ?>" height="60px" width="80px"></td>
                                        <td>
                                            <a class="edit" href="editadvert.php?advertid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                            ||
                                            <a onClick="return confirm('Are you sure you want to Delete?');" class="edit" href="?advertid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</a>                                            
                                        </td>
                                    </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
<?php include 'includes/footer.php'; ?>