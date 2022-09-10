<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Enums\StatusEnum;

class CustomerList extends Component
{
    public $status = null,
        $response, $full_name, $email, $birth_date;

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

    public function getCustomerDetail($id){
        $res = getApiCustomer($id);
        $this->full_name = $res->data[0]->full_name;
        $this->email = $res->data[0]->email;
        $this->birth_date = Carbon::parse($res->data[0]->birth_date)->format('Y-m-d');
    }
}
