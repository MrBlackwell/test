<?php
/**
 * Created by PhpStorm.
 * User: ivano
 * Date: 10.09.2018
 * Time: 14:53
 */

class Migration_Add_redirect extends CI_Migration
{
    public function up(){
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ),
            'original_link' => array(
                'type' => 'TEXT',
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '10'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        //$this->dbforge->add_index('slug', TRUE);
        $this->dbforge->create_table('redirect');

        $sql = "CREATE INDEX `link_index` ON `redirect`(`original_link`(1024))";
        $this->db->query($sql);

        $sql = "CREATE INDEX `slug_index` ON `redirect`(`slug`)";
        $this->db->query($sql);
    }

    public function down(){
        $this->dbforge->drop_table('blog');
    }
}