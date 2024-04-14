<?php

interface CRUD
{
    public function addTodo($conn,$libelle,$date_time,$description,$date_echeance,$checked,$priorite,$etat);
    public function readTodo($id);
    public function checkedTodo($con,$libelle,$date_time,$description,$date_echeance,$checked,$priorite,$etat);
    public function updateTodo($conn,$libelle,$date_time,$description,$date_echeance,$checked,$priorite,$etat);
    public function removeTodo($id);

}