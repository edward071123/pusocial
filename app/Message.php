<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Message extends Model{
    public $table = "message";
    protected $fillable = ['from','to','message'];
}