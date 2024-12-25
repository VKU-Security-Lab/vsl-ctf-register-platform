<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/classes/Admin.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = isset($data['username']) ? trim($data['username']) : '';
    $password = isset($data['password']) ? trim($data['password']) : '';
    if (empty($username) || empty($password)) {
        $response['message'] = "Vui lòng nhập đầy đủ thông tin.";
        echo json_encode($response);
        exit;
    }
    $adminObj = new Admin();
    $admin = $adminObj->getAdminByUsername($username);

    if ($admin) {
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $response['success'] = true;
            $response['message'] = "Đăng nhập thành công.";
        } else {
            $response['message'] = "Mật khẩu không đúng.";
        }
    } else {
        $response['message'] = "Username không tồn tại.";
    }
    $adminObj->close();
} else {
    $response['message'] = "Yêu cầu không hợp lệ.";
}

echo json_encode($response);
?>