<?php
$login  = $_POST['u_mail'];
$mdp    = $_POST['u_password'];
/**
 * validation coté server
 *
 * operateurs logique:
 * et = and -> &&
 * ou = or -> ||
 * vide = empty -> verifier si la valeur est vide
 */
if (empty($login) || empty($mdp)){
    header('Location:  index.php');
}
/**
 * connexion à la base de données
 */
$pdo = new PDO ('mysql:host=localhost;dbname=chez_moreno;charset=utf8', 'root', '' );
/**
 * requete
 */

/**
 * crypte un mot de passe
 */
$mdp =  md5($mdp);

$query = $pdo->query("SELECT * FROM user WHERE u_mail='".$login."' and u_password='".$mdp."'");
$response = $query->fetch();
/**
 * verifier la reponse de notre requete
 */
if (isset($response['u_mail']) && isset($response['u_password'])) {
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['mdp'] = $mdp;


    header('Location:  profil.php');

}else{
    header('Location:  index.php?error');
}


