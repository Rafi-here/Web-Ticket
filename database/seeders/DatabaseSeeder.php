<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Film;
use App\Models\Cinema;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@bpix.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user@bpix.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Action', 'slug' => 'action'],
            ['name' => 'Comedy', 'slug' => 'comedy'],
            ['name' => 'Drama', 'slug' => 'drama'],
            ['name' => 'Horror', 'slug' => 'horror'],
            ['name' => 'Sci-Fi', 'slug' => 'sci-fi'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create cinemas
        $cinemas = [
            [
                'name' => 'XXI Grand Indonesia',
                'city' => 'Jakarta',
                'address' => 'Grand Indonesia, Jl. MH Thamrin No.1',
                'phone' => '021-12345678',
                'facilities' => json_encode(['Parkir', 'Food Court', 'IMAX']),
            ],
            [
                'name' => 'CGV Central Park',
                'city' => 'Jakarta',
                'address' => 'Central Park Mall, Jl. Letjen S. Parman',
                'phone' => '021-87654321',
                'facilities' => json_encode(['Parkir', 'Food Court', '4DX']),
            ],
        ];

        foreach ($cinemas as $cinema) {
            Cinema::create($cinema);
        }

        // Create sample films
        $film1 = Film::create([
            'title' => 'Dune: Part Two',
            'poster' => 'https://via.placeholder.com/300x450?text=Dune+2',
            'genre' => 'Sci-Fi, Adventure',
            'duration' => 166,
            'rating_age' => '13+',
            'synopsis' => 'Paul Atreides bersatu dengan Chani dan Fremen untuk membalas dendam terhadap konspirator yang menghancurkan keluarganya.',
            'status' => 'now_playing',
            'category_id' => 5,
            'director' => 'Denis Villeneuve',
            'cast' => 'Timothée Chalamet, Zendaya, Austin Butler',
            'release_date' => '2024-03-01',
        ]);

        $film2 = Film::create([
            'title' => 'Godzilla x Kong',
            'poster' => 'https://via.placeholder.com/300x450?text=Godzilla+x+Kong',
            'genre' => 'Action, Sci-Fi',
            'duration' => 115,
            'rating_age' => '13+',
            'synopsis' => 'Godzilla dan Kong bersatu melawan ancaman kolosal yang mengancam dunia.',
            'status' => 'now_playing',
            'category_id' => 1,
            'director' => 'Adam Wingard',
            'cast' => 'Rebecca Hall, Brian Tyree Henry',
            'release_date' => '2024-03-29',
        ]);

        $film3 = Film::create([
            'title' => 'Kung Fu Panda 4',
            'poster' => 'https://via.placeholder.com/300x450?text=Kung+Fu+Panda+4',
            'genre' => 'Animation, Comedy',
            'duration' => 94,
            'rating_age' => 'SU',
            'synopsis' => 'Po mencari Dragon Warrior baru sambil menghadapi penjahat baru yang disebut The Chameleon.',
            'status' => 'coming_soon',
            'category_id' => 2,
            'director' => 'Mike Mitchell',
            'cast' => 'Jack Black, Awkwafina',
            'release_date' => '2024-06-14',
        ]);

        // Create banners
        $banners = [
            [
                'title' => 'Dune: Part Two',
                'subtitle' => 'Now Playing',
                'image' => 'https://via.placeholder.com/1200x400?text=Dune+Banner',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Godzilla x Kong',
                'subtitle' => 'The New Empire',
                'image' => 'https://via.placeholder.com/1200x400?text=Godzilla+Banner',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        // Create settings
        $settings = [
            ['key' => 'logo_type', 'value' => 'text', 'type' => 'text'],
            ['key' => 'logo_text', 'value' => 'TIX', 'type' => 'text'],
            ['key' => 'logo_image', 'value' => null, 'type' => 'image'],
            ['key' => 'site_name', 'value' => 'TIX - Bioskop Modern', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}