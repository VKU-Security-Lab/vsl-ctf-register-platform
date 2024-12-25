<?php
require_once 'Database.php';

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function addAdmin($username, $password)
    {
        $query = "SELECT id FROM admins WHERE username = ?";
        $result = $this->db->select($query, [$username]);

        if (count($result) > 0) {
            return false;
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO admins (username, password) VALUES (?, ?)";
        $affected_rows = $this->db->execute($insert_query, [$username, $hashed_password]);
        return $affected_rows > 0;
    }

    public function getAdminByUsername($username)
    {
        $query = "SELECT * FROM admins WHERE username = ?";
        $result = $this->db->select($query, [$username]);

        if (count($result) === 1) {
            return $result[0];
        }

        return null;
    }
    public function getTotalAdmins()
    {
        $query = "SELECT COUNT(id) as total_admins FROM admins";
        $result = $this->db->select($query);
        return $result[0]['total_admins'] ?? 0;
    }
    public function close()
    {
        $this->db->close();
    }
}
?>