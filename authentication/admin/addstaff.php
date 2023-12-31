<?php

    require_once '../classes/staff.class.php';
    require_once '../tools/functions.php';

    if(isset($_POST['save'])){
        $staff = new Staff();
        //sanitize
        $staff->firstname = htmlentities($_POST['firstname']);
        $staff->lastname = htmlentities($_POST['lastname']);
        $staff->role = htmlentities($_POST['role']);
        $staff->email = htmlentities($_POST['email']);
        $staff->password = htmlentities($_POST['password']);
        if(isset($_POST['status'])){
            $staff->status = htmlentities($_POST['status']);
        }else{
            $staff->status = '';
        }

        //validate inputs of the users
        if (validate_field($staff->firstname) && 
        validate_field($staff->lastname) &&
        validate_field($staff->role) &&
        validate_field($staff->email) &&
        validate_field($staff->password) && validate_password($staff->password) &&
        validate_field($staff->status)){
            //proceed with saving
            if($staff->add()){
                //header('location: staff2.php');
                $message = 'Staff is successfuly saved';
            }else{
                echo 'Something went wrong saving staff.';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Staff';
    $staff_page = 'active';
    require_once('../include/head.php');
?>
<body>
    <?php
        require_once('../include/header.admin.php')
    ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <?php
                    require_once('../include/sidepanel.php')
                ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <?php
                        if(isset($_POST['save']) && isset($message)){
                    ?>
                            <div class="alert alert-success mt-3 col-12 col-md-12 col-lg-6" role="alert">
                                <?= $message ?>
                            </div>
                    <?php
                        }
                    ?>
                    <div class="d-flex col-12 col-md-12 col-lg-6 justify-content-between align-items-center">
                        <h2 class="h3 brand-color pt-3 pb-2">Add Staff</h2>
                        <a href="staff2.php" class="text-primary">Back to Staff</a>
                    </div>
                    <div class="container mx-0 p-0 col-12 col-md-12 col-lg-6">
                        <form method="post" action="">
                            <div class="mb-2">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; }?>">
                                <?php
                                    if(isset($_POST['firstname']) && !validate_field($_POST['firstname'])){
                                ?>
                                    <p class="text-danger my-1">First name is required</p>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="mb-2">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; }?>">
                                <?php
                                    if(isset($_POST['lastname']) && !validate_field($_POST['lastname'])){
                                ?>
                                    <p class="text-danger my-1">Last name is required</p>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group mb-2">
                                <label for="staff-role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="Manager" <?php if(isset($_POST['role']) == 'Manager') { echo 'selected'; } ?>>Manager</option>
                                    <option value="Staff" <?php if(isset($_POST['role']) == 'Staff') { echo 'selected'; } ?>>Staff</option>
                                    <option value="Cashier <?php if(isset($_POST['role']) == 'Cashier') { echo 'selected'; } ?>">Cashier</option>
                                </select>
                                <?php
                                    if(isset($_POST['role']) && !validate_field($_POST['role'])){
                                ?>
                                    <p class="text-danger my-1">Select staff role</p>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required value="<?php if(isset($_POST['email'])) { echo $_POST['email']; }?>">
                                <?php
                                    if(isset($_POST['email']) && !validate_field($_POST['email'])){
                                ?>
                                    <p class="text-danger my-1">Email is required</p>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required value="<?php if(isset($_POST['password'])) { echo $_POST['password']; }?>">
                                <?php
                                    if(isset($_POST['password']) && strcmp(validate_password($_POST['password']), 'success') != 0){
                                ?>
                                    <p class="text-danger my-1"><?php echo validate_password($_POST['password']) ?></p>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Status</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="statusActive" name="status" value="Active" <?php if(isset($_POST['status']) && $_POST['status'] == 'Active') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="statusActive">Active</label>
                                    </div>
                                    <div class="form-check ms-3">
                                        <input type="radio" class="form-check-input" id="statusDeactivated" name="status" value="Deactivated" <?php if(isset($_POST['status']) && $_POST['status'] == 'Deactivated') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="statusDeactivated">Deactivated</label>
                                    </div>
                                </div>
                                <?php
                                    if((isset($_POST['save']) && !isset($_POST['status'])) || isset($_POST['status']) && !validate_field($_POST['status'])){
                                ?>
                                    <p class="text-danger my-1">Select staff status</p>
                                <?php
                                    }
                                ?>
                            </div>
                            <button type="submit" name="save" class="btn btn-primary mt-2 brand-bg-color" id="addStaffButton">Save Staff</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </main>
    <?php
        require_once('../include/js.php')
    ?>
</body>
</html>