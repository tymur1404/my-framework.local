<?php

namespace app;

Interface IModel{

    public static function table();

    public function getItemByID($id);
    public function get($cond, $field_order , $order, $page, $fields);

    public function create($values);
    public function update($values, $id);
    public function delete($id);

}