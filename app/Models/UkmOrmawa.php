<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UkmOrmawa extends Model
{
    /** @use HasFactory<\Database\Factories\UkmOrmawaFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'type',
        'category',
        'deskripsi',
        'visi',
        'misi', 
        'kontak_instagram',
        'kontak_email',
        'logo_url',
        'banner_url',
    ];

    protected $casts = [
        'misi' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ukmOrmawa) {
            if (empty($ukmOrmawa->slug)) {
                $ukmOrmawa->slug = Str::slug($ukmOrmawa->name);
            }
        });
        static::updating(function ($ukmOrmawa) {
            if ($ukmOrmawa->isDirty('name')) {
                $originalSlug = Str::slug($ukmOrmawa->getOriginal('name'));
                if (empty($ukmOrmawa->getOriginal('slug')) || $ukmOrmawa->getOriginal('slug') === $originalSlug) {
                    $ukmOrmawa->slug = Str::slug($ukmOrmawa->name);
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
