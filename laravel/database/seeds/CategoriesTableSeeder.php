<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catList = ['Caps','Keycords','Mugs','Phonecases','Shirts','USB'];
        for( $i = 0 ; $i < count($catList) ; $i++ )
        {
            DB::table('categories')->insert
            (
                [
                    'name' => $catList[$i],
                ]
            );
        }
    }
}
