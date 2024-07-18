<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate a random image URL
        $imageUrl = $this->faker->imageUrl(300, 300);

        // Fetch image contents and store in Laravel storage
        $imageContents = file_get_contents($imageUrl);
        $imageName = 'image_' . time() . '.jpg'; // Customize image file name as needed

        // Store image in Laravel storage
        Storage::put('public/employee/' . $imageName, $imageContents);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => Str::random(7),
            'experience' => Str::random(2),
            'salary' => $this->faker->randomNumber(7),
            'vacation' => Str::random(7),
            'city' => Str::random(5),
            'image' => 'upload/employee/' . $imageName,
            'created_at' => Carbon::now(),
        ];
    }
}
