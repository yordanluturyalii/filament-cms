<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasSEO;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function image(): BelongsTo {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function articles(): BelongsToMany {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    public function getDynamicSEOData(): SEOData {
        $image = $this->image?->path;
        return new SEOData(
            title: $this->title,
            description: tiptap_converter()->asText(Str::limit($this->content, 160)),
            image: "/storage/$image"
        );
    }
}
