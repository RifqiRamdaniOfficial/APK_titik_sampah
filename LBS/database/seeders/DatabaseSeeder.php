<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Region;
use App\Models\Req;
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


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::Create([
            'name' => 'Rifqi Ramdani',
            'email' => 'rifqi@gmail.com',
            'username' => 'rifqiramdani',
            'password' => bcrypt('12345'),
            'type' => 'admin'
        ]);
        User::Create([
            'name' => 'Manu Dzalilof',
            'email' => 'petugas@gmail.com',
            'username' => 'ptugas',
            'password' => bcrypt('12345'),
            'type' => 'petugas'
        ]);
        User::Create([
            'name' => 'Rashid',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'password' => bcrypt('12345'),
            'type' => 'user'
        ]);
        User::factory(3)->create();

        Category::Create([
            'name' => 'Culture',
            'slug' => 'culture'
        ]);
        Category::Create([
            'name' => 'Social',
            'slug' => 'social'
        ]);
        Category::Create([
            'name' => 'Environment',
            'slug' => 'environment'
        ]);

        Region::Create([
            'region_no' => '1',
            'name'=> 'Romo',
            'phone' => '628321208442'
        ]);
        Region::Create([
            'region_no' => '2',
            'name'=> 'Romi',
            'phone' => '628321208443'
        ]);

        Post::factory(20)->create();
        Req::factory(20)->create();
        Region::factory(13)->create();
    
    }
}
