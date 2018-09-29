<?php

namespace App\Module\Files\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Response\GetCatalogProductsXlsResponse;
use App\Module\Files\Collection\FileCollection;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetFilesXlsHandler extends Handler
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

        $files = new FileCollection;
        $files->load($ids, true);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $files->rewind();
        $index = 2;
        $sheet->setCellValue('A1', 'Nazwa');
        while($file = $files->current()) {
            //$sheet->setCellValue(($letter++).($index++).'', 'Hello World !');
            $sheet->setCellValue('A'.$index, $file->getName());
            $index++;
            $files->next();
        }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(DIR.'/Files/'.$uuid.'.xlsx');

        $file = new File;
        $file->setType('application/vnd.ms-excel')
            ->setUrl('/Files/'.$uuid.'.xlsx')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.xlsx'))
            ->setName('files.xlsx')
            ->setUuid($uuid)
            ->save();

        return (new GetCatalogProductsXlsResponse)
            ->setId($file->getUuid())
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}