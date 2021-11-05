<?php

class Candidate {

    private $idCandidate;
    public $name;
    private $surname;
    private $email;

    public function __construct() {
        
    }

    public function getIdCandidate() {
        return $this->idCandidate;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public  function getEmail() {
        return $this->email;
    }

    public function setIdCandidate($idCandidate) {
        $this->idCandidate = $idCandidate;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

//Función para pintar cada criatura
    function creature2HTML() {
        $result = '<div class=" col-md-4 ">';
         $result .= '<div class="card ">';
          $result .= ' <img class="card-img-top rounded mx-auto d-block email" src='.$this->getEmail().' alt="Card image cap">';
            $result .= '<div class="card-block">';
                $result .= '<h2 class="card-title">' . $this->getName() . '</h2>';
                $result .= '<p class=" card-text description">'.$this->getSurname().'</p>';                    
             $result .= '</div>';
             $result .= ' <div  class=" btn-group card-footer" role="group">';
                $result .= '<a type="button" class="btn btn-secondary" href="app/views/detail.php?id='.$this->getIdCandidate().'">Detalles</a>';
                $result .= '<a type="button" class="btn btn-success" href="app/views/edit.php?id='.$this->getIdCandidate().'">Modificar</a> ';
                $result .= '<a type="button" class="btn btn-danger" href="app/controllers/deleteController.php?id='.$this->getIdCandidate().'">Borrar</a> ';
            $result .= ' </div>';
         $result .= '</div>';
     $result .= '</div>';
        
        
        return $result;
    }
    
    
}
