<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\StatusToggleable;

class Advertisment extends Model
{
    use HasFactory, SoftDeletes, StatusToggleable;

    protected $table = 'advertisment';

    protected $fillable = [
        'start_date',
        'bussines_name',
        'type',
        'district',
        'city',
        'category',
        'home_city',
        'image',
        'image_alt',
        'sub_type',
        'expiry_date',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get Advertisment List
     */
    public function scopeGetadvertisment($model, $limit = null, $offset = null, $search = null, $filter = [], $sort = [])
    {

        $records = Advertisment::select(
            'advertisment.id',
            'advertisment.bussines_name',
            'advertisment.start_date',
            'advertisment.status',
            'advertisment.created_at',
            'users.business_name as business_name',
            'districts.name as district_name',
            'cities.name as city_name',
            'advertisment.sub_type'
        )
        ->join('users', 'users.id', '=', 'advertisment.bussines_name')
        ->leftJoin('districts', 'districts.id', '=', 'advertisment.district')
        ->leftJoin('cities', 'cities.id', '=', 'advertisment.city')

        ->where(function ($query) use ($search) {

            if (!empty($search)) {

                $search = strtolower($search);

                $query->whereRaw('(
                    lower(users.business_name) LIKE "%' . $search . '%"
                    OR lower(districts.name) LIKE "%' . $search . '%"
                    OR lower(cities.name) LIKE "%' . $search . '%"
                )');
            }
        });

        /**
         * Sorting
         */
        if ((!empty($sort) && $sort['column'] > 0) || !empty($search)) {

            $arr_fields = [
                "",
                "advertisment.start_date",
                "advertisment.type",
                "users.business_name",
                "districts.name",
                "cities.name",
                "advertisment.created_at",
                "advertisment.status",
                ""
            ];

            if (!empty($arr_fields[$sort['column']])) {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }

        } else {

            $records->orderBy('advertisment.id', 'desc');

        }

        /**
         * Pagination
         */
        if (!empty($limit)) {

            return $records->skip($offset)->take($limit)->get();

        } else {

            return $records->count();

        }
    }


    /**
     * Save New Advertisment
     */
    public function scopeSaveRecord($model, $request)
    {

        $authUser = auth()->user();

        $requestArray = $request->all();

        $data = [
            'start_date'   => $requestArray['start_date'],
            'bussines_name'=> $requestArray['vendor_user_id'],
            'type'         => $requestArray['type'],
            'district'     => $requestArray['district'] ?? 0,
            'city'         => $requestArray['city'] ?? 0,
            'category'     => $requestArray['category'] ?? 0,
            'home_city'    => $requestArray['home_city'],
            'status'       => 1,
            'image_alt'    => $requestArray['image_alt'],
            'sub_type'     => $requestArray['sub_type'],
            'expiry_date'  => $requestArray['expiry_date'],
            'created_at'   => now(),
            'updated_at'   => now(),
        ];

        /**
         * Upload Image
         */
        if ($request->hasFile('image')) {

            $path = public_path('upload/advertisment');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move($path, $filename);

            $data['image'] = asset('public/upload/advertisment/' . $filename);
        }

        return $this->create($data);
    }


    /**
     * Update Advertisment
     */
    public function scopeUpdateRecord($model, $request)
    {

        $authUser = auth()->user();

        $requestArray = $request->all();

        $advertismentData = Advertisment::where('id', $requestArray['id'])->first();

        if ($advertismentData) {

            $data = [
                'start_date'   => $requestArray['start_date'],
                'bussines_name'=> $requestArray['vendor_user_id'],
                'type'         => $requestArray['type'],
                'district'     => $requestArray['district'] ?? 0,
                'city'         => $requestArray['city'] ?? 0,
                'category'     => $requestArray['category'] ?? 0,
                'home_city'    => $requestArray['home_city'],
                'status'       => 1,
                'image_alt'    => $requestArray['image_alt'],
                'sub_type'     => $requestArray['sub_type'],
                'expiry_date'  => $requestArray['expiry_date'],
                'updated_at'   => now(),
            ];

            /**
             * Upload Image
             */
            if ($request->hasFile('image')) {

                $path = public_path('upload/advertisment');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $file     = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                $file->move($path, $filename);

                $data['image'] = asset('public/upload/advertisment/' . $filename);
            }

            return $advertismentData->update($data);
        }

        return false;
    }
}