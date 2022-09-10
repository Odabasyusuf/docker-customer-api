<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Enums\StatusEnum;

class CustomerList extends Component
{
    protected $status = null;

    public function render(){
        $response = getAPIData('customers', $this->status); // Veriler Helpers/ApiSelfHelper.php'den çekildi.

        return view('livewire.customer-list', [
            'message' => $response->message,
            'customers' => $response->data
        ]);
    }

    public function statusChange($status){
        $this->status = $status;
    }
}
