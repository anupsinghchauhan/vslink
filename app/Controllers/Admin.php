<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class Admin extends BaseController
{
    private $contact_queries_tbl = 'contact_queries';
    private $shortlinks_tbl = 'shortlinks';
    private $users_tbl = 'users';
    private $queriesfromhome_tbl = 'queriesfromhome';
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
    
    
    public function admin_dashboard()
    {
        if(isset($_SESSION['user_login'])){
        $where_data = ['Status' => '1','Role' => '2'];
        
        $db_data = array(
            "table" => $this->users_tbl,
            "where" => $where_data
        );

            $user_data = $this->CrudModel->getAnyItems($db_data);
            $this->data['users_data'] = $user_data;
            $this->data['title'] = 'Admin Dashboard';
            return render_userboard('admin/dashboard', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }

    public function user_queries()
    {
        if(isset($_SESSION['user_login'])){
        $where_data = ['Status' => '1'];
        
        $db_data = array(
            "table" => $this->contact_queries_tbl,
            "where" => $where_data
        );

            $queries_data = $this->CrudModel->getAnyItems($db_data);
            $this->data['queries_data'] = $queries_data;
            $this->data['title'] = 'User Queries';
            return render_userboard('admin/user_queries', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
    public function contact_queries()
    {
        if(isset($_SESSION['user_login'])){
        $where_data = ['Status' => '1'];
        
        $db_data = array(
            "table" => $this->queriesfromhome_tbl,
            "where" => $where_data
        );

            $queries_data = $this->CrudModel->getAnyItems($db_data);
            $this->data['queries_data'] = $queries_data;
            $this->data['title'] = 'User Queries';
            return render_userboard('admin/home_queries', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
    

public function do_reply()
{
        if(isset($_SESSION['user_login'])){
            $input = $this->validate([
            'email_address' => 'required',
            'reply_to_query' => 'required'

        ]);
                                    
        if ($input) {
            $email_address = $this->request->getPost('email_address');
            $reply_to_query = $this->request->getPost('reply_to_query');
            $name = $this->request->getPost('name');
            $date = $this->request->getPost('date');

            if(isset($name) && !empty($name)){
                
               
                    $email_config = Array(
                        'charset' => 'utf-8',
                        'mailType' => 'html'
                    );


                    $email = \Config\Services::email();
                    $email->initialize($email_config);

                    $email->setNewline("\r\n");
                    $email->setCRLF("\r\n");

                    $email->setTo($email_address);
                    $email->setFrom('verify@vslinq.com', 'VSlinQ - Reply To Your Query');
                            
                    $message = "<div style='font-family: Verdana,Geneva,sans-serif; font-size: 15px; background-color: #fff; color: #454545; margin: 0;'>
                                                    <p>Hello ".$name.",</p>
                                                    <p>You have sent us Query sent on ".$date."  , Here is the reply to it,</p>
                                                   
                                                    <p></p>
                                                    <p>".$reply_to_query."</a></p>

                                                <div style='font-size:16px;font-weight:600;'>
                                                    Thanks & Regards
                                                </div></div>";
                    $email->setSubject('VSlinQ - Reply To Your Query');
                    $email->setMessage($message);

                    if($email->send()){
                        $this->session->setFlashdata('success', 'Reply Sent Succesfully!');  
                        return redirect()->to('user-queries');
                    }else{
                        $data = $email->printDebugger(['headers']);                         
                        $this->session->setFlashdata('error', 'Something Got wrong!');
                        return redirect()->to('user-queries');
                    }
        
            }else{
                $this->session->setFlashdata('error', 'Something Got wrong!');
                return redirect()->to('user-queries');
            }
        }
    }

}
public function do_reply_onhome()
{
        if(isset($_SESSION['user_login'])){
            $input = $this->validate([
            'email_address' => 'required',
            'reply_to_query' => 'required'

        ]);
                                    
        if ($input) {
            $email_address = $this->request->getPost('email_address');
            $reply_to_query = $this->request->getPost('reply_to_query');
            $name = $this->request->getPost('name');
            $date = $this->request->getPost('date');

            if(isset($name) && !empty($name)){
                
               
                    $email_config = Array(
                        'charset' => 'utf-8',
                        'mailType' => 'html'
                    );


                    $email = \Config\Services::email();
                    $email->initialize($email_config);

                    $email->setNewline("\r\n");
                    $email->setCRLF("\r\n");

                    $email->setTo($email_address);
                    $email->setFrom('verify@vslinq.com', 'VSlinQ - Reply To Your Query');
                            
                    $message = "<div style='font-family: Verdana,Geneva,sans-serif; font-size: 15px; background-color: #fff; color: #454545; margin: 0;'>
                                                    <p>Hello ".$name.",</p>
                                                    <p>You have sent us Query sent on ".$date."  , Here is the reply to it,</p>
                                                   
                                                    <p></p>
                                                    <p>".$reply_to_query."</a></p>

                                                <div style='font-size:16px;font-weight:600;'>
                                                    Thanks & Regards
                                                </div></div>";
                    $email->setSubject('VSlinQ - Reply To Your Query');
                    $email->setMessage($message);

                    if($email->send()){
                        $this->session->setFlashdata('success', 'Reply Sent Succesfully!');  
                        return redirect()->to('contact-queries');
                    }else{
                        $data = $email->printDebugger(['headers']);                         
                        $this->session->setFlashdata('error', 'Something Got wrong!');
                        return redirect()->to('contact-queries');
                    }
        
            }else{
                $this->session->setFlashdata('error', 'Something Got wrong!');
                return redirect()->to('contact-queries');
            }
        }
    }

}
public function change_password()
    {
        if(isset($_SESSION['user_login'])){
           
            $this->data['title'] = 'Change Password';
            return render_userboard('admin/change_password', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
public function do_change_password()
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
                    return redirect()->to('change-password');
                }else if($new_pass != $confirm_new_pass){

                    $this->session->setFlashdata('error', 'New Password & Re-entered Password Must be same!');
                    return redirect()->to('change-password');
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




    /////////get data

    public function getcurrent_password(string $user_id){
        $where_data = ['user_id' => $user_id,'Status' => '1'];
        
        $db_data = array(
            "table" => $this->users_tbl,
            "where" => $where_data,
            "output" => 'row_array'
        );

        $user_data = $this->CrudModel->getAnyItems($db_data);

        return $user_data['visible_PWD'];
    }
   
}
