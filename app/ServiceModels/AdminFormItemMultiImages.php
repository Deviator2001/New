<?php

namespace App\ServiceModels;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\FormItems\Image;
use Route;

// Небольшой хелпер, нужен что-бы отвязать модель от типа авторизации в админке
// Описание ниже в тексте  
use App\Helpers\ImgHelp;


class AdminFormItemMultiImages extends Image
{

    public function initialize()
    {
        // dpmultiimages.js это правленая копия initMultiple.js
//      AssetManager::addScript('admin::default/js/formitems/image/initMultiple.js');
        AssetManager::addScript('admin::default/js/formitems/image/dpmultiimages.js');

        // Это всё штатное для Slleping-Owl
        AssetManager::addScript('admin::default/js/formitems/image/flow.min.js');
        AssetManager::addScript('admin::default/js/formitems/image/Sortable.min.js');
        AssetManager::addScript('admin::default/js/formitems/image/sortable.jquery.binding.js');
        AssetManager::addStyle('admin::default/css/formitems/image/images.css');
    }


    // переопределяем стандартное представление для "Formitem::images" на своё.
    public function render()
    {
        $params = $this->getParams();
        return view(('admin.multiimages'), $params)->render();
    }


    // собственно лоадер. Работает через ajax
    public static function registerRoutes()
    {
        Route::group(['middleware' => ['web']], function ()
        {
            Route::post('formitems/image/' . static::$route, [
                'as' => 'admin.formitems.image.' . static::$route,
                function ()
                {
                    $validator = Validator::make(Request::all(), static::uploadValidationRules());
                    if ($validator->fails())
                    {
                        return Response::make($validator->errors()->get('file'), 400);
                    }
                    $file = Request::file('file');
                    $filename = $file->getClientOriginalName();

                    // id админа и складывание картинок в папку м его id нужно для корректной уборки мусора
                    $path = config('admin.imagesUploadDirectory').'/category/'.ImgHelp::getCurUserId();
                    $fullpath = public_path($path);
                    $file->move($fullpath, $filename);
                    $value = $path . '/' . $filename;
                    return [
                        'url'   => asset($value),
                        'value' => $value,
                    ];
                }
            ]);
        });
    }



    public function save()
    {
        $name = $this->name();
        $value = Request::get($name, '');
        if ( ! empty($value))
        {
            $value = explode(',', $value);
        } else
        {
            $value = [];
        }
        Request::merge([$name => $value]);
        parent::save();
    }

    public function value()
    {
        $value = parent::value();
        if (is_null($value))
        {
            $value = [];
        }
        if (is_string($value))
        {
            $value = preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
        }
        return $value;
    }

}