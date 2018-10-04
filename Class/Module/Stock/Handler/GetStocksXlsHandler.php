<?php

namespace App\Module\Stock\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Collection\StockCollection;
use App\Module\Stock\Collection\StockViewCollection;
use App\Response\XlsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use App\Type\UUID;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetStocksXlsHandler extends Handler
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

        $letter = 'A';

        $stocks = new StockViewCollection;
        $stocks->load($ids, true);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $stocks->rewind();
        $index = 2;
        $sheet->setCellValue('A1', 'SKU');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Ilość');
        while($product = $stocks->current()) {
            $sheet->setCellValue('A'.$index, $product->getSku());
            $sheet->setCellValue('B'.$index, $product->getName());
            $sheet->setCellValue('C'.$index, $product->getCount());
            $index++;
            $stocks->next();
        }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(DIR.'/Files/'.$uuid.'.xlsx');

        $file = new File;
        $uuid = $file->setType('application/vnd.ms-excel')
            ->setUrl('/Files/'.$uuid.'.xlsx')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.xlsx'))
            ->setName('stocks.xlsx')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}