<?php

namespace Arealtime\ExceptionLog\App\Http\Livewire;

use Arealtime\ExceptionLog\App\Models\ExceptionLog;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ExceptionLogComopnent extends Component
{
    use WithPagination;
    public string $message = '';


    public function search() {}

    public function clearSearch()
    {
        $this->message = '';
    }

    public function render()
    {
        $logs =  ExceptionLog::when($this->message, fn(Builder $builder, $value) => $builder->where('url', $value))->paginate();
        return view('exception-log::livewire.exception-log-component', compact('logs'));
    }
}
