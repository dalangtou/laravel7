<?php

namespace App\Jobs;

use App\Models\Test;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AfterLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Test $test_model
     */
    protected $test_model;

    /**
     * @var array $data
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        Log::info('后置操作被执行1--'.date('H:i:s'));
        $this->test_model = new Test();
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('后置操作被执行2--'.date('H:i:s'));

        $this->data['status'] = Test::STATUS_YES;

        $this->test_model->fill($this->data);

        return $this->test_model->save();
    }

    public function failed($exception = null)
    {
        Log::debug('队列执行失败--', [$exception]);
    }
}
