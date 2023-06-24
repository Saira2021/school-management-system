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
                <h3 class="title-style">MANAGE ROOMS</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            

                <form method="post" class="signin-form">
                        <div class="input-grids">
                            <select name="class_id" class="form-control mb-3" required>
                                <option value disabled selected>- Select Class -</option>
                                <?php 
                                
                                $get_options = mysqli_query($db, "SELECT * FROM class");
                                if(mysqli_num_rows($get_options)){
                                    while($w = mysqli_fetch_assoc($get_options)){
                                        ?>
                                        <option value="<?php echo $w['id'] ?>"><?php echo $w['name']; ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <input type="text" name="name" placeholder="Room Name" class="contact-input" required="" />
                        </div>
                        <div class="text-start">
                            <button type="submit" name="add_btn" class="btn btn-style btn-style-3">Add Room</button>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['add_btn'])){

                        $name = $_POST['name'];
                        $class_id = $_POST['class_id'];
                        $check = mysqli_query($db, "SELECT * FROM class_room WHERE name = '$name' AND class_id = '$class_id' ");
                        if(mysqli_num_rows($check) == 0){

                            $insert = mysqli_query($db, "INSERT INTO class_room(class_id, name) VALUES('$class_id', '$name') ");
                            if($insert){
                                echo "<br><p class='alert alert-success'>Room has been Added.</p>";
                            }

                            
                        }else{
                            echo "<br><p class='alert alert-warning'>Already Added.</p>";
                        }

                    }
                    
                    ?>


                    <br><br>
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Class</th>
                            <th>Name</th>
                            <th width="10">Edit</th>
                            <th width="10">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $get_class = mysqli_query($db, "SELECT * FROM class_room");
                        if(mysqli_num_rows($get_class)){
                            $no = 0;
                            while($s = mysqli_fetch_assoc($get_class)){

                                $class_id = $s['class_id'];
                                $get_a = mysqli_query($db, "SELECT * FROM class WHERE id = '$class_id' ");
                                if(mysqli_num_rows($get_a)){
                                    $qq = mysqli_fetch_assoc($get_a);
                                    $class_name = $qq['name'];
                                }else{
                                    $class_name = "-";
                                }
                                $name = $s['name'];
                                $no++;

                                ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $class_name; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td>
                                        <a href="admin_room.php?edit=<?php echo $s['id']; ?>" class="btn btn-sm d-grid btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a href="admin_room.php?remove=<?php echo $s['id']; ?>" class="btn btn-sm d-grid btn-danger">Remove</a>
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
                        $remove = mysqli_query($db, "DELETE FROM class_room WHERE id = '$remove_Id' ");
                        if($remove){
                            header("Location: admin_room.php");
                        }

                    }



                    if(isset($_GET['edit'])){

                        $edit_id = $_GET['edit'];
                        $get_edit = mysqli_query($db, "SELECT * FROM class_room WHERE id = '$edit_id' ");
                        if(mysqli_num_rows($get_edit)){

                            $a = mysqli_fetch_assoc($get_edit);
                            $class_class_id = $a['class_id'];
                            $class_name = $a['name'];

                            ?>


                    <br><br>
                    <form method="post" class="signin-form">
                        <div class="input-grids">
                            <select name="class_id" class="form-control mb-3" required>
                                <option value="<?php echo $class_class_id; ?>">- Select Class -</option>
                                <?php 
                                
                                $get_options = mysqli_query($db, "SELECT * FROM class");
                                if(mysqli_num_rows($get_options)){
                                    while($w = mysqli_fetch_assoc($get_options)){
                                        ?>
                                        <option value="<?php echo $w['id'] ?>"><?php echo $w['name']; ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <input type="text" name="name" value="<?php echo $class_name ?>" placeholder="Class Name" 
                            class="contact-input" required="" />
                        </div>
                        <div class="text-start">
                            <button type="submit" name="update" class="btn btn-style btn-style-3">Update CLass</button>
                            <a href="admin_room.php" class="btn btn-style btn-style-3">Cancel</a>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['update'])){

                        $class_id = $_POST['class_id'];
                        $name = $_POST['name'];
                        $insert = mysqli_query($db, "UPDATE class_room SET name = '$name', class_id = '$class_id' WHERE id = '$edit_id' ");
                        if($insert){
                            echo "<br><p class='alert alert-success'>Room has been Updated.</p>";
                        }

                    }
                    
                    ?>


                            <?php

                        }else{
                            header('location: admin_room.php');
                        }

                    }
                    
                    ?>



                </div>
             
            </div>
        </div>
    </section>




