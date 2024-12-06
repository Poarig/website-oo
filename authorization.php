<?php
include("components/head.php");
include("components/adminPanel/adminHeader.php");
session_start();
?>
</header>
<div class="main adminPanel">
    <form class="main-content adminPanel" action="vendors/authorization.php">
        <div><input type="text" name="login" placeholder="логин" /></div>
        <div><input type="password" name="password" placeholder="пароль" /></div>
        <div ><input type="submit" value="войти" /></div>
    </form>
</div>
</body>
</html>