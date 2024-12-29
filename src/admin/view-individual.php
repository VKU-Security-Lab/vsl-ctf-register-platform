<?php
// view-individual.php

// Start session and check admin privileges
session_start();
header('Content-Type: application/json');

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode([
        'success' => false,
        'message' => 'Bạn không có quyền truy cập.',
    ]);
    exit;
}

// Validate ID parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID không hợp lệ.',
    ]);
    exit;
}

$individual_id = intval($_GET['id']);

// Include the Individual class
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

// Create HTML to display the individual details
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
        <button class='btn btn-primary me-2' id='assign-team-btn' onclick='displayFormAdd();' data-id='" . htmlspecialchars($individual['id']) . "'><i class='fas fa-user-plus me-2'></i>Thêm Vào Đội</button>
        <button class='btn btn-secondary' data-bs-dismiss='modal'><i class='fas fa-times me-2'></i>Đóng</button>
    </div>
    <!-- Popup Form for Team Assignment -->
    <div id='team-form-popup' style='display:none;'>
        <select id='team-option' onchange='toggleTeamForm();'>
            <option value='new'>Tạo Đội Mới</option>
            <option value='existing'>Thêm Vào Đội Hiện Có</option>
        </select>
        <form id='new-team-form' style='display:none;' method='post' action='add-to-team.php?existing=false'>
            <input type='hidden' name='individual_id' value='" . htmlspecialchars($individual['id']) . "' />
            <select name='typeTeam'>
                <option value='internal'>Đội Nội Bộ</option>
                <option value='external'>Đội Ngoại Bộ</option>
            </select>
            <input type='text' placeholder='Tên Đội' name='team_name' />
            <input type='number' placeholder='Số Lượng Thành Viên' name='team_size' />
            <input type='email' placeholder='Email' name='team_email' />
            <input type='text' placeholder='Số Điện Thoại' name='team_phone' />
            <button type='submit'>Tạo Đội</button>
        </form>
        <form id='existing-team-form' style='display:none;' method='post' action='add-to-team.php?existing=true'>
            <input type='hidden' name='individual_id' value='" . htmlspecialchars($individual['id']) . "' />
            <select name='typeTeam'>
                <option value='internal'>Đội Nội Bộ</option>
                <option value='external'>Đội Ngoại Bộ</option>
            </select>
            <select name='team_id'>
                <!-- Options filled by server-side logic or AJAX call -->
            </select>
            <button type='submit'>Thêm Vào Đội</button>
        </form>
    </div>
";

// Return JSON response
echo json_encode([
    'success' => true,
    'html' => $html,
]);

// Close the database connection if needed
$individualObj->close();
