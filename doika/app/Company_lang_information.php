<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_lang_information extends Model
{
    //����� ������ ����-��-������ � ������� ��� �������� ��������
    public function company(){
        return $this->belongsTo('App\Company');
    }
}
