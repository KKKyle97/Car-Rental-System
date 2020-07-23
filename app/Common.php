<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Common extends Model{


    public static $availability = [
        '0' => 'Unavailable',
		'1' => 'Available',
	];
    
    public static $category =[
        '0' => 'Hatchback',
        '1' => 'Sedan',
        '2' => 'SUV',
        '3' => 'Crossover',
        '4' => 'Coupe',
        '5' => 'Covertible',
    ];

    public static $states = [
         '01' => 'Johor',
         '02' => 'Kedah',
         '03' => 'Kelantan',
         '14' => 'Kuala Lumpur',
         '15' => 'Labuan',
         '04' => 'Melaka',
         '05' => 'Negeri Sembilan',
         '06' => 'Pahang',
         '07' => 'Penang',
         '08' => 'Perak',
         '09' => 'Perlis',
         '16' => 'Putrajaya',
         '12' => 'Sabah',
         '13' => 'Sarawak',
         '10' => 'Selangor',
         '11' => 'Terengganu',
         ];
        

}