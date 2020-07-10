<?php

    include('config/db_connect.php');   
    
    $email = $title = $ingredients = '';
    $errors = ['email'=>'', 'title'=>'', 'ingredients'=>''];

    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $errors['email'] = 'Email field can\'t be empty <br/>' ;
        } else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] =  'Invalid email format';
            }
        }
        if(empty($_POST['title'])){
            $errors['title'] =  'Title field can\'t be empty <br/>' ;
        } else{
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
                $errors['title'] =  'Title can only be alphabets';
            }
        }
        if(empty($_POST['ingredients'])){
            $errors['ingredients'] ='Ingredients field can\'t be empty <br/>' ;
        } else{
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
                $errors['ingredients'] = 'Ingredients must be seperated by commas';
            }       
        }

        if(array_filter($errors)){
            //invalid entry            
         }else{

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            $sql = "INSERT INTO pizza(title, ingredients, email) VALUES ('$title', '$ingredients', '$email')";
            
            if(mysqli_query($conn, $sql)){
                //success
                header('Location:index.php');
            } else{
                echo 'query error: '. mysqli_error($conn);
            }
        }
    }


?>

<!DOCTYPE html>
    <?php include('templates/header.php')?>

    <section class="container grey-text">
    <h4 class = "center">Add a Pizza</h4>
    <form class="white" action="" method="POST">
        <label for="">YOur email</label>
        <input type="text" name="email" value=<?php echo htmlspecialchars($email) ?>> 
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label for="">Pizza title</label>
        <input type="text" name="title" value=<?php echo htmlspecialchars($title) ?>>
        <div class="red-text"><?php echo $errors['title'] ?></div>
        <label for="">Ingredients(comma):</label>
        <input type="text" name="ingredients" value=<?php echo htmlspecialchars($ingredients) ?>>
        <div class="red-text"><?php echo $errors['ingredients'] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
    </section>
    <?php include('templates/footer.php')?>
  </body>
</html>