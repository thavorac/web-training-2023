<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PromotionController;

class UpdatePromotionStatuses extends Command
{
    protected $signature = 'promotion:update-statuses';
    protected $description = 'Update promotion statuses based on the current date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Create an instance of PromotionController and call updatePromotionStatuses
        $promotionController = new PromotionController();
        $promotionController->updatePromotionStatuses();

        $this->info('Promotion statuses updated successfully.');
    }
}
