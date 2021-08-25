<?php
require_once('config.php');
if (isset($_POST['prenom_registerTchat'], $_POST['nom_registerTchat'], $_POST['email_registerTchat'], $_POST['password_registerTchat'], $_POST['image_registerTchat'])) {
    if (!empty($_POST['prenom_registerTchat']) && !empty($_POST['nom_registerTchat']) && !empty($_POST['email_registerTchat']) && !empty($_POST['password_registerTchat']) && !empty($_POST['image_registerTchat'])) {
        $nom_registerTchat = htmlspecialchars($_POST['nom_registerTchat']);
        $prenom_registerTchat = htmlspecialchars($_POST['prenom_registerTchat']);
        $email_registerTchat = htmlspecialchars($_POST['email_registerTchat']);
        $password_registerTchat = sha1($_POST['password_registerTchat']);
        $image_registerTchat = htmlspecialchars($_POST['image_registerTchat']);
        if (filter_var($email_registerTchat, FILTER_VALIDATE_EMAIL)) {
            $erreur = 'Email invalide !';
        }
        $reqemail = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $reqemail->execute(array($email_registerTchat));
        $email_exist = $reqemail->rowCount();
        if ($email_exist == 0) {
            $insert_membre = $bdd->prepare('INSERT INTO user(firstname, lastname, email, password, image) VALUES(?, ?, ?, ?, ?)');
            $insert_membre->execute(array($nom_registerTchat, $prenom_registerTchat, $email_registerTchat, $password_registerTchat, $image_registerTchat));
            header('Location: index.php');
            }else {
                $erreur = 'Email déjà utilisé';
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
    <title>Register</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto"
                    src="https://www.instic.fr/wp-content/uploads/2015/01/logo-accueil2.png" alt="logo insti">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer un compte
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="" method="POST">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <input id="prenom_registerTchat" name="prenom_registerTchat" type="text"
                            autocomplete="prenom_registerTchat" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Prenom">
                    </div>
                    <div>
                        <input id="nom_registerTchat" name="nom_registerTchat" type="text"
                            autocomplete="nom_registerTchat" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Nom">
                    </div>
                    <div>
                        <input id="email_registerTchat" name="email_registerTchat" type="email"
                            autocomplete="email_registerTchat" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Email">
                    </div>
                    <div>
                        <input id="password_registerTchat" name="password_registerTchat" type="password"
                            autocomplete="password_registerTchat" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Password">
                    </div>
                    <div>
                        <input id="image_registerTchat" name="image_registerTchat" type="text"
                            autocomplete="image_registerTchat" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Image">
                    </div>
                </div>

                <div>
                    <input type="submit"
                        class="float-right group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                </div>
                <?php if(isset($erreur)){ ?>
                <p style="color: red;"><?= $erreur ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
</body>

</html>