<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random image URL
        $imageUrl = $this->faker->imageUrl(300, 300);

        // Fetch image contents and store in Laravel storage
        $imageContents = file_get_contents($imageUrl);
        $imageName = 'image_' . time() . '.jpg'; // Customize image file name as needed

        // Store image in Laravel storage
        Storage::put('public/customer/' . $imageName, $imageContents);
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber(),
            'address' => Str::random(7),
            'shopname' => Str::random(7),
            'account_holder' => Str::random(5),
            'account_number' => fake()->randomNumber(7),
            'bank_name' => Str::random(3),
            'bank_branch' => Str::random(3),
            'city' => Str::random(5),
            'image' => 'upload/customer/' . $imageName,
            'created_at' => Carbon::now(),
        ];
    }
}
