<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
	use Notifiable;

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'name', 'email', 'password','avatar','puid'
	];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];

	public function socialProviders(){
		return $this->hasMany(SocialProvider::class);
	}

	public function posts(){
		return $this->hasMany('App\Posts','author_id');
	}
	// user has many comments
	public function comments(){
		return $this->hasMany('App\Comments','from_user');
	}
	public function chats(){
		return $this->hasMany('App\Chat','uid');
	}
	public function can_post(){
		$role = $this->role;
		if($role == 'author' || $role == 'admin'){
			return true;
		}
		return false;
	}
	public function is_admin(){
		$role = $this->role;
		if($role == 'admin'){
			return true;
		}
		return false;
	}
}
