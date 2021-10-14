<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
         // \App\Models\Theme::factory(10)->create();

    }
}
