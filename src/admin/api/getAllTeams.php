<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /");
    exit;
}
require_once __DIR__ . '/../classes/ExternalTeam.php';
require_once __DIR__ . '/../classes/Team.php';

$teamObj = new Team();
$externalTeamObj = new ExternalTeam();

$teams = $teamObj->getTeams();
$externalTeams = $externalTeamObj->getExternalTeams();
// Return json response all teams, combine internal and external teams
echo json_encode([
    'success' => true,
    'teams' => $teams,
    'externalTeams' => $externalTeams,
]);