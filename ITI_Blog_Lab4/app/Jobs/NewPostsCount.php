<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class NewPostsCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $timestamps = Cache::get('new_posts', []);

        $timestamps[] = Carbon::now();

        $timestamps = array_filter($timestamps, fn($time) => Carbon::parse($time)->diffInSeconds(Carbon::now()) <= 60);

        Cache::put('new_posts', $timestamps, 3600);

    }
}
