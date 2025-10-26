<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','is_public','starts_at','ends_at'];

    protected $dates = ['starts_at','ends_at'];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function isActive(): bool
    {
        $now = now();
        if ($this->starts_at && $now->lt($this->starts_at)) return false;
        if ($this->ends_at && $now->gt($this->ends_at)) return false;
        return true;
    }

    public function isArchived(): bool
    {
        return $this->ends_at && now()->gt($this->ends_at);
    }
}
