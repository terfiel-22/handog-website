<?php

namespace Http\Services;

use Core\App;
use Core\Database;
use Http\Enums\PaymentStatus;

class IncomeReportService
{
    protected static function db()
    {
        return App::resolve(Database::class);
    }

    private static function getTotalIncome($start_date, $end_date)
    {
        $db = self::db();

        $result = $db->query("
            SELECT SUM(amount) AS total
            FROM payments
            WHERE DATE(created_at) BETWEEN ? AND ?
            AND payment_status IN (?, ?)
        ", [
            $start_date,
            $end_date,
            PaymentStatus::DEPOSITED,
            PaymentStatus::PAID
        ])->find();

        return (float) ($result['total'] ?? 0);
    }


    private static function getPaymentCount($start_date, $end_date)
    {
        $db = self::db();

        $result = $db->query("
            SELECT COUNT(*) AS total
            FROM payments
            WHERE DATE(created_at) BETWEEN ? AND ?
        ", [
            $start_date,
            $end_date
        ])->find();

        return (int) ($result['total'] ?? 0);
    }

    private static function getPayments($start_date, $end_date)
    {
        $db = self::db();

        // TODO: Columns should include (ID, Came From, Name, Date Created, Amount, Payment Status)
        $result = $db->query("
            SELECT *
            FROM payments
            WHERE DATE(created_at) BETWEEN ? AND ?
        ", [
            $start_date,
            $end_date
        ])->get();

        return $result;
    }

    public static function getPaymentFirstAndLastRecordDates()
    {
        $db = self::db();

        $result = $db->query("
            SELECT 
                (SELECT created_at FROM payments ORDER BY created_at ASC LIMIT 1) AS first,
                (SELECT created_at FROM payments ORDER BY created_at DESC LIMIT 1) AS last;
        ")->find();

        return [
            'first' => formatDatetimeToYmD($result['first']),
            'last' => formatDatetimeToYmD($result['last'])
        ];
    }

    public static function summary($start_date, $end_date): array
    {
        return [
            'total_income' => self::getTotalIncome($start_date, $end_date),
            'payment_count' => self::getPaymentCount($start_date, $end_date),
            'payments' => self::getPayments($start_date, $end_date),
        ];
    }
}
