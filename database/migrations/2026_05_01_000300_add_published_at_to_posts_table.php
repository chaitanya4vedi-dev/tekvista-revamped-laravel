<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->dateTime('published_at')->nullable()->after('read_time')->index();
        });

        DB::table('posts')
            ->whereNotNull('published_on')
            ->orderBy('id')
            ->chunkById(100, function ($rows): void {
                foreach ($rows as $row) {
                    if (empty($row->published_on)) {
                        continue;
                    }

                    $publishedUtc = Carbon::parse($row->published_on . ' 09:00:00', 'Asia/Kolkata')->utc();
                    DB::table('posts')->where('id', $row->id)->update(['published_at' => $publishedUtc]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table): void {
            $table->dropColumn('published_at');
        });
    }
};
