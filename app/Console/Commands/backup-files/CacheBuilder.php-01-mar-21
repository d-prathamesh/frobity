<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Service;

class CacheBuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:builder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache Application data for categories, subcategories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $categories = Cache::rememberForever('categories', function() {
            return Service::where('parent_id',0)->get(['id','name','form','image_url']);
        });

        foreach($categories as $category){
            $id = $category->id;
            $subcategories = Cache::rememberForever('subcategories-'.$id, function() use($id) {
                return Service::with('subcategories')->where('id',$id)->where('parent_id',0)->get(['id','name','form','image_url']);
            });
        }
        
    }
}
