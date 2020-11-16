<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model  
{
   
    /**
    * The database table used by the model.
    *
    * @var string
    */
    //protected $table = 'assets';

    public static function insertData($data)
    {
    	
         DB::table('assets')->insert($data);
    }

    public static function checkData($id)
    {
        return    DB::table('assets')->where($id)->first();
           
    }

    public static function insertusersData($data)
    {
        
         DB::table('users')->insert($data);
    }
}
