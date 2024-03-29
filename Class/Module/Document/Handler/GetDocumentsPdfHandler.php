<?php

namespace App\Module\Document\Handler;

use App\Common;
use App\Handler;
use App\Module\Document\Collection\DocumentViewCollection;
use App\Prints\Table;
use App\Response\XlsResponse;
use App\Request\UuidCollectionRequest;
use App\Container\File;
use App\Type\UUID;

class GetDocumentsPdfHandler extends Handler
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

        $documents = new DocumentViewCollection;
        $documents->load($ids, true);

        $tablePdf = new Table;
        $tablePdf->setFillColor(220, 220, 220);

        $documents->rewind();
        $productsPdf = [];
        while($product = $documents->current()) {
            $productsPdf[] = [
                    $product->getName(),
                    $product->getDate(),
                    $product->getContractorName(),
                    $product->getGross(),
                ];
            $documents->next();
        }
        $szerokosci = array(35, 35, 80, 40);
        $rozmieszczenieTekstu = array('L', 'L', 'L', 'R');
        $header = array('Numer', 'Data', 'Kontrahent', 'W.brutto');



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
            ->setName('documents.pdf')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}