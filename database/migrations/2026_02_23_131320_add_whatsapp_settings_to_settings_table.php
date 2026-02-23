<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $settings = [
                [
                    'key' => 'whatsapp_number',
                    'value' => '628123456789',
                    'type' => 'text',
                    'group' => 'whatsapp',
                    'description' => 'Nomor WhatsApp untuk pemesanan tiket'
                ],
                [
                    'key' => 'whatsapp_message_template',
                    'value' => "Halo, saya ingin memesan tiket untuk event *{event_title}*\n\nDetail Pemesanan:\n- Nama: {name}\n- Email: {email}\n- Event: {event_title}\n- Tanggal: {event_date}\n- Jam: {event_time}\n- Tiket:\n{ticket_details}\n- Total: Rp {total_price}\n\nMohon konfirmasi ketersediaan tiket. Terima kasih.",
                    'type' => 'text',
                    'group' => 'whatsapp',
                    'description' => 'Template pesan WhatsApp (gunakan {variable} untuk data dinamis)'
                ],
                [
                    'key' => 'whatsapp_enabled',
                    'value' => 'true',
                    'type' => 'boolean',
                    'group' => 'whatsapp',
                    'description' => 'Aktifkan pemesanan via WhatsApp'
                ],
            ];

            foreach ($settings as $setting) {
                DB::table('settings')->insert($setting);
            }
        });
    }

    public function down()
    {
        DB::table('settings')->whereIn('key', [
            'whatsapp_number',
            'whatsapp_message_template',
            'whatsapp_enabled'
        ])->delete();
    }
};
