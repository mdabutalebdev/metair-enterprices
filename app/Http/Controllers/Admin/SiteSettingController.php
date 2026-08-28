<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::getAll();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'site_name', 'site_tagline', 'topbar_text', 'phone', 'email', 'address',
            'business_hours',
            'facebook', 'instagram', 'youtube', 'tiktok', 'telegram', 'whatsapp',
            'shipping_inside_dhaka', 'shipping_outside_dhaka', 'footer_text',
            'bkash_number', 'nagad_number', 'payment_instruction',
        ];

        foreach ($fields as $field) {
            SiteSetting::set($field, $request->input($field));
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    /** Platforms shown on the Social Links admin page + footer. */
    public const SOCIAL_PLATFORMS = [
        'facebook'  => ['label' => 'Facebook',  'icon' => 'fa-facebook-f', 'placeholder' => 'https://facebook.com/yourpage'],
        'instagram' => ['label' => 'Instagram', 'icon' => 'fa-instagram',  'placeholder' => 'https://instagram.com/yourpage'],
        'tiktok'    => ['label' => 'TikTok',    'icon' => 'fa-tiktok',     'placeholder' => 'https://tiktok.com/@yourpage'],
        'linkedin'  => ['label' => 'LinkedIn',  'icon' => 'fa-linkedin-in','placeholder' => 'https://linkedin.com/company/yourpage'],
        'whatsapp'  => ['label' => 'WhatsApp',  'icon' => 'fa-whatsapp',   'placeholder' => '8801XXXXXXXXX (digits only)'],
        'youtube'   => ['label' => 'YouTube',   'icon' => 'fa-youtube',    'placeholder' => 'https://youtube.com/@yourchannel'],
    ];

    public function socialEdit()
    {
        $settings = SiteSetting::getAll();

        return view('admin.settings.social', compact('settings'));
    }

    public function socialUpdate(Request $request)
    {
        foreach (array_keys(self::SOCIAL_PLATFORMS) as $key) {
            SiteSetting::set($key, $request->input($key));
            SiteSetting::set($key.'_active', $request->boolean($key.'_active') ? '1' : '0');
        }

        return back()->with('success', 'Social links updated successfully.');
    }

    /** Flash Sale countdown — the end date/time the home timer counts down to. */
    public function counterEdit()
    {
        $settings = SiteSetting::getAll();

        return view('admin.settings.counter', compact('settings'));
    }

    public function counterUpdate(Request $request)
    {
        $data = $request->validate([
            'flash_end_at' => ['nullable', 'date'],
            'flash_enabled' => ['sometimes', 'boolean'],
        ]);

        SiteSetting::set('flash_end_at', $data['flash_end_at'] ?? null);
        SiteSetting::set('flash_enabled', $request->boolean('flash_enabled') ? '1' : '0');

        return back()->with('success', 'Flash counter updated successfully.');
    }
}
