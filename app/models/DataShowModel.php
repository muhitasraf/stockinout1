<?php

namespace App\Models;

class DataShowModel extends Model {
    public $_table = 'students_info';
    protected $primary = "id";
    protected $pdo;
    public function __construct(){
        parent::__construct();
        //$this->primary[$_table] = 'tst_id';
    }

    public function get_by_pdo_prepare($param) { //good with param
        $rs = $this->pdo->prepare("SELECT * FROM students_info where id= ?");
        $rs->execute($param);
        return $rs->fetchAll();
    }

    public function get_by_pdo_category_query() {  //good without param
        return $this->pdo->query("SELECT * FROM category")->fetchAll();
    }

    public function get_by_pdo_brand_query() {  //good without param
        return $this->pdo->query("SELECT * FROM brand")->fetchAll();
    }

    public function get_by_pdo_color_query() {  //good without param
        return $this->pdo->query("SELECT * FROM color")->fetchAll();
    }

    public function get_by_pdo_size_query() {  //good without param
        return $this->pdo->query("SELECT * FROM size")->fetchAll();
    }

    public function get_by_pdo_all_item_query() {  //good without param
        return $this->pdo->query("SELECT * FROM item")->fetchAll();
    }
}