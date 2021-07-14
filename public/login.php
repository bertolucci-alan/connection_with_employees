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
        <h3 class="light">CONECTE-SE!</h3>
    </div>

    <div id="loginbox">

        <form action="../src/php/login.php" method="POST">

            <div class="input-field" id="loginname">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="input-field" id="loginpassword">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div id="buttons">

                <a href="index.php" class="btn" id="create">CRIAR CADASTRO</a>
                <button type="submit" id="login" name="login" class="btn">ENTRAR</button>

            </div>
        </form>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>