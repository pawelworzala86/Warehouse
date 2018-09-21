<?php

namespace App\Modules\Werhouse\Controller;

use App\Controller;
use App\Modules\Werhouse\Model\ReservationsModel;

class Reservations extends Controller {

    public function __construct(ReservationsModel $reservationsModel) {
        $this->reservationsModel = $reservationsModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'filter') {
                $this->reservationsModel->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke($page = 1) {
        $this->assign('filter', $this->reservationsModel->getFilter());
        $this->assign('reservations', $this->reservationsModel->getReservations($page));
        //$this->assign('addPrivilage', $this->checkPrivilage('werhouse-add'));
        //$this->assign('decPrivilage', $this->checkPrivilage('werhouse-dec'));
        $this->assign('fluentLoader', '/rezerwacje');
        $this->display('Werhouse/Reservations');
    }

}
