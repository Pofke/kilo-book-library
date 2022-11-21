<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {

        $genre = $this->faker->randomElement(['Fantasy', 'Adventure', 'Romance', 'Contemporary', 'Dystopian', 'Mystery', 'Horror', 'Thriller', 'Paranormal', 'Historical fiction', 'Science Fiction', 'Children\'s', 'Memoir', 'Cookbook', 'Art', 'Self-help', 'Development', 'Motivational', 'Health', 'History', 'Travel', 'Guide / How-to', 'Families & Relationships', 'Humor']);

        return [
            'name' => rtrim($this->faker->sentence(3), "."),
            'author' => $this->faker->name(),
            'year' => $this->faker->year(),
            'genre' => $genre,
            'pages' => $this->faker->numberBetween(50, 850),
            'language' => $this->faker->languageCode(),
            'quantity' => $this->faker->numberBetween(10, 30)
        ];
    }
}
