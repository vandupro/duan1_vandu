<?php
class info extends Controller
{
    private $contactModel;
    public function __construct()
    {
       
    }

    function index()
    {  
        $this->be_content = "./mvc/views/backend/info_admin/info.php";
        // $cateModel = $this->model('cateModel');
        // print_r($categories);
        $this->view('contact/index');
    }
    


   
}

