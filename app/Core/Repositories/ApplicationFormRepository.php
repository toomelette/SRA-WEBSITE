<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ApplicationFormInterface;

use App\Models\ApplicationForm;


class ApplicationFormRepository extends BaseRepository implements ApplicationFormInterface {
	



    protected $application_form;




	public function __construct(ApplicationForm $application_form){

        $this->application_form = $application_form;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $application_forms = $this->cache->remember('application_forms:fetch:' . $key, 240, function() use ($request){

            $entries = isset($request->e) ? $request->e : 20;

            $application_form = $this->application_form->newQuery();

            if(isset($request->q)){
                $this->search($application_form, $request->q);
            }
            
            return $this->populate($application_form, $entries);

        });

        return $application_forms;

    }

        



    public function guestfetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $application_forms = $this->cache->remember('application_forms:guest:fetch:'. $key, 240, function() use ($request){
                
            $entries = isset($request->e) ? $request->e : 10;

            $application_form = $this->application_form->newQuery();

            if(isset($request->q)){
                $application_form->where('title', 'LIKE', '%'. $request->q .'%')
                                 ->orWhere('description', 'LIKE', '%'. $request->q .'%');
            }

            return $application_form->select('file_location', 'title', 'description', 'slug')
                                    ->sortable()
                                    ->orderBy('updated_at', 'desc')
                                    ->paginate($entries);
        });

        return $application_forms;

    }





    public function store($request, $file_location){

        $application_form = new ApplicationForm;
        $application_form->slug = $this->str->random(16);
        $application_form->application_form_id = $this->getApplicationFormIdInc();
        $application_form->title = $request->title;
        $application_form->description = $request->description;
        $application_form->file_location = $file_location;
        $application_form->created_at = $this->carbon->now();
        $application_form->updated_at = $this->carbon->now();
        $application_form->ip_created = request()->ip();
        $application_form->ip_updated = request()->ip();
        $application_form->user_created = $this->auth->user()->user_id;
        $application_form->user_updated = $this->auth->user()->user_id;
        $application_form->save();
        
        return $application_form;

    }





    public function update($request, $file_location, $application_form){

        $application_form->title = $request->title;
        $application_form->description = $request->description;
        $application_form->file_location = $file_location;
        $application_form->updated_at = $this->carbon->now();
        $application_form->ip_updated = request()->ip();
        $application_form->user_updated = $this->auth->user()->user_id;
        $application_form->save();

        return $application_form;

    }





    public function destroy($application_form){

        $application_form->delete();
        return $application_form;

    }





    public function findBySlug($slug){

        $application_form = $this->cache->remember('application_forms:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->application_form->where('slug', $slug)->first();
        }); 
        
        if(empty($application_form)){
            abort(404);
        }

        return $application_form;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'description', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getApplicationFormIdInc(){

        $id = 'AF10001';

        $application_form = $this->application_form->select('application_form_id')
                                                   ->orderBy('application_form_id', 'desc')
                                                   ->first();

        if($application_form != null){
            if($application_form->application_form_id != null){
                $num = str_replace('AF', '', $application_form->application_form_id) + 1;
                $id = 'AF' . $num;
            }
        }
        
        return $id;
        
    }






}