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
            ->where('category_id', $category_id)
            ->get();

        $return_html = "";

        foreach($specificList as $specific) {
            if ($specific->type == 1) {
                $unitStr = "";
                if ($specific->unit != '') 
                    $unitStr = '('.$specific->unit.')';
                $return_html .= "
                    <label class='col-md-1 col-sm-3 col-form-label'>".$specific->name.$unitStr."</label>
                    <div class='col-md-2 col-sm-9'>
                        <div class='form-group'>
                            <input type='text' class='form-control' name='".$specific->column_name."' require='true'>
                        </div>
                    </div>";
            } else {
                $optionAry = explode('/', $specific->value);
                $return_html .= "
                    <label class='col-md-1 col-sm-3 col-form-label'>".$specific->name."</label>
                    <div class='col-md-2 col-sm-9'>
                        <div class='form-group'>
                        <select class='selectpicker' name='".$specific->column_name."' id='".$specific->column_name."' data-style='select-with-transition'>";
                foreach ($optionAry as $option) {
                    $return_html .= "<option value='".$option."'>".$option."</option>";
                }           
                $return_html .="
                        </select>
                        </div>
                    </div>";
            }
        }

        return $return_html;
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
