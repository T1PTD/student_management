<?php
require "database/database.php";


function updateDepartmentById($name,$slug,$leader,$status,$date_beginning,$logo,$id)
{
    $checkUpdate = false ;
    $db = connectionDb();
    $sql = "UPDATE `department` SET `name` = :nameDepartment , `slug` = :slug , `leader` =:leader , `date_beginning` = :date_beginning , 
    `status` =:statusDepartment , `logo` =:logo , `updated_at` =:updated_at 
    WHERE `id` =:id AND `deleted_at` IS NULL "; 
    $updatetime =date('Y-m-d H:i:s');
    $stmt = $db->prepare($sql);
    if($stmt)
    {
        $stmt->bindParam(':nameDepartment' , $name , PDO ::PARAM_STR);
        $stmt->bindParam(':slug' , $slug , PDO ::PARAM_STR);
        $stmt->bindParam(':leader' , $leader , PDO ::PARAM_STR);
        $stmt->bindParam(':date_beginning' , $date_beginning , PDO ::PARAM_STR);
        $stmt->bindParam(':statusDepartment' , $status , PDO ::PARAM_INT);
        $stmt->bindParam(':logo' , $logo , PDO ::PARAM_STR);
        $stmt->bindParam(':updated_at' , $updatetime , PDO ::PARAM_STR);
        $stmt->bindParam(':id' , $id , PDO ::PARAM_STR);   
        if($stmt->execute())
        {
            $checkUpdate = true;
        }
        disconnectDb($db);
        return $checkUpdate;
    }
    return $checkUpdate;

}

function getDetailDepartmenById($id =0)
{
 $sql = "SELECT * FROM  `department` WHERE `id` = :id AND `deleted_at` IS NULL";
 $db = connectionDb();
 $data = [];
 $stmt = $db->prepare($sql);
 if($stmt)
 {
    $stmt->bindParam('id',$id,PDO::PARAM_INT);
    if($stmt->execute())
    {
        if($stmt->rowCount() > 0)
        {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    
 }
 disconnectDb($db);
 return $data;
}
function deleteDepartmentById($id =0)
{
 $sql = "UPDATE `department` SET `deleted_at` =:deleted_at WHERE `id` = :id";
 $db = connectionDb();
 $checkDelete = false ;
 $deleteTime = date("Y-m-d H:i:s");
 $stmt = $db->prepare($sql);
 if($stmt)
 {
    $stmt->bindParam(':deleted_at' , $deleteTime , PDO:: PARAM_STR);
    $stmt->bindParam(':id' , $id , PDO:: PARAM_INT);
    if($stmt->execute())
    {
        $checkDelete = true;

    }

 }
 disconnectDb($db);
 return $checkDelete;
}
function getAllDataDepartments($keyword = null )
{
    $db = connectionDb();
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `department` WHERE (`name` LIKE :nameDepartment OR `leader` LIKE :leader) AND  `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $data = [];
    if ($stmt) {
        $stmt->bindParam(':nameDepartment', $key, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $key, PDO::PARAM_STR);
        if ($stmt->execute()) {
            if ( $data = $stmt->rowCount() > 0 )
            {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}

function getAllDataDepartmentsByPage($keyword = null, $start = 0, $limit = 2)
{
    $start = max(0, $start); // Đảm bảo $start không âm
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `department` WHERE (`name` LIKE :nameDepartment OR `leader` LIKE :leader) AND `deleted_at` IS NULL LIMIT :startData, :limitData";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if ($stmt) {
        $stmt->bindParam(':nameDepartment', $key, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $key, PDO::PARAM_STR);
        $stmt->bindParam(':startData', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limitData', $limit, PDO::PARAM_INT);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}
function insertDepartment($name, $slug, $leader, $status,$logo ,$beginningDate)
{
$sqlInsert = "INSERT INTO `department` (`name`, `slug`, `leader`, `date_beginning`, `status`, `logo`, `created_at`) 
    VALUES (:nameDepartment, :slug, :leader, :datebeginning, :statusDepartment, :logo, :created_at)";
    
    $checkInsert = false;
    $db = connectionDb();
    $statement = $db->prepare($sqlInsert);
    $currentDate = date('Y-m-d H:i:s');
    
    if ($statement) {
        $statement->bindParam(':nameDepartment', $name, PDO::PARAM_STR);
        $statement->bindParam(':slug', $slug, PDO::PARAM_STR);
        $statement->bindParam(':leader', $leader, PDO::PARAM_STR);
        $statement->bindParam(':datebeginning', $beginningDate, PDO::PARAM_STR);
        $statement->bindParam(':statusDepartment', $status, PDO::PARAM_INT);
        $statement->bindParam(':logo', $logo, PDO::PARAM_STR);
        $statement->bindParam(':created_at', $currentDate, PDO::PARAM_STR);

        if ($statement->execute()) {
            $checkInsert = true;
        }
    }
    
    disconnectDb($db);
    return $checkInsert;
}
