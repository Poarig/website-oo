<?php
session_start();
if (!isset($_SESSION["auth"])){
    header("Location: authorization.php");
};
include("../components/head.php");
include("../components/adminPanel/adminHeader.php");
include("../components/adminPanel/adminNav.php");
?>
<div class="main admin-panel">
    <p class="text-center fs-1">
        Добро пожаловать в панель администратора сайта Ненецкого аграрно-экономического техникума имени В. Г. Волкова!
    </p>
</div>

</body>
</html>