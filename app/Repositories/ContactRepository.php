<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class ContactRepository implements ContactInterface{
    private $model;
    private $basemodel;

    public function __construct($model)
    {
        $this->setmodel($model);
    }

    public function setmodel($model)
    {
        $this->model = $model;
        $this->basemodel = $model;
    }

    public function all()
    {
        return $this->model->all()->toArray();
    }

    public function create(Request $request)
    {
        return $this->basemodel->create($request->only($this->basemodel->fillable));
    }

    public function update(Request $request)
    {
        $id = $this->model->firstWhere('id', $request->id);
        $up=$id->update($request->only($this->basemodel->fillable));
        if ($up){
            return ['message'=> 'update success','req' => $id];
        } else{
            return ['message' => 'invalid data for update!'];
        }
    }

    public function delete(Request $request)
    {
        $id = $this->model->firstWhere('id', $request->id);
        if ($id) {
            $id->delete();
            return ['message' => 'delete successfully', 'id' => $request->id];
        } else {
            return ['message' => 'nothing for delete!'];
        }

    }

}
