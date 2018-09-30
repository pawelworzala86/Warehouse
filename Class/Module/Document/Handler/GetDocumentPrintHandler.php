<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
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

        function round00($value)
        {
            $value = round($value * 100) / 100;
            $buf = number_format($value, 2, ',', ' ');
            return $buf;
        }

        $documentModel = (new DocumentModel)
            ->load($request->getId(), true);
        $contractorId = $documentModel->getContractorId();
        $contractorModel = (new ContractorModel)
            ->load($contractorId);
        $addressId = $contractorModel->getAddressId();
        $addressModel = (new AddressModel)
            ->load($addressId);
        $contactModel = (new ContractorContactModel)
            ->load($contractorModel->getContactId());

        $sellerAddress = [
            'nazwa' => 'Mirek Testowy',
            'nip' => '345-345-345',
            'ulica' => 'ul. Krótka 23/23',
            'miejscowosc' => 'Tczew',
            'kod_pocztowy' => '44-444',
            'telefon' => '423-235-235',
            'fax' => '34-342-234',
            'mail' => 'test@pl.pl',
            'www' => 'test.pl',
        ];
        $buyerAddress = [
            'nazwa' => $addressModel->getName(),
            'nip' => '356-634-346',
            'ulica' => $addressModel->getStreet(),
            'miejscowosc' => $addressModel->getCity(),
            'kod_pocztowy' => $addressModel->getPostcode(),
            'telefon' => $contactModel->getPhone(),
            'fax' => $contactModel->getFax(),
            'mail' => $contactModel->getMail(),
            'www' => $contactModel->getWww(),
        ];
        
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
        $osoba_upowazniona = $addressModel->getFirstName().' '.$addressModel->getLastName();
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

        $sellerAddress['telefon'] = $sellerAddress['telefon']?("\nTelefon: ".$sellerAddress['telefon']):'';
        $sellerAddress['fax'] = $sellerAddress['fax']?("\nFax: ".$sellerAddress['fax']):'';
        $sellerAddress['mail'] = $sellerAddress['mail']?("\nMail: ".$sellerAddress['mail']):'';
        $sellerAddress['www'] = $sellerAddress['www']?("\nWWW: ".$sellerAddress['www']):'';
        $invoice->rysujSprzedawca($sellerAddress['nazwa'].
            "\nNIP: ".$sellerAddress['nip'].
            "\n".$sellerAddress['ulica'].
            "\n".$sellerAddress['kod_pocztowy'].
            "\n".$sellerAddress['miejscowosc'].
            $sellerAddress['telefon'].
            $sellerAddress['fax'].
            $sellerAddress['mail'].
            $sellerAddress['www']);
        
        
        $buyerAddress['telefon'] = $buyerAddress['telefon']?("\nTelefon: ".$buyerAddress['telefon']):'';
        $buyerAddress['fax'] = $buyerAddress['fax']?("\nFax: ".$buyerAddress['fax']):'';
        $buyerAddress['mail'] = $buyerAddress['mail']?("\nMail: ".$buyerAddress['mail']):'';
        $buyerAddress['www'] = $buyerAddress['www']?("\nWWW: ".$buyerAddress['www']):'';
        $invoice->rysujNabywca($buyerAddress['nazwa'].
            "\n.NIP: ".$buyerAddress['nip'].
            "\n".$buyerAddress['ulica'].
            "\n".$buyerAddress['kod_pocztowy'].
            "\n".$buyerAddress['miejscowosc'].
            $buyerAddress['telefon'].
            $buyerAddress['fax'].
            $buyerAddress['mail'].
            $buyerAddress['www']);
        
        
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