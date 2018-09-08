<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function getShortLink(){
	    $link = $this->input->post('link');
        $shortLink = $this->sendRequest($link);
        echo $shortLink;

    }

    private function sendRequest($link){
	    //echo "url=".$link;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, 'https://clck.ru/--');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "url=".$link);
            $out = curl_exec($curl);
            curl_close($curl);

            return $out;
        }
    }
}
