<?php include_once('header.php'); ?>
<?php include_once('nav_admin.php'); ?>
<?php include_once('validate.php'); ?>
<?php 


// Fetching Logged-in Person Data.

$edit_id = $_GET['edit'];
$get_profile = mysqli_query($db, "SELECT * FROM user WHERE id = '$edit_id' ");
if(mysqli_num_rows($get_profile)){

    $get_data = mysqli_fetch_assoc($get_profile);
    $name = $get_data['name'];
    $email = $get_data['email'];
    $password = $get_data['password'];
    $type = $get_data['type'];
    $role = $get_data['role'];

}else{
    header('location: admin_users.php');
}



?>


    <!-- contact block -->
    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">TIMETABLE</p>
                <h3 class="title-style">ADMIN EDIT (<?php echo $name ?>)</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            

                <form method="post" class="signin-form">
                        <div class="input-grids">
                            <div class="row">
                                <div class="col-sm-6">
                                <input type="text" name="name" value="<?php echo $name; ?>" 
                                placeholder="Your Name" class="contact-input" required="" />
                                </div>
                                <div class="col-sm-6">
                                <input type="email" name="email" value="<?php echo $email; ?>" 
                                placeholder="Your Email" class="contact-input" required="" />
                                </div>
                            </div>
                            <input type="password" name="password" value="<?php echo $password; ?>" 
                            placeholder="Your Password" class="contact-input" required="" />    

                        </div>
                        <div class="text-start">
                            <button type="submit" name="update" class="btn btn-style btn-style-3">Update</button>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['update'])){

                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                            $type = $type;
                            $role = $role;


                        $check_login = mysqli_query($db, "SELECT * FROM user WHERE email = '$email' AND id != '$edit_id' ");
                        $data_login = mysqli_fetch_assoc($check_login);
                        if(mysqli_num_rows($check_login) == 0){
                            $insert_data = mysqli_query($db, "UPDATE user SET name = '$name', email = '$email', 
                            password = '$password', role = '$role', type = '$type' WHERE id = '$edit_id' ");
                            if($insert_data){
                                echo "<br><p class='alert alert-success'>Success, Account has been Updated..</p>";
                            }
                        }else{
                            echo "<br><p class='alert alert-danger'>Please change your Email..! Email already Taken.</p>";
                        }

                    }
                    
                    ?>




                </div>
             
            </div>
        </div>
    </section>




