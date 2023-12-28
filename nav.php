<nav class="navbar">
    <div class="loggedout">
            <a href="index.php">Strona główna</a>
            <a href="#">Polityka prywatności</a>
        </div>
        <div class="loggedin">
            <?php
                if(isset($_SESSION["user_id"])){ ?>
                    <a href="user_profile.php" class="profile-link" style="color: darkred; "> <?php echo $_SESSION ["user_username"] ?></a>
                    <a href='create_auction.php'>Stwórz aukcje</a>
                    <a href='includes/logout.inc.php'>Wyloguj</a>
            <?php }else{ ?>
                    <a href='login.php'>Logowanie</a>
            <?php }?>
    </div>  
</nav>