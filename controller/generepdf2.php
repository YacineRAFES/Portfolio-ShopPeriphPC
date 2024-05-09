<?php
if(isset($_GET['action'])){
    if($_GET['action']=='payee'){
        $numFacture=createFacture($bdd,$_SESSION['idUser']);

    }
}
if(!isset($_SESSION['idUser'])){
    header('Location:../index.php?page=9');
}
$recupDetailPanierEtInformationDeUser=recupDetailPanierEtInformationDeUser($bdd,$_SESSION['idUser']);

require_once '../html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

ob_start();

$total = 0;  $total_tva = 0;
?>

<style type="text/css">
    table {
        width: 100%;
        color: #717375;
        font-family: helvetica;
        line-height: 5mm;
        border-collapse: collapse;
    }
    h2 { margin: 0; padding: 0; }
    p { margin: 5px; }

    .border th {
        border: 1px solid #000;
        color: white;
        background: #000;
        padding: 5px;
        font-weight: normal;
        font-size: 14px;
        text-align: center;
    }
    .border td {
        border: 1px solid #CFD1D2;
        padding: 5px 10px;
        text-align: center;
    }
    .no-border {
        border-right: 1px solid #CFD1D2;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }
    .space { padding-top: 250px; }
    .ptop20{
        padding-top: 20px;
    }

    .10p { width: 10%; } .15p { width: 15%; }
    .25p { width: 25%; } .50p { width: 50%; }
    .60p { width: 60%; } .75p { width: 75%; }
</style>

<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">

    <page_footer>
        <hr />
        <br>
    </page_footer>

    <table style="vertical-align: top;">
        <tr>
            <td class="75p">
                <strong>ShopPeriphPC</strong><br />
                <strong>SIRET:</strong> 00004556949328<br />
               test@test.fr
            </td>
            <td class="25p">
                <strong><?php echo $recupDetailPanierEtInformationDeUser['nom'].' '.$recupDetailPanierEtInformationDeUser['prenom']?></strong><br />
                <?php echo $recupDetailPanierEtInformationDeUser['adresse']?><br />
                <?php echo $recupDetailPanierEtInformationDeUser['cp'] ?>
            </td>
        </tr>
    </table>

    <table style="margin-top: 50px;">
        <tr>
            <td class="50p"><h2>Facture n°14</h2></td>
            <td class="50p" style="text-align: right;">Emis le <?php echo date("d/m/y"); ?></td>
        </tr>
    </table>

    <table style="margin-top: 30px;" class="border">
        <thead>
        <tr>
            <th class="60p">Désignation</th>
            <th class="10p">Quantité</th>
            <th class="15p">Prix Unitaire</th>
            <th class="15p">Montant</th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td>Article 1</td>
                <td>2</td>
                <td>24.99€</td>
                <td>49.98€</td>

            </tr>
            <tr>
                <td class="space"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2" class="no-border"></td>
                <td style="text-align: center;" rowspan="3"><strong>Total:</strong></td>
                <td>HT : 200€</td>
            </tr>
            <tr>
                <td colspan="2" class="no-border"></td>
                <td>TVA : 30€</td>
            </tr>
            <tr>
                <td colspan="2" class="no-border"></td>
                <td>TTC : 230€</td>
            </tr>
        </tbody>
    </table>

</page>

<?php

try {
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 5));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example02.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
header('Location:../public/index.php?page=11')
?>
