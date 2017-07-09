<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'link_name' => '海博博客',
                'link_title' => '个人博客之家',
                'link_url' => 'www.hbblog.com',
                'link_order' => 1,
            ],
            [
                'link_name' => '海博公司',
                'link_title' => '欲创公司',
                'link_url' => 'www.haibo.com',
                'link_order' => 2,
            ],
        ];
        DB::table('links')->insert($data);
    }
}
