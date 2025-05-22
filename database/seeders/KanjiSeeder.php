<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\kanji;

class KanjiSeeder extends Seeder
{
    public function run(): void
    {
        $kanjis = [
            'JLPT N5' => [
                [
                    'character' => '山',
                    'meaning' => 'Gunung',
                    'onyomi' => 'サン',
                    'kunyomi' => 'やま',
                    'category' => 'Alam',
                    'hint' => 'Formasi alam yang tinggi',
                ],
                [
                    'character' => '水',
                    'meaning' => 'Air',
                    'onyomi' => 'スイ',
                    'kunyomi' => 'みず',
                    'category' => 'Alam',
                    'hint' => 'Cairan penting',
                ],
                [
                    'character' => '人',
                    'meaning' => 'Orang',
                    'onyomi' => 'ジン、ニン',
                    'kunyomi' => 'ひと',
                    'category' => 'Manusia',
                    'hint' => 'Makhluk manusia',
                ],
                [
                    'character' => '日',
                    'meaning' => 'Hari/Matahari',
                    'onyomi' => 'ニチ、ジツ',
                    'kunyomi' => 'ひ、か',
                    'category' => 'Alam',
                    'hint' => 'Cerah di langit',
                ],
                [
                    'character' => '月',
                    'meaning' => 'Bulan',
                    'onyomi' => 'ゲツ、ガツ',
                    'kunyomi' => 'つき',
                    'category' => 'Alam',
                    'hint' => 'Bentuknya berubah',
                ],
            ],
            'JLPT N4' => [
                [
                    'character' => '車',
                    'meaning' => 'Mobil',
                    'onyomi' => 'シャ',
                    'kunyomi' => 'くるま',
                    'category' => 'Benda',
                    'hint' => 'Kendaraan beroda',
                ],
                [
                    'character' => '店',
                    'meaning' => 'Toko',
                    'onyomi' => 'テン',
                    'kunyomi' => 'みせ',
                    'category' => 'Tempat',
                    'hint' => 'Tempat membeli barang',
                ],
                [
                    'character' => '道',
                    'meaning' => 'Jalan',
                    'onyomi' => 'ドウ',
                    'kunyomi' => 'みち',
                    'category' => 'Tempat',
                    'hint' => 'Tempat berjalan',
                ],
                [
                    'character' => '食',
                    'meaning' => 'Makan/Makanan',
                    'onyomi' => 'ショク',
                    'kunyomi' => 'たべる',
                    'category' => 'Aksi',
                    'hint' => 'Yang dilakukan saat makan',
                ],
                [
                    'character' => '飲',
                    'meaning' => 'Minum',
                    'onyomi' => 'イン',
                    'kunyomi' => 'のむ',
                    'category' => 'Aksi',
                    'hint' => 'Kebalikan dari makan',
                ],
            ],
            'Common Kanji' => [
                [
                    'character' => '学',
                    'meaning' => 'Belajar',
                    'onyomi' => 'ガク',
                    'kunyomi' => 'まなぶ',
                    'category' => 'Pendidikan',
                    'hint' => 'Yang dilakukan murid',
                ],
                [
                    'character' => '校',
                    'meaning' => 'Sekolah',
                    'onyomi' => 'コウ',
                    'kunyomi' => 'なし',
                    'category' => 'Pendidikan',
                    'hint' => 'Tempat belajar',
                ],
                [
                    'character' => '会',
                    'meaning' => 'Pertemuan/Perkumpulan',
                    'onyomi' => 'カイ',
                    'kunyomi' => 'あう',
                    'category' => 'Sosial',
                    'hint' => 'Kumpul orang-orang',
                ],
                [
                    'character' => '社',
                    'meaning' => 'Perusahaan/Kuil',
                    'onyomi' => 'シャ',
                    'kunyomi' => 'やしろ',
                    'category' => 'Tempat',
                    'hint' => 'Bisa bisnis atau keagamaan',
                ],
                [
                    'character' => '駅',
                    'meaning' => 'Stasiun',
                    'onyomi' => 'エキ',
                    'kunyomi' => 'なし',
                    'category' => 'Transportasi',
                    'hint' => 'Tempat kereta berhenti',
                ],
            ],
        ];

        foreach ($kanjis as $level => $items) {
            foreach ($items as $item) {
                kanji::create(array_merge($item, ['level' => $level]));
            }
        }
    }
}
