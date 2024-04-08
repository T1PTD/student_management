<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}

?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Course
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
        <a class="btn btn-primary btn-lg" href="index.php?c=course&m=add">Add new course</a>
        <div class="row mt-3">
            
        </div>
        </div>
        <table class="table table-bordered table-striped my-3">
            <thead class="table-primary">
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Status</th>
                <th colspan="2" class="text-center" width="10%">Action</th>
            </thead>
            <tbody>
                <?php foreach($courses as $course): ?>
                    <tr>
                        <td><?php echo $course['id']; ?></td>
                        <td><?php echo $course['course_name']; ?></td>
                        <td><?php echo $course['department_name']; ?></td>
                        <td><?php echo $course['status'] == 1 ? 'Active' : 'Deactive'; ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="index.php?c=course&m=edit&id=<?php echo $course['id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="index.php?c=course&m=delete&id=<?php echo $course['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php if ($totalPages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-start">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?c=course&m=index&page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="index.php?c=course&m=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?c=course&m=index&page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
            </ul>
        </nav>
    </div>
</div>



<?php require 'view/partials/footer_view.php'; ?>

