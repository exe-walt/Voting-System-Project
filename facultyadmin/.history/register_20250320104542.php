<?php include("includes/header.php");?>
<?php include("includes/aside.php");?>
<?php include("includes/navbar.php");?>


<!-- Logout Modal-->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registration</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">

                            <label for="username"> Username:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>

                        <div class="form-group">

                            <label for="email"> Email:</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="youremail@domain.com">
                        </div>

                        <div class="form-group">

                            <label for="usertype"> Usertype:</label>

                            <select name="usertype" class="form-control" id="usertype">
                                <option value="Admin">Admin</option>
                                <option value="Student">Student</option>
                            </select>

                        </div>

                        <div class="form-group">

                            <label for="password"> Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password">
                        </div>

                        <div class="form-group">

                            <label for="confirm_password"> Confirm password:</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Your Password">
                        </div>

                    </div>


                    <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="registerbtn">Register</button>
                    </div>

                </form>

                
            </div>
        </div>
    </div>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weigth-bold text-primary">Admin Profile
                    <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Add Admin Profile</button>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php 
                    include("dbconfig.php");
                    $sql = "SELECT * FROM registration";
                    $query = mysqli_query($conn, $sql);
                    ?>
                    <table class="table table-bordered" id="datatable" width = "100%" cellspacing = "0">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Usertype</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>    
                    <?php
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query));}
                    ?>
                    
                    <?php 
                    {

                    }
                    ?>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php include("includes/scripts.php");?>
<?php include("includes/footer.php");?>
