<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Insight extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'insight_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'seo_title',
        'seo_description',
        'sort_order',
        'created_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(InsightCategory::class, 'insight_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('published_at')->orderByDesc('id');
    }

    public function imageUrl(): string
    {
        if (! $this->featured_image) {
            return asset('assets/startup2/img/blog-1.jpg');
        }

        if (str_starts_with($this->featured_image, 'assets/')) {
            return asset($this->featured_image);
        }

        return Storage::url($this->featured_image);
    }

    public function categoryName(): string
    {
        return $this->category?->name ?? 'Insights';
    }

    public function contentBlocks(): array
    {
        return collect(preg_split("/\R{2,}/", trim($this->content)) ?: [])
            ->map(fn ($block) => trim($block))
            ->filter()
            ->map(function ($block) {
                if (str_starts_with($block, '## ')) {
                    return ['type' => 'heading', 'text' => substr($block, 3)];
                }

                return ['type' => 'paragraph', 'text' => $block];
            })
            ->values()
            ->all();
    }
}
