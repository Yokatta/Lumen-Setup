<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use App\Models\Note;
class User extends Model implements Authenticatable
{
   //
   use AuthenticableTrait;
   protected $fillable = ['user_name','email','password'];
   protected $hidden = [
   'password'
   ];
   /*
   * Get Todo of User
   *
   */
   public function todo()
   {
       return $this->hasMany(Note::class,'owned_by');
   }
}
