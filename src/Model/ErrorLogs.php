<?php

namespace Model;

class ErrorLogs extends Model
{

    protected static function getTableName(): string
    {
        return 'error_logs';
    }

    public static function create(string $message, string $file, int $line): void
    {
        $tableName = static::getTableName();
        $stmt = static::getPOO()->prepare("INSERT INTO $tableName (message, file, line) 
                                           VALUES (:message, :file, :line)");

        $stmt->execute([
            'message' => $message,
            'file' => $file,
            'line' => $line
            ]);
    }


}