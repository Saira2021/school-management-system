<?php include_once('header.php'); ?>
<?php include_once('nav_f.php'); ?>



    <!-- contact block -->
    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">WELCOME HERE</p>
                <h3 class="title-style">LOGIN PAGE</h3>
            </div>
            <div class="row contact-block">
                <div class="col-md-12 contact-right">
                    
                
                    <form method="post" class="signin-form">
                        <div class="input-grids">
                            <div class="row">
                                <div class="col-sm-6">
                                <input type="email" name="email" placeholder="Your Email" class="contact-input" 
                                required="" />
                                </div>
                                <div class="col-sm-6">
                                <input type="password" name="password" placeholder="Your Password" 
                                class="contact-input" required="" />
                                </div>
                            </div>
                            
                        </div>
                        <div class="text-start">
                            <button type="submit" name="login_btn" class="btn btn-style btn-style-3">Login</button>
                        </div>
                    </form>
                    <?php 
                    
                    if(isset($_POST['login_btn'])){

                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $check_login = mysqli_query($db, "SELECT * FROM user WHERE email = '$email' AND password = '$password' ");
                        $data_login = mysqli_fetch_assoc($check_login);
                        if(mysqli_num_rows($check_login) == 0){
                            echo "<p class='alert alert-warning'>Email or Password is not Correct.</p>";
                        }elseif(mysqli_num_rows($check_login) == 1 AND $data_login['status'] == 1){

                            header("Location: back.php");
                            $_SESSION['id']     = $data_login['id'];
                            $_SESSION['role']   = $data_login['role'];

                        }else{
                            echo "<p class='alert alert-info'>Please wait for Admin Approval.</p>";
                        }

                    }
                    
                    ?>



                </div>
             
            </div>
        </div>
    </section>




