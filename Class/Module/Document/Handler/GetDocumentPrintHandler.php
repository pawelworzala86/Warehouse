<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Collection\DocumentProductCollection;
use App\Module\Document\Model\DocumentProductModel;
use App\Module\Document\Request\GetDocumentPrintRequest;
use App\Module\Document\Request\GetDocumentRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Response\GetDocumentResponse;
use App\Module\Document\Response\GetDocumentsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Prints\Invoice;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Address;
use App\Type\Contractor;
use App\Type\Document;
use App\Type\DocumentProduct;
use App\Type\DocumentProducts;
use App\Type\Documents;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetDocumentPrintHandler extends Handler
{
    public function __invoke(GetDocumentPrintRequest $request)
    {
        $invoice = new Invoice;

        $invoice->setFillColor(220, 220, 220);

        function round00($value) {
            $value = round($value * 100) / 100;
            $buf = number_format($value, 2, ',', ' ');
            return $buf;
        }

        $rodzaj_dokumentu = 'Faktura';
        $md_nazwa = 'ACME';
        $md_nip = '356-634-346';
        $md_ulica = 'ul. Długa 23/23';
        $md_miejscowosc = 'Gdańsk';
        $md_kod_pocztowy = '11-222';
        $md_telefon = '423-235-235';
        $md_fax = '34-342-234';
        $md_mail = 'test@pl.pl';
        $md_www = 'test.pl';
        $kl_nazwa = 'Mirek Testowy';
        $kl_nip = '345-345-345';
        $kl_ulica = 'ul. Krótka 23/23';
        $kl_miejscowosc = 'Tczew';
        $kl_kod_pocztowy = '44-444';
        $kl_telefon = '234-235-325';
        $kl_fax = '';
        $kl_mail = 'mirek.testowy@pl.pl';
        $kl_www = '';
        $data_wystawienia = '21.04.2017';
        $data_sprzedazy = '21.04.2017';
        $termin_zaplaty = '21.04.2017';
        $zaplacono = '24.60';
        $slownie = 'dwadzieścia cztery zł sześciedziat gr';
        $platnosc = 'gotówka';
        $uwagi = '';
        $pozycje = 1;
        $numer_dokumentu = 'FV/1/2017';
        $numer_konta = '0000-0000-0000-0000-0000-00';
        $nazwa_banku = 'bankTest';
        $suma = '24.60';
        $pozostalo = '0.00';
        $miejsce_wystawienia = 'Gdańsk';
        $osoba_upowazniona = 'Jan Kowalski';
        $odbiorca = 'Tomek Nowak';
        $bez_odbiorcy = '';
        $bez_wystawcy = '';
        $logo = '';

        $pozycje_buf = [];
        $pozycje_buf[] = array(1, 'pkwiu', 'pozycja 1', 2, 'szt', round00(10.00), '23', round00(20.00), round00(4.60), round00(24.60));

        $szerokosci = array(10, 25, 57, 10, 10, 17, 10, 17, 17, 17);
        $rozmieszczenieTekstu = array('C', 'L', 'L', 'C', 'C', 'R', 'C', 'R', 'R', 'R');
        $header = array('Lp.', 'PKWiU', 'Nazwa produktu / usługi', 'Ilość', 'Jm', 'Cena netto', '%VAT', 'Wart. netto', 'Kwota VAT', 'Wart. brutto');

        $stawkiSzerokosci = array(12, 17, 17, 17);
        $stawkiRozmieszczenieTekstu = array('R', 'R', 'R', 'R');
        $stawkiHeader = array('', 'Wart. netto', 'Kwota VAT', 'Wart. brutto');
        $stawkiVAT = array(
            array('23 %', $pozycje_buf[0][5], $pozycje_buf[0][8], $pozycje_buf[0][9]),
            array('Razem', $pozycje_buf[0][5], $pozycje_buf[0][8], $pozycje_buf[0][9]),
        );

        $platnosc1 = array(
            array(21, 18, 'Termin zapłaty', $termin_zaplaty),
            array(20, 35, 'Forma zapłaty', $platnosc),
            array(9, 35, 'Bank', $nazwa_banku),
            array(17, 35, 'BIK/SWIFT', ''),
        );

        $platnosc2 = array(
            array(19, 76, 'Numer konta', $numer_konta),
            array(12, 17, 'Razem', round00($suma)),
            array(16, 17, 'Zapłacono', round00($zaplacono)),
            array(16, 17, 'Do zapłaty', round00($pozostalo)),
        );

        $platnosc3 = array(
            array(13, 177, 'Słownie', $slownie),
        );

        $platnosc4 = array(
            array(10, 180, 'Uwagi', $uwagi),
        );

        $invoice->AliasNbPages();
        $invoice->SetAutoPageBreak(0);
        $invoice->addPage();
        $invoice->addFooter();

        //$invoice->rysujLogo($logo);
        $invoice->rysujDataRow('Data wystawienia', $data_wystawienia);
        $invoice->rysujDataRow('Miejsce wystawienia', $miejsce_wystawienia);
        $invoice->rysujDataRow('Data dostawy', $data_sprzedazy);
        $invoice->Ln(5);
        if ($md_telefon)
            $md_telefon = "\nTelefon: $md_telefon";
        else
            $md_telefon = '';
        if ($md_fax)
            $md_fax = "\nFax: $md_fax";
        else
            $md_fax = '';
        if ($md_mail)
            $md_mail = "\nMail: $md_mail";
        else
            $md_mail = '';
        if ($md_www)
            $md_www = "\nWWW: $md_www";
        else
            $md_www = '';
        $invoice->rysujSprzedawca("$md_nazwa\nNIP: $md_nip\n$md_ulica\n$md_kod_pocztowy $md_miejscowosc$md_telefon$md_fax$md_mail$md_www");
        if ($kl_telefon)
            $kl_telefon = "\nTelefon: $kl_telefon";
        else
            $kl_telefon = '';
        if ($kl_fax)
            $kl_fax = "\nFax: $kl_fax";
        else
            $kl_fax = '';
        if ($kl_mail)
            $kl_mail = "\nMail: $kl_mail";
        else
            $kl_mail = '';
        if ($kl_www)
            $kl_www = "\nWWW: $kl_www";
        else
            $kl_www = '';
        $invoice->rysujNabywca("$kl_nazwa\nNIP: $kl_nip\n$kl_ulica\n$kl_kod_pocztowy $kl_miejscowosc$kl_telefon$kl_fax$kl_mail$kl_www");
        $invoice->rysujTytul($numer_dokumentu);

        $invoice->setSzerokosci($szerokosci);
        $invoice->setRozmieszczenieTekstu($rozmieszczenieTekstu);
        $invoice->rysujTablice($header, $pozycje_buf);

        $invoice->setSzerokosci($stawkiSzerokosci);
        $invoice->setRozmieszczenieTekstu($stawkiRozmieszczenieTekstu);
        $invoice->rysujStawkiVAT($stawkiHeader, $stawkiVAT);

        $invoice->Ln(5);
        $invoice->rysujSuma('Suma:', round00($suma));
        $invoice->rysujPlatnosc($platnosc1);
        $invoice->rysujPlatnosc($platnosc2);
        $invoice->rysujPlatnosc($platnosc3);
        $invoice->rysujPlatnosc($platnosc4);
        $invoice->Ln(5);

        $invoice->CheckPageBreak(41);
        $invoice->rysujWystawca($osoba_upowazniona);
        $invoice->rysujOdbiorca($odbiorca);
        $invoice->addFooter();

        $invoice->Output();

        //echo 'kuku';
        exit;
    }
}