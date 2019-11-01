<?php

declare(strict_types=1);

namespace App\Domain\Article\ArticleRepository;

use Illuminate\Database\Eloquent\Model;

/**
 * 何かの記事EloquentModel
 */
class ArticleEloquent extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'id',
        'content',
    ];
}
