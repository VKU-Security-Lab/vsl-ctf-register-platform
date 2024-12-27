<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

require_once 'classes/ExternalTeam.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['external_team_ids'])) {
    $external_team_ids = $_POST['external_team_ids'];
    $externalTeamObj = new ExternalTeam();

    $deleted = 0;
    foreach ($external_team_ids as $team_id) {
        if ($externalTeamObj->deleteExternalTeam($team_id)) {
            $deleted++;
        }
    }

    $externalTeamObj->close();
    header("Location: admin-dashboard.php?message=Xoá thành công {$deleted} đội khách.");
    exit;
} else {
    header("Location: admin-dashboard.php?message=Không có đội khách nào được chọn để xoá.");
    exit;
}
?>