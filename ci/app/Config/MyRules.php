<?php

class MyRules
{
    public function even($value): bool
    {
        return (int) $value % 2 === 0;
    }
    public function chercher_pseudo($pseudo){
        $model = model(Db_model::class);
        return $model->check_username($pseudo);
    }
}