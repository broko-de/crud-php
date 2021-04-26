<?php
require("../config/bd.php");

class ProvinciaModel
{
    private $pdo;
    private $table = "provincias";

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

            $stm = $this->pdo->prepare("SELECT * FROM {$this->table}");
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
                ->prepare("SELECT * FROM {$this->table} WHERE id = ?");

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
                ->prepare("DELETE FROM {$this->table} WHERE id = ?");
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
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data['nombre'],
                    )
                );
            return $this->get($data['id_provincia']);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function save($data)
    {
        try {
            $sql = "INSERT INTO {$this->table} (nombre) 
                VALUES (?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data['nombre'],
                    )
                );
            return  $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
