<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
ob_start();
?>
<html>
        <head>
            <style>
                body {
                    font-family: Arial, Helvetica, sans-serif;
                }
                .bloc50 {
                    display: block;
                    width: 50%;
                    height: auto;
                    line-height: 2px;
                }
                .bold {
                    font-weight: bold;
                }
                .container {
                    display: flex;
                    flex-direction: row;
                    flex-wrap: wrap;
                }
                table,td {
                    border: solid 1px black;
                    border-collapse: collapse;
                    margin: auto;
                }
                
            </style>
        </head>
        <body>
            <div class="container">
                <div class="bloc50">
                    <h4>Société :</h4>
                    <p class="bold">ShopPeriphPC</p>
                    <p class="bold">SIRET N°1111111111111111111111</p>
                    <p>8 rue Carnot</p>
                    <p>54110 Dombasle-sur-Meurthe</p>
                </div>
                <div class="bloc50">
                    <h4>Client :</h4>
                    <p>Nom prénom</p>
                    <p>8 rue Carnot</p>
                    <p>54110 Dombasle-sur-Meurthe</p>
                </div>
            </div>
            
                <h2>Facture N°213</h2>
                <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Qté</th>
                            <th>Prix Unit. €</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>nom de désignation</td>
                            <td>qantité</td>
                            <td>prix</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </body>
    </html>
    <?php

try {
    
    include dirname(__FILE__).'/res/example00.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('chemin absolu','F');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
