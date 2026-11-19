<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('##################'),
            'nama_lengkap' => fake()->name(),
            'jabatan' => 'Pelaksana Subbag Umum & Kepegawaian',
            'pangkat_golongan' => 'Penata Muda (III/a)',
            'no_hp' => fake()->numerify('0812########'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
            'password' => static::$password ??= Hash::make('DukcapilOKI#2026'),
            'pin_tte' => null,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
