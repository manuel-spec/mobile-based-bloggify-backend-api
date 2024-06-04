<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Like;
use App\Models\Category;



class BlogModel extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'user_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'blog_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
