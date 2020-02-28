<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
 
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Adverts List
        </h4>
        <?php
            if (isset($_GET['folioid'])) {
                $folioid = $_GET['folioid'];
                $deleteport = $folio->deletePortfolio($folioid);
            }

            if (isset($deleteport)) {
                echo $deleteport;
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
                                        <th>portfolio Image</th>
                                        <th>Title</th>                                        
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $portfolio = $folio->getAllPortfolio();
                                if ($portfolio){
                                    $i = 0;
                                    while($row = $portfolio->fetch_assoc()){
                                        $i++;
                             ?>
                                    <tr class="text-left">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo $row['image']; ?>" height="60px" width="80px"></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['link']; ?></td>
                                        <td>
                                            <a class="edit" href="editportfolio.php?folioid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                            ||
                                            <a onClick="return confirm('Are you sure you want to Delete?');" class="edit" href="?folioid=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</a>                                            
                                        </td>
                                    </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
<?php include 'includes/footer.php'; ?>