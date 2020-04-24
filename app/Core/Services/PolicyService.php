<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\PolicyInterface;
use App\Core\BaseClasses\BaseService;


class PolicyService extends BaseService{


    protected $policy_repo;



    public function __construct(PolicyInterface $policy_repo){

        $this->policy_repo = $policy_repo;
        parent::__construct();

    }





    public function fetch($request){

        $policies = $this->policy_repo->fetch($request);

        $request->flash();
        return view('dashboard.policy.index')->with('policies', $policies);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/POLICY';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $policy = $this->policy_repo->store($request, $file_location);
        
        $this->event->fire('policy.store', $policy);
        return redirect()->back();
    }







    public function viewFile($slug){

        $policy = $this->policy_repo->findBySlug($slug);

        if(!empty($policy->file_location)){

            $path = $this->__static->archive_dir() .'/'. $policy->file_location;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return "Cannot Detect File!";;
        

    }






    public function edit($slug){

        $policy = $this->policy_repo->findbySlug($slug);
        return view('dashboard.policy.edit')->with('policy', $policy);

    }







    public function update($request, $slug){

        $policy = $this->policy_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/POLICY';

        $old_file_location = $policy->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;

        // if title has change
        }elseif($request->title != $policy->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $policy = $this->policy_repo->update($request, $file_location, $policy);

        $this->event->fire('policy.update', $policy);
        return redirect()->route('dashboard.policy.index');

    }






    public function destroy($slug){

        $policy = $this->policy_repo->findbySlug($slug);

        if(!is_null($policy->file_location)){

            if ($this->storage->disk('local')->exists($policy->file_location)) {
                $this->storage->disk('local')->delete($policy->file_location);
            }

        }

        $policy = $this->policy_repo->destroy($policy);

        $this->event->fire('policy.destroy', $policy);
        return redirect()->back();

    }






}