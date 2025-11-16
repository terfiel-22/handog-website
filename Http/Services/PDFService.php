<?php

namespace Http\Services;

use Core\App;
use Dompdf\Dompdf;
use Dompdf\Options;
use Http\Models\Reservation;
use Http\Models\ReservationGuest;

class PDFService
{
    protected static function reservationModel()
    {
        return App::resolve(Reservation::class);
    }
    protected static function reservationGuestModel()
    {
        return App::resolve(ReservationGuest::class);
    }

    public static function generatePDF($reservationId)
    {
        $reservationModel = self::reservationModel();
        $reservationGuestModel = self::reservationGuestModel();

        $reservation = $reservationModel->fetchReservationById($reservationId);
        $guests = $reservationGuestModel->fetchGuestsByReservationId($reservationId);
        $logo = base64Image(SettingService::getLogo()["logo"]);

        ob_start();
        view(
            "templates/payment_receipt.view.php",
            compact('reservation', 'guests', 'logo')
        );
        $html = ob_get_clean();

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $directory = base_path("/storage/receipts/");

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filePath = $directory . "receipt_{$reservationId}.pdf";

        file_put_contents($filePath, $output);

        return $filePath;
    }
}
