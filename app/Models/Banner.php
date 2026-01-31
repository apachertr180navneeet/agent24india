<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class Banner extends Model
{
    use HasFactory, SoftDeletes, StatusToggleable; // <-- Added SoftDeletes

    protected $table = 'banners';

    protected $fillable = [
        'title',
        'image',
        'order',
        'type',
        'status',
    ];


    /**
     * Get categories list
     */
    public function scopeGetCategories($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = Banner::select('banners.id', 'banners.title', 'banners.image', 'banners.status', 'banners.created_at')
        // ->with([
        //     "parentbanner" => function($query){
        //         $query->select("id", "name", "image", "status");
        //     }
        // ])
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(banners.title) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "banners.title",
                "banners.created_at",
                "banners.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('banners.id', 'desc');
        }

        // Set final limit and records
        if(!empty($limit))
        {
            $records = $records->skip($offset)->take($limit);
            return $records->get();
        }
        else
        {
            return $records->get()->count();
        }
    }

    /**
     * Get Sub categories list
     */
    public function scopeGetSubCategories($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = Banner::select('banners.id', 'banners.parent_id', 'banners.title', 'banners.image', 'banners.status', 'banners.created_at')
        ->with([
            "parentbanner" => function($query){
                $query->select("id", "parent_id", "title", "image", "status");
            }
        ])
        ->whereHas("parentbanner", function($query){
            $query->select("id", "parent_id", "title", "image", "status");
        })
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(banners.title) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            if($sort['column']){
                $records = $records->join('banners as parent_banner', 'parent_banner.id', '=', 'banners.parent_id');
            }

            $arr_fields = array(
                "", 
                "banners.title",
                "parent_banner.title",
                "banners.created_at",
                "banners.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('categories.id', 'desc');
        }

        // Set final limit and records
        if(!empty($limit))
        {
            $records = $records->skip($offset)->take($limit);
            return $records->get();
        }
        else
        {
            return $records->get()->count();
        }
    }


    public function scopeSaveRecord($model, $request)
    {
        $authUser = auth()->user();
        $requestArray = $request->all();

        // dd($requestArray);

        $data = [
            'title'       => $requestArray['name'],
            'status'     => $requestArray['status'],
            'type'       => $requestArray['type'],
            'created_by' => $authUser->id,
            'updated_by' => $authUser->id,
        ];

        // Upload image
        if ($request->hasFile('image')) {

            $path = public_path('upload/banner');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            // Full URL save in DB
            $data['image'] = asset('public/upload/banner/' . $filename);
        }

        return $this->create($data);
    }

    /**
     * Update banner
     */
    public function scopeUpdateRecord($model, $request)
    {
        $authUser = auth()->user();
        $requestArray = $request->all();
        

        $bannerData = banner::where('id', $requestArray['banner_id'])->first();

        if (!$bannerData) {
            return null;
        }

        $data = [
            'title'       => $requestArray['name'],
            'status'     => $requestArray['status'],
            'updated_by'=> $authUser->id,
        ];

        if ($request->hasFile('image')) {

            $path = public_path('upload/banner');

            // Delete old image
            if (!empty($bannerData->image)) {
                $oldPath = public_path(
                    str_replace(asset('/'), '', $bannerData->image)
                );

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Create folder if not exists
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Upload new image
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            // Save full URL
            $data['image'] = asset('public/upload/banner/' . $filename);
        }

        $bannerData->update($data);
        return $bannerData;
    }
}
