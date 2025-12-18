<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name' , 'slug' , 'category_id'
    ];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getParentName()
    {
        return is_null($this->parent) ? 'ندارد' : $this->parent->name;
    }
}
