<?php 
include 'conn.php';

session_start();

if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        echo 'Please Enter Username';
    }elseif (empty($password)) {
        echo 'Please Enter Password';
    }else{
        $check = "SELECT id, role FROM accounts WHERE username = '$username' AND password = '$password'";
        $stmt = $conn->prepare($check);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetchALL() as $x) {
                $role = $x['role'];
            }

            if ($role == 'admin') {
                $_SESSION['username'] = $username;
                header('location:page/admin/dashboard.php');
            }elseif($role == 'user'){
                $_SESSION['username'] = $username;
                header('location:page/user/dashboard.php');
            }else{

            }
        }else{
            echo 'Wrong Username or Password';
        }
    }
}

if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('location: ../index.php');
}



?>