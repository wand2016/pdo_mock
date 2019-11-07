<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\DB;
use Mockery;
use Mockery\MockInterface;
use PDO;
use ReflectionClass;

trait MockPdo
{
    /**
     * コネクション名を指定し、当該コネクションのPDOをモックする
     * @param string $connectionName コネクション名
     * @return MockInterface|PDO PDOのProxy Partial Mock
     */
    protected function mockPdo(string $connectionName = null): MockInterface
    {
        $connection = DB::connection($connectionName);

        $pdo = $connection->getPdo();
        /**
         * Proxy Partial Mock
         * @var MockInterface $pdoMock
         */
        $pdoMock = Mockery::mock($pdo)->makePartial();

        // ----------------------------------------
        // Connection@setPdo($pdo)の中で
        // $this->transactions = 0;
        // されるとテストケース終了時に制御が返ってこなくなる
        // $this->transactionsの値を退避し、リフレクションで再セットする
        // ----------------------------------------
        $reflectionClass = new ReflectionClass(get_class($connection));
        $transactionsAccessor = $reflectionClass->getProperty('transactions');
        $transactionsAccessor->setAccessible(true);
        $transactions = $transactionsAccessor->getValue($connection);
        $connection->setPdo($pdoMock);
        $transactionsAccessor->setValue($connection, $transactions);

        return $pdoMock;
    }
}
