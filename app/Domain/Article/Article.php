<?php

declare(strict_types=1);

namespace App\Domain\Article;

/**
 * なにかの記事
 */
class Article
{
    /**
     * 記事ID
     * @var ArticleId|null
     */
    private $articleId;

    /**
     * 記事内容
     * @var string
     */
    private $content;

    /**
     * @param ArticleId|null $articleId 記事ID
     */
    public function __construct(?ArticleId $articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * 記事内容設定
     * Repositoryからのみ呼び出す
     * @param string $content
     * @return $this
     */
    public function setContentForRepository(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * 記事内容取得
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
