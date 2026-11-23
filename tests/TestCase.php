<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PDO;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    private static bool $testDatabasePrepared = false;

    protected function setUp(): void
    {
        $this->ensureIsolatedTestDatabaseExists();

        parent::setUp();

        $activeDb = (string) config('database.connections.mysql.database');
        if ($activeDb !== 'db_disdukcapil_oki_test') {
            throw new RuntimeException(
                "Proteksi Database Aktif: Pengujian dihentikan karena koneksi mengarah ke '{$activeDb}', bukan 'db_disdukcapil_oki_test'."
            );
        }
    }

    private function ensureIsolatedTestDatabaseExists(): void
    {
        if (self::$testDatabasePrepared) {
            return;
        }

        $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: '127.0.0.1';
        $port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?: '3306';
        $user = $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?: 'root';
        $pass = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: '';

        $pdo = new PDO("mysql:host={$host};port={$port}", (string) $user, (string) $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $pdo->exec('CREATE DATABASE IF NOT EXISTS `db_disdukcapil_oki_test` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');

        self::$testDatabasePrepared = true;
    }
}
