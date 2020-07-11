<?php

session_start();

?>

<head>
<title>The Net ninja</title> 
 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type='text/css'>
    .brand{
        background: #cbb09c !important;
    }
    .brand-text{
        color: #cbb09c !important;
    }
    form{
        max-width: 460px;
        margin: 20px auto;
        padding: 20px;
    }
    #logoutb{
        max-width: auto;
        margin: auto;
        padding: 0px 0px; 
    }
    .pizza{
        width:100px;
        margin: 40px auto -30px;
        display: block;
        position: relative;
        top: -30px;
    }
    .navv{
        padding-left:100px
    }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="navv nav-wrapper">
            <a href="index.php" class="brand-text brand-logo">Ninja Pizza</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="add.php" class="btn brand z-depth-0">Add a Pizza</a></li>
                <?php if(isset($_SESSION['Uid'])){
                echo
                '<li>
                <form action="includes/logout.inc.php" method="post" id="logoutb">
                <button type="submit" name="logout-sub" class="btn brand z-depth-0">Logout</button>
                </form>
                </li>';} else{
                    echo '<li><a href="login.php" class="btn brand z-depth-0">Login</a></li>';
                }
                ?>
                
            </ul>
        </div>
    </nav>