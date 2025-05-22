<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\kotoba;

class KotobaSeeder extends Seeder
{
    public function run(): void
    {
        $vocabularies = [
            'JLPT N5' => [
                [
                    'japanese' => 'こんにちは',
                    'reading' => 'こんにちは',
                    'meaning' => 'Halo',
                    'category' => 'Salam',
                    'hint' => 'Digunakan siang hari',
                ],
                [
                    'japanese' => 'ありがとう',
                    'reading' => 'ありがとう',
                    'meaning' => 'Terima kasih',
                    'category' => 'Salam',
                    'hint' => 'Ekspresi sopan terima kasih',
                ],
                [
                    'japanese' => '水',
                    'reading' => 'みず',
                    'meaning' => 'Air',
                    'category' => 'Alam',
                    'hint' => 'Penting untuk hidup',
                ],
                [
                    'japanese' => '本',
                    'reading' => 'ほん',
                    'meaning' => 'Buku',
                    'category' => 'Benda',
                    'hint' => 'Untuk dibaca',
                ],
                [
                    'japanese' => '食べる',
                    'reading' => 'たべる',
                    'meaning' => 'Makan',
                    'category' => 'Kata Kerja',
                    'hint' => 'Kebalikan dari minum',
                ],
            ],
            'JLPT N4' => [
                [
                    'japanese' => '旅行',
                    'reading' => 'りょこう',
                    'meaning' => 'Bepergian',
                    'category' => 'Aktivitas',
                    'hint' => 'Pergi ke tempat baru',
                ],
                [
                    'japanese' => '勉強',
                    'reading' => 'べんきょう',
                    'meaning' => 'Belajar',
                    'category' => 'Aktivitas',
                    'hint' => 'Yang dilakukan pelajar',
                ],
                [
                    'japanese' => '病気',
                    'reading' => 'びょうき',
                    'meaning' => 'Penyakit',
                    'category' => 'Kesehatan',
                    'hint' => 'Kebalikan dari sehat',
                ],
                [
                    'japanese' => '大切',
                    'reading' => 'たいせつ',
                    'meaning' => 'Penting',
                    'category' => 'Kata Sifat',
                    'hint' => 'Sesuatu yang berharga',
                ],
                [
                    'japanese' => '約束',
                    'reading' => 'やくそく',
                    'meaning' => 'Janji',
                    'category' => 'Abstrak',
                    'hint' => 'Sesuatu yang dijaga',
                ],
            ],
            'Daily Life' => [
                [
                    'japanese' => '朝ご飯',
                    'reading' => 'あさごはん',
                    'meaning' => 'Sarapan',
                    'category' => 'Makanan',
                    'hint' => 'Makan pagi',
                ],
                [
                    'japanese' => '電車',
                    'reading' => 'でんしゃ',
                    'meaning' => 'Kereta',
                    'category' => 'Transportasi',
                    'hint' => 'Berjalan di rel',
                ],
                [
                    'japanese' => '買い物',
                    'reading' => 'かいもの',
                    'meaning' => 'Belanja',
                    'category' => 'Aktivitas',
                    'hint' => 'Dilakukan di mall',
                ],
                [
                    'japanese' => '仕事',
                    'reading' => 'しごと',
                    'meaning' => 'Pekerjaan',
                    'category' => 'Aktivitas',
                    'hint' => 'Yang dilakukan orang dewasa',
                ],
                [
                    'japanese' => '休み',
                    'reading' => 'やすみ',
                    'meaning' => 'Istirahat/Hari Libur',
                    'category' => 'Waktu',
                    'hint' => 'Tidak bekerja',
                ],
            ],
        ];

        foreach ($vocabularies as $level => $items) {
            foreach ($items as $item) {
                kotoba::create(array_merge($item, ['level' => $level]));
            }
        }
    }
}
