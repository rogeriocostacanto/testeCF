<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TableInterface
{

    protected $fillable = ['name'];

    public function getTableHeaders()
    {
        return ['#','Nome'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
        }
    }

}
