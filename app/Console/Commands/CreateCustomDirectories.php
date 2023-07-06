<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateCustomDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    const DIRECTORY_PATH = [
    'app/public/category' => 'category',
    'app/public/course/images' => 'course/images',
    'app/public/course/thumbnail_images' => 'course/thumbnail_images',
    'app/public/unit/media' => 'unit/media',
    'app/public/unit/thumbnail_images' => 'unit/thumbnail_images',
    'app/public/unit/attachments' => 'unit/attachments',
    'app/public/blog' => 'blog',
    'app/public/banner' => 'banner',
    'app/public/logos' => 'logos',
    'app/public/users' => 'users',
    'app/public/widgets' => 'widgets',
    'app/public/webinar' => 'webinar',
];

    protected $signature = 'create:uploadable_directories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create the directories needed in the application and also create the symbolic link between storage and public/storage directory';

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
        # CREATE FOLDER PUBLIC
        foreach (self::DIRECTORY_PATH as $key => $path) {
            if (!File::isDirectory(storage_path($key))) {
                Storage::disk('public')->makeDirectory($path);
            }
        }
    }
}
