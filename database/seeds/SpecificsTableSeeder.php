<?php

use Illuminate\Database\Seeder;

class SpecificsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specifics')->insert([
            'id' => 1,
            'name' => 'Capacity',
            'description' => '',
            'unit' => 'tons',
            'column_name' => 'spec_capacity_ton',
            'type' => 1,
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('specifics')->insert([
            'id' => 2,
            'name' => 'Capacity',
            'description' => '',
            'unit' => 'kg/lbs',
            'column_name' => 'spec_capacity_weight',
            'type' => 1,
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 3,
            'name' => 'Capacity',
            'description' => '',
            'unit' => 'lt/gl',
            'column_name' => 'spec_capacity_cubic',
            'type' => 1,
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 4,
            'name' => 'Length',
            'description' => '',
            'unit' => 'm/y/ft',
            'column_name' => 'spec_length',
            'type' => 1,
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 5,
            'name' => 'Hours',
            'description' => '',
            'unit' => '',
            'column_name' => 'spec_hours',
            'type' => 1,
            'value' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 6,
            'name' => 'Extendahoe',
            'description' => '',
            'unit' => '',
            'column_name' => 'spec_extendahoe',
            'type' => 2,
            'value' => 'Yes/No',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 7,
            'name' => 'Rear Aux Hyd',
            'description' => '',
            'unit' => '',
            'column_name' => 'spec_rear_aux_hyd',
            'type' => 2,
            'value' => 'Yes/No',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 8,
            'name' => 'Cabin',
            'description' => '',
            'unit' => '',
            'column_name' => 'spec_cabin',
            'type' => 2,
            'value' => 'Yes/No',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('specifics')->insert([
            'id' => 9,
            'name' => '4WD',
            'description' => '',
            'unit' => '',
            'column_name' => 'spec_4wd',
            'type' => 2,
            'value' => 'Yes/No',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
