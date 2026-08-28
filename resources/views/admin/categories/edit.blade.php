<x-admin-layout title="Edit Category">
    <a href="{{ route('admin.categories.index') }}" class="text-sm text-muted hover:text-brand mb-4 inline-block"><i class="fa-solid fa-arrow-left mr-1"></i>Back</a>
    @include('admin.categories._form')
</x-admin-layout>
