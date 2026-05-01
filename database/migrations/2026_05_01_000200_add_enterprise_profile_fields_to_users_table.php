<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('username', 60)->nullable()->unique()->after('name');
            $table->string('job_title', 120)->nullable()->after('email');
            $table->string('department', 120)->nullable()->after('job_title');
            $table->string('phone', 40)->nullable()->after('department');
            $table->string('location', 160)->nullable()->after('phone');
            $table->string('timezone', 64)->default('Asia/Kolkata')->after('location');
            $table->string('website_url', 255)->nullable()->after('timezone');
            $table->string('linkedin_url', 255)->nullable()->after('website_url');
            $table->string('avatar_url', 500)->nullable()->after('linkedin_url');
            $table->text('bio')->nullable()->after('avatar_url');
        });

        $existingUsernames = [];

        DB::table('users')->orderBy('id')->get(['id', 'name', 'email'])->each(function ($user) use (&$existingUsernames): void {
            $base = Str::slug((string) explode('@', (string) $user->email)[0], '_');
            if ($base === '') {
                $base = Str::slug((string) $user->name, '_');
            }
            if ($base === '') {
                $base = 'user';
            }

            $candidate = $base;
            $counter = 1;
            while (in_array($candidate, $existingUsernames, true) || DB::table('users')->where('username', $candidate)->where('id', '!=', $user->id)->exists()) {
                $counter++;
                $candidate = $base.'_'.$counter;
            }

            $existingUsernames[] = $candidate;

            DB::table('users')->where('id', $user->id)->update([
                'username' => $candidate,
                'timezone' => 'Asia/Kolkata',
            ]);
        });

    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'username',
                'job_title',
                'department',
                'phone',
                'location',
                'timezone',
                'website_url',
                'linkedin_url',
                'avatar_url',
                'bio',
            ]);
        });
    }
};
