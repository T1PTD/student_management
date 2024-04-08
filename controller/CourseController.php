<?php

$m = trim($_GET['m'] ?? 'index'); 
$m = strtolower($m);
require 'Model/DepartmentModel.php';
require 'Model/CourseModel.php';
switch($m){
    case 'index':
        index();
        break;
    case 'add':
        Add();
        break;
    case 'handle-add':
        handleAdd();
        break;
    case 'edit':
        edit();
        break;
    case 'handle-edit':
        handleEdit();
        break;
    case 'delete':
        handleDelete();
        break;
    default:
        index();
        break;
}
function handleAdd()
{
    if (isset($_POST['btnSave'])) {
        $name = $_POST['name'];
        $department_id = $_POST['department_id'];
        $status = $_POST['status'];
        if (empty($name)) {
            $_SESSION['error_add_department']['name'] = 'Enter name of department,please';
        } else {
            $_SESSION['error_add_department']['name'] = null;
        }
        $created_at = trim($_POST['date_beginning'] ?? null);
        $created_at = date('Y-m-d', strtotime($created_at));
        $slug = slug_string($name);
        $insert = insertCourse($name, $slug, $department_id, $status, $created_at);
        if ($insert) {
            header("location:index.php?c=course&state=success");
        } else {
            header("location:index.php?c=courses&m=add&state=error");
        }
    }


   
}
function edit()
{
    if (!isLoginUser()) {
        header("location:index.php");
        exit();
    }
    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0;
    $info = getDetailCourseById($id);
    $department = getAllDataDepartments();
    if (!empty($info)) {
        require 'view/course/edit_view.php';
    } else {
        require 'view/error_view.php';
    }
}
function handleEdit()
{
    if (isset($_POST['btnUpdate'])) {
        // Lấy dữ liệu từ form POST
        $name = $_POST['name'];
        $department_id = $_POST['department_id'];
        $status = $_POST['status'];
        $id = $_GET['id'];

        // Kiểm tra xem dữ liệu có hợp lệ không
        if (empty($name)) {
            $_SESSION['error_update_course']['name'] = 'Enter the name of the course, please';
            header("Location: index.php?c=course&m=edit&id=$id");
            exit();
        } else {
            $_SESSION['error_update_course']['name'] = null;
        }

        // Cập nhật dữ liệu trong cơ sở dữ liệu
        $updated_at = date('Y-m-d H:i:s');
        $slug = slug_string($name);
        $update = updateCourseById($name, $slug, $department_id, $status, $id);

        if ($update) {
            header("location:index.php?c=course&state=success");
        } else {
            header("location:index.php?c=course&m=edit&id=$id&state=error");
        }
    }
}


function handleDelete()
{
    if (!isLoginUser()) {
        header("location:index.php");
        exit();
    }
    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0;
    $delete = deleteCourseById($id);
    if ($delete) {
        //xoa thanh cong
        header("location:index.php?c=course&state_del=success");
    } else {
        //xoa that bai
        header("location:index.php?c=course&state_del=failure");
    }
}

function Add()
{
   
    $department =getAllDataDepartments();
    require 'view/course/add_view.php';

    
}

require 'Model/CourseModel.php';
function index()
{
    if (!isLoginUser()){
        header("location:index.php");
        exit();
    }

    // Số trang hiện tại
    $page = $_GET['page'] ?? 1;
    $limit = 10; // Số hàng trên mỗi trang

    // Tính vị trí bắt đầu của dữ liệu
    $start = ($page - 1) * $limit;

    // Lấy dữ liệu cho trang hiện tại
    $courses = getAllDataCoursesPagination($start, $limit);

    // Tính tổng số dữ liệu
    $totalCourses = countAllCourses();

    // Tính tổng số trang dựa trên tổng số dữ liệu và giới hạn hàng trên mỗi trang
    $totalPages = ceil($totalCourses / $limit);

    // Nếu không có dữ liệu
    if (empty($courses)) {
        // Chuyển hướng người dùng đến trang đầu tiên có dữ liệu
        header("Location: index.php?c=course&m=index&page=1");
        exit();
    }

    // Hiển thị các liên kết phân trang chỉ cho các trang có dữ liệu
    require 'view/course/index_view.php';
}









