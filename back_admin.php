<?php include_once('header.php'); ?>
<?php include_once('nav_admin.php'); ?>
<?php include_once('validate.php'); ?>
<?php 


// Fetching Logged-in Person Data.

$get_profile = mysqli_query($db, "SELECT * FROM user WHERE id = '$user_id' ");
if(mysqli_num_rows($get_profile)){

    $get_data = mysqli_fetch_assoc($get_profile);
    $name = $get_data['name'];
    $email = $get_data['email'];
    $password = $get_data['password'];

}else{
    header('location: logout.php');
}



?>


    <!-- contact block -->
    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">TIMETABLE</p>
                <h3 class="title-style">ADMIN PANEL</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            


                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $password ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="admin_edit.php?edit=<?php echo $user_id ?>" class="btn btn-warning">Edit Profile Settings</a>





                </div>
             
            </div>
        </div>
    </section>




