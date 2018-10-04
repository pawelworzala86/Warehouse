<?php

namespace App\Module\Stock\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Module\Stock\Collection\StockViewCollection;
use App\Prints\Table;
use App\Response\XlsResponse;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use App\Type\UUID;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetStocksPdfHandler extends Handler
{
    public function __invoke(UuidCollectionRequest $request): XlsResponse
    {
        $uuid = Common::getUuid();
        $ids = [];
        $idsC = $request->getIds();

        $idsC->rewind();
        while($id = $idsC->current()){
            $ids[] = $id->getUuid();
            $idsC->next();
        }

        $contractors = new StockViewCollection;
        $contractors->load($ids, true);

        $tablePdf = new Table;
        $tablePdf->setFillColor(220, 220, 220);

        $contractors->rewind();
        $productsPdf = [];
        while($product = $contractors->current()) {
            $productsPdf[] = [
                    $product->getSku(),
                    $product->getName(),
                    $product->getCount(),
                ];
            $contractors->next();
        }
        $szerokosci = array(40, 120, 30);
        $rozmieszczenieTekstu = array('L', 'L', 'R');
        $header = array('SKU', 'Nazwa', 'Ilość');



        $footerText = "Druk z programu magazynowego autorstwa: Paweł Worzała.";

        $tablePdf->AliasNbPages();
        $tablePdf->SetAutoPageBreak(0);
        $tablePdf->addPage();
        $tablePdf->addFooter($footerText);

        @$tablePdf->setSzerokosci($szerokosci);
        @$tablePdf->setRozmieszczenieTekstu($rozmieszczenieTekstu);
        @$tablePdf->rysujTablice($header, $productsPdf);

        @$tablePdf->Output('F', DIR.'/Files/'.$uuid.'.pdf');

        $file = new File;
        $uuid = $file->setType('application/pdf')
            ->setUrl('/Files/'.$uuid.'.pdf')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.pdf'))
            ->setName('stocks.pdf')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}