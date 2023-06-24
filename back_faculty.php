<?php include_once('header.php'); ?>
<?php include_once('nav_faculty.php'); ?>
<?php include_once('validate.php'); ?>
<?php 


// Fetching Logged-in Person Data.

$get_profile = mysqli_query($db, "SELECT * FROM user WHERE id = '$user_id' ");
if(mysqli_num_rows($get_profile)){

    $get_data = mysqli_fetch_assoc($get_profile);
    $name = $get_data['name'];
    $email = $get_data['email'];
    $password = $get_data['password'];
    $role = $get_data['role'];
    $type = $get_data['type'];

    switch ($type) {
        case '0':
            $type_a = "Dean";
            break;
        case '1':
            $type_a = "<b>Section head</b>";
            break;
        case '2':
            $type_a = "Head of department";
            break;
        case '3':
            $type_a = "Class in-charge";
            break;
        case 'student':
            $type_a = "Student";
            break;

        default:
            # code...
            break;
    }

}else{
    header('location: logout.php');
}



?>





    <!-- contact block -->
    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">TIMETABLE</p>
                <h3 class="title-style">FACULTY PANEL</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            


                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $password ?></td>
                                <td><?php echo ucfirst($role); ?></td>
                                <td><?php echo $type_a ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
             
            </div>
        </div>
    </section>




