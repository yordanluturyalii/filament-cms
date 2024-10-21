<div class="py-12 space-y-3">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden">
            <article class="prose p-6 text-black">
                <h1 class="text-black">{{ $category?->title }}</h1>
                <img src="/storage/{{ $category->image->path }}" alt="{{ $category->image->alt_text }}"
                    class="w-full rounded">
                <small>{{ $category->image->caption }}</small>
                {!! tiptap_converter()->asHTML($category?->content ?? '', toc: true, maxDepth: 4) !!}
            </article>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($category->articles as $article)
                <livewire:components.article-card :article="$article" :key="$article->id" />
            @endforeach
        </div>
    </div>
</div>
