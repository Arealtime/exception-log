<?php

namespace Arealtime\ExceptionLog\App\Http\Livewire;

use Arealtime\ExceptionLog\App\Models\ExceptionLog;
use Livewire\Component;
use Livewire\WithPagination;

class ExceptionLogComopnent extends Component
{
    use WithPagination;

    public string $message = '';

    public string $url = '';

    public function search() {}

    public function clearSearch()
    {
        $this->message = '';
        $this->url = '';
        $this->resetPage();
    }

    public function render()
    {
        $logs =  ExceptionLog::search(trim($this->message), trim($this->url))->paginate(10);
        return view('exception-log::livewire.index', compact('logs'));
    }
}
