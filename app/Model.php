<?php

namespace app;

use PDO;
use PDOException;

abstract class Model implements IModel
{

    const QUANTITY_ELEMENT_PAGE = 3;

    public static $folder='folder';

    public function __construct()
    {
        $this->db = DB::getConnection();
    }

    public static function table()
    {
        return 'table';
    }

    public function getItemBy($cond)
    {

        try {
            if (!empty($cond)) {
                $cond = ' WHERE ' . $cond;
            }

            $sql = 'SELECT * from ' . static::table() . $cond;
            $result = $this->db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function getItemByID($id)
    {
        $id = intval($id);
        if ($id) {
            try {
                $sql = 'SELECT * from ' . static::table() . ' WHERE id =' . $id;
                $result = $this->db->query($sql);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $newsItem = $result->fetch();

                return $newsItem;
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
        return false;
    }

    public function get($cond = '', $field_order = '', $order = 'asc', $page = false, $fields = ['*'])
    {
        try {
            $limit='';

            if (!empty($field_order)) {
                $order = " ORDER BY $field_order $order";
            }
            if (!empty($cond)) {
                $cond = ' WHERE ' . $cond;
            }
            if ($page) {
                if($page == 1){
                    $page = 0;
                }else{
                    $page = ($page - 1) *  self::QUANTITY_ELEMENT_PAGE;
                }
                $limit = ' LIMIT ' .$page. ', ' . self::QUANTITY_ELEMENT_PAGE;
            }
            $fields = implode(', ', $fields);
            $sql = 'SELECT ' . $fields . ' from ' . static::table() . $cond . $order . $limit;
            $result = $this->db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetchAll();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function create($valuesArr)
    {
        $fields = '(';
        $values = '(';
        foreach ($valuesArr as $k => $v) {
            $fields .= $k . ", ";
            $values .= "'" . $v . "', ";
        }
        $fields = substr($fields, 0, -2) . ")";
        $values = substr($values, 0, -2) . ")";

        try {

            $sql = "INSERT INTO " . static::table() . " $fields VALUES $values";
            $this->db->exec($sql);
            return  $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    //Array key and name fields tables of database must be equal
    public function update($values, $id)
    {
        $fields = '';

        foreach ($values as $k => $v) {
            $fields .= "$k='" . $values[$k] . "', ";
        }
        $fields = substr($fields, 0, -2);

        try {
            $sql = "UPDATE " . static::table() . " SET $fields WHERE id=$id";
            $this->db->exec($sql);
            return $sql;

        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage() . " <br> SQL: " . $sql;
        }

    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM " . static::table() . " WHERE id = $id";
            $this->db->exec($sql);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function Pagination( $elements, $folder ='')// elements element of page, folder for links
    {
        $sql = 'SELECT COUNT(*) from ' . static::table();
        $result = $this->db->query($sql);
        $result->execute();
        $countRecords = $result->fetchColumn();
        $qantity = $countRecords/$elements;
        if($countRecords%$elements != 0){
            ++$qantity;
        }

        $current_page = getUrlParam(2) ?: 1;

        $order = setOrder();

        if($order === 'desc'){
            $order = '?order='.$order;
        }else{
            $order='';
        }
        $folder = $folder ?: static::$folder;
        $pagination = '<nav aria-label="Page navigation example">
                                <ul class="pagination">';

        for ($i = 1; $i <= $qantity; ++$i) {
            if($i == $current_page ) {
                $pagination .= " <li class='page-item active'>
                                  <a class='page-link' href='#'> $i
                                  <span class='sr-only'></span></a>
                                </li>";
            }else{
                $pagination .= "<li class='page-item'>
<a class='page-link' href='/".$folder."/$i".$order."'>$i</a></li>";
            }
        }
        return $pagination.'</ul></nav>';
    }
}