<?php

class register extends Controller
{   
    private $cateModel;
    private $slideModel;
    private $infoModel;
    private $userModel;

        public function __construct()
        {
            $this->cateModel = $this->model('cateModel');
            $this->slideModel = $this->model('slideModel');
            $this->infoModel = $this->model('infoModel');
            $this->userModel = $this->model('userModel');
        }

    function index(){
        $message = '';
        $role=0;
        $pattern = ['user_name' => '', 'user_password' => '', 'user_email' => '',];
        if (isset($_POST['btn-users'])) {
            extract($_REQUEST);
            $pattern['user_name'] = "/([^\d]*)\s([^\d]*)/i";
            $pattern['user_email'] = "/^(\w+@\gmail)(\.\w{2,})$/i";
            $pattern['user_password'] = "/^[a-z0-9]{6,}$/i";

            if ($user_name == "") {
                $message = "Mời nhập họ và tên";
            } else if (preg_match($pattern['user_name'], $user_name) == 0) {
                $message = "nhap ten ko dung vd: Nguyên Văn A";
            }  else if ($user_email == "") {
                $message = "Mời nhập email";
            } else if (preg_match($pattern['user_email'], $user_email) == 0) {
                $message = "Nhap email ko dung";
            } else if ($user_password == "") {
                $message = "Mời nhập password";
            } else if (preg_match($pattern['user_password'], $user_password) == 0) {
                $message = "Nhap mật khẩu chứa  tối đa 10 ký tự, không chưa ký tự đặc biệt !";
            } else if ($user_password != $user_password2) {
                $message = "Mật khẩu xác nhận không đúng";
            } 
            else if ($message == '') {
                $this->userModel->user_insert_dk($user_name, $user_email, $user_password, $role, $created_at);
                if ($this->userModel->message == 'flase') {
                    $message = 'Thêm user thất bại';
                } else {
                    $message = 'Thêm user thành công';
                }
            }
        
            
            
        }
echo $message;


        $categories = $this->cateModel->getCateAll();
        $slides = $this->slideModel->getSlidepAll();
        $this->fe_content = VIEW_URL."/frontend/sites/register.php";
        $this->menu = VIEW_URL."/frontend/layout/menu2.php";
        $info = $this->infoModel->getInfoAll();
        $this->view_fe('main/index', [
            'categories'=>$categories,
            'slides'=>$slides,
            'info'=>$info,
            'message' => $message
        ]);
    }
}
?>