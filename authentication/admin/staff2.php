<?php
    session_start();

    if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user'] != 'staff')){
        header('location: index.php');
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
                    <h2 class="h3 brand-color pt-3 pb-2">Staff</h2>
                    <a href="addstaff.php" class="btn btn-primary brand-bg-color">Add Staff</a>
                    <div class="table-responsive overflow-hidden">
                    <div class="row g-2 mb-2 m-0">
                    <div id="table-container">
                    <?php
                    require_once '../classes/staff.class.php';
                    require_once '../tools/functions.php';

                    $staff = new Staff();

                    // Fetch staff data (you should modify this to retrieve data from your database)
                    $staffArray = $staff->show();
                    $counter = 1;   
                    ?>
                    <table id="staff" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Staff Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col" width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="staffTableBody">
                    <?php
                        if ($staffArray) {
                            foreach ($staffArray as $item) {
                    ?>
                                <tr>
                                    <td><?= $counter ?></td>
                                    <td><?= $item['firstname'] . ' ' . $item['lastname'] ?></td>
                                    <td><?= $item['role'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><?= $item['status'] ?></td>
                                    <td class="text-center"><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                </tr>
                    <?php
                                $counter++;
                            }
                        }
                    ?>
                        </tbody>
                    </table>


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