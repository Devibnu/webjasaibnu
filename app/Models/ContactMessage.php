<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    public const STATUS_UNREAD = 'unread';
    public const STATUS_READ = 'read';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'service',
        'subject',
        'message',
        'status',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_UNREAD);
    }

    public function scopeRead(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_READ);
    }

    public function scopeNewest(Builder $query): Builder
    {
        return $query->latest('created_at')->latest('id');
    }

    public function markAsRead(): void
    {
        $this->forceFill([
            'status' => self::STATUS_READ,
            'read_at' => $this->read_at ?? now(),
        ])->save();
    }

    public function markAsUnread(): void
    {
        $this->forceFill([
            'status' => self::STATUS_UNREAD,
            'read_at' => null,
        ])->save();
    }

    public function isUnread(): bool
    {
        return $this->status === self::STATUS_UNREAD;
    }

    public function subjectLine(): string
    {
        return $this->subject ?: $this->service;
    }
}
