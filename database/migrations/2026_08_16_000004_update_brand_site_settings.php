<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Point the live site branding at METAIR ENTERPRISE. Uses the model helper
     * so timestamps are handled and the row is created if missing.
     */
    public function up(): void
    {
        SiteSetting::set('site_name', 'METAIR ENTERPRISE');
        SiteSetting::set('footer_text', 'METAIR ENTERPRISE — your trusted online shopping platform delivering quality products across Bangladesh.');
    }

    public function down(): void
    {
        // Branding change is intentional; nothing to roll back.
    }
};
