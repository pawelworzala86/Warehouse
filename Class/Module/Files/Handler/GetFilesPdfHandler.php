<?php

namespace App\Module\Files\Handler;

use App\Common;
use App\Handler;
use App\Module\Files\Collection\FileCollection;
use App\Prints\Table;
use App\Response\XlsResponse;
use App\Request\UuidCollectionRequest;
use App\Container\File;
use App\Type\UUID;

class GetFilesPdfHandler extends Handler
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

        $contractors = new FileCollection;
        $contractors->load($ids, true);

        $tablePdf = new Table;
        $tablePdf->setFillColor(220, 220, 220);

        $contractors->rewind();
        $productsPdf = [];
        while($product = $contractors->current()) {
            $productsPdf[] = [
                    $product->getName(),
                    $product->getType(),
                    $product->getSize(),
                ];
            $contractors->next();
        }
        $szerokosci = array(70, 70, 50);
        $rozmieszczenieTekstu = array('L', 'L', 'R');
        $header = array('Nazwa pliku', 'Typ pliku', 'Rozmiar pliku');



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
            ->setName('files.pdf')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}