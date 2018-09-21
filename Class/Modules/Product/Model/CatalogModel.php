<?php

namespace App\Modules\Product\Model;

use App\Model;
use App\Company;

class CatalogModel extends Model
{

    public function getCatalogByParentId(int $parentId = null, int $productId = null)
    {
        $query = 'select sys_unique_id, id, name, (select 1 from product_catalog where catalog_id=catalog.id and product_id=? limit 1) as `exists` from catalog where company_id=? and deleted is null and parent_id is null';
        $params = [
            $productId,
            Company::getId()
        ];
        if (isset($parentId)) {
            $query = 'select sys_unique_id, id, name, (select 1 from product_catalog where catalog_id=catalog.id and product_id=? limit 1) as `exists` from catalog where company_id=? and deleted is null and parent_id=?';
            $params[] = $parentId;
        }
        $catalog = $this->db()->getAll($query, $params);
        foreach ($catalog as $key => $cat) {
            $cat['element'] = $this->getCatalogByParentId($cat['id'], $productId);
            $catalog[$key] = $cat;
        }
        return $catalog;
    }

    public function getCatalog(string $productId = null): array
    {
        return [
            'element' => $this->getCatalogByParentId(null,
                $productId?$this->db()->getOne('select id from product where sys_unique_id=?', $productId):null)
        ];
    }

    public function deleteByParentId($id = null)
    {
        $query = 'update catalog set deleted=? where company_id=? and deleted is null and sys_unique_id=?';
        $params = [
            time(),
            Company::getId(),
            $id,
        ];
        $this->db()->execute($query, $params);
        $catalog = $this->db()->getAll('select id, parent_id from catalog where sys_unique_id=?', $id);
        foreach ($catalog as $cat) {
            $this->getCatalogByParentId($cat['parent_id']);
        }
    }

    public function delete($id)
    {
        $this->deleteByParentId($id);
    }

}
