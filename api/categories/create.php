<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/db.php';
include_once '../../models/categories.php';

// Tạo đối tượng Database và kết nối
$db = new Database();
$connect = $db->connect();

// Tạo đối tượng Categories và truyền kết nối
$categories = new Categories($connect);

// Lấy dữ liệu từ request (dạng JSON)
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra dữ liệu có tồn tại không
if (isset($data->category_name)) {
    // Kiểm tra xem category_name có được nhận đúng không
    echo json_encode(array("message" => "Received category name: " . $data->category_name));
    $categories->category_name = $data->category_name;
} else {
    echo json_encode(array("message" => "Category name is missing"));
    exit;
}

// Tạo mới category trong cơ sở dữ liệu
if ($categories->create()) {
    echo json_encode(array("message" => "Category created successfully"));
} else {
    echo json_encode(array("message" => "Category not created"));
}
?>