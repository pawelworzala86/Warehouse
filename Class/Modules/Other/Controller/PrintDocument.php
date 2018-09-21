<?php

namespace App\Modules\Other\Controller;

use App\Lang;
use App\Template;
use Mpdf\Mpdf;
use App\Modules\Other\Model\PrintDocumentModel;

class PrintDocument
{

    private $printDocumentModel;

    public function __construct()
    {
        $this->printDocumentModel = new PrintDocumentModel;
    }

    public function __invoke($id)
    {
        $template = new Template(true);
        $template->assign('seller', $this->printDocumentModel->getSeller());
        $template->assign('contractor', $this->printDocumentModel->getContractor($id));
        $document = $this->printDocumentModel->getDocument($id);
        $template->assign('document', $document);
        $template->assign('products', $this->printDocumentModel->getProducts($id, $document['type'], $document['kind']));
        $documentBody = $template->fetch(Lang::getFolder().'Print/Werhouse');

        $mpdf = new Mpdf(MPDF_CONFIG);
        $mpdf->SetHeader(WEB_PAGE);
        $mpdf->SetFooter('Strona {PAGENO} z {nb}');
        $mpdf->WriteHTML($documentBody);
        $mpdf->Output();
    }

}
