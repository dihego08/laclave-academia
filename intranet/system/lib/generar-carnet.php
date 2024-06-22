<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('allow_url_fopen', 1);
$id_alumno = $_GET['id'];
include("env.php");

require('picker/vendor/autoload.php');
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new BarcodeGeneratorHTML();
//echo $generator->getBarcode('123456789', $generator::TYPE_CODE_128);

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
    $auxiliar_horario=0;
    while ($r = $query_horario->fetch(PDO::FETCH_ASSOC)) {
        if($auxiliar_horario==0){
            $hora_inicio = $r['hora_inicio'].' - '. $r['hora_fin'];
        }else{
            $hora_fin = $r['hora_inicio'].' - '. $r['hora_fin'];
        }
        $auxiliar_horario++;
    }

    if ($auxiliar == 0) {
        $carnets .= '<tr>';
        $carnets .= '<td style="width: 50%; padding-top: 1%; padding-bottom:2%; padding-left: 6%; padding-right: 16%; margin: 0;">
        <div style="position:relative; border: solid 1px; width: 80mm; height: 48mm; ">
            <div style=" width: 100%;">
                    <div style="transform: scale(-1, 1);position:absolute; top: 0%;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/lib/img/us-map.png" style="width: 100%;">
                    </div>
                    
                    <div style="transform: scale(-1, 1); z-index: -1;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/lib/img/us-map2.png" style="width: 100%;">
                    </div>
                </div>
            <img src="https://laclave.diegoaranibar.com/img/logo.png" alt=""
                style="background-color: greenyellow; padding: 2px; border-radius: 4px; width: 25%; position: absolute; top: 5%; left: 3%;">
            <h5 style="color: white; position: absolute; top: -5%; right: 5%; font-size: 13px;">CARNET DE IDENTIFICACIÓN</h5>
            <table style="width: 100%; margin-top: -10%;">
                <tr>
                    <td style="width: 30%;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/controllers/photo/' . $row['foto'] . '" style="width: 100%; z-index: 0;">
                    </td>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 50%;">
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Nombres:</h5>
                                </td>
                                <td style="width: 50%;">
                                    <h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $row['nombres'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Apellidos:</h5>
                                </td>
                                <td>
                                    <h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $row['apellidos'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Horario:</h5>
                                </td>
                                <td><h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $hora_inicio . '<br>'.$hora_fin.'</h5></td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Código:</h5>
                                </td>
                                <td>
                                    <h5 style="font-size: 5px; margin: 0px 0px 0px 0px;">' .  $generator->getBarcode($row['dni'], $generator::TYPE_CODE_128) . '</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <img src="https://laclave.diegoaranibar.com/img/logo.png" alt="" style="    opacity: 0.3;
            position: absolute;
            right: 0%;
            top: 40%;
            transform: rotate(135deg) scale(-1, -1);
            width: 40%;
            z-index: 0;">
            <h5 style="position: absolute; font-size: 15px; font-weight: 700; color: green; right: 2%; bottom: -14%;">
                2024
            </h5>
            </div>
        </td>';
    } elseif ($auxiliar > 1) {
        $carnets .= '</tr>';
        $auxiliar = 0;
        $carnets .= '<tr>';
        $carnets .= '<td style="width: 50%; padding-top: 1%; padding-bottom:2%; padding-left: 6%; padding-right: 16%; margin: 0; min-height: 400px;">
            <div style="position:relative; border: solid 1px; width: 80mm; height: 48mm; ">
                <div style=" width: 100%;">
                    <div style="transform: scale(-1, 1);position:absolute; top: 0%;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/lib/img/us-map.png" style="width: 100%;">
                    </div>
                    
                    <div style="transform: scale(-1, 1); z-index: -1;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/lib/img/us-map2.png" style="width: 100%;">
                    </div>
                </div>

                <img src="https://laclave.diegoaranibar.com/img/logo.png" alt=""
                    style="background-color: greenyellow; padding: 2px; border-radius: 4px; width: 25%; position: absolute; top: 2%; left: 3%;">
                <h5 style="color: white; position: absolute; top: -5%; right: 5%; font-size: 13px;">CARNET DE IDENTIFICACIÓN</h5>
                <table style="width: 100%; margin-top: -10%;">
                <tr>
                    <td style="width: 30%;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/controllers/photo/' . $row['foto'] . '" style="width: 100%; z-index: 0;">
                    </td>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 50%;">
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Nombres:</h5>
                                </td>
                                <td style="width: 50%;">
                                    <h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $row['nombres'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Apellidos:</h5>
                                </td>
                                <td>
                                    <h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $row['apellidos'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Horario:</h5>
                                </td>
                                <td><h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $hora_inicio . '<br>'.$hora_fin.'</h5></td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Código:</h5>
                                </td>
                                <td>
                                    <h5 style="font-size: 5px; margin: 0px 0px 0px 0px;">' .  $generator->getBarcode($row['dni'], $generator::TYPE_CODE_128) . '</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
                <img src="https://laclave.diegoaranibar.com/img/logo.png" alt="" style="    opacity: 0.3;
                position: absolute;
                right: 0%;
                top: 40%;
                transform: rotate(135deg) scale(-1, -1);
                width: 40%;
                z-index: 0;">
            <h5 style="position: absolute; font-size: 15px; font-weight: 700; color: green; right: 2%; bottom: -14%;">
                2024
            </h5>
            </div>
        </td>';
    } else {
        $carnets .= '<td style="width: 50%; padding-top: 1%; padding-bottom:2%; padding-left: 6%; padding-right: 16%; margin: 0; min-height: 400px;">
        <div style="position:relative; border: solid 1px; width: 80mm; height: 48mm; ">
            <div style=" width: 100%;">
                    <div style="transform: scale(-1, 1);position:absolute; top: 0%;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/lib/img/us-map.png" style="width: 100%;">
                    </div>
                    
                    <div style="transform: scale(-1, 1); z-index: -1;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/lib/img/us-map2.png" style="width: 100%;">
                    </div>
                </div>
            <img src="https://laclave.diegoaranibar.com/img/logo.png" alt=""
                style="background-color: greenyellow; padding: 2px; border-radius: 4px; width: 25%; position: absolute; top: 5%; left: 3%;">
            <h5 style="color: white; position: absolute; top: -5%; right: 5%; font-size: 13px;">CARNET DE IDENTIFICACIÓN</h5>
            <table style="width: 100%; margin-top: -10%;">
                <tr>
                    <td style="width: 30%;">
                        <img src="https://laclave.diegoaranibar.com/intranet/system/controllers/photo/' . $row['foto'] . '" style="width: 100%; z-index: 0;">
                    </td>
                    <td>
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 50%;">
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Nombres:</h5>
                                </td>
                                <td style="width: 50%;">
                                    <h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $row['nombres'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Apellidos:</h5>
                                </td>
                                <td>
                                    <h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $row['apellidos'] . '</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Horario:</h5>
                                </td>
                                <td><h5 style="font-size: 9px; margin: 0px 0px 0px 0px;">' . $hora_inicio . '<br>'.$hora_fin.'</h5></td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 style="font-size: 10px; margin: 0px 0px 0px 0px; color: green;">Código:</h5>
                                </td>
                                <td>
                                    <h5 style="font-size: 5px; margin: 0px 0px 0px 0px;">' .  $generator->getBarcode($row['dni'], $generator::TYPE_CODE_128) . '</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <img src="https://laclave.diegoaranibar.com/img/logo.png" alt="" style="    opacity: 0.3;
            position: absolute;
            right: 0%;
            top: 40%;
            transform: rotate(135deg) scale(-1, -1);
            width: 40%;
            z-index: 0;">
            <h5 style="position: absolute; font-size: 15px; font-weight: 700; color: green; right: 2%; bottom: -14%;">
                2024
            </h5>
            </div>
        </td>';
    }
    $auxiliar++;
}

require_once 'dompdf/dompdf/vendor/autoload.php';

$im = new Imagick();
 $im->setBackgroundColor(new ImagickPixel('transparent'));
$im->readImageBlob('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#003399" fill-opacity="1"
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
    <path fill="#009933" fill-opacity="1"
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

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class

$dompdf = new Dompdf(array('enable_remote' => true));

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Carnet Impreso.pdf");
