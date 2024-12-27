<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/admin/classes/Database.php';
$db = new Database();
$pdo = $db->getConnection();
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['registration_type']) || empty($data['registration_type'])) {
    echo json_encode(['success' => false, 'message' => 'Loại đăng ký không hợp lệ.']);
    exit;
}

$registration_type = trim($data['registration_type']);
if ($registration_type === 'team') {
    if (
        !isset($data['team_name'], $data['email'], $data['phone'], $data['members']) ||
        empty($data['team_name']) ||
        empty($data['email']) ||
        empty($data['phone']) ||
        empty($data['members'])
    ) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin đội.']);
        exit;
    }
    $team_name = trim($data['team_name']);
    $team_email = trim($data['email']);
    $team_phone = trim($data['phone']);
    $members = $data['members'];
    $members_count = count($members);
    if ($members_count < 1 || $members_count > 4) {
        echo json_encode(['success' => false, 'message' => 'Số lượng thành viên không hợp lệ.']);
        exit;
    }
    foreach ($members as $index => $member) {
        if (
            !isset($member['name'], $member['username'], $member['student_id'], $member['email'], $member['faculty']) ||
            empty(trim($member['name'])) ||
            empty(trim($member['username'])) ||
            empty(trim($member['student_id'])) ||
            empty(trim($member['email'])) ||
            empty(trim($member['faculty']))
        ) {
            echo json_encode(['success' => false, 'message' => "Thông tin thành viên {$index} không đầy đủ."]);
            exit;
        }
        if (!filter_var($member['email'], FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/', $member['email'])) {
            echo json_encode(['success' => false, 'message' => "Email của thành viên {$index} không hợp lệ."]);
            exit;
        }
    }

    if (!preg_match('/^\+?\d{10,15}$/', $team_phone)) {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại đội không hợp lệ.']);
        exit;
    }

    if (!filter_var($team_email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/', $team_email)) {
        echo json_encode(['success' => false, 'message' => 'Email đội không hợp lệ.']);
        exit;
    }
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO teams (team_name, email, phone, members_count) VALUES (?, ?, ?, ?)");
        $stmt->execute([$team_name, $team_email, $team_phone, $members_count]);
        $team_id = $pdo->lastInsertId();

        $stmt_member = $pdo->prepare("INSERT INTO members (team_id, name, username, student_id, email, faculty) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($members as $member) {
            $stmt_member->execute([
                $team_id,
                trim($member['name']),
                trim($member['username']),
                trim($member['student_id']),
                trim($member['email']),
                trim($member['faculty'])
            ]);
        }
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Đăng ký đội thành công!']);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý đăng ký đội. Vui lòng thử lại sau.']);
    }

} elseif ($registration_type === 'individual') {
    if (
        !isset($data['name'], $data['email'], $data['phone'], $data['faculty']) ||
        empty($data['name']) ||
        empty($data['email']) ||
        empty($data['phone']) ||
        empty($data['student_id']) ||
        empty($data['faculty'])
    ) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin cá nhân.']);
        exit;
    }
    $name = trim($data['name']);
    $email = trim($data['email']);
    $phone = trim($data['phone']);
    $faculty = trim($data['faculty']);
    $student_id = trim($data['student_id']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/', $email)) {
        echo json_encode(['success' => false, 'message' => 'Email không hợp lệ.']);
        exit;
    }

    if (!preg_match('/^\+?\d{10,15}$/', $phone)) {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại không hợp lệ.']);
        exit;
    }
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO individuals (name, email, phone, faculty, student_id, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $faculty, $student_id, 'pending']);
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Đăng ký cá nhân thành công! BTC sẽ ghép đội cho bạn.']);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý đăng ký cá nhân. Vui lòng thử lại sau.']);
    }
} elseif ($registration_type === 'external_team') {
    if (
        !isset($data['external_team_name'], $data['external_school_name'], $data['external_email'], $data['external_phone'], $data['external_members']) ||
        empty($data['external_team_name']) ||
        empty($data['external_school_name']) ||
        empty($data['external_email']) ||
        empty($data['external_phone']) ||
        empty($data['external_members'])
    ) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin đội khách.']);
        exit;
    }

    $external_team_name = trim($data['external_team_name']);
    $external_school_name = trim($data['external_school_name']);
    $external_email = trim($data['external_email']);
    $external_phone = trim($data['external_phone']);
    $external_members = $data['external_members'];
    $external_members_count = count($external_members);

    if ($external_members_count < 1 || $external_members_count > 4) {
        echo json_encode(['success' => false, 'message' => 'Số lượng thành viên không hợp lệ.']);
        exit;
    }

    foreach ($external_members as $index => $member) {
        if (
            !isset($member['name'], $member['username'], $member['email']) ||
            empty(trim($member['name'])) ||
            empty(trim($member['username'])) ||
            empty(trim($member['email']))
        ) {
            echo json_encode(['success' => false, 'message' => "Thông tin thành viên {$index} không đầy đủ."]);
            exit;
        }

        if (!filter_var($member['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => "Email của thành viên {$index} không hợp lệ."]);
            exit;
        }
    }

    if (!preg_match('/^\+?\d{10,15}$/', $external_phone)) {
        echo json_encode(['success' => false, 'message' => 'Số điện thoại đội khách không hợp lệ.']);
        exit;
    }

    if (!filter_var($external_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Email đội khách không hợp lệ.']);
        exit;
    }

    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO external_teams (team_name, school_name, email, phone, members_count) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$external_team_name, $external_school_name, $external_email, $external_phone, $external_members_count]);
        $external_team_id = $pdo->lastInsertId();

        $stmt_member = $pdo->prepare("INSERT INTO external_members (external_team_id, name, username, email) VALUES (?, ?, ?, ?)");
        foreach ($external_members as $member) {
            $stmt_member->execute([
                $external_team_id,
                trim($member['name']),
                trim($member['username']),
                trim($member['email']),
            ]);
        }
        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Đăng ký đội khách thành công!']);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý đăng ký đội khách. Vui lòng thử lại sau.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Loại đăng ký không hợp lệ.']);
}
?>