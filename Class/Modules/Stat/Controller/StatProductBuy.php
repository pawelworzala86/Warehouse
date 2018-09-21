<?php

namespace App\Modules\Stat\Controller;

use App\Controller;
use App\Modules\Stat\Model\StatProductBuyModel;
use App\Page404;
use App\Template;
use Mpdf\Mpdf;
use App\Lang;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StatProductBuy extends Controller
{

    public function __construct()
    {
        $this->model = new StatProductBuyModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'filter') {
                $this->model->filter();
            }
        }

        parent::__construct();
    }

    private function excel(){
        $buys = $this->model->getBuys();
        $filter = $this->model->getFilterPrint();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 1;
        foreach ($buys['products'] as $buy) {
            $sheet->setCellValue('A'.$i, $buy['number']);
            $sheet->setCellValue('B'.$i, $buy['date_add']);
            $sheet->setCellValue('C'.$i, $buy['sku']);
            $sheet->setCellValue('D'.$i, $buy['name']);
            $sheet->setCellValue('E'.$i, $buy['buy_net']);
            $sheet->setCellValue('F'.$i, $buy['count']);
            $sheet->setCellValue('G'.$i, $buy['sum_net']);
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="file.xls"');
        $writer->save("php://output");
    }

    private function print(){
        $template = new Template(true);
        $template->assign('buys', $this->model->getBuys());
        $template->assign('filter', $this->model->getFilterPrint());
        $documentBody = $template->fetch(Lang::getFolder().'Print/StatProduct');

        $mpdf = new Mpdf(MPDF_CONFIG);
        $mpdf->WriteHTML($documentBody);
        $mpdf->Output();
    }

    public function __invoke(string $id = null)
    {
        if(isset($id)){
            if($id=='drukuj'){
                $this->print();
                exit;
            }else if($id=='excel'){
                $this->excel();
                exit;
            }else{
                new Page404;
            }
        }
        $this->assign('filter', $this->model->getFilter());
        $this->assign('buys', $this->model->getBuys());
        $this->assign('addPrivilage', $this->checkPrivilage('werhouse-add'));
        $this->assign('decPrivilage', $this->checkPrivilage('werhouse-dec'));
        $this->display('Stat/ProductBuy');
    }

}
