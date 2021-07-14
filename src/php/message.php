<?php

// AINDA PRECISANDO DE REPAROS COM A SESSÃO

//session_start();
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
}
//session_unset();
?>