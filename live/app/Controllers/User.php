<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class User extends BaseController
{
    private $shortlinks_tbl = 'shortlinks';
    private $users_tbl = 'users';
    private $referals_tbl = 'referals';
    private $cpmsettings_tbl = 'cpmsettings';
    private $countries_tbl = 'countries';
     private $viewcount_tbl = 'viewcount';
    private $states_tbl = 'states';
    private $earnings_tbl = 'earnings';
    private $billingsettings_tbl = 'billingsettings';
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
            $this->data['title'] = 'Dashboard';
            return render_userboard('users/index', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
    
    public function manage_links()
    {
        if(isset($_SESSION['user_login'])){
           // print_r($_SESSION['user_login']);
            $where_data = ['Status' => 1, 'user_id' => $_SESSION['user_login']['user_id']];
            $db_data = array(
                "table" => $this->shortlinks_tbl,
                "where" => $where_data,
                "order_by" => array("column"=>"created_on", "order"=>"DESC")
            );


            $links_data = $this->CrudModel->getAnyItems($db_data);

            $this->data['links_data'] = $links_data;
            $this->data['title'] = 'Manage Links';
            return render_userboard('users/manage_links', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }

    public function statistics()
    {
        if(isset($_SESSION['user_login'])){
           // print_r($_SESSION['user_login']);
            $where_data = ['Status' => 1, 'user_id' => $_SESSION['user_login']['user_id']];
            $viewcounts_perdate = 0;
            $db_data = array(
                "table" => $this->viewcount_tbl,
                "where" => $where_data,
                "group_by" => array("column"=>"viewed_on", "order"=>"DESC")
            );


            $views_data = $this->CrudModel->getAnyItems($db_data);

            foreach ($views_data as $key => $value) {
                $viewcounts_perdate = $viewcounts_perdate + $value->count;
            }


            $query_group = $this->db->query('SELECT YEAR(viewed_on) AS y, MONTH(viewed_on) AS m, DAY(viewed_on) AS d, SUM(count) as c,viewed_on,count FROM vslink_tblviewcount WHERE Status = 1 AND user_id = "'.$_SESSION['user_login']['user_id'].'" GROUP BY y, m,d');
            $monthwisedate = $query_group->getResult();
            
            $this->data['monthwisedate'] = $monthwisedate;
            $this->data['views_data'] = $views_data;
            $this->data['viewcounts_perdate'] = $viewcounts_perdate;
            $this->data['title'] = 'Statistics';
            return render_userboard('users/statistics', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }

    public function settings()
    {
        if(isset($_SESSION['user_login'])){
            $db_data = array(
                "table" => $this->countries_tbl
            );

            $countries_data = $this->CrudModel->getAnyItems($db_data);
            

            $this->data['countries_data'] = $countries_data;
            
            $where_billing_data = ['user_id' => $_SESSION['user_login']['user_id']];

            $db_billingdata = array(
                "table" => $this->billingsettings_tbl,
                "where" => $where_billing_data,
                "output" => 'row_object'
            );

            $billing_data = $this->CrudModel->getAnyItems($db_billingdata);

            $this->data['billing_data'] = $billing_data;

            $user_id = $_SESSION['user_login']['user_id'];
            $where_payment_data = ['user_id' => $user_id];
            $db_paymentdata = array(
                "table" => $this->payment_information_tbl,
                "where" => $where_payment_data,
                "output" => 'row_object'
            );

            $payment_info_data = $this->CrudModel->getAnyItems($db_paymentdata);

            $this->data['payment_info_data'] = $payment_info_data;

            $where_statedata = ['country_id ' => $billing_data->country];
        
            $db_statesdata = array(
                "table" => $this->states_tbl,
                "where" => $where_statedata
            );

            $states_data = $this->CrudModel->getAnyItems($db_statesdata);
            $this->data['states_data'] = $states_data;
            $this->data['countries_data'] = $countries_data;
            $this->data['title'] = 'Settings';
            return render_userboard('users/settings', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
    public function withdraw()
    {
        if(isset($_SESSION['user_login'])){
           
            $this->data['title'] = 'Withdraw';
            return render_userboard('users/withdraw', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
    public function referal()
    {
        if(isset($_SESSION['user_login'])){
           // print_r($_SESSION['user_login']);
            $where_data = ['Status' => 1, 'referalOwner' => $_SESSION['user_login']['user_id']];
            $db_data = array(
                "table" => $this->referals_tbl,
                "where" => $where_data,
                "order_by" => array("column"=>"Added_on", "order"=>"DESC")
            );


            $referrals_data = $this->CrudModel->getAnyItems($db_data);

            $this->data['referrals_data'] = $referrals_data;
            $this->data['title'] = 'Refer A Friend';
            return render_userboard('users/referal', $this->data);
        }else{
            $this->data['title'] = 'Login';
            return view('login', $this->data);  
        }
    }
    public function cpm_settings()
    {   
        $input = $this->validate([
            'cpm_settings'=>'required'
        ]);
            
        if ($input) {
            $cpm_settings = $this->request->getPost('cpm_settings');
           
            $user_id = $_SESSION['user_login']['user_id'];
            
            $where_userdata = ['user_id' => $user_id];

            
            if(isset($user_id) && !empty($user_id)){
            
                $db_userdata = array(
                    "table" => $this->users_tbl,
                    "where" => $where_userdata,
                    "output"=>'row_object'
                );
                $admin_data = $this->CrudModel->getAnyItems($db_userdata);
                if($cpm_settings == '4 for 14 sec'){
                    $this->session->setFlashdata('error', 'Currently this option is Disabled , You have Default option enabled which is $2.5 for 5 Sec Delay');
                    return redirect()->to('settings');
                }else if($cpm_settings == '6 for 25 sec'){
                    $this->session->setFlashdata('error', 'Currently this option is Disable , You have Default option enabled which is $2.5 for 5 Sec Delay');
                    return redirect()->to('settings');
                }else{
                   
                    $update_cpmdata = array(
                        'user_id' => $user_id,
                        'AVG_CPM' => $cpm_settings,
                        'Status' => '1'
                    );
                    $is_user_cpm_set = $this->CrudModel->updateItem($this->cpmsettings_tbl,$where_userdata, $update_cpmdata);
                    
                }
                
                if ($is_user_cpm_set) {
                    $this->session->setFlashdata('success', 'You have Updated your AVG CPM successfully!');
                    return redirect()->to('settings');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('settings');
                }
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->to('login');
            }
        
        }
    }
    public function submit_billing_details()
    {   
    
            
        if (isset($_SESSION['user_login'])) {
            $rules = [
                'phone' => 'min_length[10]|max_length[10]|numeric',
                'zipcode' => 'min_length[6]|max_length[6]|numeric',
            ];
            $messages = [
                "zipcode" => [
                    "min_length" => "Minimum length of Zipcode should be 6",
                    "max_length" => "Maximum length of Zipcode is 6",
                    "numeric" => "Zipcode Must have number Values"
                ],

                "phoneno" => [
                    "min_length" => "Minimum length of Mobile Number should be 10",
                    "max_length" => "Maximum length of Mobile Number is 10",
                    "numeric" => "Phone Number Must have number Values"
                ],
               

            ];
            $input = $this->validate($rules, $messages);
        if($input){
            $fname = $this->request->getPost('fname');
            $lname = $this->request->getPost('lname');
            $address = $this->request->getPost('address');
            $country = $this->request->getPost('country');
            $state = $this->request->getPost('state');
            $zipcode = $this->request->getPost('zipcode');
            $city = $this->request->getPost('city');
            $phone = $this->request->getPost('phone');
           
            $user_id = $_SESSION['user_login']['user_id'];
            
            $where_billing_data = ['user_id' => $user_id];
            $db_userdata = array(
                    "table" => $this->billingsettings_tbl,
                    "where" => $where_billing_data,
                    "output"=>'row_object'
            );
            $billing_data = $this->CrudModel->getAnyItems($db_userdata);
            if(!empty($billing_data)){
            
                $update_billingdata = array(
                    'user_id' => $user_id,
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zipcode' => $zipcode,
                    'country' => $country,
                    'phone' => $phone,
                    'updated_on' => date('Y-m-d'),
                    'Status' => '1'
                );
                $is_user_billing_set = $this->CrudModel->updateItem($this->billingsettings_tbl,$where_billing_data, $update_billingdata);
                    
            }else{
                $update_billingdata = array(
                    'user_id' => $user_id,
                    'firstname' => $fname,
                    'lastname' => $lname,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zipcode' => $zipcode,
                    'country' => $country,
                    'phone' => $phone,
                    'updated_on' => date('Y-m-d'),
                    'Status' => '1'
                );
                $is_user_billing_set = $this->CrudModel->insertItem($this->billingsettings_tbl, $update_billingdata);
            }
                
            if ($is_user_billing_set) {
                $this->session->setFlashdata('success', 'You have Updated your Billing Details successfully!');
                return redirect()->to('settings');
            }else {                     
                $this->session->setFlashdata('error', 'Something Got wrong!');
                return redirect()->to('settings');
            }

        }else{
            $this->session->setFlashdata('error', 'Either you have entered zip code more/less than 6 digits or you have entered phone number more/less that 10 digits, please check! ');
            return redirect()->to('settings');
        }
        }else {
            $this->session->setFlashdata('error', $this->validation->listErrors());
            return redirect()->to('login');
        }
        
    }
    public function do_addpayment_info()
    {   
        $input = $this->validate([
            'payment_method'=>'required'
        ]);
            
        if ($input) {
            $payment_method = $this->request->getPost('payment_method');
            $upi_id = $this->request->getPost('upi_id');

            $paypal_email = $this->request->getPost('paypal_email');

            $mobile_no = $this->request->getPost('mobile_no');

            $fname = $this->request->getPost('fname');
            $lname = $this->request->getPost('lname');
            $ifsc_code = $this->request->getPost('ifsc_code');
            $acc_no = $this->request->getPost('acc_no');
           
            $user_id = $_SESSION['user_login']['user_id'];
            
            if($upi_id){
                $where_payment_data = ['user_id' => $user_id];
                $db_userdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output"=>'row_object'
                );
                $userpayment_info = $this->CrudModel->getAnyItems($db_userdata);
                if(!empty($userpayment_info)){
                
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }
                        
                }else{
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }
                }
                    
                if ($is_user_payment_infoset) {
                    $this->session->setFlashdata('success', 'You have Updated your Payment Details successfully!');
                    return redirect()->to('settings');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('settings');
                }
            }else if($paypal_email){
                $where_payment_data = ['user_id' => $user_id];
                $db_userdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output"=>'row_object'
                );
                $userpayment_info = $this->CrudModel->getAnyItems($db_userdata);
                if(!empty($userpayment_info)){
                
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }
                        
                }else{
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }
                }
                    
                if ($is_user_payment_infoset) {
                    $this->session->setFlashdata('success', 'You have Updated your Payment Details successfully!');
                    return redirect()->to('settings');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('settings');
                }
            }else if($mobile_no){
                $where_payment_data = ['user_id' => $user_id];
                $db_userdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output"=>'row_object'
                );
                $userpayment_info = $this->CrudModel->getAnyItems($db_userdata);
                if(!empty($userpayment_info)){
                
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }
                        
                }else{
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }
                }
                    
                if ($is_user_payment_infoset) {
                    $this->session->setFlashdata('success', 'You have Updated your Payment Details successfully!');
                    return redirect()->to('settings');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('settings');
                }
            }else if($acc_no){
                $where_payment_data = ['user_id' => $user_id];
                $db_userdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output"=>'row_object'
                );
                $userpayment_info = $this->CrudModel->getAnyItems($db_userdata);
                if(!empty($userpayment_info)){
                
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->updateItem($this->payment_information_tbl,$where_payment_data, $update_paymentdata);
                    }
                        
                }else{
                    if(isset($payment_method) && $payment_method == 'upi'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'upi_id' => $upi_id,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paypal'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paypal_email' => $paypal_email,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'paytm'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'paytm_mobile' => $mobile_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }else if(isset($payment_method) && $payment_method == 'bank'){
                        $update_paymentdata = array(
                            'user_id' => $user_id,
                            'payment_method' => $payment_method,
                            'bank_fname' => $fname,
                            'bank_lname' => $lname,
                            'bank_IFSCcode' => $ifsc_code,
                            'bank_accountno' => $acc_no,
                            'updated_on' => date('Y-m-d'),
                            'Status' => '1'
                        );
                        $is_user_payment_infoset = $this->CrudModel->insertItem($this->payment_information_tbl, $update_paymentdata);
                    }
                }
                    
                if ($is_user_payment_infoset) {
                    $this->session->setFlashdata('success', 'You have Updated your Payment Details successfully!');
                    return redirect()->to('settings');
                }else {                     
                    $this->session->setFlashdata('error', 'Something Got wrong!');
                    return redirect()->to('settings');
                }
            }else{
                $this->session->setFlashdata('error','Payment Method is Selected but necessary details has not been entered!');
                return redirect()->to('settings');
            }
        }else {

            $this->session->setFlashdata('error','Payment Method is not Selected');
            return redirect()->to('settings');
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
    public function getusername(string $user_id){
        $where_data = ['user_id' => $user_id,'Status' => '1'];
        
        $db_data = array(
            "table" => $this->users_tbl,
            "where" => $where_data,
            "output" => 'row_array'
        );

        $user_data = $this->CrudModel->getAnyItems($db_data);
        if($user_data){
            $username = $user_data['name'];
        }else{
            $username = 'No User Available More';
        }
        
        return $username;
    }

    public function getCPM(string $user_id){
        $where_data = ['user_id' => $user_id,'Status' => '1'];
        
        $db_data = array(
            "table" => $this->cpmsettings_tbl,
            "where" => $where_data,
            "output" => 'row_array'
        );

        $user_data = $this->CrudModel->getAnyItems($db_data);
        if($user_data){
            $AVG_CPM = $user_data['AVG_CPM'];
        }else{
            $AVG_CPM = '';
        }
        
        return $AVG_CPM;
    }
    public function getstates(string $country_id){
        $where_data = ['country_id ' => $country_id];
        
        $db_data = array(
            "table" => $this->states_tbl,
            "where" => $where_data
        );

        $states_data = $this->CrudModel->getAnyItems($db_data);
        if($states_data){
            $states = $states_data;
        }else{
            $states = '';
        }
        
        return $states;
    }
   
}
