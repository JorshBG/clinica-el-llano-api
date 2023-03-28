<?php

namespace ElLlano\Api\models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    /**
     * @var string
     */
    protected $table = "Rol";
    /**
     * @var string
     */
    protected $primaryKey = "R_ID";
    /**
     * @var bool
     */
    public $incrementing = true;
    /**
     * @var string
     */
    protected $keyType = "int";
    /**
     * @var bool
     */
    public $timestamps = false;

}