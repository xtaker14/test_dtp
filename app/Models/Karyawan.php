<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
    protected $connection = 'mysql';

    protected $fillable = [
        'nama',
        'no_ktp',
        'alamat',
    ];

    public $rules = [
        'nama' => 'required|alpha',
        'no_ktp' => 'required|numeric',
    ];

    public $messages = [
        'required' => 'Harap isi field :attribute',
        'unique' => ':attribute sudah digunakan',
        'alpha' => ':attribute tidak boleh diisikan numeric',
        'numeric' => ':attribute tidak boleh diisikan alphabet',
    ];

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules, $this->messages);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }
    
    protected $errors;
    public function errors()
    {
        return $this->errors;
    }


}
