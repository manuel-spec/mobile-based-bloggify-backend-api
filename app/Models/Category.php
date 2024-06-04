<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogModel;

class Category extends Model
{
    use HasFactory;

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
    ];

    // Relationship: a category can have many blog posts
    public function blogs()
    {
        return $this->hasMany(BlogModel::class);
    }
}
