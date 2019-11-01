<?php

declare(strict_types=1);

namespace App\Domain\Article;

use App\Domain\Article\ArticleRepository\ArticleEloquent;
use App\Domain\Article\Exceptions\ArticleFetchErrorException;
use App\Domain\Article\Exceptions\ArticleNotFoundException;

/**
 * 何かの記事の永続化
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * EloquentをQueryObjectとして使用しRDBクエリを委譲する
     * @var ArticleEloquent
     */
    private $queryObject;

    /**
     * @param ArticleEloquent $queryObject Eloquentモデル
     */
    public function __construct(ArticleEloquent $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    /**
     * ID指定して1件取得
     * @param ArticleId $articleId 記事ID
     * @return Article|null
     * @throws ArticleNotFoundException 記事が見つからない場合に例外送出
     * @throws ArticleFetchErrorException 記事取得失敗時に例外送出
     */
    public function find(ArticleId $articleId): Article
    {
        try {
            return $this->queryObject->getConnection()->transaction(function () use ($articleId): Article {
                /** @var ArticleEloquent|null $articleRecord */
                $articleRecord = $this->queryObject->find($articleId->getValue());

                if (is_null($articleRecord)) {
                    throw new ArticleNotFoundException();
                }

                /** @var ArticleEloquent $articleRecord */
                $article = new Article(ArticleId::of($articleRecord->id));
                $article->setContentForRepository($articleRecord->content);

                return $article;
            });
        } catch (\PDOException $e) {
            throw new ArticleFetchErrorException();
        }
    }
}
