<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\OfficeInterface;
use App\Core\BaseClasses\BaseService;


class OfficeService extends BaseService{


    protected $office_repo;



    public function __construct(OfficeInterface $office_repo){

        $this->office_repo = $office_repo;
        parent::__construct();

    }





    public function fetch($request){

        $offices = $this->office_repo->fetch($request);

        $request->flash();
        return view('dashboard.office.index')->with('offices', $offices);

    }






    public function store($request){

        $office = $this->office_repo->store($request);
        
        $this->event->fire('office.store');
        return redirect()->back();

    }






    public function edit($slug){

        $office = $this->office_repo->findbySlug($slug);
        return view('dashboard.office.edit')->with('office', $office);

    }






    public function update($request, $slug){

        $office = $this->office_repo->update($request, $slug);

        $this->event->fire('office.update', $office);
        return redirect()->route('dashboard.office.index');

    }






    public function destroy($slug){

        $office = $this->office_repo->destroy($slug);

        $this->event->fire('office.destroy', $office);
        return redirect()->back();

    }







}