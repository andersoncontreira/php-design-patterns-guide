<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->container->get('');
        $json_data = file_get_contents(base_path() . '/tests/Datasources/database/products/products.sample.json');
        $data = json_decode($json_data, true);

        DB::table('products')->insert($data);
    }
}
