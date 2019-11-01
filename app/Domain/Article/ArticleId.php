<?php

declare(strict_types=1);

namespace App\Domain\Article;

/**
 * 記事ID ValueObject
 */
class ArticleId
{
    /**
     * スカラー値
     * @var int
     */
    private $value;

    /**
     * @param int $value スカラー値
     */
    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * スカラー値から構築
     * @param int $value
     * @return self
     */
    public static function of(int $value)
    {
        return new self($value);
    }

    /**
     * スカラー値取得
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
