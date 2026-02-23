<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Tambah kolom event_id
            if (!Schema::hasColumn('tickets', 'event_id')) {
                $table->foreignId('event_id')->after('user_id')->nullable()->constrained();
            }

            // Hapus kolom showtime_id jika ada (karena kita pindah ke event)
            if (Schema::hasColumn('tickets', 'showtime_id')) {
                $table->dropForeign(['showtime_id']);
                $table->dropColumn('showtime_id');
            }

            // Hapus kolom seats jika ada (karena event tidak pakai kursi)
            if (Schema::hasColumn('tickets', 'seats')) {
                $table->dropColumn('seats');
            }

            // Tambah kolom ticket_details untuk menyimpan detail kategori tiket
            if (!Schema::hasColumn('tickets', 'ticket_details')) {
                $table->json('ticket_details')->after('quantity')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
            $table->dropColumn('ticket_details');

            // Kembalikan kolom yang dihapus
            $table->foreignId('showtime_id')->nullable()->constrained();
            $table->json('seats')->nullable();
        });
    }
};
