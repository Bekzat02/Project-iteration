<?php
require "db.php";
$data = $_POST;
if(isset($data['do_login'])){
    $user=R::findOne('users','email=?',array($data['email']));
    if($user){
        if(password_verify($data['password'],$user->password)){
            $_SESSION['logged_user']=$user;
            echo '<div style="color: green;"> You successfully signed, come <a href="index.php">back</a> to main page</div><hr>';
        }
        else{
            $errors[]='Password is incorrect';
        }
    }
    else{
        $errors[]='User with this name has not found';
    }
    if (!empty($errors)) {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}
?>