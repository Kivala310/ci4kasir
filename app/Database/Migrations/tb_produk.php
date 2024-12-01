<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'produk_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_produk'       =>[
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'null'          => false,
            ],
            'harga'             =>[
                'type'          =>'decimal',
                'constraint'    => '10,2',
                'null'          => false,
            ],
            'stok'              =>[
               'type'           =>'INT',
                'constraint'    => 11, 
                'null'          => false,
            ],
        ]);
        $this->forge->addKey('produk_id', TRUE);
        $this->forge->createTable('tb_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tb_produk');
    }
}
