<?php
$data = $_POST;
if (isset($data['do_signup'])) {
    $errors = array();
    if (trim($data['fname']) == '') {
        $errors[] = 'Enter your first name';
    }
    if (trim($data['lname']) == '') {
        $errors[] = 'Enter your last name';
    }
    if (trim($data['email']) == '') {
        $errors[] = 'Enter your email';
    }
    if ($data['password'] == '') {
        $errors[] = 'Enter your password';
    }
    if ($data['password_2'] != $data['password']) {
        $errors[] = 'Your passwords are not same';
    }

    if (R::count('users', "email=?", array($data['email'] > 0))) {
        echo 'Email already exists';
    }
    if (empty($errors)) {
        $user = R::dispense('users');
        $user->fname = $data['fname'];
        $user->lname = $data['lname'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: green;"> You successfully registered</div><hr>';
    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}
