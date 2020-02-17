<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\SIDAProgramCategoryInterface;
use App\Core\BaseClasses\BaseService;


class SIDAProgramCategoryService extends BaseService{


    protected $sida_program_category_repo;



    public function __construct(SIDAProgramCategoryInterface $sida_program_category_repo){

        $this->sida_program_category_repo = $sida_program_category_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sida_program_categories = $this->sida_program_category_repo->fetch($request);

        $request->flash();
        return view('dashboard.sida_program_category.index')->with('sida_program_categories', $sida_program_categories);

    }






    public function store($request){

        $sida_program_category = $this->sida_program_category_repo->store($request);
        
        $this->event->fire('sida_program_category.store');
        return redirect()->back();

    }






    public function edit($slug){

        $sida_program_category = $this->sida_program_category_repo->findbySlug($slug);
        return view('dashboard.sida_program_category.edit')->with('sida_program_category', $sida_program_category);

    }






    public function update($request, $slug){

        $sida_program_category = $this->sida_program_category_repo->update($request, $slug);

        $this->event->fire('sida_program_category.update', $sida_program_category);
        return redirect()->route('dashboard.sida_program_category.index');

    }






    public function destroy($slug){

        $sida_program_category = $this->sida_program_category_repo->destroy($slug);

        $this->event->fire('sida_program_category.destroy', $sida_program_category);
        return redirect()->back();

    }






}