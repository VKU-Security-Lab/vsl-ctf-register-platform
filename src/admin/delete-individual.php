<?php
require_once __DIR__ . '/classes/Individual.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $individualObj = new Individual();
    $result = $individualObj->deleteIndividual($_POST['id']);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User đã được xóa thành công.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Xóa user thất bại.']);
    }
    exit;
}
?>