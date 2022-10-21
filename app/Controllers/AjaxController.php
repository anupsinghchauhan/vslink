<?php 

namespace App\Controllers;



use App\Models\CrudModel;

use CodeIgniter\HTTP\RequestInterface;



class AjaxController extends BaseController

{

	private $session = null;

	// Admin Table

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

		$this->data['error'] = "";

    }

    //hide link ajax

    public function hide_link(){


        $link_id = $this->request->getPost('link_id');

        $token = csrf_hash();        

        if(!empty($link_id)){

            $where_link_data = ['link_id' => $link_id];

            $update_data = array(
                'available' => '0'
            );

            $is_update = $this->CrudModel->updateItem($this->shortlinks_tbl, $where_link_data, $update_data);

            if(!empty($is_update)){
                    $responseArr = array("token" => $token, "message" => "Link is Hidden from Public View successfully!", "response" => true);
            }else{

                $responseArr = array("token" => $token, "response" => false);

            }

        }else {

            $responseArr = array("token" => $token, "response" => false);

        }
        echo json_encode($responseArr);

        die();

    }
    //show link ajax

    public function show_link(){


        $link_id = $this->request->getPost('link_id');

        $token = csrf_hash();        

        if(!empty($link_id)){

            $where_link_data = ['link_id' => $link_id];

            $update_data = array(
                'available' => '1'
            );

            $is_update = $this->CrudModel->updateItem($this->shortlinks_tbl, $where_link_data, $update_data);

            if(!empty($is_update)){
                    $responseArr = array("token" => $token, "message" => "Link is Activated for Public View successfully!", "response" => true);
            }else{

                $responseArr = array("token" => $token, "response" => false);

            }

        }else {

            $responseArr = array("token" => $token, "response" => false);

        }
        echo json_encode($responseArr);

        die();

    }
    public function get_link(){


        $link_id = $this->request->getPost('link_id');

        $token = csrf_hash();        

        if(!empty($link_id)){
            $Current_IP = get_client_ip();
            $where_link_data = ['link_id' => $link_id];

            $db_linkdata = array(
                "table" => $this->shortlinks_tbl,
                "where" => $where_link_data,
                "output" => 'row_object'
            );
                
            $link_data = $this->CrudModel->getAnyItems($db_linkdata);
          
            if(!empty($link_data)){
                if($link_data->user_ip == $Current_IP){
                    $responseArr = array("token" => $token, "message" => "Own Link View will not counted!", "response" => true , "url" => $link_data->main_link);
                }else if(isset($_SESSION['user_login'])){
                    if($link_data->user_id == $_SESSION['user_login']['user_id']){
                        $responseArr = array("token" => $token, "message" => "Own Link View will not counted!", "response" => true , "url" => $link_data->main_link);
                    } 
                }else{
                    $where_single_views = ['link_id' => $link_id, 'user_ip' => $Current_IP];
                    $link_views = array(
                        "table" => $this->viewcount_tbl,
                        "where" => $where_single_views,
                        "output" => 'row_object'
                    );              
                    $views = $this->CrudModel->getAnyItems($link_views);
    
                    if(!empty($views)){
                        $datetime2 = date('Y-m-d h:i:s');
                        $hourdiff = round((strtotime($views->updatedview_on) - strtotime($views->viewed_on))/3600);
                        if($hourdiff < 24 && $views->count < 2){
                            $total_view = $views->count + 1;
                            $view_update_single_view = array(
                                'count' => $total_view,
                                'updatedview_on' => date('Y-m-d h:i:s'),            
                            );
                                
                            $is_update = $this->CrudModel->updateItem($this->viewcount_tbl, $where_single_views, $view_update_single_view);
    
                            // get current CPM
                            $where_cpm_settings = ['user_id' => $link_data->user_id];
                            $cpm_data = array(
                                "table" => $this->cpmsettings_tbl,
                                "where" => $where_cpm_settings,
                                "output" => 'row_object'
                            );              
                            $cpm_details = $this->CrudModel->getAnyItems($cpm_data);
                            if(!empty($cpm_details)){
                                $avg_CPM = $cpm_details->AVG_CPM;
                            }
    
                            //total views count
                            $where_user_data = ['user_id' => $link_data->user_id,'Status' => '1','available' => '1'];
                            $cviews = 0;
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
                                foreach($view_perlink as $v){
                                    $cviews = $cviews + $v->count;
                                }
                            }
    
                            //earning count
                            $total_earnings = 1;
                            if($avg_CPM == "2.5 for 5 sec"){
                                $total_earnings = 1 *  2.5 * 0.001;
                            }else if($avg_CPM == "4 for 14 sec"){
                                $total_earnings = 1 *  4 * 0.001;
                            }else if($avg_CPM == "6 for 25 sec"){
                                $total_earnings = 1 *  6 * 0.001;
                            }
    
                            //add earning
                            $earning_data = array(
                                'user_id' => $link_data->user_id,
                                'earning' => $total_earnings,
                                'dated_on' => date('Y-m-d h:i:s'),
                                'status' => '1'
                            );
                                
                            $is_update_earnings = $this->CrudModel->insertItem($this->earnings_tbl, $earning_data);
                            if(!empty($is_update)){
                                $responseArr = array("token" => $token, "message" => "Viewed successfully!", "response" => true , "url" => $link_data->main_link);
                            }else{
                                $responseArr = array("token" => $token, "response" => false, "url" => $link_data->main_link);
                            }
                        }else if($hourdiff > 24){
                            $total_view = $views->count + 1;
                            $view_data = array(
                                'link_id' => $link_id,
                                'user_ip' => $Current_IP,
                                'main_link' => $link_data->main_link,
                                'generated_link' =>$link_data->generated_link,
                                'count' => $total_view,
                                'updatedview_on' => date('Y-m-d h:i:s'),
                                'Status' => 1
                            );
    
                            $is_update = $this->CrudModel->updateItem($this->viewcount_tbl, $where_single_views, $view_data);
    
                            // get current CPM
                            $where_cpm_settings = ['user_id' => $link_data->user_id];
                            $cpm_data = array(
                                "table" => $this->cpmsettings_tbl,
                                "where" => $where_cpm_settings,
                                "output" => 'row_object'
                            );              
                            $cpm_details = $this->CrudModel->getAnyItems($cpm_data);
                            if(!empty($cpm_details)){
                                $avg_CPM = $cpm_details->AVG_CPM;
                            }
    
                            //total views count
                            $where_user_data = ['user_id' => $link_data->user_id,'Status' => '1','available' => '1'];
                            $cviews = 0;
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
                                foreach($view_perlink as $v){
                                    $cviews = $cviews + $v->count;
                                }
                            }
    
                            //earning count
                            $total_earnings = 1;
                            if($avg_CPM == "2.5 for 5 sec"){
                                $total_earnings = 1 *  2.5 * 0.001;
                            }else if($avg_CPM == "4 for 14 sec"){
                                $total_earnings = 1 *  4 * 0.001;
                            }else if($avg_CPM == "6 for 25 sec"){
                                $total_earnings = 1 *  6 * 0.001;
                            }
    
                            //add earning
                            $earning_data = array(
                                'user_id' => $link_data->user_id,
                                'earning' => $total_earnings,
                                'dated_on' => date('Y-m-d h:i:s'),
                                'status' => '1'
                            );
                                
                            $is_update_earnings = $this->CrudModel->insertItem($this->earnings_tbl, $earning_data);
                            if(!empty($is_update)){
                                $responseArr = array("token" => $token, "message" => "Viewed successfully!", "response" => true , "url" => $link_data->main_link);
                            }else{
                                $responseArr = array("token" => $token, "response" => false, "url" => $link_data->main_link);
                            }
                        }else if($hourdiff < 24 && $views->count == 2){
                            $responseArr = array("token" => $token, "message" => "max 2 views in 24 hours!", "response" => true , "url" => $link_data->main_link);
                        }
                    }else{
                        $view_data = array(
                            'link_id' => $link_id,
                            'user_id' => $link_data->user_id,
                            'user_ip' => $Current_IP,
                            'main_link' => $link_data->main_link,
                            'generated_link' =>$link_data->generated_link,
                            'count' => 1,
                            'viewed_on' => date('Y-m-d h:i:s'),
                            'Status' => 1
                        );
                            
                        $is_update = $this->CrudModel->insertItem($this->viewcount_tbl, $view_data);
    
                        // get current CPM
                            $where_cpm_settings = ['user_id' => $link_data->user_id];
                            $cpm_data = array(
                                "table" => $this->cpmsettings_tbl,
                                "where" => $where_cpm_settings,
                                "output" => 'row_object'
                            );              
                            $cpm_details = $this->CrudModel->getAnyItems($cpm_data);
                            if(!empty($cpm_details)){
                                $avg_CPM = $cpm_details->AVG_CPM;
                            }
    
                            //total views count
                            $where_user_data = ['user_id' => $link_data->user_id,'Status' => '1','available' => '1'];
                            $cviews = 0;
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
                                foreach($view_perlink as $v){
                                    $cviews = $cviews + $v->count;
                                }
                            }
    
                            //earning count
                            $total_earnings = 1;
                            if($avg_CPM == "2.5 for 5 sec"){
                                $total_earnings = 1 *  2.5 * 0.001;
                            }else if($avg_CPM == "4 for 14 sec"){
                                $total_earnings = 1 *  4 * 0.001;
                            }else if($avg_CPM == "6 for 25 sec"){
                                $total_earnings = 1 *  6 * 0.001;
                            }
    
                            //add earning
                            $earning_data = array(
                                'user_id' => $link_data->user_id,
                                'earning' => $total_earnings,
                                'dated_on' => date('Y-m-d h:i:s'),
                                'status' => '1'
                            );
                                
                            $is_update_earnings = $this->CrudModel->insertItem($this->earnings_tbl, $earning_data);
                            if(!empty($is_update)){
                                $responseArr = array("token" => $token, "message" => "Viewed successfully!", "response" => true , "url" => $link_data->main_link);
                            }else{
                                $responseArr = array("token" => $token, "response" => false, "url" => $link_data->main_link);
                            }
                    }
                }
            }else{
                $responseArr = array("token" => $token, "response" => false);
            }
        }else {
            $responseArr = array("token" => $token, "response" => false);
        }
        echo json_encode($responseArr);

        die();

    }
    public function country_ajax(){

        $countryname = $this->request->getPost('countryname');


        $token = csrf_hash();        

        if(!empty($countryname)){

            $where_event = ['country_id' => $countryname];

            $db_event = array(
                "table" => $this->states_tbl,
                "where" => $where_event,
                "order_by" => array("column"=>"name", "order"=>"ASC")
            );


            $db_events = $this->CrudModel->getAnyItems($db_event);
            $where_billing_data = ['user_id' => $_SESSION['user_login']['user_id']];
            $db_billingdata = array(
                "table" => $this->billingsettings_tbl,
                "where" => $where_billing_data,
                "output" => 'row_object'
            );

            $billing_data = $this->CrudModel->getAnyItems($db_billingdata);
                    
                    
            
            if(!empty($db_events)){
                $html_events = '';
                foreach ($db_events as $key => $value) {
                    $html_events .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
                $responseArr = array("token" => $token, "message" => "States Found", "response" => true,"states" =>$html_events);

            }else{
                $responseArr = array("token" => $token, "response" => false);
            }

        }else {

            $responseArr = array("token" => $token, "response" => false);

        }
        echo json_encode($responseArr);

        die();

    } 
    public function monthwisedataajax(){

        $month = $this->request->getPost('month');


        $token = csrf_hash();        

        if(!empty($month)){

            
           
            $query_group = $this->db->query('SELECT YEAR(viewed_on) AS y, MONTH(viewed_on) AS m, DAY(viewed_on) AS d, SUM(count) as c,viewed_on,count FROM vslink_tblviewcount WHERE Status = 1 AND user_id = "'.$_SESSION['user_login']['user_id'].'" AND MONTH(viewed_on) = "'.$month.'" GROUP BY y, m,d');
            $finalmonthwisedata = $query_group->getResult();
                    
              
            if(!empty($finalmonthwisedata)){
                $html_monthwisedata = '';
                foreach ($finalmonthwisedata as $key => $value) {
                    $total_earnings = $value->c *  view_cell('\App\Controllers\Home::getAVGCPM', 'user_id='.$_SESSION['user_login']['user_id']) * 0.001;
                    $html_monthwisedata .= '<tr>
                                        <td>'.date('d-M-y', strtotime($value->viewed_on)).'</td>
                                        <td>'.$value->c.'</td>
                                        <td>'.view_cell('\App\Controllers\Home::getAVGCPM', 'user_id='.$_SESSION['user_login']['user_id']).'</td>
                                        <td>'.$total_earnings.'</td> 
                                    </tr>';
                }
                $responseArr = array("token" => $token, "message" => "States Found", "response" => true,"monthwisearray" =>$html_monthwisedata);

            }else{
                $responseArr = array("token" => $token, "response" => false);
            }

        }else {

            $responseArr = array("token" => $token, "response" => false);

        }
        echo json_encode($responseArr);

        die();

    } 
    
}