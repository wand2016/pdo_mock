<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Article\Exceptions\ArticleNotFoundException;
use App\Domain\Exceptions\TheDomainExceptionInterface;
use App\Services\ArticleService;

/**
 * 記事関連機能のルーティングコマンド群
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * 雑
     * @return mixed いろいろ返す
     */
    public function index(int $articleId)
    {
        try {
            $article = $this->articleService->getArticleById($articleId);
            return $article->getContent();
        } catch (ArticleNotFoundException $e) {
            return response('no content', 404);
        } catch (TheDomainExceptionInterface $e) {
            return response('boo!', 404);
        }
    }
}
