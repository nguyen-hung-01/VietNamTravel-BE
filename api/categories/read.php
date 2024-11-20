<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../../config/db.php';
include_once '../../models/categories.php';

// Tạo đối tượng Database và kết nối
$db = new Database();
$connect = $db->connect();

// Tạo đối tượng Categories và truyền kết nối
$categories = new Categories($connect);

// Gọi phương thức read
$read = $categories->read();

// Xử lý kết quả
$data = [];
$data['categories'] = [];
while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
    $category_item = array(
        "id" => $row['category_id'],
        "name" => $row['category_name']
    );
    array_push($data['categories'], $category_item);
}

// Trả về kết quả dưới dạng JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>