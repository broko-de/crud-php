<?php
require("../config/bd.php");

class PersonaModel
{
    private $pdo;
    private $table = "personas";

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function all()
    {
        try {
            $result = array();
            $sql = "SELECT p.*, pr.id_provincia, pr.nombre AS provincia
                    FROM {$this->table} p 
                    INNER JOIN provincias pr ON pr.id_provincia = p.id_provincia
                    WHERE p.baja = 0 
                    ORDER BY p.apellido ASC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM {$this->table} WHERE id_persona = ?");

            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("UPDATE {$this->table} SET baja = 1 WHERE id_persona = ?");
            $stm->execute(array($id));
            return $id;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($data)
    {
        try {
            $sql = "UPDATE {$this->table} SET 
                        nombre          = ?, 
                        apellido        = ?,
                        id_provincia            = ?                        
                    WHERE id_persona = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data['nombre'],
                        $data['apellido'],
                        $data['id_provincia'],
                        $data['id_persona']
                    )
                );
            return $this->get($data['id_persona']);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $sql = "INSERT INTO {$this->table} (nombre,apellido,id_provincia,baja) 
                VALUES (?, ?, ?, 0)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data['nombre'],
                        $data['apellido'],
                        $data['id_provincia']
                    )
                );
            return  $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
