<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleId;
use App\Domain\Article\ArticleRepositoryInterface;
use App\Domain\Article\Exceptions\ArticleFetchErrorException;
use App\Domain\Article\Exceptions\ArticleNotFoundException;

/**
 * 記事に関するユースケース群
 * アプリケーションロジックを定義する
 */
class ArticleService
{
    /**
     * 記事の永続化、問い合わせ
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * 記事IDを指定して記事を1件取得する
     * @param int $articleId 記事ID(スカラ)
     * @return Article 記事
     * @throws ArticleNotFoundException 記事が見つからない場合に例外送出
     * @throws ArticleFetchErrorException 記事取得失敗時に例外送出
     */
    public function getArticleById(int $articleId): Article
    {
        return $this->articleRepository->find(ArticleId::of($articleId));
    }
}
