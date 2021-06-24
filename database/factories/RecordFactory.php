<?php


namespace Database\Factories;

use App\Models\Records;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class RecordFactory extends Factory
{
    protected $model = Records::class;

    public function definition()
    {
        return [
            'source' => $this->faker->text(),
            'password' => $this->faker->password(),
            'login' => $this->faker->name(),
            'url' => $this->faker->url,
            'comment' => $this->faker->paragraph,
        ];
    }
}
