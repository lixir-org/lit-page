<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

  <div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Inbox
        </h4>
            <div class="col-md-12">
                <div class="card">
                    <div class="content">

                    <?php
                        if (isset($_GET['seenid'])) {
                            $seenid = $_GET['seenid'];
                            $getMsg = $msg->setContactAsSeen($seenid);
                            if ($getMsg){
                                echo "<span class='success'>Message Sent To Seen Box!</span>";
                            } else {
                                echo "<span class='error'>Something went wwrong!</span>"; 
                            }
                        }
                    ?>
                        <div style="overflow-x: auto;">
                            <table class="table text-left">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $getMsg = $msg->getAllContact();
                                    if ($getMsg){
                                        $i = 0;
                                        while($book = $getMsg->fetch_assoc()){
                                            $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $book['name']; ?></td>
                                        <td><?php echo $book['email']; ?></td>
                                        <td><?php echo $book['phone']; ?></td>
                                        <td><?php echo $book['subject']; ?></td>
                                        <td><?php echo substr($book['body'], 0, 30)."..."; ?></td>
                                        <td><?php echo $fm->formatDate($book['date']); ?></td>
                                        <td>
                                            <a class="edit" href="viewmsg.php?msgid=<?php echo $book['id'];?>">View</a> 
                                            || 
                                             <a class="edit" href="replymsg.php?msgid=<?php echo $book['id'];?>">Reply</a>

                                            ||
                                            <a onClick="return confirm('Are you sure you want to move the message?');" class="edit" href="?seenid=<?php echo $book['id'];?>">Seen</a>
                                        </td>
                                    </tr>
                            	<?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
  </div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">
            Seen Messages
        </h4>
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                    <?php
                        if (isset($_GET['delid'])) {
                            $delid = $_GET['delid'];
                            $getMsg = $msg->deleteMessage($delid);
                            if ($getMsg) {
                                echo "<span class='success'>Message Deleted Successfully!</span>";
                            } else {
                                echo "<span class='error'>Message Not Deleted!</span>"; 
                            }
                        }
                    ?>
                        <div style="overflow-x: auto;">
                            <table class="table text-left">
                                <thead>
                                    <tr class="text-center">
                                        <th>Serial No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>phone</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                    $getMsg = $msg->getAllContactWithStatus();
                                    if ($getMsg){
                                        $i = 0;
                                        while($book = $getMsg->fetch_assoc()){
                                            $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $book['name']; ?></td>
                                        <td><?php echo $book['email']; ?></td>
                                        <td><?php echo $book['phone']; ?></td>
                                        <td><?php echo substr($book['body'], 0, 30)."..."; ?></td>
                                        <td><?php echo $fm->formatDate($book['date']); ?></td>
                                        <td>
                                            <a class="edit" href="viewmsg.php?msgid=<?php echo $book['id'];?>">View</a> 
                                            || 
                                            <a onClick="return confirm('Are you sure you want to Delete?');" class="edit" href="?delid=<?php echo $book['id'];?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } } else {
                                    echo "<tr class='text-center'><td><span class='success'>No data available in this table</td></tr>";
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    
                    
<?php include 'includes/footer.php'; ?>