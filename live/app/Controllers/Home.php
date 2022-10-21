<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class Home extends BaseController
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
        helper(['form','security','common','url']);

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
        $this->data['title'] = 'Home';
        $where_views_data = ['Status' => '1'];
        $where_user_data = ['Status' => '1','verification_key' => '1','Role' => '2'];
        
        $views_count = 0;       
            
        $TShortlinks_count = $this->CrudModel->countTotalRows($this->shortlinks_tbl,$views_count);
        $Tusers_count = $this->CrudModel->countTotalRows($this->users_tbl,$where_user_data);

        $db_data = array(
            "table" => $this->viewcount_tbl,
            "where" => $where_views_data,
            "order_by" => array("column"=>"ID", "order"=>"DESC")
        );
        $views_data = $this->CrudModel->getAnyItems($db_data);

        if(!empty($views_data)){
            foreach ($views_data as $key => $value) {
                $views_count = $views_count + $value->count;
            }
        }else{
            $views_count = 0;
        }

        
        $this->data['views_count'] = $views_count;
        $this->data['TShortlinks_count'] = $TShortlinks_count;
        $this->data['Tusers_count'] = $Tusers_count;
        return render_frontend('index', $this->data);
    }
   
    public function index_alphanumeric($alias)
    {
        if(!empty($alias)){
            $routes_list = array('login','register','logout','verification','about-us','contact-us','terms-conditions','privacy-policy','help','final-step','dashboard','manage-links','statistics','settings','withdraw','invoices','send-query','help','forgot-password','change-pwd','referal','undefined','blogs');

            if(in_array($alias, $routes_list)){
                if($alias == 'dashboard'){
                    $this->data['title'] = 'Dashboard';
                    return render_userboard('users/index', $this->data);
                }elseif($alias == 'login'){
                    $this->data['title'] = 'Login';
                    return view('login', $this->data);
                }elseif($alias == 'register'){
                     $usercode = '';
                    $referralcode = '';
                    if(isset($_GET)){
                        if(isset($_GET['usercode'])){
                            $usercode = decryptor($_GET['usercode']);
                        }
                        else{
                            $usercode = '';
                        }

                        if(isset($_GET['amp;referral'])){
                            $referralcode = decryptor($_GET['amp;referral']);
                        }
                        else if(isset($_GET['referral'])){
                            $referralcode = decryptor($_GET['referral']);
                        }
                        else{
                            $referralcode = '';
                        }
                    }

                    $this->data['usercode'] = $usercode;
                    $this->data['referralcode'] = $referralcode;
                    $this->data['title'] = 'Register';
                    return view('register', $this->data);
                }elseif($alias == 'verification'){
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
                }elseif($alias == 'statistics'){
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
                }elseif($alias == 'settings'){
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
                    
                    if(!empty($billing_data)){
                        $this->data['billing_data'] = $billing_data;
                        $where_statedata = ['country_id ' => $billing_data->country];
            
                        $db_statesdata = array(
                            "table" => $this->states_tbl,
                            "where" => $where_statedata
                        );
    
                        $states_data = $this->CrudModel->getAnyItems($db_statesdata);
                        $this->data['states_data'] = $states_data;
                    }
                    $user_id = $_SESSION['user_login']['user_id'];
                    $where_payment_data = ['user_id' => $user_id];
                    $db_paymentdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output" => 'row_object'
                    );

                    $payment_info_data = $this->CrudModel->getAnyItems($db_paymentdata);

                    $this->data['payment_info_data'] = $payment_info_data;
                    $this->data['title'] = 'Settings';
                    return render_userboard('users/settings', $this->data);
                }elseif($alias == 'withdraw'){
                    $this->data['title'] = 'Withdraw';
                    return render_userboard('users/withdraw', $this->data);
                }elseif($alias == 'invoices'){
                    $this->data['title'] = 'Invoices';
                    return render_userboard('users/invoices', $this->data);
                }elseif($alias == 'send-query'){
                    $this->data['title'] = 'Contact Us';
                    return render_userboard('users/contact_us', $this->data);
                }elseif($alias == 'help'){
                    $this->data['title'] = 'Help';
                    return render_frontend('help', $this->data);
                }elseif($alias == 'blogs'){
                    $this->data['title'] = 'Blogs';
                    return render_frontend('blogs', $this->data);
                }elseif($alias == 'forgot-password'){
                    $this->data['title'] = 'Forgot Password';
                    return view('forgot_password', $this->data);
                }elseif($alias == 'referal'){
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
                }elseif($alias == 'logout'){
                    echo "<script>alert('Test1');</script>";
                    if(isset($_SESSION['user_login']['user_id'])){
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
                            return redirect()->route('/');
                        }else{
                            return redirect()->route('/');
                        }
                    }                    
                }elseif($alias == 'undefined'){
                    return redirect()->route("/");
                }else{
                    return redirect()->route($alias);
                }
                
            }else{
                $where_linkdata = ['alias'=> $alias,'available' => '1'];

                $db_linkdata = array(
                    "table" => $this->shortlinks_tbl,
                    "where" => $where_linkdata,
                    "output" => 'row_object'
                );
                        
                $user_aliasdata = $this->CrudModel->getAnyItems($db_linkdata);

                $where_generatedlinkdata = ['generated_alias'=> $alias,'available' => '1'];

                $db_generatedlinkdata = array(
                    "table" => $this->shortlinks_tbl,
                    "where" => $where_generatedlinkdata,
                    "output" => 'row_object'
                );
                        
                $user_generatedaliasdata = $this->CrudModel->getAnyItems($db_generatedlinkdata);
                if(!empty($user_aliasdata)){
                    $this->data['link_data'] = $user_aliasdata;
                }else if(!empty($user_generatedaliasdata)){
                    $this->data['link_data'] = $user_generatedaliasdata;
                }else{
                    $this->session->setFlashdata('error', 'The Link you have Clicked is either hidden or deleted ! please try another one or activate it for Public View!');
                    return redirect()->route('manage-links');
                }

                $this->data['title'] = 'Page 3';
                return view('step3', $this->data);
            }            
        }else{
            $this->data['title'] = 'Home';
            return render_frontend('index', $this->data);
        }
        
    }

    public function index_alpha($alias)
    {
        if(!empty($alias)){
            $routes_list = array('login','register','logout','verification','about-us','contact-us','terms-conditions','privacy-policy','help','final-step','dashboard','manage-links','statistics','settings','withdraw','invoices','send-query','help','forgot-password','change-pwd','referal','undefined','blogs');

            if(in_array($alias, $routes_list)){
                if($alias == 'dashboard'){
                    $this->data['title'] = 'Dashboard';
                    return render_userboard('users/index', $this->data);
                }elseif($alias == 'login'){
                    $this->data['title'] = 'Login';
                    return view('login', $this->data);
                }elseif($alias == 'register'){
                     $usercode = '';
                    $referralcode = '';
                    if(isset($_GET)){
                        if(isset($_GET['usercode'])){
                            $usercode = decryptor($_GET['usercode']);
                        }
                        else{
                            $usercode = '';
                        }

                        if(isset($_GET['amp;referral'])){
                            $referralcode = decryptor($_GET['amp;referral']);
                        }
                        else if(isset($_GET['referral'])){
                            $referralcode = decryptor($_GET['referral']);
                        }
                        else{
                            $referralcode = '';
                        }
                    }

                    $this->data['usercode'] = $usercode;
                    $this->data['referralcode'] = $referralcode;
                    $this->data['title'] = 'Register';
                    return view('register', $this->data);
                }elseif($alias == 'verification'){
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
                }elseif($alias == 'statistics'){
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
                }elseif($alias == 'settings'){
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
                    
                    if(!empty($billing_data)){
                        $this->data['billing_data'] = $billing_data;
                        $where_statedata = ['country_id ' => $billing_data->country];
            
                        $db_statesdata = array(
                            "table" => $this->states_tbl,
                            "where" => $where_statedata
                        );
    
                        $states_data = $this->CrudModel->getAnyItems($db_statesdata);
                        $this->data['states_data'] = $states_data;
                    }
                    $user_id = $_SESSION['user_login']['user_id'];
                    $where_payment_data = ['user_id' => $user_id];
                    $db_paymentdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output" => 'row_object'
                    );

                    $payment_info_data = $this->CrudModel->getAnyItems($db_paymentdata);

                    $this->data['payment_info_data'] = $payment_info_data;
                    $this->data['title'] = 'Settings';
                    return render_userboard('users/settings', $this->data);
                }elseif($alias == 'withdraw'){
                    $this->data['title'] = 'Withdraw';
                    return render_userboard('users/withdraw', $this->data);
                }elseif($alias == 'invoices'){
                    $this->data['title'] = 'Invoices';
                    return render_userboard('users/invoices', $this->data);
                }elseif($alias == 'send-query'){
                    $this->data['title'] = 'Contact Us';
                    return render_userboard('users/contact_us', $this->data);
                }elseif($alias == 'help'){
                    $this->data['title'] = 'Help';
                    return render_frontend('help', $this->data);
                }elseif($alias == 'blogs'){
                    $this->data['title'] = 'Blogs';
                    return render_frontend('blogs', $this->data);
                }elseif($alias == 'forgot-password'){
                    $this->data['title'] = 'Forgot Password';
                    return view('forgot_password', $this->data);
                }elseif($alias == 'referal'){
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
                }elseif($alias == 'logout'){
                    echo "<script>alert('Test2');</script>";
                    if(isset($_SESSION['user_login']['user_id'])){
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
                            return redirect()->route('/');
                        }else{
                           return redirect()->route('/');
                        }
                    }                    
                }else{
                    return redirect()->route($alias);
                }
                
            }else{

                    $where_linkdata = ['alias'=> $alias,'available' => '1'];

                    $db_linkdata = array(
                        "table" => $this->shortlinks_tbl,
                        "where" => $where_linkdata,
                        "output" => 'row_object'
                    );
                            
                    $user_aliasdata = $this->CrudModel->getAnyItems($db_linkdata);

                    $where_generatedlinkdata = ['generated_alias'=> $alias,'available' => '1'];

                    $db_generatedlinkdata = array(
                        "table" => $this->shortlinks_tbl,
                        "where" => $where_generatedlinkdata,
                        "output" => 'row_object'
                    );
                            
                    $user_generatedaliasdata = $this->CrudModel->getAnyItems($db_generatedlinkdata);

                    if(!empty($user_aliasdata)){
                        $this->data['link_data'] = $user_aliasdata;
                    }else if(!empty($user_generatedaliasdata)){
                        $this->data['link_data'] = $user_generatedaliasdata;
                    }else{
                        $this->session->setFlashdata('error', 'The Link you have Clicked is either hidden or deleted ! please try another one or activate it for Public View!');
                        return redirect()->route('manage-links');
                    }

                    $this->data['title'] = 'Page 3';
                    return view('step3', $this->data);
            }
        }else{
            $this->data['title'] = 'Home';
            return render_frontend('index', $this->data);
        }
        
    }

    public function index_number_url($alias)
    {
        if(!empty($alias)){
            $routes_list = array('login','register','logout','verification','about-us','contact-us','terms-conditions','privacy-policy','help','final-step','dashboard','manage-links','statistics','settings','withdraw','invoices','send-query','help','forgot-password','change-pwd','referal','undefined','blogs');

            if(in_array($alias, $routes_list)){
                if($alias == 'dashboard'){
                    $this->data['title'] = 'Dashboard';
                    return render_userboard('users/index', $this->data);
                }elseif($alias == 'login'){
                    $this->data['title'] = 'Login';
                    return view('login', $this->data);
                }elseif($alias == 'register'){
                     $usercode = 'none';
                    $referralcode = '';
                    if(isset($_GET)){
                        if(isset($_GET['usercode'])){
                            $usercode = decryptor($_GET['usercode']);
                        }
                        else{
                            $usercode = 'none';
                        }

                        if(isset($_GET['amp;referral'])){
                            $referralcode = decryptor($_GET['amp;referral']);
                        }
                        else if(isset($_GET['referral'])){
                            $referralcode = decryptor($_GET['referral']);
                        }
                        else{
                            $referralcode = '';
                        }
                    }

                    $this->data['usercode'] = $usercode;
                    $this->data['referralcode'] = $referralcode;
                    $this->data['title'] = 'Register';
                    return view('register', $this->data);
                }elseif($alias == 'verification'){
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
                }elseif($alias == 'statistics'){
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
                }elseif($alias == 'settings'){
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
                    
                    if(!empty($billing_data)){
                        $this->data['billing_data'] = $billing_data;
                        $where_statedata = ['country_id ' => $billing_data->country];
            
                        $db_statesdata = array(
                            "table" => $this->states_tbl,
                            "where" => $where_statedata
                        );
    
                        $states_data = $this->CrudModel->getAnyItems($db_statesdata);
                        $this->data['states_data'] = $states_data;
                    }
                    $user_id = $_SESSION['user_login']['user_id'];
                    $where_payment_data = ['user_id' => $user_id];
                    $db_paymentdata = array(
                        "table" => $this->payment_information_tbl,
                        "where" => $where_payment_data,
                        "output" => 'row_object'
                    );

                    $payment_info_data = $this->CrudModel->getAnyItems($db_paymentdata);

                    $this->data['payment_info_data'] = $payment_info_data;
                    $this->data['title'] = 'Settings';
                    return render_userboard('users/settings', $this->data);
                }elseif($alias == 'withdraw'){
                    $this->data['title'] = 'Withdraw';
                    return render_userboard('users/withdraw', $this->data);
                }elseif($alias == 'invoices'){
                    $this->data['title'] = 'Invoices';
                    return render_userboard('users/invoices', $this->data);
                }elseif($alias == 'send-query'){
                    $this->data['title'] = 'Contact Us';
                    return render_userboard('users/contact_us', $this->data);
                }elseif($alias == 'help'){
                    $this->data['title'] = 'Help';
                    return render_frontend('help', $this->data);
                }elseif($alias == 'blogs'){
                    $this->data['title'] = 'Blogs';
                    return render_frontend('blogs', $this->data);
                }elseif($alias == 'forgot-password'){
                    $this->data['title'] = 'Forgot Password';
                    return view('forgot_password', $this->data);
                }elseif($alias == 'referal'){
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
                }elseif($alias == 'logout'){
                    echo "<script>alert('Test3');</script>";
                    if(isset($_SESSION['user_login']['user_id'])){
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
                            return redirect()->route('/');
                        }else{
                            $this->data['title'] = 'Home';
                            return redirect()->route('/');
                        }
                    }                    
                }else{
                    return redirect()->route($alias);
                }
                
            }else{
                $where_linkdata = ['alias'=> $alias,'available' => '1'];

                $db_linkdata = array(
                    "table" => $this->shortlinks_tbl,
                    "where" => $where_linkdata,
                    "output" => 'row_object'
                );
                        
                $user_aliasdata = $this->CrudModel->getAnyItems($db_linkdata);

                $where_generatedlinkdata = ['generated_alias'=> $alias,'available' => '1'];

                $db_generatedlinkdata = array(
                    "table" => $this->shortlinks_tbl,
                    "where" => $where_generatedlinkdata,
                    "output" => 'row_object'
                );
                        
                $user_generatedaliasdata = $this->CrudModel->getAnyItems($db_generatedlinkdata);

                if(!empty($user_aliasdata)){
                    $this->data['link_data'] = $user_aliasdata;
                }else if(!empty($user_generatedaliasdata)){
                    $this->data['link_data'] = $user_generatedaliasdata;
                }else{
                    $this->session->setFlashdata('error', 'The Link you have Clicked is either hidden or deleted ! please try another one or activate it for Public View!');
                    return redirect()->route('manage-links');
                }

                $this->data['title'] = 'Page 3';
                return view('step3', $this->data);
            }
        }else{
            $this->data['title'] = 'Home';
            return render_frontend('index', $this->data);
        }
        
    }

    //get data control==================================================================================================================================================================

    public function getTotalView(string $user_id){
        $user_id = $user_id;
        $where_user_data = ['user_id' => $user_id,'Status' => '1','available' => '1'];
        $c = 0;
        $dbshortlinks_peruser = array(
            "table" => $this->shortlinks_tbl,
            "where" => $where_user_data
        );
                        
        $shortlinks_peruser = $this->CrudModel->getAnyItems($dbshortlinks_peruser);

        foreach ($shortlinks_peruser as $key => $value) {
            $where_link_data = ['link_id' => $value->link_id,'Status' => '1'];
            $dblinkcountuser = array(
                "table" => $this->viewcount_tbl,
                "where" => $where_link_data
            );
            $view_perlink = $this->CrudModel->getAnyItems($dblinkcountuser);
            //print_r($view_perlink);
            foreach($view_perlink as $v){
                //print_r($v->count);
                $c = $c + $v->count;
            }
           //
        }

        return $c;
    }
    public function getgeneratedlinksCount(string $user_id){
        $user_id = $user_id;
        $where_user_data = ['user_id' => $user_id,'Status' => '1','available' => '1'];
        
        $Clinks = $this->CrudModel->countTotalRows($this->shortlinks_tbl,$where_user_data);

        $total_count = $Clinks;

        return $total_count;
    }
    public function getTotalEarnings(string $user_id){
        $where_user_earningdata = ['user_id' => $user_id];
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

            return $earning_count;
    }
    public function getAVGCPM(string $user_id){
        $where_user_cpmdata = ['user_id' => $user_id];
        $cpm = 0.0000;
        $db_cpmdata = array(
            "table" => $this->cpmsettings_tbl,
            "where" => $where_user_cpmdata,
            "output" => 'row_object'
        );
        $cpm_data = $this->CrudModel->getAnyItems($db_cpmdata);

        if($cpm_data->AVG_CPM == "2.5 for 5 sec"){
            $cpm = 2.5;
        }else if($cpm_data->AVG_CPM == "4 for 14 sec"){
            $cpm = 4;
        }else if($cpm_data->AVG_CPM == "6 for 25 sec"){
            $cpm =6;
        }

        return $cpm;
    }
   
}
