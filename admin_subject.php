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
                <p class="text-uppercase">ADMIN PANEL</p>
                <h3 class="title-style">MANAGE SUBJECTS</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            

                <form method="post" class="signin-form">
                        <div class="input-grids">
                            <select name="room_id" class="form-control mb-3" required>
                                <option value disabled selected>- Select Room -</option>
                                <?php 
                                
                                $get_options = mysqli_query($db, "SELECT * FROM class_room");
                                if(mysqli_num_rows($get_options)){
                                    while($w = mysqli_fetch_assoc($get_options)){
                                        ?>
                                        <option value="<?php echo $w['id'] ?>"><?php echo $w['name']; ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <select name="faculty_id" class="form-control mb-3" required>
                                <option value disabled selected>- Faculty -</option>
                                <?php 
                                
                                $get_f = mysqli_query($db, "SELECT * FROM user WHERE role = 'faculty' AND status = 1 ");
                                if(mysqli_num_rows($get_f)){
                                    while($f = mysqli_fetch_assoc($get_f)){
                                        ?>
                                        <option value="<?php echo $f['id'] ?>"><?php echo $f['name']; ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <input type="text" name="name" placeholder="subject Name" class="contact-input" required="" />
                        </div>
                        <div class="text-start">
                            <button type="submit" name="add_btn" class="btn btn-style btn-style-3">Add subject</button>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['add_btn'])){

                        $name = $_POST['name'];
                        $room_id = $_POST['room_id'];
                        $faculty_id = $_POST['faculty_id'];
                        $check_f = mysqli_query($db, "SELECT * FROM class_subject WHERE faculty_id = '$faculty_id' AND room_id = '$room_id' ");
                        if(mysqli_num_rows($check_f) == 0){
                            $insert = mysqli_query($db, "INSERT INTO class_subject(room_id, name, faculty_id) VALUES('$room_id', '$name', '$faculty_id') ");
                            if($insert){
                                echo "<br><p class='alert alert-success'>Subject has been Added.</p>";
                            }
                        }else{
                            echo "<br><p class='alert alert-warning'>Record already Exist..</p>";
                        }
                        

                    }
                    
                    ?>


                    <br><br>
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Faculty</th>
                            <th>Class</th>
                            <th>Name</th>
                            <th width="10">Edit</th>
                            <th width="10">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $get_class = mysqli_query($db, "SELECT * FROM class_subject");
                        if(mysqli_num_rows($get_class)){
                            $no = 0;
                            while($s = mysqli_fetch_assoc($get_class)){

                                $faculty_id = $s['faculty_id'];
                                $room_id = $s['room_id'];
                                $get_a = mysqli_query($db, "SELECT * FROM class_room WHERE id = '$room_id' ");
                                if(mysqli_num_rows($get_a)){
                                    $qq = mysqli_fetch_assoc($get_a);
                                    $room_name = $qq['name'];
                                }else{
                                    $room_name = "-";
                                }
                                $get_f = mysqli_query($db, "SELECT * FROM user WHERE id = '$faculty_id' ");
                                if(mysqli_num_rows($get_f)){
                                    $ff = mysqli_fetch_assoc($get_f);
                                    $faculty_name = $ff['name'];
                                }else{
                                    $faculty_name = "-";
                                }
                                $name = $s['name'];
                                $no++;

                                ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $faculty_name; ?></td>
                                    <td><?php echo $room_name; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td>
                                        <a href="admin_subject.php?edit=<?php echo $s['id']; ?>" 
                                        class="btn btn-sm d-grid btn-warning">Edit</a>
                                    </td>

                                    <td>
                                        <a href="admin_subject.php?remove=<?php echo $s['id']; ?>"
                                         class="btn btn-sm d-grid btn-danger">Remove</a>
                                    </td>
                                </tr>


                                <?php

                            }
                        }else{
                            echo "<td>No Class Found.</td>";
                        }
                        
                        ?>
                    </tbody>
                    </table>

                    <?php 
                    

                    if(isset($_GET['remove'])){

                        $remove_Id = $_GET['remove'];
                        $remove = mysqli_query($db, "DELETE FROM class_subject WHERE id = '$remove_Id' ");
                        if($remove){
                            header("Location: admin_subject.php");
                        }

                    }



                    if(isset($_GET['edit'])){

                        $edit_id = $_GET['edit'];
                        $get_edit = mysqli_query($db, "SELECT * FROM class_subject WHERE id = '$edit_id' ");
                        if(mysqli_num_rows($get_edit)){

                            $a = mysqli_fetch_assoc($get_edit);
                            $class_room_id = $a['room_id'];
                            $faculty_id = $a['faculty_id'];
                            $room_name = $a['name'];

                            ?>


                    <br><br>
                    <form method="post" class="signin-form">
                        <div class="input-grids">
                            <select name="room_id" class="form-control mb-3" required>
                                <option value="<?php echo $class_room_id; ?>">- Select Room -</option>
                                <?php 
                                
                                $get_options = mysqli_query($db, "SELECT * FROM class_room");
                                if(mysqli_num_rows($get_options)){
                                    while($w = mysqli_fetch_assoc($get_options)){
                                        ?>
                                        <option value="<?php echo $w['id'] ?>"><?php echo $w['name']; ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <select name="faculty_id" class="form-control mb-3" required>
                                <option value="<?php echo $faculty_id; ?>">- Select Room -</option>
                                <?php 
                                
                                $get_ff = mysqli_query($db, "SELECT * FROM user WHERE role = 'faculty' AND status = 1 ");
                                if(mysqli_num_rows($get_ff)){
                                    while($qwe = mysqli_fetch_assoc($get_ff)){
                                        ?>
                                        <option value="<?php echo $qwe['id'] ?>"><?php echo $qwe['name']; ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <input type="text" name="name" value="<?php echo $room_name ?>" placeholder="Class Name" 
                            class="contact-input" required="" />
                        </div>
                        <div class="text-start">
                            <button type="submit" name="update" class="btn btn-style btn-style-3">Update CLass</button>
                            <a href="admin_subject.php" class="btn btn-style btn-style-3">Cancel</a>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['update'])){

                        $faculty_id = $_POST['faculty_id'];
                        $room_id = $_POST['room_id'];
                        $name = $_POST['name'];
                        $check_f = mysqli_query($db, "SELECT * FROM class_subject WHERE (faculty_id = '$faculty_id' OR room_id = '$room_id' OR name = '$name') AND id != '$edit_id' ");
                        if(mysqli_num_rows($check_f) == 0){
                            $insert = mysqli_query($db, "UPDATE class_subject SET name = '$name', room_id = '$room_id' WHERE id = '$edit_id' ");
                            if($insert){
                                echo "<br><p class='alert alert-success'>Record has been Updated.</p>";
                            }
                        }else{
                            echo "<br><p class='alert alert-warning'>Record Already Exist.</p>";
                        }


                    }
                    
                    ?>


                            <?php

                        }else{
                            header('location: admin_subject.php');
                        }

                    }
                    
                    ?>



                </div>
             
            </div>
        </div>
    </section>




