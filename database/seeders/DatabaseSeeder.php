<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\Campanha::factory()->create();
        } catch (\Throwable) {
            try {
                \App\Models\Produto::factory()->create();
            } catch (\Throwable) {
                \App\Models\Grupo::factory(25)->create();
                \App\Models\Cidade::factory(100)->create();
            }
        }
    }
}
