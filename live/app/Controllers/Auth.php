<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class Auth extends BaseController
{
    private $users_tbl = 'users';
    private $loginlog_tbl = 'loginlog';
    private $shortlinks_tbl = 'shortlinks';
    private $viewcount_tbl = 'viewcount';
    private $countries_tbl = 'countries';
    private $states_tbl = 'states';
    private $billingsettings_tbl = 'billingsettings';
    private $earnings_tbl = 'earnings';
    private $cpmsettings_tbl = 'cpmsettings';
    private $referals_tbl = 'referals';
    private $payment_information_tbl = 'payment_information';
    function __construct()
    {
        helper(['form','security','common']);

        // DB Connection
        $this->db = \Config\Database::connect();
        $this->CrudModel = new CrudModel($this->db);
        
        // Init Session
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->data['session'] = $this->session;

        // Init Form Validation
        $this->validation = \Config\Services::validation();
        $this->data['validation'] = $this->validation;
        
    }
   
    public function login()
    {
        $this->data['title'] = 'Login';
        return view('login', $this->data);
    }
    public function do_login()
    {

        $input = $this->validate([
            'emailid' => 'required',
            'password' => 'required'
        ]);
        if ($input) {
            $emailid = $this->request->getPost('emailid');
            $password = sha1($this->request->getPost('password'));
            
            $where_data = ['email' => $emailid, 'verification_key' => '1','Status' => 1];
            $db_data = array(
                "table" => $this->users_tbl,
                "where" => $where_data,
                "output"=>'row_object'
            );
            $admin_data_login = $this->CrudModel->getAnyItems($db_data);
            
            if(!empty($admin_data_login)){
                // Set admin session
                $where_verify = ['email' => $emailid, 'password' => $password, 'Status' => 1];
                $db_verify = array(
                    "table" => $this->users_tbl,
                    "where" => $where_verify,
                    "output"=>'row_object'
                );

                $admin_data = $this->CrudModel->getAnyItems($db_verify);
                if(!empty($admin_data)){
                    $userData['user_login'] = [
                        'user_id'  => $admin_data->user_id,
                        'Fullname'  => $admin_data->name,
                        'Username'  => $admin_data->username,
                        'Email_ID'  => $admin_data->email,
                        'referralcode' =>$admin_data->referalCode,
                        'agreement'  => $admin_data->agreement,
                        'temp_link' => '',
                        'user_ip'=>get_client_ip(),
                        'Role' => $admin_data->Role
                    ];
                    $Login_data = array(
                        'user_id' => $userData['user_login']['user_id'],
                        'user_ip' => get_client_ip(),
                        'logintime'=>date('h:i:s'),
                        'logindate'=>date('Y-m-d')
                        
                    );
                
                    $is_login_log = $this->CrudModel->insertItem($this->loginlog_tbl, $Login_data);
                    $this->session->set($userData);
                    if($_SESSION['user_login']['Role'] == '2'){
                        return redirect()->route('dashboard');
                    }else if($_SESSION['user_login']['Role'] == '1'){
                        return redirect()->route('admin-dashboard');
                    }else{
                        $this->session->destroy();
                        $this->session->setFlashdata('error', 'You need to have User profile On Platform');
                        return redirect()->route('index');
                    }
                }else{
                    $this->session->setFlashdata('error', 'Invalid Credentials');
                    $this->data['title'] = 'Login';
                    return view('login', $this->data);
                }  
            }else{
                $this->session->setFlashdata('error', 'Please verify your email first. Go to your registered email and click on verification link.');
                $this->data['title'] = 'Login';
                return view('login', $this->data);
            }
        } else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->route('index');
        }
        
    }
    public function register()
    {
        $this->data['title'] = 'Register';
       
        $referralcode = '';

        if(isset($_GET)){
            
            if(isset($_GET['referral'])){
                $referralcode = decryptor($_GET['referral']);
            }else{
                $referralcode = '';
            }
        }
        $this->data['referralcode'] = $referralcode;
        return view('register', $this->data);
    }
    public function do_register()
    {
        $input = $this->validate([
            'name' => 'required',
            'emailid' => 'required',
            'password'   => 'required',
            'agreement' => 'required'

        ]);
                                    
        if ($input) {
            $name = $this->request->getPost('name');
            $emailid = $this->request->getPost('emailid');
            $referal = $this->request->getPost('referal');
            $password = $this->request->getPost('password');
            $agreement = $this->request->getPost('agreement');

            $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
            $userreferalCode = substr(str_shuffle($str_result), 0, 8); 
            
            
            if(isset($name) && !empty($name)){
                $str_result1 = '01234567890987654321abcdefghijklmnopqrstuvwxyz';
                $user_id= substr(str_shuffle($str_result1), 0, 6);


                //random three digit number
                $nrRand = rand(0, 99);

                //final username
                $username = $name."-0".$nrRand;

                
                $where_userdata = ['email'=> $emailid];

                $db_userdata = array(
                    "table" => $this->users_tbl,
                    "where" => $where_userdata,
                    "output" => 'row_object'
                );
            
                $user_data = $this->CrudModel->getAnyItems($db_userdata);

                if(!empty($user_data)){
                    $this->session->setFlashdata('error', 'You have already Registered with this email address, please try another one!');
                    return redirect()->route('register');
                }else{

                    if($referal){
                        $wherereferral = ['referalCode' => $referal];
                        $db_userdataonreferral = array(
                            "table" => $this->users_tbl,
                            "where" => $wherereferral,
                            "output" => 'row_object'
                        );
                
                        $userreferral_data = $this->CrudModel->getAnyItems($db_userdataonreferral);

                        if(!empty($userreferral_data)){
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < 32; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            $update_data = array(
                                'user_id' => $user_id,
                                'name' => $name,
                                'username'=> $username,
                                'email'=> $emailid,
                                'referalCode'=>$userreferalCode,
                                'password'=> sha1($password),
                                'visible_PWD' => $password,
                                'Role' => '2',
                                'verification_key' => $randomString,
                                'agreement' => $agreement,
                                'Status'=> '1',
                                'registered_on' => date('Y-m-d h:i:s A')
                            );
                            $is_user_registered = $this->CrudModel->insertItem($this->users_tbl, $update_data);
                            
                            $update_referaldata = array(
                                'username' => $user_id,
                                'refercode' => $referal,
                                'referalOwner'=> $userreferral_data->user_id,
                                'Status'=> '1',
                                'Added_on' => date('Y-m-d h:i:s A')
                            );
                            $is_referal_added = $this->CrudModel->insertItem($this->referals_tbl, $update_referaldata);

                            $update_cpmdata = array(
                                'user_id' => $user_id,
                                'AVG_CPM' => '2.5 for 5 sec',
                                'Status'=> '1',
                            );
                            $is_cpm_added = $this->CrudModel->insertItem($this->cpmsettings_tbl, $update_cpmdata);

                            $email_config = Array(
                                'charset' => 'utf-8',
                                'mailType' => 'html'
                            );


                            $email = \Config\Services::email();
                            $email->initialize($email_config);

                            $email->setNewline("\r\n");
                            $email->setCRLF("\r\n");

                            $email->setTo($emailid);
                            $email->setFrom('verify@vslinq.com', 'VSlinQ - Verify Your Email');
                                    
                            $message = "<div style='font-family: Verdana,Geneva,sans-serif; font-size: 15px; background-color: #fff; color: #454545; margin: 0;'>
                                                            <p>Hello ".$name.",</p>
                                                            <p>Please verify your email to proceed further with the Link Shortening.</p>
                                                            <p>Click below link to verify your email.</p>
                                                            <p></p>
                                                            <p><a href=".base_url('/verification?email='.$emailid.'&key='.$randomString)." target='_blank'>Verify your email</a></p>

                                                        <div style='font-size:16px;font-weight:600;'>
                                                            Thanks & Regards
                                                        </div></div>";
                            $email->setSubject('VSlinQ - Verify Your Email');
                            $email->setMessage($message);

                            if ($email->send() && $is_user_registered) {   
                                $this->session->setFlashdata('success', 'Thank you for the information. You have Registered Successfully.Please check your email and verify it for further use of the platform!');               
                                $this->data['title'] = 'Register';
                                return view('register', $this->data);
                            }else {
                                $data = $email->printDebugger(['headers']);                         
                                $this->session->setFlashdata('error', 'Something Got wrong!');
                                $this->data['title'] = 'Register';
                                return view('register', $this->data);
                            } 
                        }else{
                            $this->session->setFlashdata('error', 'You have entered wrong referral code or User from which you have taken referral is inactive Right Now , Kindly Use another Referral !');
                            return redirect()->to('register');
                        }
                    }else{
                        $this->session->setFlashdata('error', 'You must have to enter referral code from whom you have taken referral, Kindly Use That Referral code !');
                        return redirect()->to('register');
                    }                 
                }
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                $this->data['title'] = 'Register';
                return view('register', $this->data);
            }       
        }else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            $this->data['title'] = 'Register';
            return view('register', $this->data);
        }
    }

    public function verification()
    {
        $key = $_GET['key'];
        $email = $_GET['email'];
        $where_data = ['email' => $email, 'verification_key' => $key];
        $LoginLog = array(
            "table" => $this->users_tbl,
            "where" => $where_data,
            "output" => 'row_object'
        );            
        $Login = $this->CrudModel->getAnyItems($LoginLog);
        
        if ($Login) { 
            $where_update = ['email' => $email, 'verification_key' => $key];
            $Login_data = array(
                'verification_key' => '1'
            );
                    
            $is_saved = $this->CrudModel->updateItem($this->users_tbl, $where_update, $Login_data);
            if($is_saved){
                $this->session->setFlashdata('success', 'You have successfully verified your email.Please login to go further.');             
                $this->data['title'] = 'Login';
                return view('login', $this->data);
            }else{
                $this->session->setFlashdata('error', 'Something Got wrong!');
                $this->data['title'] = 'Login';
                return view('login', $this->data);
            }
            
        }else {                       
            $this->session->setFlashdata('error', 'Something Got wrong!');
            $this->data['title'] = 'Login';
            return view('login', $this->data);
        }
       
    }
    public function change_password()
    {   
        $input = $this->validate([
            'new_pass'=>'required',
            'confirm_new_pass'=>'required'
        ]);
            
        if ($input) {
            $current_pass = $this->request->getPost('current_pass');
            $new_pass = $this->request->getPost('new_pass');
            $confirm_new_pass = $this->request->getPost('confirm_new_pass');
            $user_id = $_SESSION['user_login']['user_id'];
            
            $where_userdata = ['user_id' => $user_id];

            
            if(isset($user_id) && !empty($user_id)){
            
                $db_userdata = array(
                    "table" => $this->users_tbl,
                    "where" => $where_userdata,
                    "output"=>'row_object'
                );
                $admin_data = $this->CrudModel->getAnyItems($db_userdata);
                if($new_pass == $current_pass){

                    $this->session->setFlashdata('error', 'New Password & Old Password is same!try different password!');
                    return redirect()->to('settings');
                }else if($new_pass != $confirm_new_pass){

                    $this->session->setFlashdata('error', 'New Password & Re-entered Password Must be same!');
                    return redirect()->to('settings');
                }else{
                   
                    $update_admindata = array(
                        'password' => sha1($new_pass),
                        'visible_PWD' => $new_pass,
                    );
                    $is_user_admined = $this->CrudModel->updateItem($this->users_tbl,$where_userdata, $update_admindata);
                    
                }
                
                if ($is_user_admined) {
                    $this->session->setFlashdata('success', 'You have Updated your Password successfully!Login with new password');
                    return redirect()->to('login');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('login');
                }
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->to('login');
            }
        
        }
    }
    public function change_email()
    {   
        $input = $this->validate([
            'new_email'=>'required',
            'confirm_new_email'=>'required'
        ]);
            
        if ($input) {
            $current_email = $this->request->getPost('current_email');
            $new_email = $this->request->getPost('new_email');
            $confirm_new_email = $this->request->getPost('confirm_new_email');
            $user_id = $_SESSION['user_login']['user_id'];
            
            $where_userdata = ['user_id' => $user_id];

            
            if(isset($user_id) && !empty($user_id)){
            
                $db_userdata = array(
                    "table" => $this->users_tbl,
                    "where" => $where_userdata,
                    "output"=>'row_object'
                );
                $admin_data = $this->CrudModel->getAnyItems($db_userdata);
                if($new_email == $current_email){

                    $this->session->setFlashdata('error', 'New Email & Old Email is same!try different Email!');
                    return redirect()->to('settings');
                }else if($new_email != $confirm_new_email){

                    $this->session->setFlashdata('error', 'New Email & Re-entered Email Must be same!');
                    return redirect()->to('settings');
                }else{
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 32; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $update_data = array(
                        'email'=> $new_email,
                        'verification_key' => $randomString
                    );
                    $is_user_updated = $this->CrudModel->updateItem($this->users_tbl,$where_userdata, $update_data);
                
                    $email_config = Array(
                        'charset' => 'utf-8',
                        'mailType' => 'html'
                    );


                    $email = \Config\Services::email();
                    $email->initialize($email_config);

                    $email->setNewline("\r\n");
                    $email->setCRLF("\r\n");

                    $email->setTo($new_email);
                    $email->setFrom('verify@vslinq.com', 'VSlinQ - Verify Your Email');
                            
                    $message = "<div style='font-family: Verdana,Geneva,sans-serif; font-size: 15px; background-color: #fff; color: #454545; margin: 0;'>
                                                    <p>Hello ".$admin_data->name.",</p>
                                                    <p>Please verify your email to proceed further with the Link Shortening.</p>
                                                    <p>Click below link to verify your email.</p>
                                                    <p></p>
                                                    <p><a href=".base_url('/verification?email='.$new_email.'&key='.$randomString)." target='_blank'>Verify your email</a></p>

                                                <div style='font-size:16px;font-weight:600;'>
                                                    Thanks & Regards
                                                </div></div>";
                    $email->setSubject('VSlinQ - Verify Your Email');
                    $email->setMessage($message);

                    if ($email->send() && $is_user_updated) {   
                        $this->session->setFlashdata('success', 'Thank you for the information. You have changed Email Successfully.Please check your email and verify it for further use of the platform!');               
                        return redirect()->to('login');
                    }else {
                        $data = $email->printDebugger(['headers']);                         
                        $this->session->setFlashdata('error', 'Something Got wrong!');
                        return redirect()->to('settings');
                    }       
                }
                 
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->to('login');
            }
        
        }
    }
    public function forgot_password()
    {
        $this->data['title'] = 'Forgot Password';
        return view('forgot_password', $this->data);
    }
    public function doget_pwdlink()
    {   
        $input = $this->validate([
            'emailid' => 'required'
        ]);
                                    
        if ($input) {
            $emailid = $this->request->getPost('emailid');
            $where_id = ['email'=>$emailid];
            if(isset($emailid) && !empty($emailid)){

                $db_data = array(
                    "table" => $this->users_tbl,
                    "where" => $where_id,
                    "output"=>'row_object'
                );


                $admin_data = $this->CrudModel->getAnyItems($db_data);

                $email_config = Array(
                    'charset' => 'utf-8',
                    'mailType' => 'html'
                );

                $email = \Config\Services::email();
                $email->initialize($email_config);

                $email->setNewline("\r\n");
                $email->setCRLF("\r\n");

                $email->setTo($emailid);
                $email->setFrom('change@vslinq.com', 'Change Forgot Password');
                        
                $message = "<div style='font-family: Verdana,Geneva,sans-serif; font-size: 15px; background-color: #fff; color: #454545; margin: 0;'>
                                                <p>Hello ".$emailid.",</p>
                                                <p>Welcome Back , Kindly use Below link for changing your password .</p>
                                                ".base_url('/change-pwd/'.encryptor($emailid))."

                                            <div style='font-size:16px;font-weight:600;'>
                                                Thanks & Regards
                                            </div></div>";
                $email->setSubject('Change Forgot Password');
                $email->setMessage($message);
                if(!empty($admin_data)){
                    $sendemail = $email->send();
                }else{
                    $this->session->setFlashdata('error', 'Your entered email is not registered with us , Please use Registered Email Address!');
                    return redirect()->to('login');
                }

                if ($sendemail) {   
                    $this->session->setFlashdata('success', 'Thank you for the information. Email will arrive shortly to change password.');                
                    return redirect()->to('login');
                }else {
                    $data = $email->printDebugger(['headers']);                         
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('login');
                }
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->to('login');
            }       
        }else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->to('login');
        }
    }
    public function changePWD($emailID)
    {   
        $emailID = decryptor($emailID); 
        $this->data['title'] = 'Change Password';
        $this->data['emailID'] = $emailID;
        return view('changePWD', $this->data);
    }
    public function do_changePWD()
    {   
        $input = $this->validate([
            'newpassconfirm' => 'required',
            'newpass'=>'required',
            'user_id'=>'required'
        ]);
            
        if ($input) {
            $oldpass = $this->request->getPost('oldpass');
            $newpass = $this->request->getPost('newpass');
            $newpassconfirm = $this->request->getPost('newpassconfirm');
            $user_id = $this->request->getPost('user_id');
            
            $where_userdata = ['email' => $user_id];

            
            if(isset($user_id) && !empty($user_id)){
            
                $db_userdata = array(
                    "table" => $this->users_tbl,
                    "where" => $where_userdata,
                    "output"=>'row_object'
                );
                $admin_data = $this->CrudModel->getAnyItems($db_userdata);
                if($newpass != $newpassconfirm){

                    $this->session->setFlashdata('error', 'New Password & Confirm Password Must be same!');
                    return redirect()->to('changePWD/'.encryptor($user_id));
                }else{
                   

                    $update_admindata = array(
                        'password' => sha1($newpass),
                        'visible_PWD' => $newpass
                    );
                    $is_user_pwdchanged = $this->CrudModel->updateItem($this->users_tbl,$where_userdata, $update_admindata);
                    
                }
                
                if ($is_user_pwdchanged) {
                    $this->session->setFlashdata('success', 'You have Updated your Password successfully!Login with new password');
                    return redirect()->to('login');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('login');
                }
            }else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->to('login');
        }
        
    }
    }

    //Logout mgmt control================================================================================================================================================================
    public function logout_function()
    {
        $where_data = ['user_id' => $_SESSION['user_login']['user_id']];
        $LoginLog = array(
                "table" => $this->loginlog_tbl,
                "where" => $where_data,
                "output" => 'row_object'
            );  

        $Login = $this->CrudModel->getAnyItems($LoginLog);
        

        $Login_data = array(
            'logoutdate'=>date('Y-m-d'),
            'logouttime'=>date('h:i:s')
        );
                
        $is_saved = $this->CrudModel->updateItem($this->loginlog_tbl, $where_data, $Login_data);

        if($this->session->destroy()){
            $this->data['title'] = 'Home';
            return render_frontend('index', $this->data);
        }else{
            $this->data['title'] = 'Home';
            return render_frontend('index', $this->data);
        }
        
       
    }

    //--------------------------------------------------------------------
}
