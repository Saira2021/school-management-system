<?php include_once('header.php'); ?>
<?php include_once('nav_student.php'); ?>
<?php include_once('validate.php'); ?>
<?php 


// Fetching Logged-in Person Data.

$get_profile = mysqli_query($db, "SELECT * FROM user WHERE id = '$user_id' ");
if(mysqli_num_rows($get_profile)){

    $get_data    = mysqli_fetch_assoc($get_profile);
    $name        = $get_data['name'];
    $email       = $get_data['email'];
    $password    = $get_data['password'];
    $role        = $get_data['role'];
    $type        = $get_data['type'];
    $class_class = $get_data['class'];

}else{
    header('location: logout.php');
}



?>


    <!-- contact block -->
    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">TIMETABLE</p>
                <h3 class="title-style">Timetable</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
            
            <?php if($type == '1'){ ?>
                <form method="post" class="signin-form">
                        <div class="input-grids">
                            <select name="subject_id" id="subject_id" class="form-control" required>
                                <option value selected disabled>Choose Subject</option>
                                <?php 
                                
                                $get_subject = mysqli_query($db, "SELECT * FROM class_subject");
                                if(mysqli_num_rows($get_subject)){
                                    while($q = mysqli_fetch_assoc($get_subject)){

                                        $room_id = $q['room_id'];
                                        $get_room = mysqli_query($db, "SELECT * FROM class_room WHERE
                                         id = '$room_id' ");
                                        if(mysqli_num_rows($get_room)){
                                            $room_data = mysqli_fetch_assoc($get_room);
                                            $room_name = $room_data['name'];
                                                $class_id = $room_data['class_id'];
                                                $get_class_a = mysqli_query($db, "SELECT * FROM class WHERE 
                                                id = '$class_id' ");
                                                if(mysqli_num_rows($get_class_a)){
                                                    $class_data = mysqli_fetch_assoc($get_class_a);
                                                    $class_name = $class_data['name'];
                                                }else{
                                                    $class_name = "Class";
                                                }
                                        }else{
                                            $room_name = "Room";
                                        }


                                        ?>
                                        <option value="<?php echo $q['id'] ?>"><?php echo $class_name ?> | <?php
                                         echo $room_name ?> | <?php echo $q['name'] ?></option>
                                        <?php
                                    }
                                }
                                
                                ?>
                            </select>
                            <select name="day" id="day" class="form-control" required>
                                <option value disabled selected>Choose Day</option>
                                <option>Friday</option>
                                <option>Saturday</option>
                                <option>Sunday</option>
                                <option>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thursday</option>
                            </select>
                            <input type="time" class="form-control" name="time" required title="TIme" required>
                        </div>
                        <div class="text-start">
                            <button type="submit" name="generate_btn" class="btn btn-style btn-style-3">Generate Button</button>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['generate_btn'])){

                        $subject_id     = $_POST['subject_id'];
                        $day            = $_POST['day'];
                        $time            = $_POST['time'];

                        $check = mysqli_query($db, "SELECT * FROM timetable WHERE subject_id = '$subject_id' 
                        AND day = '$day' AND time = '$time' ");

                        if(mysqli_num_rows($check) != 0){
                            echo "<br><p class='alert alert-warning'>Already Exist.</p>";
                        }else{
                            $insert = mysqli_query($db, "INSERT INTO timetable(subject_id, `day`, `status`, `time`) 
                            VALUES('$subject_id','$day','0', '$time') ");

                            if($insert){
                                echo "<br><p class='alert alert-success'>Generated.</p>";
                            }else{
                                echo $db->error;
                            }
                        }




                    }
                    
                    
                    ?>


<?php } ?>




                </div>



                <div class="col-md-12 mt-5 contact-right">
                    
                    
                <div class="row">
                    <div class="col-md-4">



<!-- Class Search -->
<fieldset class="border p-2">
<legend  class="w-auto bg-white" style="margin-top: -30px;">CLASS SEARCH</legend>

<form action="" method="post">
<div class="form-group">
<select name="class_id" class="form-control" required>
<option value disabled selected>Choose Class</option>
<?php 

$get_class = mysqli_query($db, "SELECT * FROM class WHERE id = '$class_class' ");
if(mysqli_num_rows($get_class)){
while($w = mysqli_fetch_assoc($get_class)){
?>
<option value="<?php echo $w['id'] ?>"><?php echo $w['name']; ?></option>
<?php
}
}

?>
</select>
</div>
<div class="form-group">
<input type="submit" class="btn btn-dark" name="class_search" value="Class Search">
</div>
</form>

</fieldset>
<!-- // Class Search -->



<!-- Subjcet Search -->
<fieldset class="border p-2 mt-5">
<legend  class="w-auto bg-white" style="margin-top: -30px;">SUBJECT SEARCH</legend>

<form action="" method="post">
<div class="form-group">
<select name="subject_id" class="form-control" required>
<option value disabled selected>Choose Subject</option>
<?php 

$get_subject = mysqli_query($db, "SELECT * FROM class_subject");
if(mysqli_num_rows($get_subject)){
while($ss = mysqli_fetch_assoc($get_subject)){
?>
<option value="<?php echo $ss['id'] ?>"><?php echo $ss['name']; ?></option>
<?php
}
}

?>
</select>
</div>
<div class="form-group">
<input type="submit" class="btn btn-dark" name="subject_search" value="Search Subject">
</div>
</form>

</fieldset>
<!-- // Faculty Search -->





<!-- ROOM Search -->
<fieldset class="border p-2 mt-5">
<legend  class="w-auto bg-white" style="margin-top: -30px;">CLASS ROOM</legend>

<form action="" method="post">
<div class="form-group">
<select name="room_id" class="form-control" required>
<option value disabled selected>Choose Room</option>
<?php 

$get_room = mysqli_query($db, "SELECT * FROM class_room");
if(mysqli_num_rows($get_room)){
while($rr = mysqli_fetch_assoc($get_room)){
?>
<option value="<?php echo $rr['id'] ?>"><?php echo $rr['name']; ?></option>
<?php
}
}

?>
</select>
</div>
<div class="form-group">
<input type="submit" class="btn btn-dark" name="room_search" value="Search">
</div>
</form>

</fieldset>
<!-- // ROOM Search -->
                    


                    </div>
                    <div class="col-md-8">



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
                            <th>Download</th>
                        </tr>
                    </thead>
                    <?php 
                    
                    if(isset($_POST['subject_search'])){
                        $subject_id = $_POST['subject_id'];
                        ?>
                        <tbody>
                        <?php 
                        
                        $select = mysqli_query($db, "SELECT * FROM timetable WHERE subject_id = '$subject_id' 
                        AND status = 1 ");
                        if(mysqli_num_rows($select)){
                            $no = 0;
                            while($row = mysqli_fetch_assoc($select)){

                                $subject_id         = $row['subject_id'];
                                $day                = $row['day'];
                                $time               = $row['time'];



                                $subject_get = mysqli_query($db, "SELECT * FROM class_subject 
                                WHERE id = '$subject_id' ");

                                if(mysqli_num_rows($subject_get)){
                                    $subject_data = mysqli_fetch_assoc($subject_get);
                                    $subject_name = $subject_data['name'];
                                    $subject_faculty_id = $subject_data['faculty_id'];
                                    $subject_room_id = $subject_data['room_id'];

                                        $faculty = mysqli_query($db, "SELECT * FROM user WHERE 
                                        id = '$subject_faculty_id' ");

                                        if(mysqli_num_rows($faculty)){
                                            $faculty_data = mysqli_fetch_assoc($faculty);
                                            $faculty_name = $faculty_data['name'];

                                            $room = mysqli_query($db, "SELECT * FROM class_room WHERE 
                                            id = '$subject_room_id' AND class_id = '$class_class' ");
                                            if(mysqli_num_rows($room)){
                                                $room_data = mysqli_fetch_assoc($room);
                                                $room_name = $room_data['name'];
                                                $room_class_id = $room_data['class_id'];


                                                $get_class_a = mysqli_query($db, "SELECT * FROM class WHERE
                                                 id = '$room_class_id'");
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
                                                        <td>
                                                            <form action="pdf.php" method="post">
                                                                <input type="hidden" name="subject" value="<?php echo $subject_name ?>">
                                                                <input type="hidden" name="class" value="<?php echo $class_name ?>">
                                                                <input type="hidden" name="room" value="<?php echo $room_name ?>">
                                                                <input type="hidden" name="time" value="<?php echo $time ?>">
                                                                <input type="hidden" name="date" value="<?php echo $day ?>">
                                                                <input type="submit" style="padding: 0px" class="btn btn-dark" value="Download">
                                                            </form>
                                                        </td>
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
                        <?php

                    }elseif(isset($_POST['class_search'])){

                        $class_id = $_POST['class_id'];

                        ?>

<tbody>
                        <?php 
                        
                        $select = mysqli_query($db, "SELECT * FROM timetable WHERE status = 1");
                        if(mysqli_num_rows($select)){
                            $no = 0;
                            while($row = mysqli_fetch_assoc($select)){

                                $subject_id         = $row['subject_id'];
                                $day                = $row['day'];
                                $time               = $row['time'];



                                $subject_get = mysqli_query($db, "SELECT * FROM class_subject 
                                WHERE id = '$subject_id' ");
                                if(mysqli_num_rows($subject_get)){
                                    $subject_data = mysqli_fetch_assoc($subject_get);
                                    $subject_name = $subject_data['name'];
                                    $subject_faculty_id = $subject_data['faculty_id'];
                                    $subject_room_id = $subject_data['room_id'];

                                        $faculty = mysqli_query($db, "SELECT * FROM user
                                         WHERE id = '$subject_faculty_id' ");
                                        if(mysqli_num_rows($faculty)){
                                            $faculty_data = mysqli_fetch_assoc($faculty);
                                            $faculty_name = $faculty_data['name'];

                                            $room = mysqli_query($db, "SELECT * FROM class_room
                                             WHERE id = '$subject_room_id' AND class_id = '$class_id'
                                              AND class_id = '$class_class' ");
                                            if(mysqli_num_rows($room)){
                                                $room_data = mysqli_fetch_assoc($room);
                                                $room_name = $room_data['name'];
                                                $room_class_id = $room_data['class_id'];


                                                $get_class_a = mysqli_query($db, "SELECT * FROM class WHERE 
                                                id = '$room_class_id'");
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
                                                        <td>
                                                            <form action="pdf.php" method="post">
                                                                <input type="hidden" name="subject" value="<?php echo $subject_name ?>">
                                                                <input type="hidden" name="class" value="<?php echo $class_name ?>">
                                                                <input type="hidden" name="room" value="<?php echo $room_name ?>">
                                                                <input type="hidden" name="time" value="<?php echo $time ?>">
                                                                <input type="hidden" name="date" value="<?php echo $day ?>">
                                                                <input type="submit" style="padding: 0px" class="btn btn-dark" value="Download">
                                                            </form>
                                                        </td>
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

                        <?php



                    }elseif(isset($_POST['room_search'])){

                        $room_id = $_POST['room_id'];
                        ?>

<tbody>
                        <?php 
                        
                        $select = mysqli_query($db, "SELECT * FROM timetable WHERE status = 1");
                        if(mysqli_num_rows($select)){
                            $no = 0;
                            while($row = mysqli_fetch_assoc($select)){

                                $subject_id         = $row['subject_id'];
                                $day                = $row['day'];
                                $time               = $row['time'];



                                $subject_get = mysqli_query($db, "SELECT * FROM class_subject WHERE 
                                id = '$subject_id' ");

                                if(mysqli_num_rows($subject_get)){
                                    $subject_data = mysqli_fetch_assoc($subject_get);
                                    $subject_name = $subject_data['name'];
                                    $subject_faculty_id = $subject_data['faculty_id'];
                                    $subject_room_id = $subject_data['room_id'];

                                        $faculty = mysqli_query($db, "SELECT * FROM user WHERE 
                                        id = '$subject_faculty_id'");

                                        if(mysqli_num_rows($faculty)){
                                            $faculty_data = mysqli_fetch_assoc($faculty);
                                            $faculty_name = $faculty_data['name'];

                                            $room = mysqli_query($db, "SELECT * FROM class_room WHERE 
                                            id = '$subject_room_id' AND class_id = '$class_class' ");

                                            if(mysqli_num_rows($room)){
                                                $room_data = mysqli_fetch_assoc($room);
                                                $room_name = $room_data['name'];
                                                $room_class_id = $room_data['class_id'];


                                                $get_class_a = mysqli_query($db, "SELECT * FROM class WHERE 
                                                id = '$room_class_id' ");
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
                                                        <td>
                                                        <form action="pdf.php" method="post">
                                                                <input type="hidden" name="subject" value="<?php echo $subject_name ?>">
                                                                <input type="hidden" name="class" value="<?php echo $class_name ?>">
                                                                <input type="hidden" name="room" value="<?php echo $room_name ?>">
                                                                <input type="hidden" name="time" value="<?php echo $time ?>">
                                                                <input type="hidden" name="date" value="<?php echo $day ?>">
                                                                <input type="submit" style="padding: 0px" class="btn btn-dark" value="Download">
                                                            </form>
                                                        </td>
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

                        <?php

                    }else{
                        ?>
                        <tbody>
                        <?php 
                        
                        $select = mysqli_query($db, "SELECT * FROM timetable WHERE status = 1");
                        if(mysqli_num_rows($select)){
                            $no = 0;
                            while($row = mysqli_fetch_assoc($select)){

                                $subject_id         = $row['subject_id'];
                                $day                = $row['day'];
                                $time               = $row['time'];



                                $subject_get = mysqli_query($db, "SELECT * FROM class_subject WHERE 
                                id = '$subject_id' ");

                                if(mysqli_num_rows($subject_get)){
                                    $subject_data = mysqli_fetch_assoc($subject_get);
                                    $subject_name = $subject_data['name'];
                                    $subject_faculty_id = $subject_data['faculty_id'];
                                    $subject_room_id = $subject_data['room_id'];

                                        $faculty = mysqli_query($db, "SELECT * FROM user WHERE
                                         id = '$subject_faculty_id' ");

                                        if(mysqli_num_rows($faculty)){
                                            $faculty_data = mysqli_fetch_assoc($faculty);
                                            $faculty_name = $faculty_data['name'];

                                            $room = mysqli_query($db, "SELECT * FROM class_room WHERE 
                                            id = '$subject_room_id' AND class_id = '$class_class' ");

                                            if(mysqli_num_rows($room)){
                                                $room_data = mysqli_fetch_assoc($room);
                                                $room_name = $room_data['name'];
                                                $room_class_id = $room_data['class_id'];


                                                $get_class_a = mysqli_query($db, "SELECT * FROM class WHERE 
                                                id = '$room_class_id'");
                                                
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
                                                        <td>
                                                            <form action="pdf.php" method="post">
                                                                <input type="hidden" name="subject" value="<?php echo $subject_name ?>">
                                                                <input type="hidden" name="class" value="<?php echo $class_name ?>">
                                                                <input type="hidden" name="room" value="<?php echo $room_name ?>">
                                                                <input type="hidden" name="time" value="<?php echo $time ?>">
                                                                <input type="hidden" name="date" value="<?php echo $day ?>">
                                                                <input type="submit" style="padding: 0px" class="btn btn-dark" value="Download">
                                                            </form>
                                                        </td>
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
                        <?php
                    }
                    
                    ?>
                    </table>

                    </div>
                </div>


                </div>
             
            </div>
        </div>
    </section>




