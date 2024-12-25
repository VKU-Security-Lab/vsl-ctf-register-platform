<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/classes/Team.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin-dashboard.php");
    exit;
}

$team_id = intval($_GET['id']);
$teamObj = new Team();
$team = $teamObj->getTeamById($team_id);
if (!$team) {
    echo "Không tìm thấy đội này.";
    exit;
}
$members = $teamObj->getMembersByTeamId($team_id);
$teamObj->close();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem Đội - Internal VSL CTF 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/cerulean/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin-styles.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f0f2f5;
        }

        .navbar-brand img.logo {
            width: 50px;
        }

        .card-header.bg-purple {
            background-color: #0069d9 !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-purple">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/images/logo.png" alt="Logo" class="logo me-2">
                Internal VSL CTF 2025
            </a>
            <div class="d-flex align-items-center">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light"><i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất</a>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <a href="admin-dashboard.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left me-2"></i>Quay Lại
            Dashboard</a>
        <div class="card mb-4">
            <div class="card-header bg-purple text-white">
                Thông Tin Đội
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($team['team_name']); ?></h5>
                <p class="card-text"><strong>Email Đội:</strong> <?php echo htmlspecialchars($team['email']); ?></p>
                <p class="card-text"><strong>Số Điện Thoại:</strong> <?php echo htmlspecialchars($team['phone']); ?></p>
                <p class="card-text"><strong>Số Lượng Thành Viên:</strong>
                    <?php echo htmlspecialchars($team['members_count']); ?></p>
                <p class="card-text"><strong>Ngày Đăng Ký:</strong>
                    <?php echo htmlspecialchars($team['registration_date']); ?></p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-purple text-white d-flex justify-content-between align-items-center">
                <span>Danh Sách Thành Viên</span>
                <a href="add-member.php" class="btn btn-success btn-sm"><i class="fas fa-user-plus me-2"></i>Thêm Thành
                    Viên</a>
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['delete_member_success'])) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['delete_member_success']) . '</div>';
                    unset($_SESSION['delete_member_success']);
                }

                if (isset($_SESSION['delete_member_error'])) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['delete_member_error']) . '</div>';
                    unset($_SESSION['delete_member_error']);
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Username</th>
                                <th>Mã Sinh Viên</th>
                                <th>Email</th>
                                <th>Khoa</th>
                                <th>Thao Tác</th>
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
                                    echo "<td>" . htmlspecialchars($member['student_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($member['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($member['faculty']) . "</td>";
                                    echo "<td>
                                            <a href='delete-member.php?id=" . urlencode($member['id']) . "&team_id=" . urlencode($team_id) . "' class='btn btn-danger btn-sm' title='Xoá Thành Viên' onclick=\"return confirm('Bạn có chắc chắn muốn xoá thành viên này?');\"><i class='fas fa-trash-alt'></i></a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu thành viên.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/admin-scripts.js"></script>
</body>

</html>