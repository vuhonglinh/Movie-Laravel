<?php

namespace App\Repositories;

interface RepositoryInterface //interface khuôn mẫu, khai báo các phương thức chung cho các Models.
{
    public function getAll();
    public function find($id);
    public function create($attributes = []);
    public function update($id, $attributes = []);
    public function delete($id);
}
