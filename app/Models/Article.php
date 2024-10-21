<?php

namespace App\Models;

use App\Enum\ArticleStatus;
use App\Models\Scopes\IsPublishedScope;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;
use WireComments\Traits\Commentable;

class Article extends Model
{
    use HasFactory, Commentable, SoftDeletes, HasSEO;

    protected $casts = [
        'status' => ArticleStatus::class
    ];

    public function scopeIsPublished(Builder $builder): Builder {
        return $builder->where('status', ArticleStatus::PUBLISHED);
    }

    public function image(): BelongsTo {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'article_category');
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
