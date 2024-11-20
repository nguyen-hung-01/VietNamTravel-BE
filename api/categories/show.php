<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/categories.php';

// Tạo đối tượng Database và kết nối
$db = new Database();
$connect = $db->connect();

// Tạo đối tượng Categories và truyền kết nối
$categories = new Categories($connect);

$categories->category_id = isset($_GET['id']) ? $_GET['id'] : die();

$categories->show();

$categories_item = array(
    "category_id" => $categories->category_id,
    "name" => $categories->category_name
);

print_r(json_encode($categories_item));

?>