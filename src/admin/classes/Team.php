<?php
require_once 'Database.php';

class Team
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function addTeam($team_name, $email, $phone, $members_count)
    {
        $query = "INSERT INTO teams (team_name, email, phone, members_count) VALUES (?, ?, ?, ?)";
        return $this->db->execute($query, [$team_name, $email, $phone, $members_count]);
    }
    public function getTeamByName($team_name)
    {
        $query = "SELECT * FROM teams WHERE team_name = ?";
        $result = $this->db->select($query, [$team_name]);
        return count($result) === 1 ? $result[0] : null;
    }
    public function getTeamById($team_id)
    {
        $query = "SELECT * FROM teams WHERE id = ?";
        $result = $this->db->select($query, [$team_id]);
        return count($result) === 1 ? $result[0] : null;
    }
    public function getTeams($search = "")
    {
        if ($search !== "") {
            $query = "SELECT * FROM teams WHERE team_name LIKE ? OR email LIKE ? ORDER BY registration_date DESC";
            $search_param = "%" . $search . "%";
            return $this->db->select($query, [$search_param, $search_param]);
        } else {
            $query = "SELECT * FROM teams ORDER BY registration_date DESC";
            return $this->db->select($query);
        }
    }
    public function deleteTeam($team_id)
    {
        $query = "DELETE FROM teams WHERE id = ?";
        return $this->db->execute($query, [$team_id]);
    }
    public function getMembersByTeamId($team_id)
    {
        $query = "SELECT * FROM members WHERE team_id = ?";
        return $this->db->select($query, [$team_id]);
    }
    public function getTotalTeams()
    {
        $query = "SELECT COUNT(id) as total_teams FROM teams";
        $result = $this->db->select($query);
        return $result[0]['total_teams'] ?? 0;
    }
    public function getTotalMembers()
    {
        $query = "
        SELECT SUM(total) as total_members
        FROM (
            SELECT COUNT(id) as total FROM members
            UNION ALL
            SELECT COUNT(id) as total FROM individuals
        ) as combined
    ";
        $result = $this->db->select($query);
        return $result[0]['total_members'] ?? 0;
    }

    public function getRecentRegistrations($days = 7)
    {
        $query = "SELECT COUNT(id) as recent_registrations FROM teams WHERE registration_date >= NOW() - INTERVAL ? DAY";
        $result = $this->db->select($query, [$days]);
        return $result[0]['recent_registrations'] ?? 0;
    }
    public function getRegistrationsByMonth()
    {
        $query = "SELECT MONTH(registration_date) as month, COUNT(id) as count FROM teams GROUP BY MONTH(registration_date)";
        return $this->db->select($query);
    }
    public function getMembersByFaculty()
    {
        $query = "SELECT faculty, COUNT(id) as count FROM members GROUP BY faculty";
        return $this->db->select($query);
    }

    public function addMember($team_id, $name, $username, $student_id, $email, $faculty)
    {
        $query = "INSERT INTO members (team_id, name, username, student_id, email, faculty) VALUES (?, ?, ?, ?, ?, ?)";
        return $this->db->execute($query, [$team_id, $name, $username, $student_id, $email, $faculty]);
    }

    public function close()
    {
        $this->db->close();
    }
}
?>