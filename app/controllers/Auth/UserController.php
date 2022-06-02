<?php
namespace App\Controllers\Auth;
use App\Controllers\Controller;
use App\Models\User;
use Vendor\Valitron\Validator;
use App\library\Upload;

class UserController  extends Controller {
    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->upload = new Upload();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Users";
        //$users = $this->user->table('users')->paged(2,1);
        //return view('user/index',compact('title','users'));
        $queryString = $_REQUEST;
        $page = $queryString['page'] ?? 1;
        $pageSize = 10;
        $users = $this->user->table('users');
        $total_records = $users->count();
        $total_page = ceil($total_records/$pageSize);
        $users = $users->paged($pageSize,$page);
        $roles = $this->roles_array();
        return view('user/index',compact('title','users','page','total_page','pageSize','roles'));
    }

    public function get_user_info(){
        $name = $_GET['name'];
        $users = $this->user->table('users')->where('user_name',$name)->fetch();
        $data='0';
        if(!empty($users)){
            $data=$users['user_name'];
        }
        else{
            $data='0';
        }
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New User";
        $roles = $this->roles_array();
        return view('user/create',compact('title','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $inputs
     * @return Response View
     */
    public function store()
    {
        $inputs = $_POST;
        $Profile_Photo =$_FILES['user_profile_photo'];
        $Profilepath = 'images/profile/';
        $v = new Validator($inputs);
        $v->rule('required', ['name','user_name','password']);
        $v->rule('alphaNum', 'user_name');
        $v->rule('lengthBetween', 'password', 5, 20);
        if($v->validate()) {
            $name = validation($inputs['name']);
            $email = validation($inputs['email']);
            $user_name = validation($inputs['user_name']);
            $password = validation($inputs['password']);
            $role = $inputs['role'];
            $IsActive = $inputs['IsActive'] ?? 0;
            if(!empty($Profile_Photo) && ($Profile_Photo['size'])<101000){
                if(empty($Profile_Photo['error']))
                {
                    $Profile_Photo = $user_name . '-' . 'profile.jpg';
                    $emPhoto = $this->upload->make('user_profile_photo');
                    $emPhoto->save(upload_path($Profilepath . $Profile_Photo));   
                   
                }
            }
            $user_info = [
                'user_name' => $user_name
            ];
            if (!$this->user->table('users')->where($user_info)->count()) {
                $user_info = [
                    'name' => $name,
                    'email' => $email,
                    'user_name' => $user_name,
                    'password' => bcrypt($password),
                    'role_id' => $role,
                    'is_active' => $IsActive,
                    'user_image' => $Profile_Photo
                ];
                // dd($user_info);
                $rs = $this->user->table('users')->insert($user_info,'prepared');
                if($rs) {
                    notification(['type'=>'success', 'message'=>'Created Successfully']);
                }
                else {
                    $errors = $rs->errorInfo();
                }
            }
            else {
                $errors = [
                    'user_name' => ['User name is already exists.']
                ];
            }
        } else {
            $errors = $v->errors();
        }
        $with = [
            'errors' => $errors ?? '',
            'inputs' => $_REQUEST
        ];
        //myLog(json_encode($with));
        return redirect('user/create',['with'=>$with]);//->with($inputs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return View
     */
    public function edit($id = null)
    {
        $title = "Update user";
        $user = $this->user->table("users")->where('id',$id)->fetch();
        $roles = $this->roles_array();
        return view('user/edit',compact('title','user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  shiftRuleId
     * @return View
     */
    public function update($id=null)
    {
        $inputs = $_POST;
        $Profile_Photo =$_FILES['user_profile_photo'];
        $Profilepath = 'images/profile/';
        $v = new Validator($inputs);
        $v->rule('required', ['name','user_name']);
        $v->rule('alphaNum', 'user_name');
        $v->rule('lengthBetween', 'password', 5, 20);
        if($v->validate()) {
            $name = validation($inputs['name']);
            $email = validation($inputs['email']);
            $user_name = validation($inputs['user_name']);
            $password = validation($inputs['password']);
            $role = $inputs['role'];
            $IsActive = $inputs['IsActive'] ?? 0;
            if(!empty($Profile_Photo) && ($Profile_Photo['size'])<101000){
                if(empty($Profile_Photo['error']))
                {
                    $Profile_Photo = $user_name . '-' . 'profile.jpg';
                    $emPhoto = $this->upload->make('user_profile_photo');
                    $emPhoto->save(upload_path($Profilepath . $Profile_Photo));   
                }
            }
            $user_info = [
                'user_name' => $user_name
            ];
            $user = $this->user->table('users')->where($user_info);
            if (!$user->whereNot('id',$id)->count()) {
                $user_info = [
                    'name' => $name,
                    'email' => $email,
                    'user_name' => trim($user_name),
                    'password' => bcrypt($password),
                    'role_id' => $role,
                    'is_active' => $IsActive,
                    'user_image' => $Profile_Photo
                ];
                //dd($user_info);
                if (!$password) {
                    unset($user_info['password']);
                }
                $rs = $this->user->table('users',$id)->update($user_info,'prepared');
                if($rs) {
                    notification(['type'=>'success', 'message'=>'Updated Successfully']);
                }
                else {
                    $errors = $rs->errorInfo();
                }
            }
            else {
                $errors = [
                    'user_name' => ['User name is already exists.']
                ];
            }
        } else {
            $errors = $v->errors();
        }
        $with = [
            'errors' => $errors ?? '',
            'inputs' => $_REQUEST
        ];
        return redirect('user/edit/'.$id,['with'=>$with]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return View
     */
    public function destroy($id=null) {
        if($id) {
            $user = $this->user->table("users",$id)->delete();
            if($user) {
                notification(['type'=>'success', 'message'=>'Deleted Successfully']);
            }
            else {
                $errors = $user->errorInfo();
            }
        }
        else {
            notification(['type'=>'danger', 'message'=>'There is something wrong.']);
        }
        $with = [
            'errors' => $errors ?: ''
        ];
        return redirect('user/index',['with'=>$with]);
    }

    private function roles_array()
    {
        $roles = $this->user->table('roles')->fetchAll();
        $roles_array = [];
        foreach ($roles as $key=>$row) {
            $roles_array[$row->id] = $row->title;
        }
        return $roles_array;
    }
}
