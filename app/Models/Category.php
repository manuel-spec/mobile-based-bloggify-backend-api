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

    // Example of a relationship: a category can have many posts
    public function posts()
    {
        return $this->hasMany(BlogModel::class);
    }
}
