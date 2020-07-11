<?php

  include('config/db_connect.php');

  $sql = 'SELECT title, ingredients, id FROM pizza';

  $result = mysqli_query($conn, $sql);

  $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);

  mysqli_close($conn);

?>

<!DOCTYPE html>
    <?php include('templates/header.php')?>

    <?php
    
    if(isset($_SESSION['Uid'])){
      echo '<h4 class=\'center grey-text\'> You can add recipes!</h4>';
    } else{
      echo '<h4 class=\'center grey-text\'> Please login to add a pizza</h4>';
    }
    ?>
    
    <div class="container">
      <div class="row">

        <?php foreach($pizzas as $pizza): ?>
          <div class="col s6 md3">
            <div class="card z-depth-0">
            <img src="img/pizza.svg" alt="" class="pizza">
              <div class="card-content center">
                <h6><?php echo htmlspecialchars($pizza['title'])?></h6>
                <ul>
                  <?php foreach(explode(',',$pizza['ingredients']) as $ing):?>
                  <li><?php echo htmlspecialchars($ing);?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="card-action right-align">
                <a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>">more info</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php include('templates/footer.php')?>
  </body>
</html>