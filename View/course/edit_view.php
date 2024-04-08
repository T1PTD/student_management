<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Create New Courses";
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update Course
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
    <a class="btn btn-primary" href="index.php?c=course&m=index"> List Department</a>
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white mb-0">Update Course</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=course&m=handle-edit&id=<?= $info['id']; ?>">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" Name="name" value="<?php echo $info['course_name'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Department</label>
                                <select name="department_id" id="" class="form-control">
    <option value="<?php echo $info['department_id']; ?>"><?php echo $info['name']; ?></option>
    <option value="">---Choose---</option>
    <?php foreach ($department as $item) : ?>
        <option value="<?php echo $item['id'] ?>">
            <?php echo $item['name'] ?>
        </option>
    <?php endforeach; ?>
</select>

                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1"> Active</option>
                                    <option value="0"> Deactive</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" name="btnUpdate" type="submit">Update</button>
                        </div>
                        <div class="col-sm-12 col-md-6">

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>