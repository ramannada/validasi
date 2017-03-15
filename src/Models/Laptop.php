<?php

namespace App\Models;
use App\Models\AbstractModel;

class Laptop extends AbstractModel
{
    protected $table = 'laptop';
    public function getCategory()
    {
        $this->db->select('*')
                 ->from('category');
        $query = $this->db->execute();
        return $query->fetchAll();
    }
}
