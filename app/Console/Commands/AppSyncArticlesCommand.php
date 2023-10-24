<?php
namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use App\Services\ArticleSyncService;

class AppSyncArticlesCommand extends Command
{
    protected $signature = 'app:sync-articles {id?} {--refresh : Clear the Article table before syncing}';
    protected $description = 'Sync articles from articles service';

    private ArticleSyncService $syncService;

    public function __construct(ArticleSyncService $syncService)
    {
        parent::__construct();
        $this->syncService = $syncService;
    }

    public function handle(): void
    {
        $id = $this->argument('id');

        if ($this->option('refresh')) {
            Article::truncate();
            $this->info('Article table cleared.');
        }

         if($id) {
             $this->syncService->syncSingleArticle($id);
             $this->info("id:".$id." has been synchronized.");
         }else{
             $importedIds = $this->syncService->syncAllArticles();
             $count = count($importedIds);
             $this->info("All ({$count}) articles have been synchronized.");
         }
    }
}
