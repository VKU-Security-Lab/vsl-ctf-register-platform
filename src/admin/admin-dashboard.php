<?php
// admin/admin-dashboard.php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
require_once __DIR__ . '/classes/Team.php';
require_once __DIR__ . '/classes/Admin.php';
require_once __DIR__ . '/classes/Individual.php';
$individualObj = new Individual();
$teamObj = new Team();
$adminObj = new Admin();
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$teams = $teamObj->getTeams($search);
$total_teams = $teamObj->getTotalTeams();
$total_members = $teamObj->getTotalMembers();
$total_admins = $adminObj->getTotalAdmins();
$recent_registrations = $teamObj->getRecentRegistrations();
$registrations_by_month = $teamObj->getRegistrationsByMonth();
$members_by_faculty = $teamObj->getMembersByFaculty();
$individuals = $individualObj->getIndividuals($search);
$teamObj->close();
$adminObj->close();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Internal VSL CTF 2025</title>
    <!-- Bootswatch Cerulean Theme CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/cerulean/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <!-- Custom CSS -->
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

        .stat-card {
            border-left: 5px solid #0069d9;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stat-card {
                text-align: center;
                border-left: none;
                border-top: 5px solid #0069d9;
            }
        }

        /* Modal Customization */
        .modal-lg {
            max-width: 800px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Main Container -->
    <div class="container my-4">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card text-white bg-primary mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Tổng Đội</h5>
                                <p class="card-text display-6"><?php echo $total_teams; ?></p>
                            </div>
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card text-white bg-success mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Tổng Thành Viên</h5>
                                <p class="card-text display-6"><?php echo $total_members; ?></p>
                            </div>
                            <i class="fas fa-user-friends fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card text-white bg-warning mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Tổng Admin</h5>
                                <p class="card-text display-6"><?php echo $total_admins; ?></p>
                            </div>
                            <i class="fas fa-user-shield fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card text-white bg-danger mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Đăng Ký Gần Đây</h5>
                                <p class="card-text display-6"><?php echo $recent_registrations; ?></p>
                            </div>
                            <i class="fas fa-chart-line fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Danh Sách Đội Đăng Ký</h2>
            <div>
                <button id="bulk-delete-btn" class="btn btn-danger me-2" disabled>
                    <i class="fas fa-trash-alt me-2"></i>Xoá Hàng Loạt
                </button>
            </div>
        </div>
        <form class="row g-3 mb-4" method="GET" action="admin-dashboard.php">
            <div class="col-md-6">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên đội hoặc email..."
                    value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search me-2"></i>Tìm
                    Kiếm</button>
            </div>
        </form>
        <div class="table-responsive">
            <form id="teams-form" method="POST" action="delete-teams.php">
                <table id="teams-table" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>ID</th>
                            <th>Tên Đội</th>
                            <th>Email Đội</th>
                            <th>Số Điện Thoại</th>
                            <th>Số Lượng Thành Viên</th>
                            <th>Ngày Đăng Ký</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($teams) > 0) {
                            foreach ($teams as $team) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='team_ids[]' value='" . htmlspecialchars($team['id']) . "' class='team-checkbox'></td>";
                                echo "<td>" . htmlspecialchars($team['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($team['team_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($team['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($team['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($team['members_count']) . "</td>";
                                echo "<td>" . htmlspecialchars($team['registration_date']) . "</td>";
                                echo "<td>
                                        <a href='view-team.php?id=" . urlencode($team['id']) . "' class='btn btn-info btn-sm me-2 view-team-btn' data-id='" . htmlspecialchars($team['id']) . "' title='Xem Chi Tiết'><i class='fas fa-eye'></i></a>
                                        <a href='delete-team.php?id=" . urlencode($team['id']) . "' class='btn btn-danger btn-sm delete-team-btn' title='Xoá Đội' onclick=\"return confirm('Bạn có chắc chắn muốn xoá đội này?');\"><i class='fas fa-trash-alt'></i></a>
                                      </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="card my-4">
            <div class="card-header bg-purple text-white">
                <h4>Danh Sách User Chưa Có Đội</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="individuals-table" class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>MSSV</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Khoa</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Đăng Ký</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($individuals) > 0) {
                                foreach ($individuals as $individual) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($individual['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['student_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['faculty']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['status']) . "</td>";
                                    echo "<td>" . htmlspecialchars($individual['registration_date']) . "</td>";
                                    echo "<td>
                                    <a href='#' class='btn btn-info btn-sm me-2 view-individual-btn' data-id='" . htmlspecialchars($individual['id']) . "' title='Xem Chi Tiết'><i class='fas fa-eye'></i></a>
                                    <a href='delete-individual.php?id=" . urlencode($individual['id']) . "' class='btn btn-danger btn-sm' title='Xoá User' onclick=\"return confirm('Bạn có chắc chắn muốn xoá user này?');\"><i class='fas fa-trash-alt'></i></a>
                                  </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>Không có user nào chưa có đội.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Biểu Đồ Thống Kê -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-purple text-white">
                        Số Đội Đăng Ký Theo Tháng
                    </div>
                    <div class="card-body">
                        <canvas id="teamsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-purple text-white">
                        Số Thành Viên Theo Khoa
                    </div>
                    <div class="card-body">
                        <canvas id="membersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xem Chi Tiết Đội -->
    <div class="modal fade" id="viewTeamModal" tabindex="-1" aria-labelledby="viewTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white">
                    <h5 class="modal-title" id="viewTeamModalLabel">Chi Tiết Đội</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nội dung chi tiết đội sẽ được tải động qua AJAX -->
                    <div id="team-details">
                        <p>Đang tải...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Xem Chi Tiết User -->
    <div class="modal fade" id="viewIndividualModal" tabindex="-1" aria-labelledby="viewIndividualModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white">
                    <h5 class="modal-title" id="viewIndividualModalLabel">Chi Tiết User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nội dung chi tiết user sẽ được tải động qua AJAX -->
                    <div id="individual-details">
                        <p>Đang tải...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/admin-scripts.js"></script>
    <script>
        const teamsCtx = document.getElementById('teamsChart').getContext('2d');
        const teamsChart = new Chart(teamsCtx, {
            type: 'bar',
            data: {
                labels: [<?php
                $labels = [];
                $data = [];
                foreach ($registrations_by_month as $row) {
                    $labels[] = 'Tháng ' . $row['month'];
                    $data[] = $row['count'];
                }
                echo '"' . implode('","', $labels) . '"';
                ?>],
                datasets: [{
                    label: 'Số Đội Đăng Ký',
                    data: [<?php echo implode(',', $data); ?>],
                    backgroundColor: 'rgba(0, 123, 255, 0.6)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: false,
                        text: 'Số Đội Đăng Ký Theo Tháng'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        // Biểu Đồ Số Thành Viên Theo Khoa
        const membersCtx = document.getElementById('membersChart').getContext('2d');
        const membersChart = new Chart(membersCtx, {
            type: 'pie',
            data: {
                labels: [<?php
                $labels = [];
                $data = [];
                foreach ($members_by_faculty as $row) {
                    $labels[] = $row['faculty'];
                    $data[] = $row['count'];
                }
                echo '"' . implode('","', $labels) . '"';
                ?>],
                datasets: [{
                    label: 'Số Thành Viên',
                    data: [<?php echo implode(',', $data); ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 205, 86, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' },
                    title: {
                        display: false,
                        text: 'Số Thành Viên Theo Khoa'
                    }
                }
            }
        });
    </script>
</body>

</html>