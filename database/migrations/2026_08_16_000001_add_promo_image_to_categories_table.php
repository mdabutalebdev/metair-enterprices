<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Wide promotional image used by the home "Categories" cards (the
     * banner-style promo tiles). Kept separate from `image` (the small square
     * icon/thumbnail) so both looks can be managed independently.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('promo_image')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('promo_image');
        });
    }
};
