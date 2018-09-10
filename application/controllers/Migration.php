<?php
/**
 * Created by PhpStorm.
 * User: ivano
 * Date: 10.09.2018
 * Time: 15:17
 */

class Migration extends CI_Controller
{
    public function index(){
        $this->load->library('migration');
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }
}