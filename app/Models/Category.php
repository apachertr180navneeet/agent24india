<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\UploadImage;
use App\Http\Traits\UploadFile;

class Category extends Model
{
    use SoftDeletes, Statusable, StatusToggleable, UploadImage, UploadFile;

    protected $fillable = [
        'parent_id',
        'name',
        'image',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get Parent Category
     */
    public function parentCategory(){
        return $this->belongsTo(Category::class, "parent_id", "id");
    }

    /**
     * Get categories list
     */
    public function scopeGetCategories($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = Category::select('categories.id', 'categories.parent_id', 'categories.name', 'categories.image', 'categories.status', 'categories.created_at')
        // ->with([
        //     "parentCategory" => function($query){
        //         $query->select("id", "name", "image", "status");
        //     }
        // ])
        ->whereNull('parent_id')
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(categories.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "categories.name",
                "categories.created_at",
                "categories.status",
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

    /**
     * Get Sub categories list
     */
    public function scopeGetSubCategories($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = Category::select('categories.id', 'categories.parent_id', 'categories.name', 'categories.image', 'categories.status', 'categories.created_at')
        ->with([
            "parentCategory" => function($query){
                $query->select("id", "parent_id", "name", "image", "status");
            }
        ])
        ->whereHas("parentCategory", function($query){
            $query->select("id", "parent_id", "name", "image", "status");
        })
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(categories.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            if($sort['column']){
                $records = $records->join('categories as parent_category', 'parent_category.id', '=', 'categories.parent_id');
            }

            $arr_fields = array(
                "", 
                "categories.name",
                "parent_category.name",
                "categories.created_at",
                "categories.status",
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

    /**
     * Save New Category
     */
    // public function scopeSaveRecord($model, $request)
    // {
    //     // dd($request->all());
    //     // Get user
    //     $authUser = auth()->user();
    //     //----------

    //     $requestArray = $request->all();

    //     $data = [
    //         'parent_id' => !empty($requestArray['parent_id']) ? $requestArray['parent_id'] : null,
    //         'name' => $requestArray['name'],
    //         'status' => $requestArray['status'],
    //         'created_at' => date('Y-m-d H:i:s'),
    //         'updated_at' => date('Y-m-d H:i:s'),
    //         'created_by' => $authUser->id,
    //         'updated_by' => $authUser->id
    //     ];

    //     // Upload image and add to data array
    //     if ($request->hasFile('image'))
    //     {
    //         if(!file_exists(storage_path("app/public/images/category/"))){
    //             mkdir(storage_path("app/public/images/category/"), 0777, true);
    //         }
    //         else
    //         {
    //             chmod(storage_path("app/public/images/category/"), 0777);
    //         }

    //         $image = $this->uploadImage($request->file('image'), "images/category/", 70, null);

    //         if ($image['_status']) 
    //         {
    //             $imageName = $image['_data'];
    //             $data['image'] = $imageName;
    //         }
    //     }

    //     $record = $this->create($data);

    //     return $record;
    // }


    public function scopeSaveRecord($model, $request)
    {
        $authUser = auth()->user();
        $requestArray = $request->all();

        $data = [
            'parent_id' => !empty($requestArray['parent_id']) ? $requestArray['parent_id'] : null,
            'name'       => $requestArray['name'],
            'status'     => $requestArray['status'],
            'created_by' => $authUser->id,
            'updated_by' => $authUser->id,
        ];

        // Upload image
        if ($request->hasFile('image')) {

            $path = public_path('upload/category');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            // Full URL save in DB
            $data['image'] = asset('public/upload/category/' . $filename);
        }

        return $this->create($data);
    }

    /**
     * Update Category
     */
    public function scopeUpdateRecord($model, $request)
    {
        $authUser = auth()->user();
        $requestArray = $request->all();

        $categoryData = Category::where('id', $requestArray['category_id'])->first();

        if (!$categoryData) {
            return null;
        }

        $data = [
            'parent_id' => !empty($requestArray['parent_id']) ? $requestArray['parent_id'] : null,
            'name'       => $requestArray['name'],
            'status'     => $requestArray['status'],
            'updated_by'=> $authUser->id,
        ];

        if ($request->hasFile('image')) {

            $path = public_path('upload/category');

            // Delete old image
            if (!empty($categoryData->image)) {
                $oldPath = public_path(
                    str_replace(asset('/'), '', $categoryData->image)
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
            $data['image'] = asset('public/upload/category/' . $filename);
        }

        $categoryData->update($data);
        return $categoryData;
    }

}
