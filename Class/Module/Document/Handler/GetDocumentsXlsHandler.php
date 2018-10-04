<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Response\XlsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use App\Type\UUID;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetDocumentsXlsHandler extends Handler
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

        $documents = new DocumentViewCollection;
        $documents->load($ids, true);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $documents->rewind();
        $index = 2;
        $sheet->setCellValue('A1', 'Numer');
        $sheet->setCellValue('B1', 'Data');
        $sheet->setCellValue('C1', 'Kontrahent');
        $sheet->setCellValue('D1', 'W.brutto');
        while($product = $documents->current()) {
            $sheet->setCellValue('A'.$index, $product->getName());
            $sheet->setCellValue('B'.$index, $product->getDate());
            $sheet->setCellValue('C'.$index, $product->getContractorName());
            $sheet->setCellValue('D'.$index, $product->getGross());
            $index++;
            $documents->next();
        }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(DIR.'/Files/'.$uuid.'.xlsx');

        $file = new File;
        $uuid = $file->setType('application/vnd.ms-excel')
            ->setUrl('/Files/'.$uuid.'.xlsx')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.xlsx'))
            ->setName('documents.xlsx')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}