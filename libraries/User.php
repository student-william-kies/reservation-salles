<?php

class User extends Model
{
    /**
     * 1. Créer un utilisateur en base de données
     */
    public function register()
    {
        if (isset($_POST['register']))
        {
            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(trim($_POST['password']));
            $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $loginExist = $this -> find($login);
            if ($loginExist)
            {
                echo ("<section class='alert alert-danger' style='width: 20%; text-align: center; float: left; margin-left: 20%;' role='alert'><strong>Erreur :</strong> Ce nom d'utilisateur existe déjà.</section>");
            }
            else
            {
                if ($password === $confirmPassword)
                {
                    $query = $this -> pdo -> prepare("INSERT INTO utilisateurs(login, password) VALUES(:login, :password)");
                    $query -> execute([
                        "login" => $login,
                        "password" => $hashedPassword
                    ]);

                    Http::redirect('../../templates/users/connection.php');
                }
                else
                {
                    echo ("<section class='alert alert-danger' style='width: 20%; text-align: center; float: left; margin-left: 20%;' role='alert'><strong>Erreur :</strong> Login/mot de passe incorrect.</section>");
                }
            }
        }
    }

    /**
     * 2. Permet de chercher dans la base de données si un login est déjà utilisé
     *
     * @param $login
     * @return mixed
     */
    public function find($login)
    {
        $query = $this -> pdo -> prepare("SELECT login FROM utilisateurs WHERE login = :login");
        $query -> execute([
            "login" => $login
        ]);

        $result = $query -> fetch();
        return $result;
    }

    /**
     * 3. Permet d'établir une connexion à l'utilisateur
     */
    public function connect()
    {
        if (isset($_POST['signin']))
        {
            $user = htmlspecialchars(trim($_POST['login']));
            $userPassword = htmlspecialchars(trim($_POST['password']));

            $getPassword = $this -> pdo -> prepare("SELECT password FROM utilisateurs WHERE login = :login");
            $getPassword -> execute([
                "login" => $user
            ]);

            $result = $getPassword -> fetch();

            if (!$result)
            {
                echo ("<section class='alert alert-danger' style='width: 20%; text-align: center; margin-left: 40%; margin-bottom: -2.6%;' role='alert'><strong>Erreur :</strong> utilisateur introuvable.</section>");
            }
            else
            {
                $checkPassword = $result['password'];

                if (password_verify($userPassword, $checkPassword))
                {
                    $data = $this -> pdo -> prepare("SELECT * FROM utilisateurs WHERE login = :login AND password = :password");
                    $data -> execute([
                       "login" => $user,
                       "password" => $checkPassword
                    ]);

                    $infoUser = $data -> fetch(PDO::FETCH_ASSOC);

                    if ($data -> rowCount())
                    {
                        $_SESSION['id'] = $infoUser['id'];
                        $_SESSION['login'] = $infoUser['login'];
                        $_SESSION['password'] = $infoUser['password'];
                    }

                    Http::redirect('../../templates/users/index.php');
                }
                else
                {
                    echo ("<section class='alert alert-danger' style='width: 20%; text-align: center; margin-left: 40%; margin-bottom: -2.6%;' role='alert'><strong>Erreur :</strong> utilisateur introuvable.</section>");
                }
            }
        }
    }

    /**
     * 4. Permet de modifier son profil
     */
    public function update()
    {
        if (isset($_SESSION['id']))
        {
            if (isset($_POST['modify']))
            {
                $newLogin = htmlspecialchars(trim($_POST['newLogin']));
                $unhashedPassword = htmlspecialchars(trim($_POST['newPassword']));
                $newConfirmPassword = htmlspecialchars(trim($_POST['newConfirmPassword']));

                $updateHashedPassword = password_hash($unhashedPassword, PASSWORD_BCRYPT);

                if ($unhashedPassword === $newConfirmPassword)
                {
                    $loginExist = $this -> find($newLogin);

                    if ($loginExist)
                    {
                        echo ("<section class='alert alert-danger' style='width: 22%; float: left; margin-bottom: -3%;' role='alert'><strong>Erreur :</strong> nom d'utilisateur déjà existant.</section>");
                    }
                    else
                    {
                        $updateUser = $this -> pdo -> prepare("UPDATE utilisateurs SET login = :newLogin, password = :newPassword WHERE id = :id");
                        $updateUser -> execute([
                            "newLogin" => $newLogin,
                            "newPassword" => $updateHashedPassword,
                            "id" => $_SESSION['id']
                        ]);

                        $_SESSION['login'] = $newLogin;
                        $_SESSION['password'] = $updateHashedPassword;

                        session_destroy();
                        Http::redirect('../../templates/users/connection.php');
                    }
                }
                else
                {
                    echo ("<section class='alert alert-danger container' style='width: 22%; float: left; margin-bottom: -3%;' role='alert'><strong>Erreur :</strong> authentification des mot de passes incorrect.</section>");
                }
            }
            else
            {
                echo ("<section class='alert alert-danger container' style='width: 22%; float: left; margin-bottom: -3%;' role='alert'><strong>Erreur :</strong> login/mot de passe incorrect.</section>");
            }
        }
    }
}