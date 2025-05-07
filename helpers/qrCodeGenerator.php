<?php

require_once APP_ROOT . '/vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeGenerator {
    /**
     * Generate a base64-encoded QR code PNG image from given data.
     *
     * @param string $data The data/text to encode into the QR code.
     * @return string Base64-encoded PNG image data (you can use it in <img src="...">).
     */
    public static function generate($data) {
        // Create a new QR code instance with the provided data
        $qrCode = new QrCode($data);

        // Use the PNG writer to generate the QR code image
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Convert the QR code image to a base64-encoded string
        $imageData = $result->getString();
        $base64 = base64_encode($imageData);

        // Return the base64-encoded image with the appropriate data URI scheme
        return 'data:image/png;base64,' . $base64;
    }
}
