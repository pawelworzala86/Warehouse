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
use App\Module\User\Model\UserModel;
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
        $userModel = (new UserModel)
            ->load(User::getId());
        $userAddressModel = (new AddressModel)
            ->load($userModel->getAddressId());
        $userContactModel = (new ContractorContactModel)
            ->load($userModel->getContactId());

        $sellerAddress = [
            'nazwa' => $userAddressModel->getName(),
            'nip' => '345-345-345',
            'ulica' => $userAddressModel->getStreet(),
            'miejscowosc' => $userAddressModel->getCity(),
            'kod_pocztowy' => $userAddressModel->getPostcode(),
            'telefon' => $userContactModel->getPhone(),
            'fax' => $userContactModel->getFax(),
            'mail' => $userContactModel->getMail(),
            'www' => $userContactModel->getWww(),
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

        $data_wystawienia = $documentModel->getDate();
        $data_sprzedazy = $documentModel->getDeliveryDate();
        $termin_zaplaty = $documentModel->getPayDate();

        $zaplacono = '24.60';
        $slownie = 'dwadzieścia cztery zł sześciedziat gr';
        $payments = [
            null => '',
            'money' => 'Gotówka',
            'wire' => 'Przelew',
        ];
        $platnosc = $payments[$documentModel->getPayment()];

        $uwagi = '';
        $pozycje = 1;

        $numer_dokumentu = $documentModel->getName();

        $numer_konta = $documentModel->getBankNumber();
        $nazwa_banku = $documentModel->getBankName();
        $swift = $documentModel->getSwift();

        $miejsce_wystawienia = $documentModel->getIssuePlace();
        $osoba_upowazniona = $userAddressModel->getFirstName() . ' ' . $userAddressModel->getLastName();
        $odbiorca = $addressModel->getFirstName() . ' ' . $addressModel->getLastName();
        $bez_odbiorcy = '';
        $bez_wystawcy = '';
        $logo = '';

        $documentProducts = (new DocumentProductCollection)
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->where(new Filter([
                'name' => 'document_id',
                'kind' => new FilterKind('='),
                'value' => $documentModel->getId(),
            ]))
            ->load();

        $products = [];
        $documentProducts->current();
        $index = 1;
        while ($product = $documentProducts->current()) {
            $productModel = (new ProductModel)
                ->load($product->getProductId());
            $products[] = [
                $index++,
                $productModel->getSku(),
                $productModel->getName(),
                $product->getCount(),
                'szt',
                number_format($product->getNet(), 2),
                $product->getVat(),
                number_format($product->getSumNet(), 2),
                number_format($product->getSumGross() - $product->getSumNet(), 2),
                number_format($product->getSumGross(), 2)
            ];
            $documentProducts->next();
        }

        $szerokosci = array(10, 25, 57, 10, 10, 17, 10, 17, 17, 17);
        $rozmieszczenieTekstu = array('C', 'L', 'L', 'C', 'C', 'R', 'C', 'R', 'R', 'R');
        $header = array('Lp.', 'PKWiU', 'Nazwa produktu / usługi', 'Ilość', 'Jm', 'Netto', '%VAT', 'W.netto', 'W.VAT', 'W.brutto');

        $stawkiSzerokosci = array(17, 17, 17, 17);
        $stawkiRozmieszczenieTekstu = array('R', 'R', 'R', 'R');
        $stawkiHeader = array('', 'W.netto', 'W.VAT', 'W.brutto');
        $vats = [];
        foreach ($products as $product) {
            @$vats[$product[6]]['sumNet'] += $product[7];
            @$vats[$product[6]]['sumVat'] += $product[8];
            @$vats[$product[6]]['sumGross'] += $product[9];
        }
        $vatTable = [];
        foreach ($vats as $key => $value) {
            $vatTable[] = [
                $key,
                number_format($value['sumNet'], 2),
                number_format($value['sumVat'], 2),
                number_format($value['sumGross'], 2),
            ];
        }
        $vatTable[] = ['Razem', $documentModel->getNet(), $documentModel->getGross() - $documentModel->getNet(), $documentModel->getGross()];

        $platnosc1 = array(
            array(26, 23, 'Termin zapłaty', $termin_zaplaty),
            array(25, 30, 'Forma zapłaty', $platnosc),
            array(9, 30, 'Bank', $nazwa_banku),
            array(20, 27, 'BIK/SWIFT', $swift),
        );

        $platnosc2 = array(
            array(25, 64, 'Numer konta', $numer_konta),
            array(14, 15, 'Razem', number_format($documentModel->getGross(), 2)),
            array(21, 15, 'Zapłacono', number_format($documentModel->getPayed(), 2)),
            array(21, 15, 'Do zapłaty', number_format($documentModel->getToPay(), 2)),
        );

        $platnosc3 = array(
            array(13, 177, 'Słownie', $slownie),
        );

        $platnosc4 = array(
            array(20, 170, 'Uwagi', $documentModel->getDescription()),
        );

        $footerText = "Druk z programu magazynowego autorstwa: Paweł Worzała.";

        $invoice->AliasNbPages();
        $invoice->SetAutoPageBreak(0);
        $invoice->addPage();
        $invoice->addFooter($footerText);

        //$invoice->rysujLogo($logo);
        $invoice->rysujDataRow('Data wystawienia', $data_wystawienia);
        $invoice->rysujDataRow('Miejsce wystawienia', $miejsce_wystawienia);
        $invoice->rysujDataRow('Data dostawy', $data_sprzedazy);
        $invoice->Ln(5);

        $sellerAddress['telefon'] = $sellerAddress['telefon'] ? ("\nTelefon: " . $sellerAddress['telefon']) : '';
        $sellerAddress['fax'] = $sellerAddress['fax'] ? ("\nFax: " . $sellerAddress['fax']) : '';
        $sellerAddress['mail'] = $sellerAddress['mail'] ? ("\nMail: " . $sellerAddress['mail']) : '';
        $sellerAddress['www'] = $sellerAddress['www'] ? ("\nWWW: " . $sellerAddress['www']) : '';
        $invoice->rysujSprzedawca($sellerAddress['nazwa'] .
            "\nNIP: " . $sellerAddress['nip'] .
            "\n" . $sellerAddress['ulica'] .
            "\n" . $sellerAddress['kod_pocztowy'] .
            "\n" . $sellerAddress['miejscowosc'] .
            $sellerAddress['telefon'] .
            $sellerAddress['fax'] .
            $sellerAddress['mail'] .
            $sellerAddress['www']);


        $buyerAddress['telefon'] = $buyerAddress['telefon'] ? ("\nTelefon: " . $buyerAddress['telefon']) : '';
        $buyerAddress['fax'] = $buyerAddress['fax'] ? ("\nFax: " . $buyerAddress['fax']) : '';
        $buyerAddress['mail'] = $buyerAddress['mail'] ? ("\nMail: " . $buyerAddress['mail']) : '';
        $buyerAddress['www'] = $buyerAddress['www'] ? ("\nWWW: " . $buyerAddress['www']) : '';
        $invoice->rysujNabywca($buyerAddress['nazwa'] .
            "\n.NIP: " . $buyerAddress['nip'] .
            "\n" . $buyerAddress['ulica'] .
            "\n" . $buyerAddress['kod_pocztowy'] .
            "\n" . $buyerAddress['miejscowosc'] .
            $buyerAddress['telefon'] .
            $buyerAddress['fax'] .
            $buyerAddress['mail'] .
            $buyerAddress['www']);


        $invoice->rysujTytul($numer_dokumentu);

        $invoice->setSzerokosci($szerokosci);
        $invoice->setRozmieszczenieTekstu($rozmieszczenieTekstu);
        $invoice->rysujTablice($header, $products);

        $invoice->setSzerokosci($stawkiSzerokosci);
        $invoice->setRozmieszczenieTekstu($stawkiRozmieszczenieTekstu);
        $invoice->rysujStawkiVAT($stawkiHeader, $vatTable);

        $invoice->Ln(5);
        $invoice->rysujSuma('Suma:', number_format($documentModel->getGross(), 2));
        $invoice->rysujPlatnosc($platnosc1);
        $invoice->rysujPlatnosc($platnosc2);
        //$invoice->rysujPlatnosc($platnosc3);//słownie
        $invoice->rysujPlatnosc($platnosc4);
        $invoice->Ln(5);

        $invoice->CheckPageBreak(41);
        $invoice->rysujWystawca($osoba_upowazniona);
        $invoice->rysujOdbiorca($odbiorca);
        $invoice->addFooter($footerText);

        $invoice->Output();

        //echo 'kuku';
        exit;
    }
}