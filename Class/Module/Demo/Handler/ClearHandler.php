<?php

namespace App\Module\Demo\Handler;

use App\DB;
use App\Handler;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class ClearHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $db = DB::get();

        $db->execute('truncate address');
        $db->execute('truncate cash_document');
        $db->execute('truncate category');
        $db->execute('truncate channel');
        $db->execute('truncate contractor');
        $db->execute('truncate contractor_contact');
        $db->execute('truncate contractor_integration');
        $db->execute('truncate document');
        $db->execute('truncate document_number');
        $db->execute('truncate document_product');
        $db->execute('truncate file');
        $db->execute('truncate `order`');
        $db->execute('truncate order_integration');
        $db->execute('truncate order_product');
        $db->execute('truncate product');
        $db->execute('truncate production');
        $db->execute('truncate production_document');
        $db->execute('truncate product_attachment');
        $db->execute('truncate product_files');
        $db->execute('truncate product_integration');
        $db->execute('truncate stock');
        $db->execute('truncate financial');
        $db->execute('truncate document_financial');
        $db->execute('truncate integration');
        $db->execute('truncate oauth');
        $db->execute('truncate product_allegro');

        return new SuccessResponse;
    }
}