<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'file_path',
    ];

    /**
     * Get the full URL to the photo.
     *
     * @return string
     */
    public function getUrlAttribute()
{
    return asset('storage/' . $this->file_path);
}

}
