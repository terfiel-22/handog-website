<?php

namespace Http\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFService
{
    /**
     * Handles actual PDF rendering + saving
     */
    public static function generatePDF($html, $filename, $folder)
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $directory = base_path("/storage/$folder/");

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filePath = $directory . $filename;
        file_put_contents($filePath, $output);

        return $filePath;
    }
}
