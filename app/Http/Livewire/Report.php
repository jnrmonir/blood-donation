<?php

namespace App\Http\Livewire;

use App\Models\Reports;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Report extends Component
{
    public $report;

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'report'=> 'required | min:3 | max:255',
        ]);
    }

    public function send(){
        $this->validate([
            'report' => 'required | min:3 | max:255'
        ]);

        if(Auth::check()){
            $report = new Reports();
            $report->user_id = Auth::id();
            $report->reports = $this->report;
            if($report->save()){
                session()->flash('status','Thank you for your Report');
            }else{
             session()->flash('wrong','Something Went To Wrong');
            }
         }else{
             session()->flash('wrong','Please Login Then Push your Availabe Report');
         }
    }
    public function render()
    {
        return view('livewire.report');
    }
}
