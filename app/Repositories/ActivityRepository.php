<?php

namespace App\Repositories;

use App\Models\Activity;
use Illuminate\Notifications\Action;

class ActivityRepository
{
    public function create(array $data)
    {
        return Activity::create($data);
    }

    public function update(Activity $Activity, array $data)
    {
        $Activity->update($data);
        return $Activity;
    }

    public function delete(Activity $Activity)
    {
        return $Activity->delete();
    }
    public function getById(int $id)
    {
        return Activity::find($id);
    }
     
    public function getAll()
    {
        return Activity::all();
    }
    public function paginate(int $Nrows){
        return Activity::paginate($Nrows);
    }
}
