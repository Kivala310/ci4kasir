<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pelanggan_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pelanggan'       =>[
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'null'          => false,
            ],
            'alamat'             =>[
                'type'          =>'VARCHAR',
                'constraint'    => '225',
                'null'          => false,
            ],
            'no_telp'              =>[
               'type'           =>'VARCHAR',
                'constraint'    => '225', 
                'null'          => false,
            ],
        ]);
        $this->forge->addKey('pelanggan_id', TRUE);
        $this->forge->createTable('tb_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tb_produk');
    }
}

