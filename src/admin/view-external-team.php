<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "<p>Không có quyền truy cập.</p>";
    exit;
}

require_once 'classes/ExternalTeam.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>ID đội khách không hợp lệ.</p>";
    exit;
}

$team_id = intval($_GET['id']);

$externalTeamObj = new ExternalTeam();
$team = $externalTeamObj->getExternalTeamById($team_id);
$members = $externalTeamObj->getMembersByTeamId($team_id);
$externalTeamObj->close();

if (!$team) {
    echo "<p>Không tìm thấy đội khách.</p>";
    exit;
}
?>

<div class="container">
    <h4>Thông Tin Đội Khách</h4>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Tên Đội Khách:</strong> <?php echo htmlspecialchars($team['team_name']); ?>
        </li>
        <li class="list-group-item"><strong>Tên Trường:</strong> <?php echo htmlspecialchars($team['school_name']); ?>
        </li>
        <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($team['email']); ?></li>
        <li class="list-group-item"><strong>Số Điện Thoại:</strong> <?php echo htmlspecialchars($team['phone']); ?></li>
        <li class="list-group-item"><strong>Số Lượng Thành Viên:</strong>
            <?php echo htmlspecialchars($team['members_count']); ?></li>
        <li class="list-group-item"><strong>Ngày Đăng Ký:</strong>
            <?php echo htmlspecialchars($team['created_at']); ?></li>
    </ul>

    <h5>Danh Sách Thành Viên</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ Tên</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($members) > 0) {
                foreach ($members as $member) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($member['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($member['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($member['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($member['email']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Không có thành viên nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>