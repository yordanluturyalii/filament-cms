<a href="{{ route('category.show', $category->slug) }}" wire:navigate>
    <x-mary-badge value="{{ $category->title }}" class="badge badge-primary text-white" />
</a>
