<?php
require_once 'Database.php';

class ExternalTeam
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function addExternalTeam($team_name, $school_name, $email, $phone, $members)
    {
        $this->db->beginTransaction();

        try {
            $query = "INSERT INTO external_teams (team_name, school_name, email, phone, members_count) VALUES (?, ?, ?, ?, ?)";
            $this->db->execute($query, [$team_name, $school_name, $email, $phone, count($members)]);
            $external_team_id = $this->db->getLastInsertId();
            $memberQuery = "INSERT INTO external_members (external_team_id, name, username, email) VALUES (?, ?, ?, ?)";
            foreach ($members as $member) {
                $this->db->execute($memberQuery, [
                    $external_team_id,
                    trim($member['name']),
                    trim($member['username']),
                    trim($member['email']),
                ]);
            }
            $this->db->commit();
            return ['success' => true, 'message' => 'Đăng ký đội khách thành công!'];
        } catch (Exception $e) {

            $this->db->rollBack();
            return ['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý đăng ký đội khách. Vui lòng thử lại sau.'];
        }
    }
    public function getExternalTeamById($team_id)
    {
        $query = "SELECT * FROM external_teams WHERE id = ?";
        $result = $this->db->select($query, [$team_id]);
        return count($result) === 1 ? $result[0] : null;
    }
    public function getExternalTeams($search = "")
    {
        if ($search !== "") {
            $query = "SELECT * FROM external_teams WHERE team_name LIKE ? OR email LIKE ? ORDER BY created_at DESC";
            $search_param = "%" . $search . "%";
            return $this->db->select($query, [$search_param, $search_param]);
        } else {
            $query = "SELECT * FROM external_teams ORDER BY created_at DESC";
            return $this->db->select($query);
        }
    }
    public function deleteExternalTeam($team_id)
    {
        $this->db->beginTransaction();

        try {
            $deleteMembersQuery = "DELETE FROM external_members WHERE external_team_id = ?";
            $this->db->execute($deleteMembersQuery, [$team_id]);
            $deleteTeamQuery = "DELETE FROM external_teams WHERE id = ?";
            $this->db->execute($deleteTeamQuery, [$team_id]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    public function getMembersByTeamId($team_id)
    {
        $query = "SELECT * FROM external_members WHERE external_team_id = ?";
        return $this->db->select($query, [$team_id]);
    }
    public function getTotalExternalTeams()
    {
        $query = "SELECT COUNT(id) as total_external_teams FROM external_teams";
        $result = $this->db->select($query);
        return $result[0]['total_external_teams'] ?? 0;
    }
    public function getTotalExternalMembers()
    {
        $query = "SELECT COUNT(id) as total_external_members FROM external_members";
        $result = $this->db->select($query);
        return $result[0]['total_external_members'] ?? 0;
    }
    public function close()
    {
        $this->db->close();
    }
}
?>