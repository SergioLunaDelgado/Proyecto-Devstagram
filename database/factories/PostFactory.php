<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /* en el return agregamos nuestro fake para hacer el test la bd 
        para testear esto usamos tinker, tinker es un CLI que ya integra laravel en que cual puede interactuar entre la aplicacion y la bd
        php artisan tinker | $usuario = User::find(5) | Post::factory() | Post::factory()->times(100)->create() | exit */
        return [
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid() . '.jpg', /* testeamos que no se corte el unique id ni la extension */
            'user_id' => $this->faker->randomElement([1,2]),
        ];
    }
}
