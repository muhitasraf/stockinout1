<?php

namespace App\Controllers;

use App\Models\Model;
use App\Models\DataShowModel;
use Vendor\Valitron\Validator;
//use App\Models\ModelMysqli;

class DataShowController extends Controller {
    public $dataShow;

    public function __construct() {
        $this->dataShow = new DataShowModel();
    }

    public function index(){
        $dataShow = $this->dataShow->select("item")->fetchAll();
        return view('ecommerce/index',['all_item'=>$dataShow]);
    }

    public function insertajax(){
        
        $title = "Address New";
        $category = $this->dataShow->get_by_pdo_category_query();
        $brand = $this->dataShow->get_by_pdo_brand_query();
        $color = $this->dataShow->get_by_pdo_color_query();
        $size = $this->dataShow->get_by_pdo_size_query();

        return view('ecommerce/insert',compact('category','brand','color','size','title'));
    }

    public function ajxreqdata($cat_id = null){
        $selected_subcat = $this->dataShow->query("SELECT id, subcat_name FROM sub_category where id = '$cat_id'")->fetchAll();
        echo json_encode(['selected_subcat'=>$selected_subcat]);
    }

    public function store() {
        $v = new Validator($_POST);
        $v->rule('required', ['item_name', 'item_price','brand_name','category_name','color_name','size_name']);
        
        if($v->validate()) {
            $item_name = validation($_POST['item_name']);
            $item_price = validation($_POST['item_price']);
            $brand_id = validation($_POST['brand_name']);
            $category_id = validation($_POST['category_name']);
            $color_id = validation($_POST['color_name']);
            $size_id = validation($_POST['size_name']);

            $data = [
                'item_name'=>$item_name,
                'item_price'=>$item_price,
                'brand_id'=>$brand_id,
                'category_id'=>$category_id,
                'color_id'=>$color_id,
                'size_id'=>$size_id,
            ];

            //echo $item_name;
            $insert_item = $this->dataShow->table("item")->insert($data);

            if($insert_item) {
                return redirect('ecommerce');
            }
            else {
                $insert_item->errorInfo();
            }
        } else {
            return view('ecommerce/index',['data'=>$data]);
        }
    }


    public function stockin(){
        $all_item = $this->dataShow->get_by_pdo_all_item_query();
        return view('ecommerce/stockin',['all_item'=>$all_item]);
    }

    public function storestock(){
        $v = new Validator($_POST);
        $v->rule('required', ['item_name','quantity']);
        
        if($v->validate()) {
            $item_name = validation($_POST['item_name']);
            $quantity = validation($_POST['quantity']);
            $stock_in_date = date("Y:m:d");
            $stock_in_time = date("h:i:s");
            $data = [
                'item_id'=>$item_name,
                'quantity'=>$quantity,
                'stock_in_date'=>$stock_in_date,
                'stock_in_time'=>$stock_in_time,
            ];

            $insert_item = $this->dataShow->table("stock_out")->insert($data);

            if($insert_item) {
                return redirect('ecommerce');
            }
            else {
                $insert_item->errorInfo();
            }
        } else {
            //$err = "Something going wrong...!";
            return view('ecommerce/index');
        }
    }

    public function stockout(){
        $all_item = $this->dataShow->get_by_pdo_all_item_query();
        return view('ecommerce/stockout',['all_item'=>$all_item]);
    }

    public function updatestock(){
        $v = new Validator($_POST);
        $v->rule('required', ['quantity']);
        
        if($v->validate()) {
            $quantity = validation($_POST['quantity']);
            $stock_in_date = date("Y:m:d");
            $stock_in_time = date("h:i:s");
            $old_quantity = $this->dataShow->table("stock_out")->fatchAll();
            $quantity = $quantity + $old_quantity;
            
            $data = [
                'item_id'=>$item_name,
                'quantity'=>$quantity,
            ];

            $row = $this->dataShow->table("stock_out",$id);
            $row->update($data);

            if($insert_item) {
                return redirect('ecommerce');
            }
            else {
                $insert_item->errorInfo();
            }
        } else {
            //$err = "Something going wrong...!";
            return view('ecommerce/index');
        }
    }

    public function edit($id=null) {
        $row = $this->dataShow->table("students_info",$id);
        if(!empty($row)){
            return view('curd/edit',['student'=>$row]);
        }else{
            echo 'Data not found.';
        }
    }

    public function update($id=null) {
        if(isset($id)){
            $name = validation($_POST['name']);
            $roll = validation($_POST['roll']);
            $class = validation($_POST['class']);
            
            $data = [
                'name'=>$name,
                'roll'=>$roll,
                'class'=>$class,
            ];

            $row = $this->dataShow->table("students_info",$id);
            $row->update($data);
            return redirect('curd');
        }
        else {
            echo 'Update id not found.';
        }
    }

    public function delete($id=null) {
        if(isset($id)) {
            $row = $this->dataShow->table("students_info",$id)->delete();
            if($row) {
                return redirect('curd');
            }
            else {
                echo "Error: on " . $row->errorInfo();
            }
        }
        else {
            echo 'Update id not found.';
        }
    }
}