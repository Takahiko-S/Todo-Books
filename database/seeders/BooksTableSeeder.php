<?php

namespace Database\Seeders;

use App\Models\Book;

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $init_books =[
                [
                    'u_id'=> 1,
                    'title' => '若葉ちゃんと学ぶgit使い方入門',
                    'sakusya' => '湊川あい',
                    'readend' => '2023-6-5',
                    'image_path' => '122.png'


                ],
                [
                    'u_id'=> 1,
                    'title' => '無駄にならない勉強法',
                    'sakusya' => '樺沢紫苑',
                    'readend' => '2023-4-5',
                    'image_path' => '123.png'
                ],
            ];

            foreach($init_books as $book){
                $data = new Book();
                $data->u_id = $book['u_id'];
                $data->title = $book['title'];
                $data->sakusya = $book['sakusya'];
                $data->readend = $book['readend'];
                $data->image_path= $book['image_path'];
                $data->save();
            }

    }
}
