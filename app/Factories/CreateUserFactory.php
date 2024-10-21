<?php

namespace App\Factories;
use App\Actions\Social\CreateXUser;

class CreateUserFactory {
    public function forService(string $service) {
        return match ($service) {
            'twitter' => new CreateXUser(),
            'default' => throw new \Exception('Unsupported Service')
        };
    }
}
