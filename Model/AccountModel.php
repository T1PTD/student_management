<?php
require "database/database.php";
function getAllAccount()
{
    global $db;


    $sql = "SELECT a.acc_id as account_id, u.full_name as fullname, a.username, r.name , a.password
    FROM users AS u 
    INNER JOIN  accounts AS a ON a.user_id = u.id 
    INNER JOIN roles AS r ON r.id = a.role_id";
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
