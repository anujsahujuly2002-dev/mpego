<?php

namespace Database\Seeders;

use App\Models\AccountDeleteReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountDeleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountDeleteReason::create([
            'reason' => 'I no longer need this account',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I am concerned about my privacy',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I am not satisfied with the service',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I am experiencing technical issues',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I want to switch to a different platform',
        ]);     
        AccountDeleteReason::create([
            'reason' => 'I am receiving too many notifications',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I am concerned about data security',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I am not using this account anymore',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I want to start fresh with a new account',
        ]);
        AccountDeleteReason::create([
            'reason' => 'Other',
        ]);
        AccountDeleteReason::create([
            'reason' => 'I am concerned about the content on this platform',
        ]);
        AccountDeleteReason::create([
            'reason' => "I am concerned about the platform's policies",
        ]);
        AccountDeleteReason::create([
            'reason' => "I am concerned about the platform's advertising practices",
        ]);         
    }
}
