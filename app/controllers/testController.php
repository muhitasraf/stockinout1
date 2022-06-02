<?php

namespace App\Controllers;

use App\Models\testadd;
use Vendor\Valitron\Validator;
//use App\Models\ModelMysqli;

class testController extends Controller {
    private $address;

 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->address = new testadd();
    }

    public function dataf() {
        //$title = "Address New";
          return view('test/dataf');
      }

      public function save()
      {
         
        $v = new Validator($_POST);
        $v->rule('required', ['name', 'firstname','street','zip_code','city']);
        $v->rule('lengthBetween', 'name', 5, 50);
        $v->rule('lengthBetween', 'firstname', 5, 50);
        $v->rule('email', 'email');
        if($v->validate()) {
            $name = validation($_POST['name']);
            $firstname = validation($_POST['firstname']);
            $street = validation($_POST['street']);
            $zip_code = validation($_POST['zip_code']);
            $city = validation($_POST['city']);
            //$sql = "INSERT INTO address_book(name,firstname,street,zip_code,city) VALUES('$name','$firstname','$street','$zip_code','$city')";
            //$this->model->query($sql);
            //echo "Error: " . $sql . "<br>" . $this->model->error;
            
            $data = [
                'firstname'=>$name,
                'lastname'=>$firstname,
                'street'=>$street,
                'zipcode'=>$zip_code,
                'city'=>$city
            ];
            $rs = $this->address->table("test_book")->insert($data);
            if($rs) {
               //return redirect('testadd');
               echo("Data Inserted");
            }
            else {
                $rs->errorInfo();
            }
        } else {
           // return view('test/dataf');
           echo("Data Inserted");
        }
        
      }




}