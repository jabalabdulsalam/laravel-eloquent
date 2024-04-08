<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    public $table = "comments";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true; //defaultnya adalah true

    protected $attributes = [
        "title" => "Sample Title",
        "comment" => "Sample Comment"
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
