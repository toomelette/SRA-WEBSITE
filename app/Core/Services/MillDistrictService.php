<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\MillDistrictInterface;
use App\Core\BaseClasses\BaseService;


class MillDistrictService extends BaseService{


    protected $mill_district_repo;



    public function __construct(MillDistrictInterface $mill_district_repo){

        $this->mill_district_repo = $mill_district_repo;
        parent::__construct();

    }





    public function fetch($request){

        $mill_districts = $this->mill_district_repo->fetch($request);

        $request->flash();
        return view('dashboard.mill_district.index')->with('mill_districts', $mill_districts);

    }






    public function store($request){

        $mill_district = $this->mill_district_repo->store($request);
        
        $this->event->fire('mill_district.store');
        return redirect()->back();

    }






    public function edit($slug){

        $mill_district = $this->mill_district_repo->findbySlug($slug);
        return view('dashboard.mill_district.edit')->with('mill_district', $mill_district);

    }






    public function update($request, $slug){

        $mill_district = $this->mill_district_repo->update($request, $slug);

        $this->event->fire('mill_district.update', $mill_district);
        return redirect()->route('dashboard.mill_district.index');

    }






    public function destroy($slug){

        $mill_district = $this->mill_district_repo->destroy($slug);

        $this->event->fire('mill_district.destroy', $mill_district);
        return redirect()->back();

    }






}