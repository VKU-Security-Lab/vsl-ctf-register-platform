<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/classes/Team.php';
require_once __DIR__ . '/classes/ExternalTeam.php';
require_once __DIR__ . '/classes/Individual.php';

if (isset($_GET['existing']) ) {
    if ($_GET['existing'] === 'true') {
        if ($_POST['typeTeam'] === 'internal') {
            $teamObj = new Team();
            $team = $teamObj->getTeamById($_POST['team_id']);
        } else {
            $teamObj = new ExternalTeam();
            $team = $teamObj->getExternalTeamById($_POST['team_id']);
        }

        if (!$team) {
            header("Location: /admin/admin-dashboard.php?error=team_not_found");
            exit;
        }
        $members = $teamObj->getMembersByTeamId($_POST['team_id']);
        $total_members = count($members);
        if ($total_members >= $team['members_count']) {
            header("Location: /admin/admin-dashboard.php?error=team_full");
            exit;
        }

    
        $individualObj = new Individual();
        $individual = $individualObj->getIndividualById($_POST['individual_id']);
        // Generate a random username follow format: user-<random>
        $username = 'user-' . substr(md5(uniqid(mt_rand(), true)), 0, 8);
        $individual['username'] = $username;
        $teamObj->addMember($_POST['team_id'], $individual['name'], $individual['username'], $individual['student_id'], $individual['email'], $individual['faculty']);
        $individualObj->deleteIndividual($_POST['individual_id']);
        header("Location: /admin/admin-dashboard.php?success=member_added");
    } else {
        if ($_POST['typeTeam'] === 'internal') {
            $teamObj = new Team();
            $teamObj->addTeam($_POST['team_name'], $_POST['team_email'], $_POST['team_phone'], $_POST['team_size']);
            $team = $teamObj->getTeamByName($_POST['team_name']);
            $team_id = $team['id'];
            $individualObj = new Individual();
            $individual = $individualObj->getIndividualById($_POST['individual_id']);
            // Generate a random username follow format: user-<random>
            $username = 'user-' . substr(md5(uniqid(mt_rand(), true)), 0, 8);
            $individual['username'] = $username;

            $teamObj->addMember($team_id, $individual['name'], $individual['username'], $individual['student_id'], $individual['email'], $individual['faculty']);
            
            $individualObj->deleteIndividual($_POST['individual_id']);
            header("Location: /admin/admin-dashboard.php?success=member_added");
        } else {
            $teamObj = new ExternalTeam();
            $teamObj->addExternalTeam($_POST['team_name'], $_POST['school_name'], $_POST['email'], $_POST['phone'], $_POST['members']);
        }

    }
} else {
    header("Location: /admin/admin-dashboard.php?error=invalid_request");
    exit;
}