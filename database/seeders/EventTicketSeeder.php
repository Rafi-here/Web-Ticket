<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\TicketCategory;
use Carbon\Carbon;

class EventTicketSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama jika ada
        TicketCategory::truncate();
        Event::truncate();

        // Event 1: Bruno Mars
        $bruno = Event::create([
            'title' => 'Bruno Mars: 24K Magic Tour',
            'slug' => 'bruno-mars-24k-magic-tour',
            'poster' => 'events/bruno-mars.jpg',
            'category' => 'Konser',
            'duration' => 150,
            'event_date' => Carbon::parse('2025-06-15'),
            'event_time' => '19:30:00',
            'venue' => 'Stadion Utama Gelora Bung Karno',
            'city' => 'Jakarta',
            'address' => 'Jl. Pintu Satu Senayan, Jakarta Pusat',
            'description' => 'Bruno Mars kembali ke Jakarta dengan 24K Magic Tour. Saksikan penampilan spektakuler dari pemenang Grammy Award ini dengan hits seperti "Just The Way You Are", "Grenade", "24K Magic", dan "Locked Out of Heaven".',
            'status' => 'upcoming',
            'artists' => json_encode(['Bruno Mars']),
            'age_rating' => 'SU',
        ]);

        TicketCategory::create([
            'event_id' => $bruno->id,
            'name' => 'VIP',
            'description' => 'Akses VIP + Meet & Greet dengan Bruno Mars',
            'price' => 3500000,
            'quantity' => 200,
            'available' => 200,
            'max_per_order' => 2,
            'benefits' => json_encode(['Meet & Greet', 'Foto bersama', 'Merchandise eksklusif', 'Akses VIP Lounge']),
        ]);

        TicketCategory::create([
            'event_id' => $bruno->id,
            'name' => 'CAT 1',
            'description' => 'Tribune Timur & Barat (Area Tengah)',
            'price' => 2000000,
            'quantity' => 500,
            'available' => 500,
            'max_per_order' => 4,
            'benefits' => json_encode(['View terbaik', 'Snack & minuman']),
        ]);

        TicketCategory::create([
            'event_id' => $bruno->id,
            'name' => 'CAT 2',
            'description' => 'Tribune Utara & Selatan',
            'price' => 1250000,
            'quantity' => 800,
            'available' => 800,
            'max_per_order' => 5,
            'benefits' => null,
        ]);

        // Event 2: Coldplay
        $coldplay = Event::create([
            'title' => 'Coldplay: Music of the Spheres World Tour',
            'slug' => 'coldplay-music-of-the-spheres-tour',
            'poster' => 'events/coldplay.jpg',
            'category' => 'Konser',
            'duration' => 180,
            'event_date' => Carbon::parse('2025-08-20'),
            'event_time' => '19:00:00',
            'venue' => 'Stadion Internasional Jakarta',
            'city' => 'Jakarta',
            'address' => 'Jl. BSD Raya Utama, Tangerang',
            'description' => 'Coldplay akan membawa tur "Music of the Spheres" ke Jakarta. Nikmati pengalaman konser spektakuler dengan灯光, fireworks, dan hits seperti "Yellow", "Viva La Vida", "Fix You", dan "My Universe".',
            'status' => 'upcoming',
            'artists' => json_encode(['Coldplay']),
            'age_rating' => 'SU',
        ]);

        TicketCategory::create([
            'event_id' => $coldplay->id,
            'name' => 'Ultimate Experience',
            'description' => 'Paket pengalaman terbaik',
            'price' => 4500000,
            'quantity' => 100,
            'available' => 100,
            'max_per_order' => 2,
            'benefits' => json_encode(['Soundcheck party', 'Merchandise limited', 'Akses backstage', 'Makan malam']),
        ]);

        TicketCategory::create([
            'event_id' => $coldplay->id,
            'name' => 'Festival',
            'description' => 'Area festival berdiri',
            'price' => 2250000,
            'quantity' => 1000,
            'available' => 1000,
            'max_per_order' => 4,
            'benefits' => null,
        ]);

        TicketCategory::create([
            'event_id' => $coldplay->id,
            'name' => 'Tribune',
            'description' => 'Tribune duduk',
            'price' => 1500000,
            'quantity' => 1500,
            'available' => 1500,
            'max_per_order' => 5,
            'benefits' => null,
        ]);

        // Event 3: Java Jazz Festival
        $jazz = Event::create([
            'title' => 'Java Jazz Festival 2025',
            'slug' => 'java-jazz-festival-2025',
            'poster' => 'events/java-jazz.jpg',
            'category' => 'Festival',
            'duration' => 480,
            'event_date' => Carbon::parse('2025-09-05'),
            'event_time' => '12:00:00',
            'venue' => 'JIEXPO Kemayoran',
            'city' => 'Jakarta',
            'address' => 'Jakarta International Expo, Kemayoran',
            'description' => 'Festival jazz terbesar di Asia Tenggara kembali dengan lineup internasional dan lokal terbaik. 3 hari penuh musik jazz, fusion, dan soul.',
            'status' => 'upcoming',
            'artists' => json_encode(['John Legend', 'Norah Jones', 'Tulus', 'Andmesh']),
            'age_rating' => 'SU',
        ]);

        TicketCategory::create([
            'event_id' => $jazz->id,
            'name' => '3 Days Pass',
            'description' => 'Akses 3 hari festival',
            'price' => 2500000,
            'quantity' => 1000,
            'available' => 1000,
            'max_per_order' => 4,
            'benefits' => json_encode(['Akses semua stage', 'Festival kit']),
        ]);

        TicketCategory::create([
            'event_id' => $jazz->id,
            'name' => '1 Day Pass',
            'description' => 'Akses 1 hari (pilih tanggal)',
            'price' => 1000000,
            'quantity' => 2000,
            'available' => 2000,
            'max_per_order' => 5,
            'benefits' => null,
        ]);

        // Event 4: Ed Sheeran
        $ed = Event::create([
            'title' => 'Ed Sheeran: +-=÷x Tour',
            'slug' => 'ed-sheeran-tour',
            'poster' => 'events/ed-sheeran.jpg',
            'category' => 'Konser',
            'duration' => 160,
            'event_date' => Carbon::parse('2025-10-10'),
            'event_time' => '19:30:00',
            'venue' => 'Stadion Madya Gelora Bung Karno',
            'city' => 'Jakarta',
            'address' => 'Kompleks Gelora Bung Karno, Jakarta Pusat',
            'description' => 'Ed Sheeran, penyanyi dan penulis lagu asal Inggris, akan tampil di Jakarta dengan tur "Mathematics". Saksikan hits seperti "Shape of You", "Perfect", "Thinking Out Loud", dan "Bad Habits".',
            'status' => 'upcoming',
            'artists' => json_encode(['Ed Sheeran']),
            'age_rating' => 'SU',
        ]);

        TicketCategory::create([
            'event_id' => $ed->id,
            'name' => 'VIP',
            'description' => 'Package VIP',
            'price' => 3000000,
            'quantity' => 150,
            'available' => 150,
            'max_per_order' => 2,
            'benefits' => json_encode(['Meet & Greet', 'Merchandise']),
        ]);

        TicketCategory::create([
            'event_id' => $ed->id,
            'name' => 'Festival',
            'description' => 'Area festival',
            'price' => 1750000,
            'quantity' => 800,
            'available' => 800,
            'max_per_order' => 4,
            'benefits' => null,
        ]);

        $this->command->info('Events and ticket categories seeded successfully!');
    }
}
