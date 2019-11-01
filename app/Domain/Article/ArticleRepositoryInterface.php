<?php

declare(strict_types=1);

namespace App\Domain\Article;

use App\Domain\Article\Exceptions\ArticleFetchErrorException;
use App\Domain\Article\Exceptions\ArticleNotFoundException;

/**
 * 何かの記事の永続化
 */
interface ArticleRepositoryInterface
{
    /**
     * ID指定して1件取得
     * @param ArticleId $articleId 記事ID
     * @return Article|null
     * @throws ArticleNotFoundException 記事が見つからない場合に例外送出
     * @throws ArticleFetchErrorException 記事取得失敗時に例外送出
     */
    public function find(ArticleId $articleId): Article;
}
