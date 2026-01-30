<?php
use App\Models\Setting;

if(!function_exists('getSettingBySlug')){
    function getSettingBySlug($settingSlug){
        $setting = Setting::where('slug', $settingSlug)->first();

        return $setting;
    }
}

if(!function_exists('checkRecordReferenceByTable')){
    // checkRecordReferenceByTable([
    //     'main_table' => 'roles',
    //     'conditions' => [
    //         'roles.id = 1',
    //     ],
    //     'ref_tables' => [
    //         'users' => [
    //             'conditions' => [
    //                 'users.deleted_at is null'
    //             ],
    //         ],
    //     ],
    // ]);
    function checkRecordReferenceByTable($conditions){
        $mainTable = DB::table($conditions['main_table']);
        
        if(isset($conditions['ref_tables'])){
            $mainTable->selectRaw('count('.$conditions['main_table'].'.id) as count_records');

            foreach ($conditions['ref_tables'] as $key => $value) {
                $mainTable->join($key, function($join) use($conditions, $key, $value){
                    $join->on($key.'.role_id', '=', $conditions['main_table'].'.id');

                    if(isset($value['conditions'])){
                        foreach($value['conditions'] as $cKey => $cValue){
                            $join->whereRaw($cValue);
                        }
                    }
                });
            }
        }

        if(isset($conditions['conditions'])){
            foreach ($conditions['conditions'] as $key => $value) {
                $mainTable->whereRaw($value);
            }
        }

        // dd($mainTable->dump());

        $refCounts = $mainTable->first();

        return $refCounts->count_records;
    }
}
?>