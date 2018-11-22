<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class SpuGender extends AbstractTool
{    
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function render()
    {   
        $options = $this->id;
        return view('admin.tools.spugender',['options' => $options]);
    }
}