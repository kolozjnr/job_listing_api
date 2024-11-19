<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Listing::create([
            'title' => 'Laravel Senior Developer',
            'tags' => 'laravel, javascript',
            'company' => 'Acme Corp',
            'location' => 'Abuja, FCT',
            'email' => 'K4HvH@example.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium exercitationem, tenetur officiis assumenda minima aliquam iusto quod sint rem a temporibus quis eum sunt esse obcaecati distinctio, nihil quas perspiciatis?'
        ]);

        Listing::create([
            'title' => 'Full-Stack Engineer',
            'tags' => 'laravel, react, javascript',
            'company' => 'Stark Industries',
            'location' => 'New York, NY',
            'email' => 'K4HvH@example.com',
            'website' => 'https://www.starkindustries.com',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae itaque at fugit deserunt eaque asperiores voluptatibus facilis maxime necessitatibus rem, vero suscipit omnis amet, corrupti id, minus ipsum maiores dolore sunt praesentium perspiciatis reiciendis quos commodi molestias. Enim rerum omnis aliquid magnam pariatur officiis ullam fugit! Ipsa unde dolorem veniam.'
        ]);
    }
}
