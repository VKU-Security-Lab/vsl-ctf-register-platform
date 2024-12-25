<?php
require_once 'Database.php';

class Individual
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function addIndividual($name, $email, $phone, $faculty)
    {
        $query = "INSERT INTO individuals (name, email, phone, faculty, status) VALUES (?, ?, ?, ?, ?)";
        return $this->db->execute($query, [$name, $email, $phone, $faculty, 'pending']);
    }
    public function getIndividualById($individual_id)
    {
        $query = "SELECT * FROM individuals WHERE id = ?";
        $result = $this->db->select($query, [$individual_id]);
        return count($result) === 1 ? $result[0] : null;
    }
    public function getIndividuals($search = "")
    {
        if ($search !== "") {
            $query = "SELECT * FROM individuals WHERE name LIKE ? OR email LIKE ? ORDER BY registration_date DESC";
            $search_param = "%" . $search . "%";
            return $this->db->select($query, [$search_param, $search_param]);
        } else {
            $query = "SELECT * FROM individuals ORDER BY registration_date DESC";
            return $this->db->select($query);
        }
    }
    public function deleteIndividual($individual_id)
    {
        $query = "DELETE FROM individuals WHERE id = ?";
        return $this->db->execute($query, [$individual_id]);
    }
    public function getTotalIndividuals()
    {
        $query = "SELECT COUNT(id) as total_individuals FROM individuals";
        $result = $this->db->select($query);
        return $result[0]['total_individuals'] ?? 0;
    }
    public function getRecentIndividuals($days = 7)
    {
        $query = "SELECT COUNT(id) as recent_individuals FROM individuals WHERE registration_date >= NOW() - INTERVAL ? DAY";
        $result = $this->db->select($query, [$days]);
        return $result[0]['recent_individuals'] ?? 0;
    }
    public function getRegistrationsByMonth()
    {
        $query = "SELECT MONTH(registration_date) as month, COUNT(id) as count FROM individuals GROUP BY MONTH(registration_date)";
        return $this->db->select($query);
    }
    public function getIndividualsByFaculty()
    {
        $query = "SELECT faculty, COUNT(id) as count FROM individuals GROUP BY faculty";
        return $this->db->select($query);
    }
    public function close()
    {
        $this->db->close();
    }

}
?>