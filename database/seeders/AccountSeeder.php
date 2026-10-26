<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::updateOrCreate(
    ['email' => 'admin@bitebyay.test'],
    [
        'name' => 'Admin',
        'password' => Hash::make('password123'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]
);

User::updateOrCreate(
    ['email' => 'customer@bitebyay.test'],
    [
        'name' => 'Customer',
        'password' => Hash::make('password123'),
        'role' => 'customer',
        'email_verified_at' => now(),
    ]
);

echo "Akun admin & customer berhasil dibuat\n";
