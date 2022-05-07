<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'topic_category_id',
        'order'
    ];

    public function topicCategory()
    {
        return $this->belongsTo(TopicCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
