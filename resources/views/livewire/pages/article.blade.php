<div class="py-12 space-y-3">
    <div class="max-w-7xl w-full mx-auto">
        <div class="bg-white overflow-hidden">
            <article class="prose p-6 text-black">
                <h1 class="text-black">{{ $article?->title }}</h1>
                <img src="/storage/{{ $article->image->path }}" alt="{{ $article->image->alt_text }}"
                    class="w-full rounded">
                <small>{{ $article->image->caption }}</small>
                {!! tiptap_converter()->asHTML($article?->content ?? '', toc: true, maxDepth: 4) !!}

                @foreach ($article->categories as $category)
                    <x-tag-component :category="$category" />
                @endforeach
            </article>
        </div>
    </div>
    <div class="max-w-7xl w-full mx-auto">
        <div class="bg-white overflow-hidden">
            <div class="prose p-10 bg-white">
                <livewire:comments :model="$article" :emojis="['👍', '👎', '❤️', '😂', '😯', '😢', '😡']" />
            </div>
        </div>
    </div>
</div>
