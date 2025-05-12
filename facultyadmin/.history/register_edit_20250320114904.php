<?php
// session_start();
    
 include('includes/header.php');
 include('includes/aside.php'); 
 include('includes/navbar.php'); ?>
  


<div class="container">
    <!--DataTable -->
    <div class="card shadow mb-4">
        <div class="card-header py-3  text-primary">Edit Admin Profile </h6>
        </div>
    </div>
    <div class="card-body">
        <?php
        include('dbconfig.php');
        // $connection = mysqli_connect("localhost", "root", "", "scot");
        
        if(isset($_POST['edit_btn'])){
            $id = $_POST['edit_id'];

            $query = "SELECT * FROM registration WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            foreach($query_run as $row);
            {?>
            <form action="code.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['user_id'];?>">
                    
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="edit_username" value="<?php echo $row['username'];?>" class="form-control" placeholder="Enter Username" >
                </div>
        
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="edit_email" value="<?php echo $row['email'];?>" class="form-control" placeholder="Enter Email" >
                </div>
            
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="edit_password"  value="<?php echo $row['password'];?>" class="form-control" placeholder="Enter Password" >
                </div>
                <div class="form-group">
                    <label>Usertype </label>
                    <select name="edit_usertype" class="form-control">
                        <option value="admin"> Admin </option>
                        <option value="user"> User </option>
                    </select>       
                </div>
            

            
                <a href="register.php" class="btn btn-danger">CANCEL</a>
                <button type="submit" class="btn btn-warning" name="updatebtn">UPDATE</button>
            </form>
            <?php            
            }

        }
    ?>    
    

    </div>
</div>
<!-- </div> -->
<?php include ('includes/footer.php');?>