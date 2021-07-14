<?php

include 'message.php';


class Funcionarios
{

    private $connection;


    public function __construct()
    {

        try {

            $this->connection = new PDO('mysql:host=localhost;port=3307;dbname=exemplopdo', 'root', '');

            return $this->connection;
        } catch (PDOException $e) {

            throw new PDOException($e);
        }
        //return $this->connection;
    }

    public function create()
    {

        if (isset($_POST['create'])) {

            $name = $_POST['name'];

            $surname = $_POST['surname'];

            $email = $_POST['email'];

            $age = $_POST['age'];

            if (empty($name) || empty($surname) || empty($email) || empty($age)) {

                header('Location: ../../public/index.php');

                $_SESSION['mensagem'] = "Preencha todos os campos!";
            } elseif (is_int($age)) {

                $_SESSION['mensagem'] = "Formato de idade inválido!";

                header('Location: ../../public/index.php');
            } else {


                $sql = "INSERT INTO funcionarios(name, surname, email, age) VALUES(?, ?, ?, ?)";

                $prepare = $this->connection->prepare($sql);

                $prepare->bindParam(1, $name);

                $prepare->bindParam(2, $surname);

                $prepare->bindParam(3, $email);

                $prepare->bindParam(4, $age);

                $prepare->execute();

                header('Location: ../../public/password.php');
            }
        }
    }

    public function createPassword()
    {
        $connection = $this->connection;

        if (isset($_POST['password'])) {

            if (isset($_GET['id'])) {

                $password = $_POST['tpassword'];

                if (empty($password)) {

                    header('Location: ../../public/password.php');
                } else {

                    $passwordMd5 = md5($password);

                    $id = $_GET['id'];

                    $sql = "UPDATE funcionarios SET password = ? WHERE id = '$id'";

                    $prepare = $connection->prepare($sql);

                    $prepare->bindParam(1, $passwordMd5);

                    $prepare->execute();

                    header('Location: ../../public/wellcome.php?id=' . $id);
                }
            }
        }
    }

    public function login()
    {
        $connection = $this->connection;

        if (isset($_POST['login'])) {

            $name = $_POST['name'];

            $password = $_POST['password'];

            $passwordMD5 = md5($password);

            $sql = "SELECT * FROM funcionarios WHERE name = ?";

            $prepare = $connection->prepare($sql);

            $prepare->execute([$name]);

            if ($prepare->rowCount() == 1) {

                $info = $prepare->fetch();

                if ($passwordMD5 == $info['password']) {

                    $_SESSION['login'] = true;

                    $_SESSION['id'] = $info['id'];

                    $_SESSION['name'] = $info['name'];

                    header('Location: ../../public/wellcome.php?id=' . $info['id']);
                } else {

                    header('Location: ../../public/login.php');

                    $_SESSION['mensagem'] = "Senha inválida";
                }
            } else {

                header('Location: ../../public/login.php');

                $_SESSION['mensagem'] = "Usuário não encontrado";
            }
        }
    }

    public function update()
    {
        $connection = $this->connection;

        if (isset($_POST['update'])) {

            $name = $_POST['name'];

            $surname = $_POST['surname'];

            $email = $_POST['email'];

            $age = $_POST['age'];

            $age = intval($age);


            if (!is_int($age)) {

                $_SESSION['mensagem'] = "Formato de idade inválido!";

                header('Location: ../../public/screenEdit.php?id=' . $_GET['id']);
            } elseif (empty($name) || empty($surname) || empty($email) || empty($age)) {

                $_SESSION['mensagem'] = "Preencha corretamente!";

                header('Location: ../../public/screenEdit.php?id=' . $_GET['id']);
            } else {

                $sql = "UPDATE funcionarios SET name = ?, surname = ?, email = ?, age =? WHERE id = ? ";

                $prepare = $connection->prepare($sql);

                $prepare->bindParam(1, $name);

                $prepare->bindParam(2, $surname);

                $prepare->bindParam(3, $email);

                $prepare->bindParam(4, $age);

                $prepare->bindParam(5, $_GET['id']);

                $prepare->execute();

                //$prepare->rowCount();

                $_SESSION['mensagem'] = "Atualizado com sucesso!";

                header('Location: ../../public/wellcome.php?id=' . $_GET['id']);
            }
        }
    }

    public function delete()
    {
        $connection = $this->connection;

        if (isset($_POST['delete'])) {

            //eduardo:
            $idUser = $_GET['id'];

            //beatriz:
            $idRemove = $_GET['id2'];

            $sql = "DELETE FROM funcionarios WHERE id = ?";

            $prepare = $connection->prepare($sql);

            $prepare->bindParam(1, $_GET['id2']);

            $prepare->execute();



            //echo $prepare->rowCount();

            $_SESSION['mensagem'] = "Registro removido com sucesso!";

            if ($idUser == $idRemove) {

                header('Location: ../../public/index.php');
            } else {

                header('Location: ../../public/wellcome.php?id=' . $idUser);
            }
        }
    }

    public function getIdForEmail()
    {

        $connection = $this->connection;

        $idUser = $_GET['id'];
        $idEmail = $_GET['id2'];

        header('Location: ../../public/email.php?id=' . $idUser . '&id2=' . $idEmail);
    }
    public function sendEmail()
    {
        //     $connection = $this->connection;

        //     if (isset($_POST['send'])) {

        $idUser = $_GET['id'];

        //         $idUserEmail = $_GET['id2'];

        //         $text = $_POST['textEmail'];

        //         //------USER-----//
        //         $sql = "SELECT * FROM funcionarios WHERE id = ?";

        //         $prepare = $connection->prepare($sql);

        //         $prepare->bindParam(1, $idUser);

        //         $prepare->execute();

        //         $infoUser = $prepare->fetch();

        //         //----USEREMAIL----//
        //         $sql = "SELECT * FROM funcionarios WHERE id = ?";

        //         $prepare = $connection->prepare($sql);

        //         $prepare->bindParam(1, $idUserEmail);

        //         $prepare->execute();

        //         $infoUserEmail = $prepare->fetch();

        //         //--------EMAIL-------//

        //         $to = $infoUserEmail['email'];

        //         $subject = "Contato Programador";

        //         $body = "Nome: " . $infoUser['name'] . "\n" .
        //             "Email:" . $infoUser['email'] . "\n" .
        //             "Mensagem: " . $text;

        //         $header = "From: " . $infoUser['email'] . "\n" .
        //             "Replay-To: " . $infoUser['email'] . "\n" .
        //             "X=Mailer: " . phpversion();


        //         if (mail($to, $subject, $body, $header)) {
        //             echo "enviado";
        //             //header('Location: ../../public/wellcome?id=' . $infoUser['id'] . "&id2=" . $infoUserEmail['id']);
        //         } else {
        //             echo "não foi enviado";
        //         }
        //     }
        header('Location: ../../public/error.php?id=' . $idUser);
    }
}