<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'After Movie PKKMB 2023',
                'filename' => 'https://www.youtube.com/embed/m4Fj1Y1fF6U',
                'urutan' => 1
            ],
            [
                'title' => 'After Movie MP2K 2022',
                'filename' => 'https://www.youtube.com/embed/vH_pzodfabo',
                'urutan' => 2
            ],
            [
                'title' => 'After Movie MP2K 2021',
                'filename' => 'https://www.youtube.com/embed/wLMnyw5cQ1g',
                'urutan' => 3
            ],
            [
                'title' => 'After Movie MP2K 2020',
                'filename' => 'https://www.youtube.com/embed/1OwrQll4Dw0',
                'urutan' => 4
            ],
            [
                'title' => 'After Movie MP2K 2019',
                'filename' => 'https://www.youtube.com/embed/1WRd0zrepOg',
                'urutan' => 5
            ],
            [
                'title' => 'Highlight MP2K 2018',
                'filename' => 'https://www.youtube.com/embed/pIsPfy_-UCg',
                'urutan' => 6
            ],
        ];

        foreach ($data as $video) {
            Gallery::create([
                'category' => CATEGORY_GALLERY_VIDEO,
                'title' => $video['title'],
                'filename' => $video['filename'],
                'caption' => null,
                'urutan' => $video['urutan']
            ]);
        }
    }
}
