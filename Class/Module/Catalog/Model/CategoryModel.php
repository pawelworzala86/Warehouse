<?php

namespace App\Module\Catalog\Model;

use App\Model;
use App\Type\UUID;

class CategoryModel extends Model
{
    private $name;
    private $uuid;
    private $id;
    private $lp;
    private $categoryId;

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId = null): CategoryModel
    {
        $this->set('category_id', $categoryId);
        $this->categoryId = $categoryId;
        return $this;
    }

    public function getLp(): int
    {
        return $this->lp;
    }

    public function setLp(int $lp): CategoryModel
    {
        $this->set('lp', $lp);
        $this->lp = $lp;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CategoryModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): CategoryModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CategoryModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getNewLp(int $addedBy, UUID $parentId = null): int
    {
        $params = [$addedBy];
        $where = '';
        if ($parentId) {
            $parentId = hex2bin($parentId);
            $where = ' category_id=? and ';
            $params[] = $parentId;
        } else {
            $where = ' category_id is null and ';
        }
        return $this->db()->getOne('select coalesce((select max(lp) from category where ' . $where . ' added_by=? and deleted is null), 0)+1 as res', $params);
    }

    public function moveLp(int $addedBy, int $lp)
    {
        $params = [
            'lp' => $lp,
            'added_by' => $addedBy,
            'lp_start' => $this->getLp()
        ];
        $this->db()->execute('update category set lp=lp-1 where lp<=:lp and added_by=:added_by and lp>=:lp_start', $params);
        $this->db()->execute('update category set lp=lp+1 where lp>=:lp and added_by=:added_by and lp<:lp_start', $params);
    }

    public function getCategoryUuid()
    {
        $categoryId = $this->get('category_id');
        if (!$categoryId) {
            return null;
        }
        $uuid = $this->db()->getOne('select uuid from category where id=?', $categoryId);
        $categoryUuid = new UUID(['uuid'=>bin2hex($uuid)]);
        return $categoryUuid;
    }

    public function repairLps(int $id = null)
    {
        $categories = [];
        if ($id) {
            $categories = $this->db()->getAll('select id from category where category_id=? order by lp asc', $id);
        } else {
            $categories = $this->db()->getAll('select id from category where category_id is null order by lp asc');
        }
        $i = 1;
        foreach ($categories as $category) {
            $this->db()->execute('update category set lp=? where id=?', [$i, $category['id']]);
            $i++;
        }
    }
}