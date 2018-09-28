<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
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
        $idsCollection = $request->getIds();
        //print_r($idsCollection);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        //$writer = new Xlsx($spreadsheet);
        //$writer->save('hello world.xlsx');

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        //header('Content-Type: application/vnd.ms-excel');
        //header('Content-Disposition: attachment; filename="products.xls"');
        //$writer->
        //print_r(DIR.'/Files/'.$uuid.'.xlsx');
        $writer->save(DIR.'/Files/'.$uuid.'.xlsx');

        $file = new File;
        $file->setType('application/vnd.ms-excel')
            ->setUrl('/Files/'.$uuid.'.xlsx')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.xlsx'))
            ->setName('helloworld.xlsx')
            ->setUuid($uuid)
            ->save();
        //$handle = $writer->save('php://memory');
        //print_r($handle);

        return (new GetCatalogProductsXlsResponse)
            ->setId($file->getUuid())
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}