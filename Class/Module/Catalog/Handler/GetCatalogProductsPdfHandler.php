<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Prints\Table;
use App\Response\XlsResponse;
use App\Request\UuidCollectionRequest;
use App\Container\File;
use App\Type\UUID;

class GetCatalogProductsPdfHandler extends Handler
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

        $products = new ProductCollection;
        $products->load($ids, true);

        $tablePdf = new Table;
        $tablePdf->setFillColor(220, 220, 220);

        $products->rewind();
        $productsPdf = [];
        while($product = $products->current()) {
            $productsPdf[] = [
                    $product->getSku(),
                    $product->getName(),
                ];
            $products->next();
        }
        $szerokosci = array(70, 120);
        $rozmieszczenieTekstu = array('L', 'L');
        $header = array('SKU', 'Nazwa produktu / usługi');



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
            ->setName('products.pdf')
            ->save(false);

        return (new XlsResponse)
            ->setId(new UUID($uuid))
            ->setUrl($file->getUrl())
            ->setName($file->getName());
    }
}