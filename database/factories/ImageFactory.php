<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'sandal',
            'price' => 3000,
            'info_head' => '毎日履きたくなる、スニーカー。',
            'file_name' => 'storage/images/beigesandal.jpg',
            'info' => '朝の支度が、格段にラクになる一足。新ウルで秋の来ないチームコートは、クリーンでモダンなデザインが魅力。合わせたいのは、デニムやバギースウェット。スタイリッシュなレザーアッパーとフレッシュなカラーが、どんなコーディねーも引き締めてくれる。もちろん、履き心地の良さもいうことなし。'
        ];
    }
}
