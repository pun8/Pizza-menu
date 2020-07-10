<?php
    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id-to-delete']);

        $sql = "DELETE FROM pizza WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location:index.php');
        }else{
            echo 'query error: ' . mysqli_error($conn) ;
        }

    }

    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, ($_GET['id']));

        $sql = "SELECT * FROM pizza WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>

<!DOCTYPE html
<?php include('templates/header.php')?>

    <div class="containter center grey-text">
        <?php if($pizza):?>
            <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
            <p>Created by: <?php echo htmlspecialchars($pizza['email']);?></p>
            <p><?php echo date($pizza['created_at']);?></p>
            <h5>Ingredients</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients'])?></p>

            <form action="details.php" method="POST">
                <input type="hidden" name="id-to-delete" value="<?php echo htmlspecialchars($pizza['id']) ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>
        <?php else:?>
            <h2>Pizza not available</h2>
        <?php endif?>
    </div>

<?php include('templates/footer.php')?>
</html>