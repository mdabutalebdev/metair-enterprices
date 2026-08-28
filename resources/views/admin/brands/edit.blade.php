<x-admin-layout title="Edit Brand">
    <a href="{{ route('admin.brands.index') }}" class="text-sm text-muted hover:text-brand mb-4 inline-block"><i class="fa-solid fa-arrow-left mr-1"></i>Back to Brands</a>
    @include('admin.brands._form')
</x-admin-layout>
