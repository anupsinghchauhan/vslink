<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class Shortenalgorithm extends BaseController
{
    private $users_tbl = 'users';
    private $loginlog_tbl = 'loginlog';
    private $shortlinks_tbl = 'shortlinks';

    function __construct()
    {
        helper(['form','security','common','app']);

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
   
    public function step3($alias)
    {
        if(!empty($alias)){
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
        }else{
            $this->data['title'] = 'Page 3';
            return view('step3', $this->data);
        }
        
    }
    
    public function do_generate()
    {
        if(isset($_SESSION['user_login'])){
            return redirect()->to('index');
        }else{  
            $this->session->setFlashdata('error', 'You need to have User profile On Platform to Generate Short Link');
            return redirect()->to('login');
        }
    }
    public function generate_link()
    {
        if(isset($_SESSION['user_login'])){

            $input = $this->validate([
                'main_url' => 'required',

            ]);
            if ($input) {
                $main_url = $this->request->getPost('main_url');
                $user_alias = $this->request->getPost('user_alias');
                $user_id = $this->request->getPost('user_id');

                $Current_IP = get_client_ip();
                $str_result1 = '0123456789098765432157482390495';
                $str_result2 = 'abcdefghijklmnop1234567890qrstuvwxyz98736451gfbcndhejuwikshfnvby';
                $link_id= 'VL'.substr(str_shuffle($str_result1), 0, 6);
                $generted_alias= substr(str_shuffle($str_result2), 0, 8);
                $pre_linkurl = 'https://vslinq.com/';

                $where_link_available = ['main_link'=> $main_url,'user_id' => $user_id];
                
                $db_link_available = array(
                        "table" => $this->shortlinks_tbl,
                        "where" => $where_link_available,
                        "output" => 'row_object'
                );                
                $user_link_available = $this->CrudModel->getAnyItems($db_link_available);

                $where_shortlink_available = ['generated_link'=> $main_url];
                $db_shortlink_available = array(
                        "table" => $this->shortlinks_tbl,
                        "where" => $where_shortlink_available,
                        "output" => 'row_object'
                );                
                $user_shortedlink_available = $this->CrudModel->getAnyItems($db_shortlink_available);

                if(!empty($user_shortedlink_available)){
                    $this->session->setFlashdata('error', 'Already Shorted link will not be shorted further ,Please try different link!');
                    return redirect()->route('dashboard');
                }else if(!empty($user_link_available)){
                    $this->session->setFlashdata('error', 'You have already generated link for the URL that you have entered.Please try different link!');
                    return redirect()->route('dashboard');
                }else{
              
                    if(!empty($user_alias)){
                        // $where_linkdata = ['alias'=> $user_alias];

                        // $db_linkdata = array(
                        //     "table" => $this->shortlinks_tbl,
                        //     "where" => $where_linkdata,
                        //     "output" => 'row_object'
                        // );
                    
                        // $user_aliasdata = $this->CrudModel->getAnyItems($db_linkdata);

                        $user_aliasdata = $this->CrudModel->get_link($user_alias);
                        //print_r($user_aliasdata);exit;
                    }else{
                        $where_linkdata = ['generated_alias'=> $generted_alias];

                        $db_linkdata = array(
                            "table" => $this->shortlinks_tbl,
                            "where" => $where_linkdata,
                            "output" => 'row_object'
                        );
                    
                        $user_generatedaliasdata = $this->CrudModel->getAnyItems($db_linkdata);
                    }
                    

                    if(!empty($user_aliasdata)){
                        $_SESSION['user_login']['temp_link'] = $user_aliasdata[0]->generated_link;
                        $_SESSION['user_login']['main_templink'] = $user_aliasdata[0]->main_link;
                            $_SESSION['user_login']['aliastemp'] = $user_aliasdata[0]->alias;
                        $this->session->setFlashdata('error', 'You have entered alias but its already exist, check it in your list of generated links! please try another one!');
                        return redirect()->route('dashboard');
                    }else if(!empty($user_generatedaliasdata)){
                        $_SESSION['user_login']['temp_link'] = $user_generatedaliasdata->generated_link;
                        $_SESSION['user_login']['main_templink'] = $user_generatedaliasdata->main_link;
                        $_SESSION['user_login']['aliastemp'] = $user_generatedaliasdata->generated_alias;
                        $this->session->setFlashdata('error', 'You need to try Again as Alias Mistaken generated Duplicate, please try again entering link!');
                        return redirect()->route('dashboard');
                    }else{
                        if(!empty($user_alias)){
                            if(strlen($user_alias) >= 3 && strlen($user_alias) <=8 ){
                                $generted_link = $pre_linkurl.$user_alias;
                                $update_data = array(
                                    'link_id' => $link_id,
                                    'pre_linkurl' => $pre_linkurl,
                                    'main_link'=> $main_url,
                                    'user_id'=> $user_id,
                                    'alias'=> $user_alias,
                                    'generated_link' => $generted_link,
                                    'user_ip' => $Current_IP,
                                    'Status'=> '1',
                                    'created_on' => date('Y-m-d h:i:s A'),
                                    'available' => '1'
                                );

                                $_SESSION['user_login']['temp_link'] = $generted_link;
                                $_SESSION['user_login']['main_templink'] = $main_url;
                                $_SESSION['user_login']['aliastemp'] = $user_alias;
                            }else if(strlen($user_alias) < 3){
                                $this->session->setFlashdata('error', 'You have entered alias of length less than 3 , It must be atlease length of 3 Characters, please try another one!');
                                return redirect()->route('dashboard');
                            }
                            else if(strlen($user_alias) > 3){
                                $this->session->setFlashdata('error', 'You have entered alias of length greater than 8 , It must be maximum length of 8 Characters, please try another one!');
                                return redirect()->route('dashboard');
                            }
                            
                        }else{
                            $generted_link = $pre_linkurl.$generted_alias;
                            $update_data = array(
                                'link_id' => $link_id,
                                'pre_linkurl' => $pre_linkurl,
                                'main_link'=> $main_url,
                                'user_id'=> $user_id,
                                'generated_alias'=> $generted_alias,
                                'generated_link' => $generted_link,
                                'user_ip' => $Current_IP,
                                'Status'=> '1',
                                'created_on' => date('Y-m-d h:i:s A'),
                                'available' => '1'
                            );

                            $_SESSION['user_login']['temp_link'] = $generted_link;
                            $_SESSION['user_login']['main_templink'] = $main_url;
                            $_SESSION['user_login']['aliastemp'] = $generted_alias;
                        }
                        
                        $is_link_generated = $this->CrudModel->insertItem($this->shortlinks_tbl, $update_data);
                    

                        if ($is_link_generated) {   
                            $this->session->setFlashdata('success', 'Thank you ! Link is generated Successfully ! Check it in Manage Links Menu !.');             
                            return redirect()->route('dashboard');
                        }else {                       
                            $this->session->setFlashdata('error', 'Something Got wrong!Try Again');
                            return redirect()->route('dashboard');
                        }
                    }
                }
            }else {
                $this->session->setFlashdata('error', $this->validation->listErrors());
                return redirect()->route('dashboard');
            }
           
        }else{
            $this->session->setFlashdata('error', 'You must need to Login.');
                return redirect()->route('login');
        }
    }
}