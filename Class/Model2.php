<?php

namespace App;

class Model2 extends CollectionIterator
{
    private $db;
    private $table;
    private $fields;
    private $limit;
    private $offset;
    private $updatedFields;

    public function __construct()
    {
        $this->db = DB::get();
        $this->table($this->getTableName());
    }

    public function db()
    {
        return $this->db;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function fields($fields)
    {
        $e = explode(',', $fields);
        foreach ($e as $field) {
            $this->fields[] = $field;
        }

        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function load($ids = null)
    {
        $params = [];
        $fields = '*';
        if (isset($this->fields)) {
            $fields = join(', ', $this->fields);
        }
        $limit = '';
        if ($this->limit) {
            $limit = ' limit ' . $this->limit . ' ';
        }
        $offset = '';
        if ($this->offset) {
            $offset = ' offset ' . $this->offset . ' ';
        }
        $where = '';
        if ($ids) {
            if (!is_array($ids)) {
                if (is_string($ids)) {
                    $where .= ' sys_unique_id=? ';
                } else {
                    $where .= ' id=? ';
                }
                $params[] = $ids;
            } else {
                $c = [];
                foreach ($ids as $u) {
                    $params[] = $u;
                    $c[] = '?';
                }
                if (is_string($ids)) {
                    $where .= ' sys_unique_id in (' . join(', ', $c) . ') ';
                } else {
                    $where .= ' id in (' . join(', ', $c) . ') ';
                }
            }
        }
        if (!empty($where)) {
            $where = ' where ' . $where . ' ';
        }
        $res = $this->db()->getAll('select ' . $fields . ' from ' . $this->table . ' ' . $where . ' ' . $limit . $offset, $params);
        $this->rewind();
        $this->updatedFields = [];
        $this->array = $res;
        return $this;
    }

    public function getTableName()
    {
        $name = str_replace(__NAMESPACE__, '', get_class($this));
        $nameParts = explode('\\', $name);
        $name = $nameParts[count($nameParts)-1];
        preg_match_all('/([A-Z][a-z]+)/', $name, $matches, PREG_OFFSET_CAPTURE);
        $tableNameParts = [];
        foreach ($matches[0] as $match) {
            if ($match[0] != 'Model') {
                $tableNameParts[] = lcfirst($match[0]);
            }
        }
        $tableName = trim(join('_', $tableNameParts), '_');
        return $tableName;
    }

    public function get($fieldName)
    {
        return $this->current()[$fieldName];
    }

    public function set($fieldName, $value)
    {
        $this->current()[$fieldName] = $value;
        $this->updatedFields[$fieldName] = $value;
        return $this;
    }

    public function insert()
    {
        $params = [];
        $set = [];
        foreach ($this->updatedFields as $key => $value) {
            $set[] = ' ' . $key . '=? ';
            $params[] = $value;
        }
        $this->db()->execute('insert into ' . $this->table . ' set ' . join(', ', $set), $params);
        return $this->db()->insertId();
    }

    public function update()
    {
        $params = [];
        $set = [];
        foreach ($this->updatedFields as $key => $value) {
            if ($key != 'id') {
                $set[] = ' ' . $key . '=? ';
                $params[] = $value;
            }
        }
        $where = '';
        foreach ($this->current() as $key => $value) {
            if ($key == 'id') {
                $where = ' where id=? ';
                $params[] = $value;
            }
        }
        $this->db()->execute('update ' . $this->table . ' set ' . join(', ', $set) . ' ' . $where, $params);
        return $this->db()->insertId();
    }


}