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
                <p class="text-uppercase">SECTION 01</p>
                <h3 class="title-style">MANAGE REQUESTS</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            


                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th>Approve</th>
                                <th>Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                           
                           $select = mysqli_query($db, "SELECT * FROM user WHERE role != 'admin' AND status = 0 ");
                           if(mysqli_num_rows($select)){
                            $no = 0;
                            while($s = mysqli_fetch_assoc($select)){
                                $name = $s['name'];
                                $email = $s['email'];
                                $password = $s['password'];
                                $role = $s['role'];
                                $class = $s['class'];
                                $get_a = mysqli_query($db, "SELECT * FROM class WHERE id = '$class' ");
                                if(mysqli_num_rows($get_a)){
                                    $qq = mysqli_fetch_assoc($get_a);
                                    $class_name = $qq['name'];
                                }else{
                                    $class_name = "FACULTY";
                                }
                                $type = $s['type'];
                                switch ($type) {
                                    case '0':
                                        $type_a = "Dean";
                                        break;
                                    case '1':
                                        $type_a = "Section head";
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
                                $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $class_name; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $password; ?></td>
                                    <td><?php echo ucfirst($role); ?></td>
                                    <td><?php echo $type_a; ?></td>
                                    <td>
                                        <a href="admin_users.php?approve=<?php echo $s['id']; ?>" class="btn btn-success d-grid btn-sm">Approve</a>
                                    </td>
                                    <td>
                                        <a href="admin_users.php?reject=<?php echo $s['id']; ?>" class="btn btn-danger d-grid btn-sm">Reject</a>
                                    </td>
                                </tr>
                                <?php
                            }
                           }else{
                               echo "<td colspan='12' class='text-center'>No Request Found.</td>";
                           }
                           
                           ?>
                        </tbody>
                    </table>
                    <?php 
                    
                    if(isset($_GET['approve'])){

                        $ap_id = $_GET['approve'];
                        $approve = mysqli_query($db, "UPDATE user SET status = 1 WHERE id = '$ap_id' ");
                        if($approve){
                            header("Location: admin_users.php");
                        }
                    }

                    if(isset($_GET['reject'])){

                        $ap_id = $_GET['reject'];
                        $reject = mysqli_query($db, "DELETE FROM user WHERE id = '$ap_id' ");
                        if($reject){
                            header("Location: admin_users.php");
                        }
                    }
                    
                    ?>





                </div>
             
            </div>
        </div>
    </section>





    <!-- 2nd Section Start Here -->





    <section class="w3l-contact" id="contact">
        <div class="container">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
            <p class="text-uppercase">SECTION 02</p>
                <h3 class="title-style">ALL MEMBERS</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            


                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                           
                           $select = mysqli_query($db, "SELECT * FROM user WHERE role != 'admin' AND status = 1 ");
                           if(mysqli_num_rows($select)){
                            $no = 0;
                            while($s = mysqli_fetch_assoc($select)){
                                $name = $s['name'];
                                $email = $s['email'];
                                $password = $s['password'];
                                $role = $s['role'];
                                $class = $s['class'];
                                $get_a = mysqli_query($db, "SELECT * FROM class WHERE id = '$class' ");
                                if(mysqli_num_rows($get_a)){
                                    $qq = mysqli_fetch_assoc($get_a);
                                    $class_name = "<b>".$qq['name']."</b>";
                                }else{
                                    $class_name = "<i><small>FACULTY</small></i>";
                                }
                                $type = $s['type'];
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
                                $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $class_name; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $password; ?></td>
                                    <td><?php echo ucfirst($role); ?></td>
                                    <td><?php echo $type_a; ?></td>
                                    <td>
                                        <a href="admin_edit.php?edit=<?php echo $s['id']; ?>" class="btn btn-warning d-grid btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <a href="admin_users.php?reject=<?php echo $s['id']; ?>" class="btn btn-danger d-grid btn-sm">Remove</a>
                                    </td>
                                </tr>
                                <?php
                            }
                           }else{
                               echo "<td colspan='6' class='text-center'>No Request Found.</td>";
                           }
                           
                           ?>
                        </tbody>
                    </table>
             




                </div>
             
            </div>
        </div>
    </section>




