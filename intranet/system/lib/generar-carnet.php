<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('allow_url_fopen', 1);

$id_alumno = $_GET['id'];
include("env.php");

require('picker/vendor/autoload.php');

use Picqer\Barcode\BarcodeGeneratorPNG;

$generator = new BarcodeGeneratorPNG();
//echo $generator->getBarcode('123456789', $generator::TYPE_CODE_128);

$query_configuracion = $mbd->prepare("SELECT * FROM settings ORDER BY id DESC LIMIT 1;");
$query_configuracion->execute();
$settings = $query_configuracion->fetch(PDO::FETCH_ASSOC);


$query = $mbd->prepare("SELECT * FROM usuarios where id in (" . $id_alumno . ")");
$query->execute();
$carnets = "";
$auxiliar = 0;
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_horario = $mbd->prepare("SELECT hora_inicio, hora_fin FROM horario_ciclo WHERE id_grupo = :id");
    $query_horario->bindParam(":id", $row['id_grupo']);
    $query_horario->execute();
    $hora_inicio = '';
    $hora_fin = '';
    while ($r = $query_horario->fetch(PDO::FETCH_ASSOC)) {
        $hora_inicio = $r['hora_inicio'] . ' - ' . $r['hora_fin'];
    }
    $foto = 'user-2935527_1280.png';
    if (is_null($row['foto']) || empty($row['foto'])) {
    } else {
        //cropImageImagick('../controllers/photo/' . $row['foto'], $row['foto'], 300, 300);
        $foto = $row['foto'];
    }
    if (strlen($row['apellidos']) > 15) {
        $font_size = '0.5rem;';
    } else {
        $font_size = '0.6rem;';
    }
    if ($auxiliar == 0) {
        $carnets .= '<tr>';
        $carnets .= '<td style="width: 33%; padding-top: 1%; padding-bottom:2%; padding-left: 6%; padding-right: 16%; margin: 0;">
        <div style="position:relative; border: solid 1px; width: 48mm; height: 80mm; background-image:url(\'https://intranet.laclaveacademia.com/system/controllers/fondos_carnet/' . $settings['imagen'] . '\');background-size: contain;background-position: top;background-repeat: no-repeat;">
            
            <table style="width: 100%; margin-top: 20%;">
                <tr>
                    <td>
                        <table border="0" style="width: 100%;" >
                            <tr>
                                <td style="width: 25%; padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Nombres:</h5>
                                </td>
                                <td style="width: 75%; padding: 5px;">
                                    <h5 style="font-size: 0.6rem; margin: 0px 0px 0px 0px;">' . $row['nombres'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Apellidos:</h5>
                                </td>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: ' . $font_size . ' margin: 0px 0px 0px 0px;">' . $row['apellidos'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Horario:</h5>
                                </td>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.6rem; margin: 0px 0px 0px 0px;">' . $hora_inicio . '</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" style="width: 100%;" >
                            <tr>
                                <td style="width: 25%;">
                                </td>
                                <td style="width: 50%;">
                                    <img src="https://intranet.laclaveacademia.com/system/controllers/photo/' . $foto . '" style="width: 19.50mm; height: 23mm;">
                                </td>
                                <td style="width: 25%;">
                                </td>
                            <tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="text-align: center; font-size: 0.70rem;padding: 5px;">
                                    <div style="width: 100%; text-align: center;">
                                        <img style="width: 75%;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($row['dni'], $generator::TYPE_CODE_128)) . '">
                                    </div>
                                    <span style="display: block;">' . $row['dni'] . '</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            
            </div>
        </td>';
    } elseif ($auxiliar > 2) {
        $carnets .= '</tr>';
        $auxiliar = 0;
        $carnets .= '<tr>';
        $carnets .= '<td style="width: 33%; padding-top: 1%; padding-bottom:2%; padding-left: 6%; padding-right: 16%; margin: 0; min-height: 400px;">
            <div style="position:relative; border: solid 1px; width: 48mm; height: 80mm; background-image:url(\'https://intranet.laclaveacademia.com/system/controllers/fondos_carnet/' . $settings['imagen'] . '\');background-size: contain;background-position: top;background-repeat: no-repeat;">
                
                
                <table style="width: 100%; margin-top: 20%;">
                <tr>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 25%; padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Nombres:</h5>
                                </td>
                                <td style="width: 75%; padding: 5px;">
                                    <h5 style="font-size: 0.6rem; margin: 0px 0px 0px 0px;">' . $row['nombres'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Apellidos:</h5>
                                </td>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: ' . $font_size . ' margin: 0px 0px 0px 0px;">' . $row['apellidos'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Horario:</h5>
                                </td>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.6rem; margin: 0px 0px 0px 0px;">' . $hora_inicio . '</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" style="width: 100%;" >
                            <tr>
                                <td style="width: 25%;">
                                </td>
                                <td style="width: 50%;">
                                    <img src="https://intranet.laclaveacademia.com/system/controllers/photo/' . $foto . '" style="width: 19.50mm; height: 23mm;">
                                </td>
                                <td style="width: 25%;">
                                </td>
                            <tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="text-align: center; font-size: 0.70rem;padding: 5px;">
                                    <div style="width: 100%; text-align: center;">
                                        <img style="width: 75%;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($row['dni'], $generator::TYPE_CODE_128)) . '">
                                    </div>
                                    <span style="display: block;">' . $row['dni'] . '</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            </div>
        </td>';
    } else {
        $carnets .= '<td style="width: 33%; padding-top: 1%; padding-bottom:2%; padding-left: 6%; padding-right: 16%; margin: 0; min-height: 400px;">
        <div style="position:relative; border: solid 1px; width: 48mm; height: 80mm; background-image:url(\'https://intranet.laclaveacademia.com/system/controllers/fondos_carnet/' . $settings['imagen'] . '\');background-size: contain;background-position: top;background-repeat: no-repeat;">
            
            
            
            <table style="width: 100%; margin-top: 20%;">
                <tr>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 25%; padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Nombres:</h5>
                                </td>
                                <td style="width: 75%; padding: 5px;">
                                    <h5 style="font-size: 0.6rem; margin: 0px 0px 0px 0px;">' . $row['nombres'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Apellidos:</h5>
                                </td>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: ' . $font_size . ' margin: 0px 0px 0px 0px;">' . $row['apellidos'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.70rem; margin: 0px 0px 0px 20px; color: ' . $settings['color_texto'] . ';">Horario:</h5>
                                </td>
                                <td style=" padding: 5px;">
                                    <h5 style="font-size: 0.6rem; margin: 0px 0px 0px 0px;">' . $hora_inicio . '</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" style="width: 100%;" >
                            <tr>
                                <td style="width: 25%;">
                                </td>
                                <td style="width: 50%;">
                                    <img src="https://intranet.laclaveacademia.com/system/controllers/photo/' . $foto . '" style="width: 19.50mm; height: 23mm;">
                                </td>
                                <td style="width: 25%;">
                                </td>
                            <tr>
                        </table>
                    </td>
                </tr>
                <tr>

                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="text-align: center; font-size: 0.70rem;padding: 5px;">
                                    <div style="width: 100%; text-align: center;">
                                        <img style="width: 75%;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($row['dni'], $generator::TYPE_CODE_128)) . '">
                                    </div>
                                    <span style="display: block;">' . $row['dni'] . '</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    
                </tr>
            </table>
            </div>
        </td>';
    }
    $auxiliar++;
}

require_once 'dompdf/dompdf/vendor/autoload.php';

$im = new Imagick();
$im->setBackgroundColor(new ImagickPixel('transparent'));
$im->readImageBlob('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="' . $settings['color_principal'] . '" fill-opacity="1"
        d="M0,96L80,122.7C160,149,320,203,480,192C640,181,800,107,960,112C1120,117,1280,203,1360,245.3L1440,288L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
    </path>
</svg>');

/*png settings*/
$im->setImageFormat("png24");
//$im->resizeImage(720, 320, imagick::FILTER_LANCZOS, 1);  /*Optional, if you need to resize*/

/*png24*/
$im->setImageFormat("png24");
$im->adaptiveResizeImage(1440, 400); /*Optional, if you need to resize*/

$im->writeImage('img/us-map.png');/*(or .jpg)*/
$im->clear();
$im->destroy();

$im = new Imagick();
$im->setBackgroundColor(new ImagickPixel('transparent'));
$im->readImageBlob('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="' . $settings['color_secundario'] . '" fill-opacity="1"
        d="M0,96L80,122.7C160,149,320,203,480,192C640,181,800,107,960,112C1120,117,1280,203,1360,245.3L1440,288L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
    </path>
</svg>');

/*png settings*/
$im->setImageFormat("png24");
//$im->resizeImage(720, 320, imagick::FILTER_LANCZOS, 1);  /*Optional, if you need to resize*/

/*png24*/
$im->setImageFormat("png24");
$im->adaptiveResizeImage(1440, 445); /*Optional, if you need to resize*/

$im->writeImage('img/us-map2.png');/*(or .jpg)*/
$im->clear();
$im->destroy();

$html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <style>
            @page { margin: 0; }
        </style>
    </head>
    <body style="padding: 0; margin: 0;">
        <table style="width: 100%;">
        ' . $carnets . '
        </table>
    </body>    
</html>';


//echo $html;
//return;
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class

$dompdf = new Dompdf(array('enable_remote' => true));

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
$dompdf->set_option('dpi', 300);
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Carnet Impreso.pdf");
function cropImageImagick($sourcePath, $destPath, $targetWidth, $targetHeight)
{
    // Obtener información de la imagen original
    list($origWidth, $origHeight, $imageType) = getimagesize($sourcePath);

    // Crear la imagen en base al tipo
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $original = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $original = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $original = imagecreatefromgif($sourcePath);
            break;
        default:
            return false; // Tipo de imagen no soportado
    }

    // Calcular el área a recortar para mantener la proporción
    $aspectRatio = min($origWidth / $targetWidth, $origHeight / $targetHeight);
    $newWidth = (int)($targetWidth * $aspectRatio);
    $newHeight = (int)($targetHeight * $aspectRatio);

    // Posicionar el recorte en el centro
    $x = (int)(($origWidth - $newWidth) / 2);
    $y = (int)(($origHeight - $newHeight) / 2);

    // Crear una nueva imagen con el tamaño deseado
    $croppedImage = imagecreatetruecolor($targetWidth, $targetHeight);

    // Copiar y recortar la imagen
    imagecopyresampled($croppedImage, $original, 0, 0, $x, $y, $targetWidth, $targetHeight, $newWidth, $newHeight);

    // Guardar la imagen
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($croppedImage, $destPath, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($croppedImage, $destPath);
            break;
        case IMAGETYPE_GIF:
            imagegif($croppedImage, $destPath);
            break;
    }

    // Liberar memoria
    imagedestroy($original);
    imagedestroy($croppedImage);

    return true;
}
