<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Create Department";
$errorAdd  = $_SESSION['error_add_department'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Create Department
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
        <a class="btn btn-primary" href="index.php?c=department&m=index"> List Departments</a>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white"> Add New Department</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=user&m=handle-add">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Extra Code</label>
                                <input class="form-control" type="text" name="extraCode" />

                            </div>
                            <div class="form-group mb-3">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="fname" />

                            </div>
                            <div class="form-group mb-3">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lname" />

                            </div>
                            <div class="form-group mb-3">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="fullName" />

                            </div>
                            <div class="form-group mb-3">
                                <label>Role</label>
                                <select name="role" id="" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">Student</option>
                                    <option value="3">Teacher</option>
                                </select>

                            </div>
                            <div class="form-group mb-3">
                                <label>Gender</label>
                                <select name="gender" id="" class="form-control">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">None</option>
                                </select>

                            </div>

                            <div class="form-group mb-3">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" />

                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" />

                            </div>
                            <div class="form-group mb-3">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="phone" />

                            </div>
                            <div class="form-group mb-3">
                                <label> Avatar </label>
                                <input type="file" class="form-control" name="avt" />
                                <?php if (!empty($errorAdd['logo'])) : ?>
                                    <span class="text-danger"><?= $errorAdd['logo']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1"> Active</option>
                                    <option value="0"> Deactive</option>
                                </select>
                            </div><?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Create User";
$errorAdd = $_SESSION['error_add_user'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Create User
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
        <a class="btn btn-primary btn-lg" href="index.php?c=user">List Users</a>
        <div class="card card-primary mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white">Add New Users</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=user&m=handle-add">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Extra Code</label>
                                <input type="text" name="extra_code" id="" class="form-control">
                                <?php if(!empty($errorAdd['extra_code'])): ?>
                                <span class="text-danger"><?= $errorAdd['extra_code']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                    <option value="23">-- Choose --</option>
                                    <?php foreach($role as $item): ?>
                                    <option value="<?=$item['id']?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="full_name" id="" class="form-control">
                                <?php if(!empty($errorAdd['full_name'])): ?>
                                <span class="text-danger"><?= $errorAdd['full_name']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" id="" class="form-control">
                                <?php if(!empty($errorAdd['email'])): ?>
                                <span class="text-danger"><?= $errorAdd['email']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Avatar</label>
                                <input type="file" name="avatar" class="form-control" id="">
                                <?php if(!empty($errorAdd['avatar'])): ?>
                                <span class="text-danger"><?= $errorAdd['avatar']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1"> Active</option>
                                    <option value="0"> Deactive</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 begin form-margin  ">
                                <label>Birthday</label>
                                <input type="date" class="form-control" id="" name="birthday">
                            </div>
                            <div class="form-group mb-3">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="1"> Male</option>
                                    <option value="0"> Female</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" pattern="[0-9]*">
                                <?php if (!empty($errorAdd['phone'])): ?>
                                <span class="text-danger"><?= $errorAdd['phone']; ?></span>
                                <?php endif; ?>

                            </div>
                            <div class="form-group mb-3">
                                <label for="">Address</label>
                                <input type="text" name="address" id="" class="form-control">
                                <?php if(!empty($errorAdd['address'])): ?>
                                <span class="text-danger"><?= $errorAdd['address']; ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="btn btn-primary btn-lg btnA" type="submit" name="btnSave">Save</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>
                            <div class="form-group mb-3">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="birthday" />
                            </div>
                            <button class="btn btn-primary" type="submit" name="btnAdd">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>