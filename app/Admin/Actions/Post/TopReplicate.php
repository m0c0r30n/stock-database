<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class TopReplicate extends RowAction
{
    public $name = 'PDF作成';

    public function href()
    {
        return "/admin/maketoppdf/" . $this->getKey();
    }

}