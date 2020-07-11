<!DOCTYPE html>
    <?php include('templates/header.php');
    if(isset($_GET['signup'])){
        if($_GET['signup']=='success'){
            echo '<h5 class="green-text center"> User Created! Please log in.</h5>';
        }
    }
    if(isset($_GET['error'])){
        if($_GET['error']=="loggedout"){
            echo '<h6 class="red-text center">Please log in to add pizza.</h6>';
        } elseif($_GET['error']=="emptyfields"){
            echo '<h6 class="red-text center">Please fill all fields.</h6>';
        }elseif($_GET['error']=="sqlerror"){
            echo '<h6 class="red-text center">Internal error, retry.</h6>';
        }elseif($_GET['error']=="wrongpwd"){
            echo '<h6 class="red-text center">Wrong password.</h6>';
        }elseif($_GET['error']=="nouser"){
            echo '<h6 class="red-text center">User not found.</h6>';
        }
    }
    ?>
    <form action="includes/login.inc.php" method="post">
   <input type="text" name="mailuid" placeholder="Username">
   <input type="password" name="pwd" placeholder="Password">
   <button type="submit" name="login-sub" class="btn brand z-depth-0">Login</button>
   <a href="signup.php"class="right" style="padding:10px">NEW account?</a>
</form>

<?php include('templates/footer.php')?>

</html>