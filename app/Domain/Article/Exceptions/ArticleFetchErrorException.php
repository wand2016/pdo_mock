<?php

declare(strict_types=1);

namespace App\Domain\Article\Exceptions;

use App\Domain\Exceptions\TheDomainExceptionInterface;

/**
 * 記事取得失敗時の例外
 */
class ArticleFetchErrorException
extends \RuntimeException
implements TheDomainExceptionInterface
{ }
