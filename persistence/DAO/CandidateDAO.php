<?php

//dirname(__FILE__) Es el directorio del archivo actual
require_once(dirname(__FILE__) . '..\..\conf\PersistentManager.php');

class CandidateDAO {

    //Se define una constante con el nombre de la tabla
    const CANDIDATE_TABLE = 'candidates';

    //Conexión a BD
    private $conn = null;

    //Constructor de la clase
    public function __construct() {
        $this->conn = PersistentManager::getInstance()->get_connection();
    }

    public function selectAll() {
        $query = "SELECT * FROM " . CandidateDAO::CANDIDATE_TABLE;
        $result = mysqli_query($this->conn, $query);
        $candidates= array();
        while ($candidateBD = mysqli_fetch_array($result)) {

            $candidate = new Candidate();
            $candidate->setIdCandidate($candidateBD["idCandidate"]);
            $candidate->setName($candidateBD["name"]);
            $candidate->setSurname($candidateBD["surname"]);
            $candidate->setEmail($candidateBD["email"]);
            
            array_push($candidates, $candidate);
        }
        return $candidates;
    }

    public function insert($candidate) {
        $query = "INSERT INTO " . CandidateDAO::CANDIDATE_TABLE .
                " (name, surname, email) VALUES(?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $name = $candidate->getName();
        $surname = $candidate->getSurname();
        $email = $candidate->getEmail();
        
        mysqli_stmt_bind_param($stmt, 'sss', $name, $surname, $email);
        return $stmt->execute();
    }

    public function selectById($id) {
        $query = "SELECT name, surname, email FROM " . CandidateDAO::CANDIDATE_TABLE . " WHERE idCandidate=?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name, $surname, $email);

        $candidate = new Candidate();
        while (mysqli_stmt_fetch($stmt)) {
            $candidate->setIdCandidate($id);
            $candidate->setName($name);
            $candidate->setSurname($surname);
            $candidate->setEmail($email);
       }

        return $candidate;
    }

    public function update($candidate) {
        $query = "UPDATE " . CandidateDAO::CANDIDATE_TABLE .
                " SET name=?, surname=?, email=?"
                . " WHERE idCandidate=?";
        $stmt = mysqli_prepare($this->conn, $query);
        $name = $candidate->getName();
        $surname= $candidate->getSurname();
        $email = $candidate->getEmail();
        $id = $candidate->getIdCandidate();
        mysqli_stmt_bind_param($stmt, 'sssi', $name, $surname, $email, $id);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM " . CandidateDAO::CANDIDATE_TABLE . " WHERE idCandidate =?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return $stmt->execute();
    }

        
}

?>
