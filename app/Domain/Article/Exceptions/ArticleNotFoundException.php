<?php

declare(strict_types=1);

namespace App\Domain\Article\Exceptions;

use App\Domain\Exceptions\TheDomainExceptionInterface;

/**
 * 記事取得結果が空の場合の例外
 */
class ArticleNotFoundException
extends \RuntimeException
implements TheDomainExceptionInterface
{ }
