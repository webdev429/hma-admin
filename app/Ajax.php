<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Deal;

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

    static function getSpecificsByCategories($categories = array()) {
        $specifics = DB::table('category_specific')
            ->leftJoin('specifics', 'category_specific.specific_id', '=', 'specifics.id')
            ->leftJoin('categories', 'category_specific.category_id', '=', 'categories.id');
        
        if (!$categories)
            return 'fail';

        foreach ($categories as $category) {
            $specifics ->orWhere('category_specific.category_id', $category);
        }

        $specifics ->select('specifics.name', 
                        'specifics.unit',
                        'specifics.column_name',
                        'specifics.type',
                        'specifics.data_type',
                        'specifics.value')
                ->distinct()
                ->get();
        
        return $specifics->get();
    }

    static function getMakeByCategories($categories = array()) {
        $return = DB::table('modelds')
            ->leftJoin('makes', 'modelds.make_id', '=', 'makes.id');
        
        if (!$categories)
            return 'fail';

        foreach ($categories as $category) {
            $return ->orWhere('modelds.category_id', $category);
        }

        $pre_return = $return ->select('makes.id', 'makes.name');

        $result['data'] = $pre_return ->take(5) ->distinct() ->get();
        if(sizeof($result['data']) > 5) {
            $result['data_modal'] = $pre_return ->get();
        } else {
            $result['data_modal'] = 'no_more';
        }

        return $result;
    }

    static function getModeldByCategories($categories = array()) {
        $return = DB::table('modelds');
        
        if (!$categories)
            return 'fail';
        
        foreach ($categories as $category) {
            $return ->orWhere('category_id', $category);
        }

        $pre_return = $return ->select('id', 'name');

        $result['data'] = $pre_return ->take(5) ->distinct() ->get();
        if(sizeof($result['data']) > 5) {
            $result['data_modal'] = $pre_return ->get();
        } else {
            $result['data_modal'] = 'no_more';
        }

        return $result;
    }

    static function getCitiesByCountries($countries = array()) {
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
        $returnAry = array();

        foreach ($countries as $country) {
            switch($country) {
                case 'United States':
                    $returnAry = array_merge($returnAry, $us_states);
                break;
                
                case 'Canada':
                    $returnAry = array_merge($returnAry, $canadian_states);
                break;
                
                case 'Mexico':
                    $returnAry = array_merge($returnAry, $mexico_states);
                    break;

                default:
                    break;
            }
        }
        return $returnAry;
    } 

    static function getIfTruckByCategories($categories = array()) {
        $return = DB::table('categories')
            ->where('truck_mounted', 1);
        
        if (empty($categories)) {
            return 'fail';
        }
        
        foreach ($categories as $category) {
            $return ->orWhere('id', $category);
        }

        $return ->get(); 

        if (empty($return)) {
            return 'fail';
        } else {
            return 'success';
        }
    }

    static function getCategoryByTypes($types = array(), $ext = 3) {
        $categoryList = DB::table('categories');

        if (empty($types)) 
            return 'fail';

        foreach ($types as $type) {
            $categoryList ->orWhere('type_id', $type);
        }

        $categoryList ->select('id', 'name');

        if ($ext == 3) {
            $categoryList ->take(3) ->get();
        } else {
            $categoryList ->get();
        }

        return $categoryList->get();
    }

    static function getModelByMake($makes = array()) {
        $modeldList = DB::table('modelds');

        if (empty($makes)) 
            return 'fail';
        
        foreach ($makes as $make) {
            $modeldList ->orWhere('make_id', $make);
        }

        $modeldList ->select('id', 'name')
            ->get();

        return $modeldList->get();
    }

    static function getDealsWithFilter($request = array()) {        
        $searchResult = DB::table('deals')
            ->leftJoin('types', 'deals.type_id', '=', 'types.id')
            ->leftJoin('categories', 'deals.category_id', '=', 'categories.id')
            ->leftJoin('makes', 'deals.make_id', '=', 'makes.id')
            ->leftJoin('modelds', 'deals.modeld_id', '=', 'modelds.id')
            ->leftJoin('truckmakes', 'deals.truckmake_id', '=', 'truckmakes.id')
            ->leftJoin('users', 'deals.user_id', '=', 'users.id');

        switch ($request->deal_type) {
            case 0:
                $searchResult ->where('deals.deal_type', '=', 0);
            break;
            case 1:
                $searchResult ->where('deals.deal_type', '=', 1);
            break;
            case 2:
                $searchResult ->where('deals.deal_type', '=', 1)
                    ->orWhere('deals.deal_type', '=', 0);
            break;
            case 3:
                return 'fail';
            break;
            default:
                return 'fail';
                break;
        }

        if ($request->search_key) {
            $searchResult ->where('deals.title', 'LIKE', '%'.$request->search_key.'%')
                ->orWhere('deals.description', 'LIKE', '%'.$request->search_key.'%')
                ->orWhere('makes.name', 'LIKE', '%'.$request->search_key.'%')
                ->orWhere('modelds.name', 'LIKE', '%'.$request->search_key.'%')
                ->orWhere('categories.name', 'LIKE', '%'.$request->search_key.'%');
        }

        if ($request->eq_type) {
            $flag = 0;
            foreach ($request->eq_type as $type) {
                if (sizeof($request->eq_type) == 1 || $flag == 0) {
                    $searchResult ->where('types.id', $type);
                    $flag = 1;
                } else {
                    $searchResult ->orWhere('types.id', $type);
                }
            }
        }

        if ($request->eq_category) {
            $flag = 0;
            foreach ($request->eq_category as $category) {
                if (sizeof($request->eq_category) == 1 || $flag == 0) {
                    $searchResult ->where('categories.id', $category);
                    $flag = 1;
                } else {
                    $searchResult ->orWhere('categories.id', $category);
                }
            }
        }

        if ($request->eq_make) {
            $flag = 0;
            foreach ($request->eq_make as $make) {
                if (sizeof($request->eq_make) == 1 || $flag == 0) {
                    $searchResult ->where('categories.id', $make);
                    $flag = 1;
                } else {
                    $searchResult ->orWhere('categories.id', $make);
                }
            }
        }

        if ($request->eq_model) {
            $flag = 0;
            foreach ($request->eq_model as $model) {
                if (sizeof($request->eq_model) == 1 || $flag == 0) {
                    $searchResult ->where('modelds.id', $model);
                    $flag = 1;
                } else {
                    $searchResult ->orWhere('modelds.id', $model);
                }
            }
        }

        if ($request->from_year) {
            if ($request->end_year) {
                $searchResult ->whereBetween('deals.year', [$request->from_year, $request->end_year]);
            } else {
                $searchResult ->where('deals.year', '>=', $request->from_year);
            }
        } else {
            if ($request->end_year) {
                $searchResult ->where('deals.year', '<=', $request->end_year);                
            }
        }

        if ($request->country) {
            if ($request->state) {
                if (sizeof($request->country) == 1) {
                    foreach ($request->country as $country) {
                        $searchResult ->where('deals.country', $country);
                    }
                    if (sizeof($request->state) == 1) {
                        foreach ($request->state as $state) {
                            $searchResult ->where('deals.state', $state);
                        }
                    } else {      
                        $flag = 0;                  
                        foreach ($request->state as $state) {
                            if ($flag == 0) {
                                $searchResult ->where('deals.state', $state);
                                $flag = 1;
                            } else {
                                $searchResult ->orWhere('deals.state', $state);
                            }
                        }
                    }
                } else {
                    foreach ($request->country as $country) {
                        $searchResult ->orWhere('deals.country', $country);
                    }
                    if (sizeof($request->state) == 1) {
                        foreach ($request->state as $state) {
                            $searchResult ->where('deals.state', $state);
                        }
                    } else {       
                        $flag = 0;                 
                        foreach ($request->state as $state) {
                            if ($flag == 0) {
                                $searchResult ->where('deals.state', $state);
                                $flag = 1;
                            } else {
                                $searchResult ->orWhere('deals.state', $state);
                            }
                        }
                    }
                }
            } else {
                if (sizeof($request->state) == 1) {
                    foreach ($request->state as $state) {
                        $searchResult ->where('deals.state', $state);
                    }
                } else {       
                    $flag = 0;                 
                    foreach ($request->state as $state) {
                        if ($flag == 0) {
                            $searchResult ->where('deals.state', $state);
                            $flag = 1;
                        } else {
                            $searchResult ->orWhere('deals.state', $state);
                        }
                    }
                }
            }
        }

        if ($request->start_premium) {
            if ($request->end_premium) {
                $searchResult ->whereBetween('deals.premium', [$request->from_premium, $request->end_premium]);
            } else {
                $searchResult ->where('deals.premium', '>=', $request->start_premium);
            }
        } else {
            if ($request->end_premium) {
                $searchResult ->where('deals.premium', '<=', $request->end_premium);
            }
        }

        $searchResult ->select('deals.*', 
            DB::raw('types.name as type_name'), 
            DB::raw('users.name as user_name'), 
            DB::raw('users.phone_number as user_phone'), 
            DB::raw('categories.name as category_name'), 
            DB::raw('categories.truck_mounted as truck_mount'), 
            DB::raw('makes.name as make_name'),
            DB::raw('modelds.name as modeld_name'),
            DB::raw('truckmakes.name as truckmake_name')
        );

        $return = $searchResult->paginate(10);
        
        return $return;
    }

    static function getTitleStructure($category_id) {
        $tmp_result = DB::table('categories')
            ->where('id', $category_id)
            ->select('title_structure')
            ->get();

        $tmp_str = explode(',', $tmp_result[0]->title_structure);
        $return = array();
        foreach ($tmp_str as $tmp) {
            switch ($tmp) {
                case 'year':
                    array_push($return, '#year');
                    break;
                case 'make':
                    array_push($return, '#make_id');
                    break;
                case 'model':
                    array_push($return, '#modeld_id');
                    break;
                case 'truckmake':
                    array_push($return, '#truckmake_id');
                    break;
                case 'truckmodel':
                    array_push($return, '#truck_model');
                    break;
                case 'truckyear':
                    array_push($return, '#truck_year');
                    break;
                
                default:
                    $result = DB::table('specifics')
                        ->where('id', $tmp)
                        ->select('column_name')
                        ->get();

                    array_push($return, '#'.$result[0]->column_name);
                    break;
            }
        }

        return $return;
    }
 
    static function getModeldByCategory($category_id) {
        $result = DB::table('modelds')
            ->where('category_id', $category_id)
            ->select('id', 'name')
            ->get();

        return $result;
    }

    static function getMakeByCategory($category_id) {
        $result = DB::table('makes')
            ->leftJoin('modelds', 'makes.id', '=', 'modelds.make_id')
            ->where('category_id', $category_id)
            ->select('makes.id', 'makes.name')
            ->distinct()
            ->get();

        return $result;
    }

    static function getAllSpecificFields() {
        $return = DB::table('specifics')->get();

        return $return;
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
