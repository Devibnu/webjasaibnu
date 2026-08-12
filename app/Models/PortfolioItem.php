<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PortfolioItem extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'portfolio_category_id',
        'title',
        'slug',
        'code',
        'excerpt',
        'description',
        'featured_image',
        'client_name',
        'project_url',
        'technologies',
        'status',
        'published_at',
        'sort_order',
        'is_featured',
        'seo_title',
        'seo_description',
        'created_by',
    ];

    protected $casts = [
        'technologies' => 'array',
        'published_at' => 'datetime',
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('published_at')->orderByDesc('id');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function imageUrl(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'assets/')) {
            return asset($this->featured_image);
        }

        return Storage::url($this->featured_image);
    }

    public function categoryName(): string
    {
        return $this->category?->name ?? 'Portfolio';
    }

    public function technologyList(): array
    {
        return array_values(array_filter($this->technologies ?? []));
    }
}
