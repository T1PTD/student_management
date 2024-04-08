<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Courses";
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>  Account
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <a href="index.php?c=courses&m=add" class="btn btn-primary btn-lg">List Account</a>
        <!-- <div class="row mt-3">
            <div class="col-sm-12 col-md-6">
                <input type="text" id="keyword" value="<?= htmlentities($keyword); ?>">
                <button class="btn btn-primary btn-sm" id="btnSearchDepartment">Search</button>
                <a href="index.php?c=department" class="btn btn-info btn-sm">Back to lists</a>
            </div>
        </div> -->
        <table class="table table-bordered table-striped my-3">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>FullName</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th colspan="2" class="text-center" width="10%">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $key => $item) : ?>
                    <tr>
                        <td><?= $item['account_id']; ?></td>
                        <td><?= $item['fullname']; ?></td>

                        <td><?= $item['name']; ?></td>

                        <td><?= $item['username']  ?></td>
                        <td><?= $item['password']  ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="index.php?c=course&m=edit&id=<?= $item['account_id']; ?>">
                                Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="index.php?c=course&m=delete&id=<?= $item['account_id']; ?>">
                                Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>