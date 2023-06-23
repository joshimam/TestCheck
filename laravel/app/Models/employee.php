<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
   protected  $tablename ="employees";
   protected $primerykey ="id";
   protected $fillable= ['Name','parentid'];
    use HasFactory;

    


    public function scopeTree()
    {
        $allemployee=employee::get();
        $rootemps= $allemployee->where('parentid',0)->values();
        //echo 'w';
        //print_r($rootemps);die;
        self::formattree($rootemps,$allemployee);
        return $rootemps;

    }

    private function formattree($emps,$allemployee)
    {
        foreach($emps as $emp)
        {
          $emp->children=$allemployee->where('parentid',$emp->id)->values();
          if($emp->children->isNotEmpty())
          {
            
          self::formattree($emp->children,$allemployee);
          }
          
        }
    }

 
}
