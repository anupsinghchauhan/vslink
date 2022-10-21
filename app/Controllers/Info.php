<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\HTTP\RequestInterface;
class Info extends BaseController
{
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
    
    public function aboutus()
    {
        $this->data['title'] = 'About Us';
        return render_frontend('aboutus', $this->data);
    }
    public function contactus()
    {
        $this->data['title'] = 'Contact Us';
        return render_frontend('contactus', $this->data);
    }
    public function terms()
    {
        $this->data['title'] = 'Terms & Conditions';
        return render_frontend('terms', $this->data);
    }
    public function privacy()
    {
        $this->data['title'] = 'Privacy Policy';
        return render_frontend('privacy', $this->data);
    }

    public function help()
    {
        $this->data['title'] = 'Help';
        return render_frontend('help', $this->data);
    }
    public function blogs()
    {
        $this->data['title'] = 'Blogs';
        return render_frontend('blogs', $this->data);
    }
}
