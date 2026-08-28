<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryBannerController extends Controller
{
    public function index()
    {
        $banners = CategoryBanner::with('category')->orderBy('category_id')->orderBy('sort_order')->get();

        return view('admin.category_banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.category_banners.create', [
            'banner' => new CategoryBanner,
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data = $this->handleImage($request, $data);
        $data['is_active'] = $request->boolean('is_active');

        CategoryBanner::create($data);

        return redirect()->route('admin.category-banners.index')->with('success', 'Category banner added successfully.');
    }

    public function edit(CategoryBanner $categoryBanner)
    {
        return view('admin.category_banners.edit', [
            'banner' => $categoryBanner,
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function update(Request $request, CategoryBanner $categoryBanner)
    {
        $data = $this->validated($request);
        $data = $this->handleImage($request, $data, $categoryBanner);
        $data['is_active'] = $request->boolean('is_active');

        $categoryBanner->update($data);

        return redirect()->route('admin.category-banners.index')->with('success', 'Category banner updated successfully.');
    }

    public function destroy(CategoryBanner $categoryBanner)
    {
        if ($categoryBanner->image && ! str_starts_with($categoryBanner->image, 'http')) {
            Storage::disk('public')->delete($categoryBanner->image);
        }

        $categoryBanner->delete();

        return back()->with('success', 'Category banner deleted successfully.');
    }

    private function categoryOptions()
    {
        return Category::orderBy('sort_order')->orderBy('name_en')->get();
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:1000',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
            'image_url' => 'nullable|string|max:1000',
        ]);
    }

    private function handleImage(Request $request, array $data, ?CategoryBanner $banner = null): array
    {
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('category-banners', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        } else {
            $data['image'] = $banner?->image ?? 'https://placehold.co/1200x375/0e9495/ffffff?text=Category+Banner';
        }

        unset($data['image_url']);

        return $data;
    }
}
