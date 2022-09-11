<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Enums\StatusEnum;

class CustomerList extends Component
{
    public $status = null,
        $response, $message, $customer_id, $full_name, $password, $email, $birth_date;

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

    public function addCustomer(){
        $data = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'password' => $this->password,
            'birth_date' => $this->birth_date
        ];
        $this->message = postApiAddCustomer($data);

        session()->flash('created', $this->message );

        $this->resetInfo();
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
            'birth_date' => $this->birth_date
        ];

        $this->message = postApiUpdateCustomer($this->customer_id, $data);

        session()->flash('update', $this->message );

        $this->resetInfo();
    }

    public function customerIdAssign($id){
        $this->customer_id = $id;
    }

    public function destroyCustomer(){
        $this->message = destroyApiCustomer($this->customer_id);

        session()->flash('deleted', $this->message);
    }

    public function resetInfo(){
        $this->customer_id = $this->full_name = $this->email = $this->password = null;
    }

}
