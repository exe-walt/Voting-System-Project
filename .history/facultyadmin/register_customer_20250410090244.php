<?php
// session_start();
    
 include('includes/header.php');
 include('includes/aside.php'); 
 include('includes/navbar.php'); ?>
 

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weigth-bold text-primary">Student Profile
                            <button class="btn btn-primary">Review Student Profile</button>
                        </h6>
                    </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <?php
                        include ("../db.php");

                        
                        $sql="SELECT * FROM login";
                        $query= mysqli_query($conn,$sql);
                        ?>
                        <table class="table table-bordered" id="datatable" width="100%">
                            <tr>
                                <th>id</th>
                                <th>studentID</th>
                                <th>studentPin</th>
                                <th>firstName</th>
                                <th>lastName</th>
                                <th>fullName</th>
                                <th>profile</th>
                                <th>Delete</th>
                            
                                
                            </tr>

                            <?php
                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['studentID'];?></td>
                                <td><?php echo $row['studentPin'];?></td>
                                <td><?php echo $row['firstName'];?></td>
                                <td><?php echo $row['lastName'];?></td>
                                <td><?php echo $row['fullName'];?></td>
                                <td><?php echo "<img src='" . $row['profile'] . "' alt='Profile Image' style='width: px; height: 100px; border-radius: 50%;'>"; ?></td>


                                <td>
                                    <form action="code1.php" method="post"><!--code.php-->
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                
                                
                            </tr>

                            <?php
                                };
                            }
                        
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
<?php include ('includes/footer.php');?>
<?php include("includes/scripts.php");?>