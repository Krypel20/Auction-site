<nav class="navbar">
    <div class="loggedout">
            <a href="index.php">Strona główna</a>
            <a href="#">Polityka prywatności</a>
        </div>
        <div class="loggedin">
            <?php
                if(isset($_SESSION["user_id"])){
                    echo '<a class="hello-text" style="color: darkred; ">' . $_SESSION ["user_username"] .'</a>';
                    echo "<a href='user_page.php'>Profil</a>";
                    echo "<a href='create_auction.php'>Stwórz aukcje</a>";
                    echo "<a href='includes/logout.inc.php'>Wyloguj</a>";
                }else{
                    echo "<a href='login.php'>Logowanie</a>";
                }
            ?>
    </div>  
</nav>