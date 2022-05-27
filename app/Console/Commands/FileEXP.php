<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Upload;

class FileEXP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete file uplaoded from user every 4 days';

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
     * @return int
     */
    public function handle()
    {

        if(env("DELETE_USER_FILES") == true){
            $del = Upload::where('status_id',0)->get();
        
            $now = date('Y-m-d');
            foreach($del as $d){
                if($d->delete_at == $now){
                    Upload::find($d->id)->delete();
                    unlink(PUBLIC_PATH('uploads/'.$d->file));
                    
                }
            }
        }
        
    }
}