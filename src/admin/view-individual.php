<?php
// view-individual.php

// Bắt đầu phiên làm việc và kiểm tra quyền admin
session_start();
header('Content-Type: application/json');

// Kiểm tra xem admin đã đăng nhập chưa
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode([
        'success' => false,
        'message' => 'Bạn không có quyền truy cập.',
    ]);
    exit;
}

// Kiểm tra tham số ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID không hợp lệ.',
    ]);
    exit;
}

$individual_id = intval($_GET['id']);

// Bao gồm lớp Individual
require_once __DIR__ . '/classes/Individual.php';

$individualObj = new Individual();
$individual = $individualObj->getIndividualById($individual_id);

if (!$individual) {
    echo json_encode([
        'success' => false,
        'message' => 'Không tìm thấy user với ID đã cho.',
    ]);
    exit;
}

// Tạo HTML để hiển thị chi tiết user
$html = "
    <div class='row'>
        <div class='col-md-6'>
            <p><strong>ID:</strong> " . htmlspecialchars($individual['id']) . "</p>
            <p><strong>Tên:</strong> " . htmlspecialchars($individual['name']) . "</p>
            <p><strong>MSSV:</strong> " . htmlspecialchars($individual['student_id']) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($individual['email']) . "</p>
            <p><strong>Số Điện Thoại:</strong> " . htmlspecialchars($individual['phone']) . "</p>
        </div>
        <div class='col-md-6'>
            <p><strong>Khoa:</strong> " . htmlspecialchars($individual['faculty']) . "</p>
            <p><strong>Trạng Thái:</strong> " . htmlspecialchars($individual['status']) . "</p>
            <p><strong>Ngày Đăng Ký:</strong> " . htmlspecialchars($individual['registration_date']) . "</p>
        </div>
    </div>
    <hr>
    <div class='d-flex justify-content-end'>
        <button class='btn btn-primary me-2' id='assign-team-btn' data-id='" . htmlspecialchars($individual['id']) . "'><i class='fas fa-user-plus me-2'></i>Thêm Vào Đội</button>
        <button class='btn btn-secondary' data-bs-dismiss='modal'><i class='fas fa-times me-2'></i>Đóng</button>
    </div>
";

// Trả về phản hồi JSON
echo json_encode([
    'success' => true,
    'html' => $html,
]);

// Đóng kết nối cơ sở dữ liệu nếu cần
$individualObj->close();
?>