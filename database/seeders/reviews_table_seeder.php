<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class reviews_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $init_reviews =[
            [
                'book_id' => '1',
                'score' => '100',
                'review' => 'とてもためになる本。普段勉強があまり進められない人でもこの本を読んでコツをつかむことで、勉強に対するモチベーションが上がるので、ぜひ読んでみてください！',


            ],
            [
                'book_id' => '2',
                'score' => '100',
                'review' => 'とてもためになる本。普段勉強があまり進められない人でもこの本を読んでコツをつかむことで、勉強に対するモチベーションが上がるので、ぜひ読んでみてください！',


            ],
        ];

        foreach($init_reviews as $review){
            $data = new Review();
            $data->book_id = $review['book_id'];
            $data->score = $review['score'];
            $data->review = $review['review'];
            $data->save();
        }

}
}
