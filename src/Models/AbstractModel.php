<?php
namespace App\Models;

class AbstractModel
{
    protected $db, $table;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $this->db->select('*')
                 ->from($this->table)
                 ->where('deleted = 0');
        $query = $this->db->execute();
        return $query->fetchAll();
    }
    public function getById($id)
    {
        $this->db
            ->select('*')
            ->from($this->table)
            ->where($this->table.".id=".$id);
        $query = $this->db->execute();
        return $query->fetch();
    }
    public function add($data)
    {
        $valuesColumn = [];
        $valuesData = [];
        foreach ($data as $key => $val) {
            $valuesColumn[$key] = ':' . $key;
            $valuesData[$key] = $val;
        }
        $this->db->insert($this->table)
                 ->values($valuesColumn)
                 ->setParameters($valuesData)
                 ->execute();
    }
    public function softDelete($id)
    {
        $this->db
        ->update($this->table)
        ->set('deleted', 1)
        ->where("id ='" . $id."'")
        ->execute();
    }
    public function delete($id)
    {
        $this->db->delete($this->table)
                 ->where("id=". $id);
    }
}
