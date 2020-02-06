<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\NewsInterface;
use App\Core\BaseClasses\BaseService;


class NewsService extends BaseService{


    protected $news_repo;



    public function __construct(NewsInterface $news_repo){

        $this->news_repo = $news_repo;
        parent::__construct();

    }





    public function fetch($request){

        $news = $this->news_repo->fetch($request);

        $request->flash();
        return view('dashboard.news.index')->with('news', $news);

    }






    public function store($request){

        $file_location = "";

        if ($request->type == "FILE") {

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NEWS';

            if(!is_null($request->file('doc_file'))){
                $request->file('doc_file')->storeAs($dir, $filename);
            }
            
            $file_location = $dir .'/'. $filename;
        
        }

        $news = $this->news_repo->store($request, $file_location);
        
        $this->event->fire('news.store');
        return redirect()->back();

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

        return "Cannot Detect File!";;
        

    }






    public function edit($slug){

        $news = $this->news_repo->findbySlug($slug);
        return view('dashboard.news.edit')->with('news', $news);

    }






    public function show($slug){

        $news = $this->news_repo->findbySlug($slug);
        return view('dashboard.news.show')->with('news', $news);

    }






    public function update($request, $slug){

        $news = $this->news_repo->findbySlug($slug);

        $file_location = "";
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NEWS';

        $old_file_location = $news->file_location;
        $new_file_location = $dir .'/'. $new_filename;


        if ($request->type == "FILE") {

            // if doc_file has value
            if(!is_null($request->file('doc_file'))){

                if ($this->storage->disk('local')->exists($old_file_location)) {
                    $this->storage->disk('local')->delete($old_file_location);
                }
                
                $request->file('doc_file')->storeAs($dir, $new_filename);
                $file_location = $new_file_location;

            // if title has change
            }elseif($request->title != $news->title && $this->storage->disk('local')->exists($old_file_location)){
                $this->storage->disk('local')->move($old_file_location, $new_file_location);
                $file_location = $new_file_location;
            }
            
        }elseif($request->type == "URL"){

            if(isset($news->file_location)){

                if ($this->storage->disk('local')->exists($old_file_location)) {
                    $this->storage->disk('local')->delete($old_file_location);
                }

            }

        }

        $news = $this->news_repo->update($request, $file_location, $news);

        $this->event->fire('news.update', $news);
        return redirect()->route('dashboard.news.index');

    }






    public function destroy($slug){

        $news = $this->news_repo->findbySlug($slug);

        if(!is_null($news->file_location)){

            if ($this->storage->disk('local')->exists($news->file_location)) {
                $this->storage->disk('local')->delete($news->file_location);
            }

        }

        $news = $this->news_repo->destroy($news);

        $this->event->fire('news.destroy', $news);
        return redirect()->back();

    }






}