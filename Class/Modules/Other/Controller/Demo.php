<?php

namespace App\Modules\Other\Controller;

use App\Common;
use App\Model;
use App\LoremIpsum;
use App\User;
use App\Modules\Werhouse\Model\WerhouseAdd;
use App\Mail;
use App\Template;
use App\Lang;

class Demo extends Model
{

    private function insertFilesInDb()
    {
        $files = [];
        foreach (scandir('Files/Demo/Product') as $file) {
            if (is_file('Files/Demo/Product/' . $file))
                $files[] = '/Files/Demo/Product/' . $file;
        }
        foreach ($files as $file) {
            $this->db()->execute('insert into file (link, sys_unique_id) values (:link, :sys_unique_id)', [
                'link' => $file,
                'sys_unique_id' => Common::getRandomChars(),
            ]);
        }
    }

    private function insertProducts()
    {
        $loremIpsum = new LoremIpsum;
        $this->db()->execute('start transaction');
        for ($i = 0; $i < 1000; $i++) {
            $net = rand(10, 99) + (rand(0, 99) / 100);
            $gross = round($net * 1.23, 2);
            $params = [
                'name' => $loremIpsum->wordsR(rand(1, 4)),
                'user_id' => User::getId(),
                'sku' => 'PR' . rand(1000, 9999),
                'net' => $net,
                'tax' => '23%',
                'gross' => $gross,
                'description_short' => $loremIpsum->sentences(1),
                'description' => $loremIpsum->sentences(rand(2, 5)),
                'sys_unique_id' => Common::getRandomChars(),
            ];
            $this->db()->execute('insert into product ('
                . 'name, user_id, sku, net, tax, gross, description_short, description, sys_unique_id'
                . ') values ('
                . ':name, :user_id, :sku, :net, :tax, :gross, :description_short, :description, :sys_unique_id'
                . ')', $params);
            $productId = $this->db()->insertId();
            $this->db()->execute('insert into product_file ('
                . 'product_id, file_id, sys_unique_id'
                . ') values ('
                . ':product_id, :file_id, :sys_unique_id'
                . ')', [
                'product_id' => $productId,
                'file_id' => $this->db()->getOne('select id from file order by rand() limit 1'),
                'sys_unique_id' => Common::getRandomChars(),
            ]);
        }
        $this->db()->execute('commit');
    }

    private function insertContractors()
    {
        $loremIpsum = new LoremIpsum;
        $this->db()->execute('start transaction');
        for ($i = 0; $i < 1000; $i++) {
            $firstname = $loremIpsum->wordsR(rand(1, 2));
            $surname = $loremIpsum->wordsR(1);
            $params = [
                'firstname' => $firstname,
                'surname' => $surname,
                'postcode' => rand(10, 99) . '-' . rand(100, 999),
                'city' => $loremIpsum->wordsR(rand(1, 2)),
                'street' => 'ul. ' . $loremIpsum->wordsR(rand(1, 2)),
                'number' => rand(10, 99),
                'subnumber' => rand(10, 99) > 50 ? rand(10, 99) : null,
                'sys_unique_id' => Common::getRandomChars(),
            ];
            $this->db()->execute('insert into address ('
                . 'firstname, surname, postcode, city, street, number, subnumber, sys_unique_id'
                . ') values ('
                . ':firstname, :surname, :postcode, :city, :street, :number, :subnumber, :sys_unique_id'
                . ')', $params);
            $addressId = $this->db()->insertId();
            $params = [
                'name' => $firstname . ' ' . $surname,
                'user_id' => User::getId(),
                'sys_unique_id' => Common::getRandomChars(),
                'code' => 'KL' . rand(100, 999),
                'phone' => '+' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'fax' => rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
                'address_id' => $addressId,
                'mail' => trim($loremIpsum->wordsR(1)) . '@pl.pl',
                'nip' => rand(100, 999) . '-' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99),
            ];
            $this->db()->execute('insert into contractor ('
                . 'name, user_id, sys_unique_id, code, phone, fax, address_id, mail, nip'
                . ') values ('
                . ':name, :user_id, :sys_unique_id, :code, :phone, :fax, :address_id, :mail, :nip'
                . ')', $params);
        }
        $this->db()->execute('commit');
    }

    private function insertDocumentHistory()
    {
        $this->db()->execute('start transaction');

        $products = [];
        for ($i = 0; $i < rand(2, 10); $i++) {
            $net = rand(10, 20) + (rand(1, 100) / 100);
            $gross = round($net * 1.23, 2);
            $products[] = [
                'count' => rand(1, 20),
                'productId' => $this->db()->getOne('select sys_unique_id from product order by rand() limit 1'),
                'net' => $net,
                'tax' => '23%',
                'gross' => $gross,
            ];
        }

        $contractor = [
            'sys_unique_id' => $this->db()->getOne('select sys_unique_id from contractor order by rand() limit 1'),
        ];

        $document = [
            'date_add' => date("j-n-Y"),
            'date_act' => date("j-n-Y"),
            'city' => 'Elbląg',
        ];

        $werhouseAdd = new WerhouseAdd;
        $werhouseAdd->setProducts($products);
        $werhouseAdd->setContractor($contractor);
        $werhouseAdd->setDocument($document);
        $werhouseAdd->werhouseAdd();

        $this->db()->execute('commit');
    }

    private function update()
    {
        $this->db()->execute('start transaction');
        foreach ($this->db()->getAll('select id from contractor') as $contractor) {
            $this->db()->execute('update contractor set nip=:nip where id=:id', [
                'id' => $contractor['id'],
                'nip' => rand(100, 999) . '-' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99),
            ]);
        }
        $this->db()->execute('commit');
    }

    public function __invoke()
    {
        //$this->insertFilesInDb();
        //$this->insertProducts();
        //$this->insertContractors();
        //$this->insertDocumentHistory();
        //$this->update();
        exit;
    }

}
