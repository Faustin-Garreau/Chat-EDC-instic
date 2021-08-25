<?php
session_start();
require_once('config.php');
if (isset($_POST['email_log'], $_POST['password_log'])) {
    $email_log = htmlspecialchars($_POST['email_log']);
    $password_log = sha1($_POST['password_log']);
    if (!empty($email_log) && !empty($password_log)) {
        $req_user = $bdd->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
        $req_user->execute(array($email_log, $password_log));
        $user_exist = $req_user->rowCount();
        if ($user_exist == 1) {
           $user_info = $req_user->fetch();
           $_SESSION['id'] = $user_info['id'];
           $_SESSION['email'] = $user_info['email'];
           $_SESSION['password'] = $user_info['password'];
           $_SESSION['image'] = $user_info['image'];
        }else {
            $erreur = 'Email ou mot de passe incorrect';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<header>
        <nav> 
            <div class="nav-style">
            <?php if(!isset($_SESSION['id'])){ ?>
                <form action=""  method="POST">
                    <div id="form">
                        <div>
                            <input type="email" required name="email_log" placeholder="email" autocomplete="email_log">
                            <input type="password" required name="password_log" placeholder="password" autocomplete="password_log">
                        </div>
                        <div class="login_register">
                            <a class="register_button" href="registerTchat.php">Pas de compte ? clique ici</a>
                            <input type="submit" value="login" class="float-right group relative flex justify-center py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    <?php if(isset($erreur)){ ?>
                <p style="color: red;"><?= $erreur ?></p>
                <?php } ?>
                </form>
                <?php }else { ?>
                    <img width="180px" src="<?php echo $_SESSION['image'];?>" alt="">
                <?php } ?>
                <div>
                    <a class="link" href="index.php">Acceuil</a>
                    <?php if(isset($_SESSION['id'])){ ?>
                        <a class="link" href="deconnexion.php">se deconnecter</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
<body>
 <h1 id='title' class="text-center font-extrabold text-gray-900">Acceuil</h1>
</body>
<style>

 

.nav-style {
    display: flex;
    align-items: center;
    height: 100px;
    justify-content: space-around;
}

nav {
    background-color: #D3D3D3;
}

#form {
    display: flex;
    flex-flow: column wrap;
}

.login_register {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}

#title {
    font-size: 60px;
    margin-top: 100px;
}

.link {
  text-decoration: none;
  padding: 5px;
}
</style>

</html>

