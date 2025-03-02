<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;

class Vehicles extends Component
{
    use WithPagination;

    public $search = '';
    public $filterType = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $page = 1;
    public $vehicles;
    public $vehicleType = "";
    public $sort = "desc";
    public $current = 1;
    public $last = 0;

    public function mount()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get('http://backend.test/api/vehicles');

        $this->vehicles = $response->json()["data"];
        $this->current = $response->json()["current_page"];
        $this->last = $response->json()["last_page"];
    }

    public function updatedSearch()
    {
        $this->updateData();
    }

    public function updatedVehicleType()
    {
        $this->updateData();
    }

    public function updatedSort()
    {
        $this->updateData();
    }

    public function updateData($page = null)
    {
        $params = [];

        if(($this->search != "")&&(!is_null($this->search)))
        {
            $params["search"] = $this->search;
        }

        if($this->vehicleType !="")
        {
            $params["type"] = $this->vehicleType;
        }

        $params["sort"] = $this->sort;

        if(is_null($page))
        {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get('http://backend.test/api/vehicles', $params);
        }
        else
        {
            $params["page"] = $page;

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get('http://backend.test/api/vehicles', $params);
        }

        $this->vehicles = $response->json()["data"];
        $this->current = $response->json()["current_page"];
        $this->last = $response->json()["last_page"];
    }

    public function previousPage()
    {
        if($this->current > 1)
        {
            $this->updateData(--$this->current);
        }
    }

    public function nextPage()
    {
        if($this->current < $this->last)
        {
            $this->updateData(++$this->current);
        }
    }

    public function render()
    {

        return view('livewire.vehicles')->layout('layouts.app');
    }
}

