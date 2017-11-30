<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model{
    public $table = "chat";
    protected $fillable = ['uid','fd'];

    public function user(){
		return $this->belongsTo('App\User','uid');
	}
}