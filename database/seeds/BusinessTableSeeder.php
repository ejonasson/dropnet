<?php

use App\Models\Business\Business;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Business::class)
            ->create(['name' => 'Test', 'slug' => 'test'])
            ->each(function ($b) {
                $user = factory(User::class)->create([
                    'email' => 'ejonasson@gmail.com',
                ]);
                $user->businesses()->attach($b->id);
                $b->updateSettings([
                    'secret_key' => env('TEST_STRIPE_SECRET_KEY'),
                    'publishable_key' => env('TEST_STRIPE_PUBLISHABLE_KEY')
                ]);
                $b->save();
            });
    }
}
