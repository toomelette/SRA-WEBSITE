<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SMSFormInterface;

use App\Models\SMSForm;


class SMSFormRepository extends BaseRepository implements SMSFormInterface {
	


    protected $sms_form;



	public function __construct(SMSForm $sms_form){

        $this->sms_form = $sms_form;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sms_forms = $this->cache->remember('sms_forms:fetch:' . $key, 240, function() use ($request, $entries){

            $sms_form = $this->sms_form->newQuery();
            
            if(isset($request->q)){
                $this->search($sms_form, $request->q);
            }

            return $this->populate($sms_form, $entries);

        });

        return $sms_forms;

    }

        



    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $sms_forms = $this->cache->remember('sms_forms:guest:fetch:'. $key, 240, function() use ($request){
                
            $entries = isset($request->e) ? $request->e : 20;

            $sms_form = $this->sms_form->newQuery();

            if(isset($request->q)){
                $sms_form->where('title', 'LIKE', '%'. $request->q .'%')
                         ->orWhere('description', 'LIKE', '%'. $request->q .'%');
            }

            return $sms_form->select('file_location', 'title', 'description', 'slug')
                            ->sortable()
                            ->orderBy('updated_at', 'desc')
                            ->paginate($entries);
        });

        return $sms_forms;

    }





    public function store($request, $file_location){

        $sms_form = new SMSForm;
        $sms_form->slug = $this->str->random(16);
        $sms_form->sms_form_id = $this->getSMSFormIdInc();
        $sms_form->title = $request->title;
        $sms_form->description = $request->description;
        $sms_form->file_location = $file_location;
        $sms_form->created_at = $this->carbon->now();
        $sms_form->updated_at = $this->carbon->now();
        $sms_form->ip_created = request()->ip();
        $sms_form->ip_updated = request()->ip();
        $sms_form->user_created = $this->auth->user()->user_id;
        $sms_form->user_updated = $this->auth->user()->user_id;
        $sms_form->save();
        
        return $sms_form;

    }





    public function update($request, $file_location, $sms_form){

        $sms_form->title = $request->title;
        $sms_form->description = $request->description;
        $sms_form->file_location = $file_location;
        $sms_form->updated_at = $this->carbon->now();
        $sms_form->ip_updated = request()->ip();
        $sms_form->user_updated = $this->auth->user()->user_id;
        $sms_form->save();

        return $sms_form;

    }





    public function destroy($sms_form){

        $sms_form->delete();
        return $sms_form;

    }





    public function findBySlug($slug){

        $sms_form = $this->cache->remember('sms_forms:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sms_form->where('slug', $slug)->first();
        }); 
        
        if(empty($sms_form)){
            abort(404);
        }

        return $sms_form;

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






    public function getSMSFormIdInc(){

        $id = 'SMSF10001';

        $sms_form = $this->sms_form->select('sms_form_id')->orderBy('sms_form_id', 'desc')->first();

        if($sms_form != null){

            if($sms_form->sms_form_id != null){
                $num = str_replace('SMSF', '', $sms_form->sms_form_id) + 1;
                $id = 'SMSF' . $num;
            }
        
        }
        
        return $id;
        
    }






}