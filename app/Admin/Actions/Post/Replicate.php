<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Replicate extends RowAction
{
    public $name = 'PDF作成';

    public function href()
    {
        return "/admin/makereviewpdf/" . $this->getKey();
    }

}