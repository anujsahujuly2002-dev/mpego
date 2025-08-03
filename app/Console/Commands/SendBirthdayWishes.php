<?php

namespace App\Console\Commands;

use App\Models\GiftCard;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserBirthdayGift;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Notifications\BirthdayWishNotification;

class SendBirthdayWishes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-birthday-wishes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday emails and notifications to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->format('m-d');
        $users = User::whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') = ?", [$today])->get();
        // dd($users,$today);
         foreach ($users as $user) {
            $giftCardScratch = false;
            $token = Str::uuid(); // Or Str::random(32)
            $giftCard = GiftCard::whereDoesntHave('userBirthDayGift')->inRandomOrder()->first();
            if(!is_null($giftCard)):
                $giftCardScratch = true;
                UserBirthdayGift::create([
                    'user_id' => $user->id,
                    'gift_card_id'    => $giftCard->id,
                    'token'   => $token,
                ]);
            endif;
            // dd($user);
            $user->notify(New BirthdayWishNotification($user,$token,$giftCardScratch));
        }

        $this->info('Birthday wishes sent successfully.');
    }
}
