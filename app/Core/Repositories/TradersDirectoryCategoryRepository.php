<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\TradersDirectoryCategoryInterface;


use App\Models\TradersDirectoryCategory;


class TradersDirectoryCategoryRepository extends BaseRepository implements TradersDirectoryCategoryInterface {
	



    protected $traders_dir_cat;




	public function __construct(TradersDirectoryCategory $traders_dir_cat){

        $this->traders_dir_cat = $traders_dir_cat;
        parent::__construct();

    }





    public function getAll(){

        $traders_dir_cats = $this->cache->remember('traders_directory_categories:getAll', 240, function(){
            return $this->traders_dir_cat->select('traders_dir_cat_id', 'name')
                                         ->with('tradersDirectory')
                                         ->orderBy('seq_no', 'asc')->get();
        });
        
        return $traders_dir_cats;

    }




}