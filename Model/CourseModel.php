<?php
   

    function getAllDataCourses() 
    {
        $sql = "SELECT c.*, d.name FROM `course` AS c INNER JOIN `department` AS d ON d.id = c.department_id WHERE c.`deleted_at` IS NULL";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if ($stmt) {
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;

    }

        function getAllDataCoursesPagination($start, $limit) 
    {
        $sql = "SELECT c.*, d.name AS department_name 
                FROM `course` AS c 
                INNER JOIN `department` AS d ON d.id = c.department_id 
                WHERE c.`deleted_at` IS NULL 
                LIMIT :start, :limit";
    
        $db = connectionDb();
        $statement = $db->prepare($sql);
        $statement->bindParam(':start', $start, PDO::PARAM_INT);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $data = [];
    
        if ($statement && $statement->execute()) {
            if ($statement->rowCount() > 0) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        
        disconnectDb($db);
        return $data;
    }
    
    function countAllCourses() 
    {
        $sql = "SELECT COUNT(*) AS total FROM `course` WHERE `deleted_at` IS NULL";
    
        $db = connectionDb();
        $statement = $db->prepare($sql);
        $total = 0;
    
        if ($statement && $statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $total = $result['total'];
        }
    
        disconnectDb($db);
        return $total;
    }
    

 function insertCourse($name,$slug, $department_id, $status,$created_at) {

            $sqlInsert = "INSERT INTO `course` (`course_name`, `slug`,`department_id`, `status`, `created_at`) 
            VALUES (:nameCourse, :slug, :department_id, :statusCourse, :created_at)";
            $checkInsert = false;
            $db = connectionDb();
            $statement = $db->prepare($sqlInsert);
            $created_at = date('Y-m-d H:i:s');
            if ($statement) {
                $statement->bindParam(':nameCourse' , $name , PDO ::PARAM_STR);
                $statement->bindParam(':slug' , $slug , PDO ::PARAM_STR);
                $statement->bindParam(':department_id' , $department_id , PDO ::PARAM_STR);
                $statement->bindParam(':statusCourse' , $status , PDO ::PARAM_INT);
                $statement->bindParam(':created_at', $created_at, PDO::PARAM_STR);

                if (  $statement->execute()) {
                    $checkInsert = true;
                }
            }
            
            disconnectDb($db);
            return  $checkInsert;
        }
        
    
function getDetailCourseById($id =0)
{
    $sql = "SELECT c.*, d.name FROM `course` AS c INNER JOIN `department` AS d ON d.id = c.department_id WHERE c.`id` = :id AND c.`deleted_at` IS NULL";
 $db = connectionDb();
 $data = [];
 $statement = $db->prepare($sql);
 if($statement )
 {
    $statement ->bindParam(':id',$id,PDO::PARAM_INT);
    if($statement ->execute())
    {
        if($statement ->rowCount() > 0)
        {
            $data = $statement ->fetch(PDO::FETCH_ASSOC);
        }
    }
    
 }
 disconnectDb($db);
 return $data;
}

function deleteCourseById($id = 0)
{
    $sql = "UPDATE `course` SET `deleted_at` = :deleted_at WHERE `course_id` = :id";
    $db = connectionDb();
    $checkDelete = false;
    $deleteTime = date("Y-m-d H:i:s");
    $statement = $db->prepare($sql);
    if ( $statement) {
        $statement->bindParam(':deleted_at', $deleteTime, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        if ( $statement->execute()) {
            $checkDelete = true;
        }
    }
    disconnectDb($db);
    return $checkDelete;
}
    
function updateCourseById($name, $slug, $department_id, $status, $id)
{
    $checkUpdate = false;
    $db = connectionDb();
    $updated_at = date('Y-m-d H:i:s');
    $sqlUpdate = "UPDATE `course` SET `course_name`= :nameCourse,`slug`=:slug,`department_id`=:department_id,`status`=:statusCourse,`updated_at`= :updated_at
     WHERE `id`=:id AND `deleted_at` IS NULL";
    $statement = $db->prepare($sqlUpdate);
    if ($statement) {
        $statement->bindParam(':nameCourse', $name, PDO::PARAM_STR);
        $statement->bindParam(':slug', $slug, PDO::PARAM_STR);
        $statement->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $statement->bindParam(':statusCourse', $status, PDO::PARAM_INT);
        $statement->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $checkUpdate = true;
        }
    }
    disconnectDb($db);
    return $checkUpdate;
}


