<?php
session_start();
if (!isset($_SESSION)){
    header("Location: authorization.php");
};
include("components/head.php");
include("components/adminPanel/adminHeader.php");
include("components/adminPanel/adminNav.php");
?>
</body>
</html>