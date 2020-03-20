<?php
 
namespace App\Core\Services\Guest;

use App\Core\Interfaces\NewsInterface;
use App\Core\BaseClasses\BaseService;



class NewsService extends BaseService{
	


    protected $news_repo;



	public function __construct(NewsInterface $news_repo){

        $this->news_repo = $news_repo;
        parent::__construct();

    }









    public function viewFile($slug){

        $news = $this->news_repo->findBySlug($slug);

        if(!empty($news->file_location)){

            $path = $this->__static->archive_dir() .'/'. $news->file_location;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return "Cannot Detect File!";
        

    }







    public function viewImg($slug){

        $news = $this->news_repo->findBySlug($slug);

        if(!empty($news->file_location)){

            $path = $this->__static->archive_dir() .'/'. $news->img_location;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return "Cannot Detect File!";
        

    }






}