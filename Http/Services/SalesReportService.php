<?php

namespace Http\Services;

use Core\App;
use Core\Database;
use Http\Enums\PaymentStatus;

class SalesReportService
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

        $result = $db->query("
            SELECT 
                p.*,
                CASE 
                    WHEN p.processed_by IS NULL THEN 'guest'
                    ELSE u.type 
                END AS came_from,
                CASE
                    WHEN p.processed_by IS NULL THEN r.contact_person
                    ELSE u.username
                END AS came_from_name
            FROM payments p
            LEFT JOIN users u 
                ON u.id = p.processed_by
            LEFT JOIN reservations r
                ON r.id = p.reservation_id
            WHERE DATE(p.created_at) BETWEEN ? AND ?
        ", [
            $start_date,
            $end_date
        ])->get();

        return $result;
    }

    private static function getTopFacilities($start_date, $end_date)
    {
        $db = self::db();

        $result = $db->query("
            SELECT
                f.name AS facility_name,
                fi.image AS facility_image,
                COUNT(r.id) AS total_reservations
            FROM facilities f
            LEFT JOIN reservations r 
                ON r.facility_id = f.id
                AND DATE(r.created_at) BETWEEN ? AND ?
            LEFT JOIN facility_images fi 
                ON fi.id = (
                    SELECT MIN(id)
                    FROM facility_images
                    WHERE facility_id = f.id
                )
            GROUP BY f.id
            ORDER BY total_reservations DESC
            LIMIT 5;
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
            'top_facilities' => self::getTopFacilities($start_date, $end_date),
            'total_income' => self::getTotalIncome($start_date, $end_date),
            'payment_count' => self::getPaymentCount($start_date, $end_date),
            'payments' => self::getPayments($start_date, $end_date),
        ];
    }
}
