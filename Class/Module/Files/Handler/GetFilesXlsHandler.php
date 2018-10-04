<?php

namespace App\Module\Files\Handler;

use App\Common;
use App\Handler;
use App\Response\XlsResponse;
use App\Module\Files\Collection\FileCollection;
use App\Request\UuidCollectionRequest;
use App\Type\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetFilesXlsHandler extends Handler
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

        $files = new FileCollection;
        $files->load($ids, true);

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $files->rewind();
        $index = 2;
        $sheet->setCellValue('A1', 'Nazwa');
        $sheet->setCellValue('B1', 'Typ pliku');
        $sheet->setCellValue('C1', 'Rozmiar pliku');
        while($file = $files->current()) {
            $sheet->setCellValue('A'.$index, $file->getName());
            $sheet->setCellValue('B'.$index, $file->getType());
            $sheet->setCellValue('C'.$index, $file->getSize());
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

        return (new XlsResponse)
            ->setId($file->getUuid())
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}