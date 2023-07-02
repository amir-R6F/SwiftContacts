<?php

namespace App\Repositories;
use Illuminate\Http\Request;

interface ContactInterface
{
    public function setmodel($model);
    public function all();
    public function create(Request $request);
    public function update(Request $request);
    public function delete(Request $request);
}
