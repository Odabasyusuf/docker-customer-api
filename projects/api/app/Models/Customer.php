<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\StatusEnum;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'birth_date',
        'deleted_at'
    ];

    public static function getAllCustomers()
    {
        return self::all();
    }

    public static function getAllCustomersWithTrashed()
    {
        return self::withTrashed()->get();
    }

    public static function getCustomersJustTrashed()
    {
        return self::onlyTrashed()->get();
    }

    public static function getCustomer($id)
    {
        return self::withTrashed()->where('id',$id)->get();
    }

    public static function getRequest($request){
        if($request->status){
            switch ($request->status){
                case StatusEnum::ACTIVE:
                    return self::getAllCustomers();
                case StatusEnum::PASSIVE:
                    return self::getCustomersJustTrashed();
            }
        }
        return self::getAllCustomersWithTrashed();
    }

    public static function findId($id){
        return self::withTrashed()->find($id);
    }
}
