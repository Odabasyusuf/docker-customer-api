<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Enums\StatusEnum;

class CustomerList extends Component
{
    public $status = null,
        $response, $message, $customer_id, $full_name, $email, $birth_date;

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
        $this->customer_id = $res->data[0]->id;
        $this->full_name = $res->data[0]->full_name;
        $this->email = $res->data[0]->email;
        $this->birth_date = datePickerReadableDate($res->data[0]->birth_date);
    }

    public function updateCustomer(){
        $data = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'birth_date' => $this->birth_date,
        ];

        $this->message = postApiUpdateCustomer($this->customer_id, $data);

        session()->flash('update', $this->message );
    }
}
