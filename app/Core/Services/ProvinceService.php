<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\ProvinceInterface;
use App\Core\BaseClasses\BaseService;


class ProvinceService extends BaseService{


    protected $province_repo;



    public function __construct(ProvinceInterface $province_repo){

        $this->province_repo = $province_repo;
        parent::__construct();

    }





    public function fetch($request){

        $provinces = $this->province_repo->fetch($request);

        $request->flash();
        return view('dashboard.province.index')->with('provinces', $provinces);

    }






    public function store($request){

        $province = $this->province_repo->store($request);
        
        $this->event->fire('province.store');
        return redirect()->back();

    }






    public function edit($slug){

        $province = $this->province_repo->findbySlug($slug);
        return view('dashboard.province.edit')->with('province', $province);

    }






    public function update($request, $slug){

        $province = $this->province_repo->update($request, $slug);

        $this->event->fire('province.update', $province);
        return redirect()->route('dashboard.province.index');

    }






    public function destroy($slug){

        $province = $this->province_repo->destroy($slug);

        $this->event->fire('province.destroy', $province);
        return redirect()->back();

    }






}