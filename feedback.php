<?php
include('components/head.php');
include('components/header.php');
?>

<form class="main-content">
    <div><input type="text" name="name" placeholder="*имя" /></div>
    <div><input type="text" name="surname" placeholder="*фамилия" /></div>
    <div><input type="text" name="patronymic" placeholder="отчество" /></div>
    <div><input type="email" name="email" placeholder="*электронная почта" /></div>
    <div><input type="tel" name="phone_number" placeholder="*номер телефона" /></div>
    <div><textarea name="question" placeholder="*вопрос"></textarea></div>
    <div class="form-buttons">
        <div ><input type="submit" value="отправить" /></div>
        <div class="blue-button"><a href="index.php">отмена</a></div>
    </div>
</form>

<?php
include('components/footer.php');
?>