<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Start from a clean slate: hide any legacy categories so only the
        // METAIR electrical catalogue shows on the storefront. (Non-destructive —
        // rows are kept, just deactivated.)
        Category::query()->update([
            'is_active' => false,
            'show_in_nav' => false,
            'show_on_home' => false,
        ]);

        // name_en, name_bn, slug, promo_image (wide banner in public/images), icon, sort_order
        $categories = [
            ['Electrical Hi-Tech', 'ইলেকট্রিক্যাল হাই-টেক', 'hi-tech', 'images/1771399318-10.webp', 'fa-solid fa-microchip', 1],
            ['Electrical Accessories', 'ইলেকট্রিক্যাল অ্যাক্সেসরিজ', 'electrical-accessories', 'images/1771399329-09.webp', 'fa-solid fa-plug', 2],
            ['Kitchen & Home Appliances', 'কিচেন ও হোম অ্যাপ্লায়েন্স', 'kitchen-home-appliances', 'images/1771399295-08.webp', 'fa-solid fa-blender', 3],
            ['RCCB & RCBO', 'আরসিসিবি ও আরসিবিও', 'rccb-rcbo', 'images/1771399365-11.webp', 'fa-solid fa-shield-halved', 4],
            ['Transfer Switch', 'ট্রান্সফার সুইচ', 'transfer-switch', 'images/1771399121-01.webp', 'fa-solid fa-arrows-rotate', 5],
            ['Green Energy', 'গ্রিন এনার্জি', 'green-energy', 'images/1774761744-ecoflow-delta-.webp', 'fa-solid fa-solar-panel', 6],
            ['Multi Plugs', 'মাল্টিপ্লাগ', 'multi-plugs', 'images/1771399260-05.webp', 'fa-solid fa-plug-circle-bolt', 7],
            ['Bulb & LED Lights', 'বাল্ব ও এলইডি লাইট', 'bulb-led-lights', 'images/1771402591-02.webp', 'fa-solid fa-lightbulb', 8],
            // --- Hidden behind "See All Categories" ---
            ['Distribution Box', 'ডিস্ট্রিবিউশন বক্স', 'distribution-box', 'images/1771399187-03.webp', 'fa-solid fa-box', 9],
            ['Test Board & Safety', 'টেস্ট বোর্ড ও সেফটি', 'test-board-safety', 'images/1771399221-04.webp', 'fa-solid fa-screwdriver-wrench', 10],
            ['Holders & Ceiling Rose', 'হোল্ডার ও সিলিং রোজ', 'holders-ceiling-rose', 'images/1771399245-06.webp', 'fa-solid fa-circle-dot', 11],
        ];

        foreach ($categories as [$en, $bn, $slug, $promo, $icon, $order]) {
            Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name_en' => $en,
                    'name_bn' => $bn,
                    'promo_image' => $promo,
                    'icon' => $icon,
                    'sort_order' => $order,
                    // Kept out of the slim top nav bar (would overflow on desktop);
                    // discoverable via the home category grid + shop page instead.
                    'show_in_nav' => false,
                    'show_on_home' => true,
                    'is_active' => true,
                    'parent_id' => null,
                ]
            );
        }
    }
}
