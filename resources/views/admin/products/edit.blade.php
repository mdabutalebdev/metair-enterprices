<x-admin-layout title="Edit Product">
    <a href="{{ route('admin.products.index') }}" class="text-sm text-muted hover:text-brand mb-4 inline-block"><i class="fa-solid fa-arrow-left mr-1"></i>Back to Products</a>
    @include('admin.products._form')
</x-admin-layout>
