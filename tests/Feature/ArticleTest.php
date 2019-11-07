<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domain\Article\ArticleRepository\ArticleEloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\Concerns\MockPdo;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    use MockPdo;

    private $connectionsToTransact = ['mysql'];

    /**
     * @test
     */
    public function articles_id_idに対応する記事があれば200OK()
    {
        ArticleEloquent::create(['id' => 1, 'content' => 'hoge']);

        $this->get('/articles/1')->assertStatus(200);
    }

    /**
     * @test
     * @dataProvider dataProvider_content
     */
    public function articles_id_idに対応する記事があればその内容を返す(
        string $content
    ) {
        ArticleEloquent::create(['id' => 1, 'content' => $content]);

        $this->get('/articles/1')->assertSeeText($content);
    }

    /**
     * @test
     */
    public function articles_id_DBエラー時boo()
    {
        // ----------------------------------------
        // 1. setup
        // クエリ発行時にPDOExceptionが発生するようにPDOをモック
        // ----------------------------------------
        $pdoMock = $this->mockPdo();
        $pdoMock->shouldReceive('prepare')
            ->with(Mockery::on(function (string $stmt): bool {
                return preg_match('/select.*articles/', $stmt) === 1;
            }))
            ->andThrow(new \PDOException);

        // ----------------------------------------
        // 2. action and assertion
        // ----------------------------------------
        $this->get('/articles/999')->assertSeeText('boo!');
    }

    /**
     * @test
     */
    public function articles_id_idに対応する記事がなければ404()
    {
        $this->get('/articles/999')->assertStatus(404);
    }


    // ----------------------------------------
    // dataProviders
    // ----------------------------------------

    public function dataProvider_content(): iterable
    {
        yield [
            'hoge'
        ];

        yield [
            'fuga'
        ];
    }
}
