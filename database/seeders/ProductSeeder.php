<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cats = Category::pluck('id', 'slug');

        // Hide any legacy demo products so only these show on the storefront.
        // (Non-destructive — rows are kept, just deactivated.)
        Product::query()->update(['is_active' => false]);

        // name, category slug, main_image (public/images/products), price, old_price, short_desc(bn)
        $rows = [
            [
                'Surge Protective Device (SPD)-AC',
                'hi-tech',
                'images/products/spd-ac.webp',
                1280, 1650,
                'বজ্রপাত ও ভোল্টেজ সার্জ থেকে আপনার বৈদ্যুতিক যন্ত্রপাতি রক্ষা করে।',
            ],
            [
                'Mini Automatic Transfer Switch (ATS)-63A 2P CNC',
                'transfer-switch',
                'images/products/mini-ats-63a.webp',
                4100, 5500,
                'বিদ্যুৎ চলে গেলে স্বয়ংক্রিয়ভাবে জেনারেটর/ব্যাকআপ লাইনে সুইচ করে — ৬৩A, ২ পোল, CNC।',
            ],
            [
                'Solar Light-3 Modes',
                'green-energy',
                'images/products/solar-light-3modes.webp',
                999, 1450,
                'সৌরবিদ্যুৎ চালিত ৩ মোড LED লাইট — রিমোট, মোশন সেন্সর ও ওয়াটারপ্রুফ।',
            ],
            [
                'Type-C Auto Eject Charging Protector',
                'hi-tech',
                'images/products/type-c-protector.webp',
                999, 1350,
                'ফুল চার্জ হলে স্বয়ংক্রিয়ভাবে চার্জিং বন্ধ করে ব্যাটারি ও ডিভাইস সুরক্ষিত রাখে।',
            ],
            [
                'Manual Transfer Switch (MTS)-63A',
                'transfer-switch',
                'images/products/mts-63a.webp',
                1450, 1700,
                'মেইন ও জেনারেটর লাইনের মধ্যে নিরাপদে ম্যানুয়াল সুইচিং — ৬৩A।',
            ],
        ];

        $i = 0;
        foreach ($rows as [$name, $catSlug, $image, $price, $old, $shortBn]) {
            $i++;

            Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'category_id' => $cats[$catSlug] ?? null,
                    'name' => $name,
                    'main_image' => $image,
                    'short_description' => $shortBn,
                    'description' => "<p>{$shortBn}</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</p>",
                    'price' => $price,
                    'old_price' => $old,
                    'stock' => 100,
                    'sku' => 'MET-'.str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                    'rating' => 5,
                    'reviews_count' => 0,
                    'is_active' => true,
                    // Show these products in every home section for now.
                    'is_flash_sale' => true,
                    'is_featured' => true,
                    'is_best_seller' => true,
                    'is_new_arrival' => true,
                    'sort_order' => $i,
                ]
            );
        }
    }
}
