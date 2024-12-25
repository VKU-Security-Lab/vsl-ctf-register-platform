<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
    exit;
}

$team_id = intval($_GET['id']);

if ($team_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID đội không hợp lệ.']);
    exit;
}

require_once __DIR__ . '/classes/Team.php';

$teamObj = new Team();
$team = $teamObj->getTeamById($team_id);
$members = $teamObj->getMembersByTeamId($team_id);
$teamObj->close();

if ($team) {
    $html = "
    <h4>Thông Tin Đội</h4>
    <p><strong>ID:</strong> " . htmlspecialchars($team['id']) . "</p>
    <p><strong>Tên Đội:</strong> " . htmlspecialchars($team['team_name']) . "</p>
    <p><strong>Email Đội:</strong> " . htmlspecialchars($team['email']) . "</p>
    <p><strong>Số Điện Thoại:</strong> " . htmlspecialchars($team['phone']) . "</p>
    <p><strong>Số Lượng Thành Viên:</strong> " . htmlspecialchars($team['members_count']) . "</p>
    <p><strong>Ngày Đăng Ký:</strong> " . htmlspecialchars($team['registration_date']) . "</p>
    <hr>
    <h4>Danh Sách Thành Viên</h4>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Username</th>
                <th>Mã Sinh Viên</th>
                <th>Email</th>
                <th>Khoa</th>
            </tr>
        </thead>
        <tbody>";
    if (count($members) > 0) {
        foreach ($members as $member) {
            $html .= "<tr>
                        <td>" . htmlspecialchars($member['id']) . "</td>
                        <td>" . htmlspecialchars($member['name']) . "</td>
                        <td>" . htmlspecialchars($member['username']) . "</td>
                        <td>" . htmlspecialchars($member['student_id']) . "</td>
                        <td>" . htmlspecialchars($member['email']) . "</td>
                        <td>" . htmlspecialchars($member['faculty']) . "</td>
                      </tr>";
        }
    } else {
        $html .= "<tr><td colspan='6' class='text-center'>Không có thành viên nào.</td></tr>";
    }
    $html .= "</tbody></table>";

    echo json_encode(['success' => true, 'html' => $html]);
} else {
    echo json_encode(['success' => false, 'message' => 'Không tìm thấy đội này.']);
}
?>