<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SinhviensImport;
use Throwable;

class ImportsinhviensCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $sinhvienImport;

    /**
     * Create a new job instance.
     */
    public function __construct($path, $sinhvienImport)
    {
        $this->path = $path;
        $this->sinhvienImport = $sinhvienImport;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->sinhvienImport->update(['status' => 1]);
        
        Excel::import(new sinhviensImport, $this->path);

        $this->sinhvienImport->update(['status' => 2]);
    }

    public function fail(Throwable $exception)
    {
        $this->sinhvienImport->update(['status' => 3]);
    }
}
