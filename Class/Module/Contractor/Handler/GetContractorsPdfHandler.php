<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Prints\Table;
use App\Response\XlsResponse;
use App\Request\UuidCollectionRequest;
use App\Container\File;
use App\Type\UUID;

class GetContractorsPdfHandler extends Handler
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

        $contractors = new ContractorCollection;
        $contractors->load($ids, true);

        $tablePdf = new Table;
        $tablePdf->setFillColor(220, 220, 220);

        $contractors->rewind();
        $productsPdf = [];
        while($product = $contractors->current()) {
            $productsPdf[] = [
                    $product->getCode(),
                    $product->getName(),
                ];
            $contractors->next();
        }
        $szerokosci = array(40, 150);
        $rozmieszczenieTekstu = array('L', 'L');
        $header = array('Kod', 'Nazwa');



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
            ->setName('contractors.pdf')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}