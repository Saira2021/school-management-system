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
                            <select name="class_id" class="form-control mb-3" required>
                                <option value disabled selected>Choose Class</option>
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
                        $role       = "student";
                        $type       = "student";
                        $class_id       = $_POST['class_id'];

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




