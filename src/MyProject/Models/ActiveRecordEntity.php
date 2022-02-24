<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
    /** @var int */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    /**
     * @return static[]
     */
    public static function findAll(): array
    {
        $db = $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        $db = $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }
    public static function getByIdComment($filmId): array
    {
        $db = $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE film_id=:id;',
            [':id' => $filmId],
            static::class
        );

    }
    public static function getIdByOrig(string $origName): ?self{
        $db = $db = Db::getInstance();
        $origName = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE orig_name=:id;',
            [':id' => $origName],
            static::class
        );
        return $origName ? $origName[0] : null;
    }
    public static function getCommentCheck(string $textComm){
        $db = $db = Db::getInstance();
        $comment = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE comment=:id;',
            [':id' => $textComm],
            static::class
        );
        return $comment ? $comment[0] : null;
    }
    public static function getUrlCheck(string $url){
        $db = $db = Db::getInstance();
        $url = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE urllive=:id;',
            [':id' => $url],
            static::class
        );
        return $url ? $url[0] : null;
    }

    public static function sortMain($pivgrade, $genre, $country, $grade){
        $endSort = '';
       if(!empty($pivgrade) && !empty($genre)){
           $endSort = self::getSortPlusA($genre, $pivgrade);
       }elseif (!empty($grade) && !empty($genre)){
           $endSort = self::getSortPlusA($genre, $grade);
       } elseif (!empty($grade)){
           $endSort = self::getSortPlus($grade);
       }elseif (!empty($genre)){
           $endSort = self::getSort($genre);
       }elseif(!empty($pivgrade)){
            $endSort = self::getSortPlus($pivgrade);
        }
       return $endSort;
    }

    public static function getSort($sort){

        $db = $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE '. key($sort) . ' LIKE :id;',
            [':id' => implode('',($sort[key($sort)])),

            ],
            static::class
        );
    }

    public static function getSortPlus($sortPlus){

        $db = $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` ORDER BY '. $sortPlus  . ' DESC;',
            [],
            static::class
        );
    }

    public static function getSortPlusA($genre, $type){

        $db = $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE '. array_key_first($genre) . ' LIKE :id AND ' . array_key_last($genre) . ' LIKE :idi ORDER BY ' . $type . ' DESC;',
            [':id' => '%' . implode('',(reset($genre))),
                ':idi' => '%' . implode('',end($genre))
            ],
            static::class
        );
    }



    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }




    abstract protected static function getTableName(): string;

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName. '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();

    }


    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }
}