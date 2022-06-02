<?php
    namespace App\Controllers;

use App\Models\Dashboard;

class DashboardController extends Controller {
    private $dashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->dashboard = new Dashboard();
    }

    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        $title = "Dashboard";
        

        return view('dashboard/index',compact('title'));
    }
}
