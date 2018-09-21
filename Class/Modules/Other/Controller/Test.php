<?php

namespace App\Modules\Other\Controller;

use App\CollectionIterator;
use App\Common;
use App\DB;
use App\Model2;

class AddressModel extends Model2
{
    /*public function __construct()
    {
        $this->table('address');
    }*/
}

class Test
{

    public function __construct()
    {
    }

    public function __invoke()
    {
        /*$res = (new Model)
            ->table('address')
            ->fields('id, firstname, surname')
            ->offset(2)
            ->limit(2)
            ->load();
        print_r($res);*/

        $res = new AddressModel;

        $res->load(['3r4Uhsy9aro9YywO', '4miZf8zADnArTRLT']);
        print_r([$res->get('sys_unique_id'), $res->get('firstname'), $res->get('surname')]);
        $res->next();
        print_r([$res->get('sys_unique_id'), $res->get('firstname'), $res->get('surname')]);

        $res->load(1);
        print_r([$res->get('sys_unique_id'), $res->get('firstname'), $res->get('surname')]);

        $res
            ->load(20)
            ->set('surname', 'nazwisko')
            ->update();

        /*$res = (new AddressModel)
            ->load();
        foreach($res as $r){
            print_r([$res->get('id'), $res->get('firstname'), $res->get('surname')]);
        }*/

        exit;
    }

}
