<?php

namespace App\Modules\Other\Model;

use App\Model;
use App\Company;
use App\User;

class PrintDocumentModel extends Model
{

    public function getSeller(): array
    {
        return $this->db()->getRow('select *, '
            . '(select nip from user where id=?) as nip from address where id='
            . '(select address_id from user where id=?)', [User::getId(), User::getId()]);
    }

    public function getContractor(string $id): ?array
    {
        if($this->db()->getOne('select contractor_id from document where sys_unique_id=?', $id)===null){
            return null;
        }
        $contractor = $this->db()->getRow('select *, '
            . '(select nip from contractor where id=(select contractor_id from document where sys_unique_id=?) and address_id=address.id) as nip '
            . ' from address where id='
            . '(select address_id from contractor where id=(select contractor_id from document where sys_unique_id=?))', [$id, $id]);
        return $contractor;
    }

    public function getDocument(string $id): array
    {
        $document = $this->db()->getRow('select kind, type, from_unixtime(date_add,\'%d-%m-%Y\') as date_add, '
            . 'from_unixtime(date_pay,\'%d-%m-%Y\') as date_pay, payment, '
            . 'number, city, from_unixtime(date_act,\'%d-%m-%Y\') as date_act '
            . ' from document where sys_unique_id=? and company_id=?', [$id, Company::getId()]);
        $payments = [
            'wire' => 'Przelew',
            'cash' => 'Gotówka',
            'none' => 'Inne',
        ];
        $document['payment'] = $payments[$document['payment']];
        return $document;
    }

    public function getProducts(string $id, string $type, string $kind): array
    {
        $prefix = 'buy';
        if (($type == 'dec')||($kind=='PW')) {
            $prefix = 'sell';
        }
        $products = $this->db()->getAll('select *, (sum_gross-sum_net) as sum_tax from '
            . '(select (document_product.' . $prefix . '_gross*document_product.`count`) as sum_gross, '
            . '(document_product.' . $prefix . '_net*document_product.`count`) as sum_net, '
            . 'document_product.' . $prefix . '_tax as tax, document_product.' . $prefix . '_net as net, ' .
            '`count`, product.sku, product.name from document_product '
            . 'left join product on product.id=document_product.product_id '
            . 'where exists(select 1 from '
            . 'document where document.id=document_product.document_id and document.sys_unique_id=? and company_id=?) '
            . ') as x', [$id, Company::getId()]);

        $net = 0;
        $tax = 0;
        $gross = 0;
        $summary = [];
        $i = 1;
        foreach ($products as $key => $product) {
            $summary[(string)$product['tax']] = [
                'sum_net' => 0,
                'sum_gross' => 0,
                'sum_tax' => 0,
                'key' => '',
            ];
        }
        foreach ($products as $key => $product) {
            $summary[(string)$product['tax']]['key'] = $product['tax'];
            $summary[(string)$product['tax']]['sum_net'] += isset($product['sum_net']) ? $product['sum_net'] : 0;
            $summary[(string)$product['tax']]['sum_gross'] += isset($product['sum_gross']) ? $product['sum_gross'] : 0;
            $summary[(string)$product['tax']]['sum_tax'] += isset($product['sum_tax']) ? $product['sum_tax'] : 0;
            $product['lp'] = $i++;
            $product['net'] = number_format($product['net'], 2);
            $product['sum_net'] = number_format($product['sum_net'], 2);
            $product['sum_gross'] = number_format($product['sum_gross'], 2);
            $product['sum_tax'] = number_format($product['sum_tax'], 2);
            $products[$key] = $product;
        }
        foreach ($summary as $key => $sum) {
            $net += $sum['sum_net'];
            $gross += $sum['sum_gross'];
            $tax += $sum['sum_tax'];
            $sum['sum_net'] = number_format($sum['sum_net'], 2);
            $sum['sum_gross'] = number_format($sum['sum_gross'], 2);
            $sum['sum_tax'] = number_format($sum['sum_tax'], 2);
            $summary[$key] = $sum;
        }
        $net = number_format($sum['sum_net'], 2);
        $gross = number_format($sum['sum_gross'], 2);
        $tax = number_format($sum['sum_tax'], 2);
        return [
            'summary' => $summary,
            'products' => $products,
            'net' => $net,
            'tax' => $tax,
            'gross' => $gross,
        ];
    }

}
