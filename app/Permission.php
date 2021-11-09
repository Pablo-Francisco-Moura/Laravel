<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{ 
    public function defaultPermission(){
        return [
            array('name' => 'visualizar_tidings'),
            array('name' => 'armazenar_tidings'),
            array('name' => 'editar_tidings'),
            array('name' => 'deletar_tidings'),
            array('name' => 'visualizar_bank'),
        ];
    }
}
