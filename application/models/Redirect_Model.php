<?php
/**
 * Created by PhpStorm.
 * User: ivano
 * Date: 10.09.2018
 * Time: 15:49
 */

class Redirect_Model extends CI_Model
{
    public $original_link;
    public $slug;

    public function __construct()
    {
        parent::__construct();
    }

    public function getLink($slug){
        $sql = "SELECT `original_link` FROM `redirect` WHERE `slug` = ?";
        $query = $this->db->query($sql, array($slug));

        return $query->row()->original_link;
    }

    public function createLink($link){
        $this->original_link = $link;

        $query = $this->findByLink();

        if($query->num_rows() == 1){
            return $query->row()->slug;
        } else {
            $this->insertNewSlug();
            return $this->slug;
        }
    }

    private function findByLink(){
        $sql = "SELECT `slug` FROM `redirect` WHERE `original_link` = ?";
        $query = $this->db->query($sql, array($this->original_link));
        return $query;
    }

    private function insertNewSlug(){
        $this->slug = $this->generateNewSlug();

        $this->db->insert('redirect', $this);
    }

    private function generateNewSlug($length = 10){
        $work = true;
        do{
            $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
            $numChars = strlen($chars);
            $string = '';
            for ($i = 0; $i < $length; $i++) {
                $string .= substr($chars, rand(1, $numChars) - 1, 1);
            }

            $sql = "SELECT `id` FROM `redirect` WHERE `slug` = ?";
            $query = $this->db->query($sql, array($string));

            if($query->num_rows() == 0){
                $work = false;
            }

        } while($work);

        return $string;
    }
}