<?php

namespace App;

use App\Container\Filter;
use App\Type\FilterKind;
use ReflectionMethod;

class Model
{
    private $db;
    private $table;
    private $fields;
    private $limit;
    private $offset;
    private $updatedFields;
    private $where;
    private $order;
    private $beforeLoadFunctions;
    private $afterLoadFunctions;

    public function __construct(array $datas = [])
    {
        $this->db = DB::get();
        $this->table($this->getTableName($this));
        $this->setFromData($datas);
        $this->beforeLoadFunctions = [];
        $this->afterLoadFunctions = [];
        $this->where = [];
        $this->order = [];
        if (method_exists($this, 'initPagination')) {
            $this->initPagination();
        }
        if (method_exists($this, 'initFilters')) {
            $this->initFilters();
        }
        if (method_exists($this, 'initCollection')) {
            $this->initCollection();
        }
    }

    private function getWhere()
    {
        return $this->where;
    }

    function setBeforeLoadFunctions($data)
    {
        $this->beforeLoadFunctions[] = $data;
    }

    function setAfterLoadFunctionss($data)
    {
        $this->afterLoadFunctions[] = $data;
    }

    function getBeforeLoadFunctions()
    {
        return $this->beforeLoadFunctions;
    }

    function getAfterLoadFunctions()
    {
        return $this->afterLoadFunctions;
    }

    function setFromData(array $dataFrom = [])
    {
        $uuid = null;
        foreach ($dataFrom as $key => $data) {
            $fieldNameCamel = Common::camelCase($key);
            if (method_exists($this, 'set' . ucfirst($fieldNameCamel))) {
                $method = new ReflectionMethod($this, 'set' . ucfirst($fieldNameCamel));
                $params = $method->getParameters();
                $className = $params[0]->getClass()->name;
                if (class_exists($className)) {
                    $classRealName = explode('\\', $className);
                    $classRealName = $classRealName[count($classRealName) - 1];
                    if ($classRealName == 'UUID') {
                        $data = bin2hex($data);
                        $uuid = $data;
                    }
                    if(!empty($data)) {
                        $class = new $className($data);
                        $this->{'set' . ucfirst($fieldNameCamel)}($class);
                    }
                } else {
                    $this->{'set' . ucfirst($fieldNameCamel)}($data);
                }
            }
        }
        $this->updatedFields = [];
        if ($uuid) {
            $this->updatedFields['uuid'] = $uuid;
        }
    }

    function db()
    {
        return $this->db;
    }

    function table($table)
    {
        $this->table = $table;
        return $this;
    }

    function fields($fields)
    {
        $e = explode(',', $fields);
        foreach ($e as $field) {
            $this->fields[] = $field;
        }

        return $this;
    }

    function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    function where($value1, string $value2 = null, string $value3 = null)
    {
        if (is_object($value1)) {
            $this->where[] = $value1;
        }else if (is_string($value1)&&($value2==null)&&($value3==null)) {
            $this->where[] = $value1;
        } else {
            $this->where[] = new Filter([
                'name' => $value1,
                'kind' => new FilterKind($value2),
                'value' => $value3,
            ]);
        }
        return $this;
    }

    function order($order)
    {
        $this->order[] = $order;
        return $this;
    }

    function loadAll($ids = null, $uuid = false)
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
                if ($uuid) {
                    $where .= ' uuid=? ';
                    $params[] = hex2bin($ids);
                } else {
                    $where .= ' id=? ';
                    $params[] = $ids;
                }
            } else {
                $c = [];
                foreach ($ids as $u) {
                    if ($uuid) {
                        $params[] = hex2bin($u);
                    } else {
                        $params[] = $u;
                    }
                    $c[] = '?';
                }
                if ($uuid) {
                    $where .= ' uuid in (' . join(', ', $c) . ') ';
                } else {
                    $where .= ' id in (' . join(', ', $c) . ') ';
                }
            }
        }

        //print_r($this->getWhere());
        $filters = $this->getWhere();
        $where2 = '';
        if ($filters) {
            foreach ($filters as $key => $value) {
                if (!is_string($value)) {
                    $kind = $value->getKind();
                    $kindValue = $kind->getValue();
                    if ($kindValue == '=') {
                        $where2 .= ' `' . $value->getName() . '`=? and ';
                        $params[] = $value->getValue();
                    } else if ($kindValue == '>') {
                        $where2 .= ' `' . $value->getName() . '`>? and ';
                        $params[] = $value->getValue();
                    } else if ($kindValue == '<') {
                        $where2 .= ' `' . $value->getName() . '`<? and ';
                        $params[] = $value->getValue();
                    } else if ($kindValue == 'null') {
                        $where2 .= ' `' . $value->getName() . '` is null and ';
                    } else if ($kindValue == '%') {
                        $where2 .= ' `' . $value->getName() . "` like concat('%', ?, '%') and ";
                        $params[] = $value->getValue();
                    }
                } else {
                    $where2 .= ' ' . $value . ' and ';
                }
            }
        }
        if (!empty($where)) {
            $where = ' where ' . $where . ' ';
            $where = $where . (!empty($where2) ? (' and ' . trim($where2, 'and ')) : '');
        } else {
            $where = !empty($where2) ? ' where ' . trim($where2, 'and ') : '';
        }

        if (!isset($this->order) || (count($this->order) == 0)) {
            $this->order(' id desc ');
        }

        $order = '';
        if (isset($this->order) && (count($this->order) > 0)) {
            $order = ' order by ' . trim(join(', ', $this->order), ', ') . ' ';
        }

        $sql = 'select ' . $fields . ' from `' . $this->table . '` ' . $where . ' ' . $order . ' ' . $limit . $offset;
        //print_r([$sql, $params]);
        $result = $this->db()->getAll($sql, $params);
        $this->updatedFields = [];
        return $result;
    }

    function load($ids = null, $uuid = false)
    {
        foreach ($this->getBeforeLoadFunctions() as $function) {
            call_user_func_array([$function[0], $function[1]], []);
        }

        $result = $this->loadAll($ids, $uuid);
        if ($result) {
            foreach ($result as $res) {
                if ($res) {
                    $this->setFromData($res);
                    break;
                }
            }
        }

        foreach ($this->getAfterLoadFunctions() as $function) {
            call_user_func_array([$function[0], $function[1]], []);
        }

        return $this;
    }

    function getTableName($object)
    {
        $name = str_replace(__NAMESPACE__, '', get_class($object));
        $nameParts = explode('\\', $name);
        $name = $nameParts[count($nameParts) - 1];
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

    function get($fieldName)
    {
        return isset($this->updatedFields[$fieldName]) ? $this->updatedFields[$fieldName] : null;
    }

    function set($fieldName, $value)
    {
        $this->updatedFields[$fieldName] = $value;
        return $this;
    }

    function insert(): int
    {
        $params = [];
        $set = [];
        foreach ($this->updatedFields as $key => $value) {
            $set[] = ' `' . $key . '`=? ';
            if ($key == 'uuid') {
                $params[] = $value;
            } else {
                $params[] = $value;
            }
        }
        if (!isset($this->updatedFields['sessid'])) {
            $set[] = ' `added`=? ';
            $params[] = time();
            $set[] = ' `added_by`=? ';
            $params[] = User::getId();
            $set[] = ' `added_ip_id`=? ';
            $params[] = IP::getId();
        }

        $this->db()->execute('insert into `' . $this->table . '` set ' . join(', ', $set), $params);
        return $this->db()->insertId();
    }

    function update()
    {
        $params = [];
        $set = [];
        foreach ($this->updatedFields as $key => $value) {
            if (($key != 'id') && ($key != 'uuid')) {
                $set[] = ' ' . $key . '=? ';
                $params[] = $value;
            }
        }

        $set[] = ' updated=? ';
        $params[] = time();
        $set[] = ' updated_by=? ';
        $params[] = User::getId();
        $set[] = ' updated_ip_id=? ';
        $params[] = IP::getId();

        $where = [];
        foreach ($this->updatedFields as $key => $value) {
            if ($key == 'id') {
                $where[] = ' id=? ';
                $params[] = $value;
            }
            if ($key == 'uuid') {
                $where[] = ' uuid=? ';
                $params[] = $value;
            }
        }
        if (count($where) > 0) {
            $joined = join(' and ', $where);
            $where = ' where ' . $joined;
        }

        $this->db()->execute('update `' . $this->table . '` set ' . join(', ', $set) . ' ' . $where, $params);
    }

    function delete()
    {
        $params = [
            time(),
            User::getId(),
            IP::getId(),
            $this->get('uuid'),
        ];
        $this->db()->execute('update `' . $this->table . '` set deleted=?, deleted_by=?, deleted_ip_id=? where uuid=?', $params);
    }

    function isLoaded()
    {
        return ($this->updatedFields) > 0;
    }

    function start()
    {
        $this->db()->execute('start transaction');
    }

    function commit()
    {
        $this->db()->execute('commit');
    }
}