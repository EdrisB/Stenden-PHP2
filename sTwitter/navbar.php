<?php
session_start();
?>
<div class="navbar">
    <a href="index.php"><img src="logo.png" alt="Logo" width="259px"></a>
    <?php
    if (!isset($_SESSION['userId'])){
        echo " <a href=\"login.php\">Login</a> - <a href=\"signUp.php\">Registreer</a>";
    }else{
        echo " <a href=\"addMessage.php\">Post bericht</a> - <a href=\"logout.php\">Logout</a>";
    }
    ?>




<hr>
</div>