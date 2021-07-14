<?php
session_start();
require_once 'includes/header.php';
//require_once '../src/php/message.php';


if (isset($_SESSION['mensagem'])) {
?>
<script>
window.onload = () => {
    M.toast({
        html: "<?php echo $_SESSION['mensagem']; ?>"
    })
}
</script>
<?php
    session_unset();
}




?>


<div class="row">
    <div id="title">
        <h3 class="light">REALIZE SEU CADASTRO!</h3>
    </div>
    <div id="form">
        <form action="../src/php/create.php" method="POST">

            <div class="input-field" id="name">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="input-field" id="surname">
                <label for="surname">Surname</label>
                <input type="text" name="surname" id="surname">
            </div>

            <div class="input-field" id="email">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="input-field" id="age">
                <label for="age">Age</label>
                <input type="text" name="age" id="age">
            </div>



            <div id="buttons">
                <a href="login.php" class="btn" id="headerLogin">JÁ SOU CADASTRADO</a>

                <button type="submit" id="create" name="create" class="btn">CADASTRAR</button>



            </div>
        </form>
    </div>
</div>






<?php
require_once 'includes/footer.php';
?>