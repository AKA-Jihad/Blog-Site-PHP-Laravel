<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function subCategories(){
        return $this->hasMany(Category::class, 'parent_id')->whereNotNull('parent_id');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
