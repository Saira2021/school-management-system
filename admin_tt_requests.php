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





    <!-- 2nd Section Start Here -->





    <section class="w3l-contact py-5 mt-5" id="contact">
        <div class="container">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
            <p class="text-uppercase">SECTION 01</p>
                <h3 class="title-style">All Timetable Requests</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            


                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Room</th>
                            <th>Faculty</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Approve</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                   
                        <tbody>
                        <?php 
                        
                        $select = mysqli_query($db, "SELECT * FROM timetable WHERE status = 0");
                        if(mysqli_num_rows($select)){
                            $no = 0;
                            while($row = mysqli_fetch_assoc($select)){

                                $subject_id         = $row['subject_id'];
                                $day                = $row['day'];
                                $time               = $row['time'];



                                $subject_get = mysqli_query($db, "SELECT * FROM class_subject WHERE id = '$subject_id' ");
                                if(mysqli_num_rows($subject_get)){
                                    $subject_data = mysqli_fetch_assoc($subject_get);
                                    $subject_name = $subject_data['name'];
                                    $subject_faculty_id = $subject_data['faculty_id'];
                                    $subject_room_id = $subject_data['room_id'];

                                        $faculty = mysqli_query($db, "SELECT * FROM user WHERE id = '$subject_faculty_id' ");
                                        if(mysqli_num_rows($faculty)){
                                            $faculty_data = mysqli_fetch_assoc($faculty);
                                            $faculty_name = $faculty_data['name'];

                                            $room = mysqli_query($db, "SELECT * FROM class_room WHERE id = '$subject_room_id' ");
                                            if(mysqli_num_rows($room)){
                                                $room_data = mysqli_fetch_assoc($room);
                                                $room_name = $room_data['name'];
                                                $room_class_id = $room_data['class_id'];


                                                $get_class_a = mysqli_query($db, "SELECT * FROM class WHERE id = '$room_class_id' ");
                                                if(mysqli_num_rows($get_class_a)){
                                                    $rows_get = mysqli_fetch_assoc($get_class_a);
                                                    $class_name = $rows_get['name'];

                                                    $no++;
    
                                                    ?>
    
    
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $class_name ?></td>
                                                        <td><?php echo $subject_name ?></td>
                                                        <td><?php echo $room_name ?></td>
                                                        <td><?php echo $faculty_name ?></td>
                                                        <td><?php echo $day ?></td>
                                                        <td><?php echo $time ?></td>
                                                        <td><a href="admin_tt_requests.php?approve=<?php echo $row['id']; ?>" 
                                                        class="btn btn-dark btn-sm">Approve</a></td>
                                                        
                                                        <td><a href="admin_tt_requests.php?remove=<?php echo $row['id']; ?>"
                                                         class="btn btn-secondary btn-sm">Reject</a></td>
                                                    </tr>
    
    
    
                                                    <?php
                                                    
                                                }else{
                                                    $class_name = "";
                                                }

    
                                            }else{
                                                $room_name = "";
                                            }

                                        }else{
                                            $faculty_name = "";
                                        }

                                }else{
                                    $subject_name = "";
                                }
                                

                                ?>
                                <?php


                            }
                        }
                        
                        ?>
                    </tbody>
                   
                    </table>
                    <?php 

                    if(isset($_GET['approve'])){

                        $approve_id = $_GET['approve'];
                        $approve = mysqli_query($db, "UPDATE timetable SET status = 1 WHERE id = '$approve_id' ");
                        if($approve){
                            header("Location: admin_tt_requests.php");
                        }

                    }

                    if(isset($_GET['remove'])){

                        $remove_id = $_GET['remove'];
                        $remove = mysqli_query($db, "DELETE FROM timetable WHERE id = '$remove_id' ");
                        if($remove){
                            header("Location: admin_tt_requests.php");
                        }

                    }

                    ?>




                </div>
             
            </div>
        </div>
    </section>




