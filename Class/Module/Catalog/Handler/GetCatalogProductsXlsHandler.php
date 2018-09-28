<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Response\GetCatalogProductsXlsResponse;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetCatalogProductsXlsHandler extends Handler
{
    public function __invoke(UuidCollectionRequest $request): GetCatalogProductsXlsResponse
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

        $products = new ProductCollection;
        $products->load($ids, true);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $products->rewind();
        $index = 2;
        $sheet->setCellValue('A1', 'SKU');
        $sheet->setCellValue('B1', 'Nazwa');
        while($product = $products->current()) {
            //$sheet->setCellValue(($letter++).($index++).'', 'Hello World !');
            $sheet->setCellValue('A'.$index, $product->getSku());
            $sheet->setCellValue('B'.$index, $product->getName());
            $index++;
            $products->next();
        }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(DIR.'/Files/'.$uuid.'.xlsx');

        $file = new File;
        $file->setType('application/vnd.ms-excel')
            ->setUrl('/Files/'.$uuid.'.xlsx')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.xlsx'))
            ->setName('helloworld.xlsx')
            ->setUuid($uuid)
            ->save();

        return (new GetCatalogProductsXlsResponse)
            ->setId($file->getUuid())
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}