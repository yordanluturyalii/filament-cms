<a href="{{ route('article.show', $article->slug) }}"
    class="group flex flex-col h-full border border-gray-200 bg-white rounded-lg shadow-md overflow-hidden p-5" wire:navigate>
    <div class="aspect-w-16 aspect-h-11">
        <picture>
            <img src="/storage/{{ $article->image->path }}" alt="{{ $article->image->alt_text }}"
                class="w-full object-cover rounded-xl">
        </picture>
        <div class="my-6">
            <h3 class="text-xl font-semibold text-gray-800">
                {{ $article->title }}
            </h3>
            @if ($article->content)
                <p class="mt-5 text-gray-600 text-clip">
                    {!! tiptap_converter()->asHTML(Str::limit($article->content, 100)) !!}
                </p>
            @endif
        </div>
        <div class="mt-auto flex items-center gap-x-3">
            <img src="{{ $article?->user?->profile_photo_url }}" alt="{{ $article?->user?->name }}"
                class="w-8 h-8 rounded-full">
            <div>
                <h5 class="text-sm text-gray-800">By {{ $article->user?->name }}</h5>
            </div>
        </div>
    </div>
</a>
