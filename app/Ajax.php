<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class Ajax extends Model
{
    static function getSpecificField($category_id = '') {
        $specificList = DB::table('category_specific')
            ->leftJoin('specifics', 'category_specific.specific_id', '=', 'specifics.id')
            ->leftJoin('categories', 'category_specific.category_id', '=', 'categories.id')
            ->where('category_specific.category_id', $category_id)
            ->get();

        return $specificList;
    }

    static function getCategoryField($type_id = '') {
        $categoryList = DB::table('categories')
            ->where('type_id', $type_id)
            ->select('id', 'name')
            ->get();
        
        return $categoryList;
    }

    static function getModeld($make_id = '') {
        $modeldList = DB::table('modelds')
            ->where('make_id', $make_id)
            ->select('id', 'name')
            ->get();

        return $modeldList;
    }

    static function getStatesOfCountries($country = ''){
        $us_states = array('AL'=>"Alabama",  
            'AK'=>"Alaska",  
            'AZ'=>"Arizona",  
            'AR'=>"Arkansas",  
            'CA'=>"California",
            'CO'=>"Colorado",  
            'CT'=>"Connecticut",  
            'DE'=>"Delaware",  
            'DC'=>"District Of Columbia",  
            'FL'=>"Florida",  
            'GA'=>"Georgia",  
            'HI'=>"Hawaii",  
            'ID'=>"Idaho",  
            'IL'=>"Illinois",  
            'IN'=>"Indiana",  
            'IA'=>"Iowa",  
            'KS'=>"Kansas",  
            'KY'=>"Kentucky",  
            'LA'=>"Louisiana",  
            'ME'=>"Maine",  
            'MD'=>"Maryland",  
            'MA'=>"Massachusetts",  
            'MI'=>"Michigan",  
            'MN'=>"Minnesota",  
            'MS'=>"Mississippi",  
            'MO'=>"Missouri",  
            'MT'=>"Montana",
            'NE'=>"Nebraska",
            'NV'=>"Nevada",
            'NH'=>"New Hampshire",
            'NJ'=>"New Jersey",
            'NM'=>"New Mexico",
            'NY'=>"New York",
            'NC'=>"North Carolina",
            'ND'=>"North Dakota",
            'OH'=>"Ohio",  
            'OK'=>"Oklahoma",  
            'OR'=>"Oregon",  
            'PA'=>"Pennsylvania",  
            'RI'=>"Rhode Island",  
            'SC'=>"South Carolina",  
            'SD'=>"South Dakota",
            'TN'=>"Tennessee",  
            'TX'=>"Texas",  
            'UT'=>"Utah",  
            'VT'=>"Vermont",  
            'VA'=>"Virginia",  
            'WA'=>"Washington",  
            'WV'=>"West Virginia",  
            'WI'=>"Wisconsin",  
            'WY'=>"Wyoming");
        $canadian_states = array( 
            "BC" => "British Columbia", 
            "ON" => "Ontario", 
            "NL" => "Newfoundland and Labrador", 
            "NS" => "Nova Scotia", 
            "PE" => "Prince Edward Island", 
            "NB" => "New Brunswick", 
            "QC" => "Quebec", 
            "MB" => "Manitoba", 
            "SK" => "Saskatchewan", 
            "AB" => "Alberta", 
            "NT" => "Northwest Territories", 
            "NU" => "Nunavut",
            "YT" => "Yukon Territory"
        );
        $mexico_states = array( 
            "AG" => "Aguascalientes",
            "BC" => "Baja California",
            "BS" => "Baja California Sur",
            "CH" => "Chihuahua",
            "CL" => "Colima",
            "CM" => "Campeche",
            "CO" => "Coahuila",
            "CS" => "Chiapas",
            "DF" => "Federal District",
            "DG" => "Durango",
            "GR" => "Guerrero",
            "GT" => "Guanajuato",
            "HG" => "Hidalgo",
            "JA" => "Jalisco",
            "ME" => "México State",
            "MI" => "Michoacán",
            "MO" => "Morelos",
            "NA" => "Nayarit",
            "NL" => "Nuevo León",
            "OA" => "Oaxaca",
            "PB" => "Puebla",
            "QE" => "Querétaro",
            "QR" => "Quintana Roo",
            "SI" => "Sinaloa",
            "SL" => "San Luis Potosí",
            "SO" => "Sonora",
            "TB" => "Tabasco",
            "TL" => "Tlaxcala",
            "TM" => "Tamaulipas",
            "VE" => "Veracruz",
            "YU" => "Yucatán",
            "ZA" => "Zacatecas",
        );
        switch ($country) {
            case 'United States':
                return $us_states;
                break;
            
            case 'Canada':
                return $canadian_states;
                break;
            
            case 'Mexico':
                return $mexico_states;
                break;
            
            default:
                return $us_states;
                break;
        }
    }

    static function getDoctorlist($per_page='', $page='', $search='', $practice='', $available='') {
        $doctorlist = DB::table('cms_doctor');
        
        if ($practice != '')
            $doctorlist ->where('practice', $practice);
        if ($available != '')
            $doctorlist ->where('available', $available);
        if ($search != '') {
            $doctorlist ->where('name', "LIKE", "%{$search}%")
                ->orWhere('practice', "LIKE", "%{$search}%")
                ->orWhere('available', "LIKE", "%{$search}%");
        }
        if ($per_page != '') {
            $doctorlist ->skip( $per_page * ($page - 1) ) ->take($per_page);
        }

        return $doctorlist ->get();
    }

    static function getDoctorlistForTable() {
        $doctorlist = DB::table('cms_doctor')
            ->select('id', 'name')
            ->get();
        
        $return = array();
        foreach ($doctorlist as $item) {
            $return[$item->id] = $item->name;
        }

        return $return;
    }

    static function addNewDoctor($newDoctor) {
        $doctorChecker = DB::table('cms_doctor')
            ->where('name', $newDoctor['name'])
            ->where('practice', $newDoctor['practice'])
            ->where('available', $newDoctor['available'])
            ->first();

        if (isset($doctorChecker ->name))
            return 'DUPLICATE_DOCTOR';

        $createdDoctor = DB::table('cms_doctor')
            ->insert([
                'user_id' => 0,
                'name' => "{$newDoctor['name']}",
                'practice' => "{$newDoctor['practice']}",
                'available' => "{$newDoctor['available']}",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        
        if($createdDoctor) 
            return 'SUCCESS';
    }

    static function updateDoctor($updateData) {
        $updatedDoctor = DB::table('cms_doctor')
            ->where('id', $updateData['id'])
            ->update([
                'name' => $updateData['name'],
                'practice' => $updateData['practice'],
                'available' => $updateData['available'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        
        if($updatedDoctor)
            return 'SUCCESS';
    }

    static function getPharmacylist($per_page='', $page='', $search='') {
        $pharmacylist = DB::table('cms_pharmacy');
        
        if ($search != '') {
            $pharmacylist ->where('name', "LIKE", "%{$search}%")
                ->orWhere('postcode', "LIKE", "%{$search}%")
                ->orWhere('address', "LIKE", "%{$search}%")
                ->orWhere('phone_number', "LIKE", "%{$search}%")
                ->orWhere('fax_number', "LIKE", "%{$search}%")
                ->orWhere('email', "LIKE", "%{$search}%")
                ->orWhere('open_time', "LIKE", "%{$search}%")
                ->orWhere('close_time', "LIKE", "%{$search}%");
        }
        if ($per_page != '') {
            $pharmacylist ->skip( $per_page * ($page - 1) ) ->take($per_page);
        }

        return $pharmacylist ->get();
    }

    static function getPharmacylistForTable() {
        $pharmacylist = DB::table('cms_pharmacy')
            ->select('id', 'name')
            ->get();
        
        $return = array();
        foreach ($pharmacylist as $item) {
            $return[$item->id] = $item->name;
        }

        return $return;
    }

    static function addNewPharmacy($newPharmacy) {
        $pharmacyChecker = DB::table('cms_pharmacy')
            ->where('name', $newPharmacy['name'])
            ->where('postcode', $newPharmacy['postcode'])
            ->where('address', $newPharmacy['address'])
            ->first();

        if (isset($pharmacyChecker ->name))
            return 'DUPLICATE_PHARMACY';

        $createdPharmacy = DB::table('cms_pharmacy')
            ->insert([
                'name' => "{$newPharmacy['name']}",
                'postcode' => "{$newPharmacy['postcode']}",
                'address' => "{$newPharmacy['address']}",
                'phone_number' => "{$newPharmacy['phone_number']}",
                'fax_number' => "{$newPharmacy['fax_number']}",
                'email' => "{$newPharmacy['email']}",
                'open_time' => "{$newPharmacy['open_time']}",
                'close_time' => "{$newPharmacy['close_time']}",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        
        if($createdPharmacy) 
            return 'SUCCESS';
    }

    static function updatePharmacy($updateData) {
        $updatedPharmacy = DB::table('cms_pharmacy')
            ->where('id', $updateData['id'])
            ->update([
                'name' => $updateData['name'],
                'postcode' => $updateData['postcode'],
                'address' => $updateData['address'],
                'phone_number' => $updateData['phone_number'],
                'fax_number' => $updateData['fax_number'],
                'email' => $updateData['email'],
                'open_time' => $updateData['open_time'],
                'close_time' => $updateData['close_time'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        
        if($updatedPharmacy)
            return 'SUCCESS';
    }

    
    static function getCouponlist($per_page='', $page='', $search='') {
        $couponlist = DB::table('cms_coupon');
        
        if ($search != '') {
            $couponlist 
                ->leftJoin('users', 'cms_coupon.user_id', '=', 'users.id')
                ->leftJoin('pp_patients', 'users.id', '=', 'patient.user_id')
                ->where('pp_patients.firstname', "LIKE", "%{$search}%")
                ->orWhere('pp_patients.familyname', "LIKE", "%{$search}%")
                ->orWhere('cms_coupon.number', 'LIKE', "%{$search}%")
                ->orWhere('cms_coupon.coupon_date', 'LIKE', "%{$search}%")
                ->orWhere('cms_coupon.coupon_time', 'LIKE', "%{$search}%");
        }
        if ($per_page != '') {
            $couponlist ->skip( $per_page * ($page - 1) ) ->take($per_page);
        }

        return $couponlist ->get();
    }
}
