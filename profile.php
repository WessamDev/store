<?php
//fixing header problem
ob_start();
//starting the session
session_start();
//Page Tilte Tag
$pagetitle = 'Profile';
include 'init.php';
// Check If the user login redirect to users profile else redirect to index.php
if (!isset($_SESSION['username'])) {
    header('location: index.php');
}
// includes the confgrition file
$users = getById('*', 'users', $_SESSION['userid']);
?>
<div class="container">
    <div class="row-cols-4 justify-content-center align-items-center g-2">
        <div class="col-sm-12">
            <div class="card mt-5">
                <h4 class="card-title text-start text-bg-primary p-3 align-content-center"> <i class="fas fa-user"></i>
                    <?php echo ucfirst($_SESSION['username']); ?> Profile
                    <span class="float-end ">
                        <a class="text-white" href="logout.php"> <i class="fas fa-sign-out-alt "></i> Logout </a>
                    </span>
                </h4>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-md-4">
                            <h3 class=""><?=ucfirst($_SESSION['username']);?> Profile </h3>
                            <img src="admin/uploads/img/<?=$users['avatar'];?>" class="img-fluid" alt="profile pic">
                            <div class="mt-2">
                                <a class="" href="#">
                                    <i class="fab fa-facebook fa-3x"></i>
                                    <i class="fab fa-twitter fa-3x"></i>
                                    <i class="fab fa-instagram fa-3x"></i>
                                    <i class="fab fa-youtube fa-3x"></i>
                                </a>
                                <a href="#"></a>
                                <a href="#"></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <?php

$users = getById('*', 'users', $_SESSION['userid']);

/* $sql = "SELECT * FROM users WHERE userid = ? LIMIT 1";
$stmt = $con->prepare($sql);
$stmt->execute(array($_SESSION['userid']));
$user = $stmt->fetch(); */
?>
                            <form class="form " action="" method="POST" name="editform" id="editform" >
                                <input type="hidden" name="userid" value="<?php echo $users['userid']; ?>" />

                                <div class="input-group mb-3">
                                    <span class="input-group-text" >
                                        <i class="fas fa-user-circle fa-2x"></i>
                                    </span>
                                    <input type="text" class="form-control" value="<?=$users['fullname'];?>">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" >
                                        <i class="fas fa-envelope-open fa-2x"></i>
                                    </span>
                                    <input type="email" class="form-control" value="<?=$users['email'];?>">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" >
                                        <i class="fas fa-user-alt fa-2x"></i>
                                    </span>
                                    <input type="text" class="form-control" value="<?=$users['username'];?>">
                                </div>

                                <input type="hidden" class="form-control" name= "old_pass" value="<?=$users['pass'];?>">

                                <div class="input-group mb-3">
                                    <span class="input-group-text" >
                                        <i class="fas fa-key fa-2x"></i>
                                    </span>
                                    <input
                                            type            ="text"
                                            class           ="form-control"
                                            placeholder     ="New Password If You Want To Change It."
                                            onfocus         ="this.placeholder=''"
                                            onblur          ="this.placeholder='New Password If You Want'"
                                            autocomplete    ="new-password"
                                            name            = "new_pass"
                                    />
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" >
                                        <i class="fas fa-image fa-2x"></i>
                                    </span>
                                    <input
                                            type            ="file"
                                            class           ="form-control"
                                            name            = "avatar"
                                    />
                                </div>

                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <i class="fas fa-user-edit"></i> Update Profile
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include $inc . 'footer.php';
ob_end_flush();
?>