<?php

namespace App\Jobs;

use App\Models\UploadFile;
use App\Services\UploadFile\LocalStorageDriver;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemoveUploadedFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    private $file;

    public function __construct(UploadFile $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $file = $this->file;
            if ($file->upload_file_type == null && $file->upload_file_id == null && $file->is_private) {
                if (resolve(LocalStorageDriver::class)->deleteFile($file)) {
                    $file->status = 0;
                    $file->save();
                }
            }
        } catch (\Exception $exception) {

        }
    }
}
