<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
    exit;
}
if (!isset($_POST['team_ids']) || !is_array($_POST['team_ids']) || empty($_POST['team_ids'])) {
    echo json_encode(['success' => false, 'message' => 'Không có đội nào được chọn để xoá.']);
    exit;
}
$team_ids = array_map('intval', $_POST['team_ids']);
if (empty($team_ids)) {
    echo json_encode(['success' => false, 'message' => 'Không có đội nào được chọn để xoá.']);
    exit;
}
require_once __DIR__ . '/classes/Database.php';
$db = new Database();
$pdo = $db->getConnection();

try {
    $pdo->beginTransaction();
    $placeholders = implode(',', array_fill(0, count($team_ids), '?'));
    $stmt_members = $pdo->prepare("DELETE FROM members WHERE team_id IN ($placeholders)");
    $stmt_members->execute($team_ids);
    $stmt = $pdo->prepare("DELETE FROM teams WHERE id IN ($placeholders)");
    $stmt->execute($team_ids);
    $pdo->commit();

    echo json_encode(['success' => true, 'message' => 'Các đội đã được xoá thành công.']);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Đã xảy ra lỗi khi xoá các đội. Vui lòng thử lại sau.']);
}
?>