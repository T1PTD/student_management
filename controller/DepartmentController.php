<?php
require 'Model/DepartmentModel.php';
//m = ten cua ham nam trong thu muc controller
$m = trim($_GET['m'] ?? 'index'); //ham mac dinh trong controller la index
$m = strtolower($m); //viet thuong tat ca ten ham
switch($m){
    case 'index':
        index();
        break;
        case 'add' :
        Add();
        break;
        case'handle-add':
        handleAdd();
        break;
        case 'delete':
        handleDelete();
        break;
        case 'edit';
        edit();
        break;
        case 'handle-edit';
        handleEdit ();
        break;
        default:

        index();
        break;    
}
function handleEdit()
{
    if(isset($_POST['btnSave']));
    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0;
    $infor = getDetailDepartmenById($id);
    $name =trim($_POST['name'] ?? null );
    $name = strip_tags ($name);
    $leader =trim($_POST['leader'] ?? null );
    $leader = strip_tags ($leader);
    $status =trim($_POST['status'] ?? null );
    $status = $status === '0' || $status === '1' ? $status : 0;
    $beginningDate =trim($_POST['date_beginning'] ?? null );
    $beginningDate = date('Y-m-d',strtotime($beginningDate));
    $_SESSION ['error_update_department'] =[];
       if (empty($name))
       {
        $_SESSION['error_update_department'] ['name'] ='Enter name of department ,please ' ;
       } else
       {
        $_SESSION ['error_update_department'] ['name'] = null ;
       }
       if (empty($leader))
       {
        $_SESSION['error_update_department'] ['leader'] ='Enter name of leader ,please ' ;
       } else
       {
        $_SESSION ['error_update_department'] ['$leader'] = null ;       
       }
       $logo = $infor['logo'] ?? null;
       if (!empty($_FILES['logo']['tmp_name'])) {
           $logo = uploadFile($_FILES['logo'], 'public/uploads/image/', ['image/png', 'image/jpg', 'image/jpeg'], 5 * 1024 * 1024);
           if (empty($logo)) {
               $_SESSION['error_update_department']['logo'] = 'File only accepts extensions .png, .jpg, .jpeg and file size <= 5Mb';
           } else {
               $_SESSION['error_update_department']['logo'] = null;
           }
       }
       $flagCheckingError = false;
       foreach($_SESSION['error_update_department'] as $error){
           if(!empty($error)){
               $flagCheckingError=true;
               break;
           }
       }
      if(!$flagCheckingError )
      {
        if(isset($_SESSION['error_update_department']))
        {
            unset($_SESSION['error_update_department']);

        }
        $slug = slug_string($name);
        $update = updateDepartmentById($name,$slug,$leader,$status,$beginningDate,$logo,$id);
        if($update)
        {
            header("Location:index.php?c=Department&state=success");
        }
        else
        {
            header("Location:index.php?c=Department&m=edit&id={$id}&state=error");

        }
      }
      else
      {
header("Location:index.php?c=Department&m=edit&id={$id}&state=failure");

      }   
}
function edit()
{
    if (!isLoginUser()){
        header("location:index.php");
        exit();
    }
    $id = trim($_GET['id'] ?? null );
    $id = is_numeric($id) ? $id : 0;
   $infor = getDetailDepartmenById($id);
   if(!empty($infor))
   {
    require 'view/department/edit_view.php'; 
   }
   else
   {
    require 'view/error_view.php';
   }
}
function handleDelete()
{
    if (!isLoginUser()){
        header("location:index.php");
        exit();
    }

    $id = trim($_GET['id'] ?? null );
    $id = is_numeric($id) ? $id : 0;
    $delete = deleteDepartmentById($id);
    if($delete)
    {
        header("Location:index.php?c=Department&state_del=success");
    }
    else
    {
        header("Location:index.php?c=Department&state_del=fail");
    }

}
function handleAdd()
{
    if(isset($_POST['BtnSave']))
    {
       $name =trim($_POST['name'] ?? null );
       $name = strip_tags ($name);
       $leader =trim($_POST['leader'] ?? null );
       $leader = strip_tags ($leader);
       $status =trim($_POST['status'] ?? null );
       $status = $status === '0' || $status === '1' ? $status : 0;
       $beginningDate =trim($_POST['date_beginning'] ?? null );
       $beginningDate = date('Y-m-d',strtotime($beginningDate));
       $_SESSION ['error_add_department'] =[];
       if (empty($name))
       {
        $_SESSION['error_add_department'] ['name'] ='Enter name of department ,please ' ;
       } else
       {
        $_SESSION ['error_add_department'] ['name'] = null ;
       }
       if (empty($leader))
       {
        $_SESSION['error_add_department'] ['leader'] ='Enter name of leader ,please ' ;
       } else
       {
        $_SESSION ['error_add_department'] ['$leader'] = null ;    
       }
       $logo =null;
       $_SESSION['error_add_department']['logo'] = null;
       if (!empty($_FILES['logo']['tmp_name']))
       {
           $logo =uploadFile($_FILES['logo'],'public/uploads/image/',['image/png','image/jpg','image/jpeg'] , 5*1024*1024) ;
           if(empty(($logo)))
           {
            $_SESSION['error_add_department']['logo']='File only accpet extension is .png, .jpg, .jpeg and file <=5Mb ';
           }
           else
           {
            $_SESSION['error_add_department']['logo'] = null;
           }
       }
       $flagCheckingError = false;
       foreach($_SESSION['error_add_department'] as $error){
           if(!empty($error)){
               $flagCheckingError=true;
               break;
           }
       }
       if(!$flagCheckingError)
       {
        $slug = slug_string($name);
        $insert = insertDepartment($name , $slug , $leader ,$status,$logo ,$beginningDate);
        if($insert)
        {
            header(("location:index.php?c=Department&state=success"));
        }
        else
        {
            header("location:index.php?c=Department&m=add&state=error");
        }
}
       else
       {
         header("location:index.php?c=department&m=add&state=fail");
       }
    }
}
function Add()
{
    require 'view/Department/add_view.php';
}

function index(){
    if (!isLoginUser()){
        header("location:index.php");
        exit();
    }
    $keyword = trim($_GET['search'] ?? null);
    $keyword =strip_tags($keyword);
    $page = trim($_GET['page'] ?? null);
    $page = (is_numeric($page) && $page > 0 ) ? $page : 1;
    $LinkPage = createLink([
        'c' => 'department',
        'm' => 'index',
        'page' => '{page}',
        'search' => $keyword
    ]) ;


    $totalItems =  getAllDataDepartments($keyword);
    $totalItems = count($totalItems);
    
    $pagigate = pagigate($LinkPage,$totalItems,$page,$keyword,4);
    $start = $pagigate['start'] ?? 0;
    $department = getAllDataDepartmentsByPage($keyword,$start,4);
    $htmlPage = $pagigate ['pagination'] ?? null ;


   
    require 'view/Department/index_view.php';
}
