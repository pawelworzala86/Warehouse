<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Response\XlsResponse;
use App\Module\Document\Collection\DocumentCollection;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use App\Type\UUID;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetContractorsXlsHandler extends Handler
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

        $contractors = new ContractorCollection;
        $contractors->load($ids, true);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $contractors->rewind();
        $index = 2;
        $sheet->setCellValue('A1', 'Kod');
        $sheet->setCellValue('B1', 'Nazwa');
        while($product = $contractors->current()) {
            $sheet->setCellValue('A'.$index, $product->getCode());
            $sheet->setCellValue('B'.$index, $product->getName());
            $index++;
            $contractors->next();
        }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(DIR.'/Files/'.$uuid.'.xlsx');

        $file = new File;
        $uuid = $file->setType('application/vnd.ms-excel')
            ->setUrl('/Files/'.$uuid.'.xlsx')
            ->setSize(filesize(DIR.'/Files/'.$uuid.'.xlsx'))
            ->setName('contractors.xlsx')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}