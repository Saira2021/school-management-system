<?php include_once('header.php'); ?>
<?php include_once('nav_f.php'); ?>


    <!-- contact block -->
    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">WELCOME HERE</p>
                <h3 class="title-style">REGISTER PAGE</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
                
                    <form method="post" class="signin-form">
                        <div class="input-grids">
                            <div class="row">
                                <div class="col-sm-6">
                                <input type="text" name="name" placeholder="Your Name" class="contact-input" 
                                required="" />
                                </div>
                                <div class="col-sm-6">
                                <input type="email" name="email" placeholder="Your Email" class="contact-input" 
                                required="" />
                                </div>
                            </div>
                            <input type="password" name="password" placeholder="Your Password" class="contact-input" 
                            required="" />                            
                            <select name="type" id="type" required >
                                <option value disabled selected>Choose Type</option>
                                <option value="0">Dean</option>
                                <option value="1">Section head</option>
                                <option value="2">Head of department</option>
                                <option value="3">Class in-charge</option>
                            </select>
                        </div>
                        <div class="text-start">
                            <button type="submit" name="register_btn" class="btn btn-style btn-style-3">Register</button>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['register_btn'])){

                        $name       = $_POST['name'];
                        $email      = $_POST['email'];
                        $password   = $_POST['password'];
                        $role       = "faculty";
                        $type       = $_POST['type'];
                        $class_id       = "0";

                        $check_login = mysqli_query($db, "SELECT * FROM user WHERE email = '$email' ");
                        $data_login = mysqli_fetch_assoc($check_login);
                        if(mysqli_num_rows($check_login) == 0){
                            $insert_data = mysqli_query($db, "INSERT INTO user(name, email, password, status, role, type, class) 
                            VALUES('$name', '$email', '$password', '0', '$role', '$type', '$class_id') ");
                            
                            if($insert_data){
                                echo "<br><p class='alert alert-success'>Success, Account has been Created..</p>";
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




