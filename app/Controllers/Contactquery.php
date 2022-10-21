<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class Contactquery extends BaseController
{
    private $contact_queries_tbl = 'contact_queries';
    private $users_tbl = 'users';
    private $shortlinks_tbl = 'shortlinks';
    private $referals_tbl = 'referals';
    private $cpmsettings_tbl = 'cpmsettings';
    private $countries_tbl = 'countries';
    private $states_tbl = 'states';
    private $earnings_tbl = 'earnings';
    private $billingsettings_tbl = 'billingsettings';
    private $payment_information_tbl = 'payment_information';
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

        if(isset($_SESSION['user_login']['user_id'])){
            $where_user_earningdata = ['user_id' => $_SESSION['user_login']['user_id']];
            $earning_count = 0;  
            $db_earningsdata = array(
                "table" => $this->earnings_tbl,
                "where" => $where_user_earningdata,
                "order_by" => array("column"=>"ID", "order"=>"DESC")
            );
            $earnings_data = $this->CrudModel->getAnyItems($db_earningsdata);

            if(!empty($earnings_data)){
                foreach ($earnings_data as $k => $earn) {
                    $earning_count = $earning_count + $earn->earning;
                }
            }else{
                $earning_count = 0.0000;
            }
            $this->data['earning_count'] = $earning_count;
        }
        
    }
    
    public function index()
    {
        if(isset($_SESSION['user_login'])){
            $this->data['title'] = 'Contact Us';
            return render_userboard('users/contact_us', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }

    public function do_contact()
    {
        $input = $this->validate([
            'name' => 'required',
            'email_address' => 'required',
            'Subject'   => 'required',
            'msg' => 'required'

        ]);
                                    
        if ($input) {
            $name = $this->request->getPost('name');
            $email_address = $this->request->getPost('email_address');
            $Subject = $this->request->getPost('Subject');
            $msg = $this->request->getPost('msg');
            $phone = $this->request->getPost('phone');

            if(isset($name) && !empty($name)){
                
                    $update_data = array(
                        'name' => $name,
                        'email' => $email_address,
                        'phone'=> $phone,
                        'subject'=> $Subject,
                        'message'=> $msg,
                        'Status'=> '1',
                        'added_on' => date('Y-m-d h:i:s A')
                    );
                    $is_user_query_done = $this->CrudModel->insertItem($this->contact_queries_tbl, $update_data);
                
                    

                    if ($is_user_query_done) {   
                        $this->session->setFlashdata('success', 'Thank you for the information. Your Query is submitted Successfully.We will come back to you soon!');               
                        return redirect()->to('send-query');
                    }else {
                        $data = $email->printDebugger(['headers']);                         
                        $this->session->setFlashdata('error', 'Something Got wrong!');
                        return redirect()->to('send-query');
                    }                    
                
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->to('send-query');
            }       
        }else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->to('send-query');
        }
    }
    public function do_send_query()
    {
        $input = $this->validate([
            'name' => 'required',
            'emailid' => 'required',

        ]);
                                    
        if ($input) {
            $name = $this->request->getPost('name');
            $emailid = $this->request->getPost('emailid');
            $subject = $this->request->getPost('subject');
            $message = $this->request->getPost('message');
            $consent = $this->request->getPost('consent');

            if(isset($name) && !empty($name)){
                
                    $update_data = array(
                        'name' => $name,
                        'email_address' => $emailid,
                        'subject'=> $subject,
                        'message'=> $message,
                        'consent_agree'=>$consent,
                        'status'=> '1',
                        'dated_on' => date('Y-m-d h:i:s A')
                    );
                    $is_user_query_done = $this->CrudModel->insertItem($this->queriesfromhome_tbl, $update_data);
                
                    

                    if ($is_user_query_done) {   
                        $this->session->setFlashdata('success', 'Thank you for the information. Your Query is submitted Successfully.We will come back to you soon!');               
                        return redirect()->to('/');
                    }else {
                        $data = $email->printDebugger(['headers']);                         
                        $this->session->setFlashdata('error', 'Something Got wrong!');
                        return redirect()->to('/');
                    }                    
                
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->to('/');
            }       
        }else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->to('/');
        }
    }
    
   
}
