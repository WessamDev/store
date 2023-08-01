<?php
//fixing header problem
ob_start();
//start the session
session_start();
$pagetitle = "Vendors-code";
$nonav = '';
//includes Configration file
include 'init.php';

if (!isset($_SESSION['username'])) {

    header("Location:login.php");
}
// check if end user comes from login page form using post method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if the usr clicked on the login form submit button(login)
    if (isset($_POST['login'])) {
        // identify login form variables
        $user = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        $hashedpass = sha1($pass);

        $login_error = array();

        if (empty($user)) {$login_error[] = 'User Name Is Empty Please Fill IT ';}

        if (empty($pass)) {$login_error[] = 'Password Is Empty Please Fill IT ';}

        if (empty($login_error)) {
            // Select username &  userpass From Database if the user already exists in database
            $sql = "SELECT userid, fullname, username, pass FROM users WHERE username=? AND pass=?";
            $user_stmt = $con->prepare($sql);
            $user_stmt->execute(array($user, $hashedpass));
            $userinfo = $user_stmt->fetch();
            $count = $user_stmt->rowCount();
            // identify variables {
            $userid = $userinfo['userid'];
            $fullname = $userinfo['fullname'];
            $groupid = $userinfo['groupid'];
            // Check If count exist then put the session in page
            if ($count > 0) {
                // registed session user information
                $_SESSION['username'] = $user;
                $_SESSION['userid'] = $userid;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['groupid'] = $groupid;

                header('location: profile.php');
                $_SESSION['MSG'] = 'lOGIN iN Sucessed, Welcome' . $_SESSION['username'];
            } else {
                header('location: index.php');
            }
        }
    }

    if (isset($_POST['signup_btn'])) {

        // Global Variables For Signup Form
        $fullname = htmlspecialchars($_POST['fullname']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $repassword = htmlspecialchars($_POST['repassword']);

        // uploaded files image file avatar image
        $avatar_name = $_FILES['avatar']['name']; // name of the uploaded file
        $avatar_tmp = $_FILES['avatar']['tmp_name']; // path to the uploaded file localhost
        $avatar_size = $_FILES['avatar']['size']; //size of the uploaded file
        $avatar_type = $_FILES['avatar']['type']; // type of the uploaded file
        //variable for the uploaded file
        $avatar = time() . '_' . $avatar_name;
        //really path to the uploaded file
        $path = 'admin\uploads\img\\' . $avatar;

        //Avatar Exetension Allowed
        $allowed_ext = array('png', 'jpg', 'jpeg', 'gif', 'icon');
        //exploded string
        $exploded = explode('.', $avatar_name);
        //chosse extenstioon ('png', 'jpg', 'jpeg', 'gif', 'icon') from array and make sure it is lower case
        $avatar_ext = strtolower(end($exploded));

        // Identifie Errors Array
        $sign_error = array();
        // this functions check duplicated insert from form (fullname / username / email)
        $check_fullname = isExist('fullname', 'users', $fullname); //for fullnmae
        $check_username = isExist('username', 'users', $username); //for username
        $check_email = isExist('email', 'users', $email); //foremail

        if ($check_fullname == 1) {$sign_error[] = "Full Name Already Exist In Website";}

        if ($check_username == 1) {$sign_error[] = "User Name Already Exist In Website";}

        if ($check_email == 1) {$sign_error[] = "This Email Already Exist In Website";}

        if (empty($fullname)) {$sign_error[] = "Full Name Is Empty Please Fill It.";}
        if (strlen($fullname) < 4) {$sign_error[] = "Full Name Must 8 Character";}
        if (empty($email)) {$sign_error[] = "Email Is Empty Please Fill It, And Must Invalid Email Like Example@Email.io";}
        if (empty($username)) {$sign_error[] = " user Name Is Empty Please Fill It.";}
        if (strlen($username) < 4) {$sign_error[] = "User Name Must 8 Character";}
        if (empty($password)) {$sign_error[] = " Password Is Empty Please Fill It.";}
        if (empty($repassword)) {$sign_error[] = " Confirm Password Is Empty Please Fill It.";}
        if (strlen($password) < 3) {$sign_error[] = "Password Must More Than 3 Character";}
        if (strlen($repassword) < 3) {$sign_error[] = "Confirm Password Must More Than 3 Character";}
        if ($password !== $repassword) {$sign_error[] = "Password Dosen't Matched";} else { $hash_pass = sha1($password);}
        // check if is error in uploaded file
        if (!empty($avatar_name) && !in_array($avatar_ext, $allowed_ext)) {$sign_error[] = "This Extenstion Is Not Allowed";}
        if (empty($avatar_name)) {$sign_error[] = "Image Can't Be Empty";}
        if ($avatar_size > 2000000) {$sign_error[] = "Image Can't Be Larger Than 4 Mega Byte";}

        if (empty($sign_error)) {

            // upload the file function will
            move_uploaded_file($avatar_tmp, $path);
            // insert data to database table users
            $sql = "INSERT INTO users (fullname, email, username, pass, groupid, create_at, avatar ) VALUES (:full,:email,:name,:pass,0,NOW(), :avatar)";
            $sign_stmt = $con->prepare($sql);
            $sign_stmt->execute(array('full' => $fullname, 'email' => $email, 'name' => $username, 'pass' => $hash_pass, 'avatar' => $avatar));

            if ($sign_stmt) {
                $sign_success = " User Add Success";
                header('location:index.php');
            } else {
                echo 'Something Wrong ! Please Try Again.. <a href="signup.php"> Signup Again </a>';
            }

        }
    }

} else {
    $_SESSION['MSG'] = "You Can't Browse This Page Directely";
}
