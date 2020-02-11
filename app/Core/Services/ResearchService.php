<?php
 
namespace App\Core\Services;

use App\Core\Interfaces\ResearchInterface;
use App\Core\BaseClasses\BaseService;


class ResearchService extends BaseService{


    protected $research_repo;



    public function __construct(ResearchInterface $research_repo){

        $this->research_repo = $research_repo;
        parent::__construct();

    }





    public function fetch($request){

        $researches = $this->research_repo->fetch($request);

        $request->flash();
        return view('dashboard.research.index')->with('researches', $researches);

    }






    public function store($request){

        $research = $this->research_repo->store($request);
        
        $this->event->fire('research.store');
        return redirect()->back();

    }






    public function edit($slug){

        $research = $this->research_repo->findbySlug($slug);
        return view('dashboard.research.edit')->with('research', $research);

    }






    public function show($slug){

        $research = $this->research_repo->findbySlug($slug);
        return view('dashboard.research.show')->with('research', $research);

    }






    public function update($request, $slug){

        $research = $this->research_repo->update($request, $slug);

        $this->event->fire('research.update', $research);
        return redirect()->route('dashboard.research.index');

    }






    public function destroy($slug){

        $research = $this->research_repo->destroy($slug);

        $this->event->fire('research.destroy', $research);
        return redirect()->back();

    }






}