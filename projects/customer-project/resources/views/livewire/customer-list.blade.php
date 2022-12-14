<div>
    <div class="row mt-4">
        <div style="text-align: center;">
            <button type="button" class="btn btn-sm btn-dark"
                    wire:click="statusChange('{{ \App\Enums\StatusEnum::NULL }}')"><i class="fas fa-user-check"></i>
                  {{ __('customer.all') }}</button>
            <button type="button" class="btn btn-sm btn-success"
                    wire:click="statusChange('{{ \App\Enums\StatusEnum::ACTIVE }}')"><i class="fas fa-user-check"></i>
                  {{ __('customer.active') }}</button>
            <button type="button" class="btn btn-sm btn-danger"
                    wire:click="statusChange('{{ \App\Enums\StatusEnum::PASSIVE }}')"><i class="fas fa-ban"></i>
                  {{ __('customer.passive') }}</button>
        </div>
        <div style="position: fixed; top: 58px; left: 45%;">
            <div wire:loading class="spinner-border mt-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="col-md-9 mt-3" style="margin: 0 auto">
            <div class="mb-2" style="text-align: right">
                <button type="button" class="btn btn-sm btn-success"
                        wire:click="resetInfo()"
                        data-bs-toggle="modal" data-bs-target="#customerAddModal">
                    <i class="fas fa-plus"></i>  {{ __('customer.add_customer') }}</button>
            </div>
            @include('layouts.message')
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('customer.full_name') }}</th>
                    <th scope="col">{{ __('customer.email') }}</th>
                    <th scope="col">{{ __('customer.birth_date') }}</th>
                    <th scope="col">{{ __('customer.status') }}</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody wire:loading.class="loading-opacity">
                @foreach($customers as $customer)
                    <tr>
                        <th scope="row">{{ $customer->id }}</th>
                        <td>{{ $customer->full_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ dateTouch($customer->birth_date)  }}</td>
                        <td style="text-align: center;">
                            @if($customer->deleted_at)
                                {!! __('customer.status-badge.passive') !!}
                            @else
                                {!! __('customer.status-badge.active') !!}
                            @endif
                        </td>
                        <td>
                            <i class="fas fa-pen" wire:click="getCustomerDetail({{ $customer->id }})"
                               data-bs-toggle="modal" data-bs-target="#updateCustomerModal"
                               style="cursor:pointer;color: cornflowerblue"></i>  
                            <i class="fas fa-trash" wire:click="customerIdAssign({{ $customer->id }})"
                               data-bs-toggle="modal" data-bs-target="#destroyCustomerModal"
                               style="cursor:pointer; color: #c50d0d"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="customerAddModal" aria-labelledby="customerAddModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('customer.add_customer') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="addCustomer">
                        @if(session()->has('created'))
                            <div class="alert alert-success">
                                {{ session('created') }}
                            </div>
                        @endif

                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.full_name') }}
                            </div>
                            <div class="col-md-9">
                                <input type="text" wire:model.lazy="full_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.email') }}
                            </div>
                            <div class="col-md-9">
                                <input type="email" wire:model.lazy="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.password') }}
                            </div>
                            <div class="col-md-9">
                                <input type="password" wire:model.lazy="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.birth_date') }}
                            </div>
                            <div class="col-md-9">
                                <input type="date" wire:model.lazy="birth_date" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                <button type="submit" class="btn btn-primary mt-2"> {{ __('customer.save') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="updateCustomerModal" aria-labelledby="updateCustomerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $full_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" wire:loading.class="loading-opacity">
                    <form wire:submit.prevent="updateCustomer">
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.full_name') }}
                            </div>
                            <div class="col-md-9">
                                <input type="text" wire:model.lazy="full_name" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.email') }}
                            </div>
                            <div class="col-md-9">
                                <input type="email" wire:model.lazy="email" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                {{ __('customer.birth_date') }}
                            </div>
                            <div class="col-md-9">
                                <input type="date" wire:model.lazy="birth_date" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div wire:loading class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="col-md-9" style="text-align: right">
                                <button type="submit" class="btn btn-primary mt-2" data-bs-dismiss="modal"> {{ __('customer.update') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="modal fade" id="destroyCustomerModal" aria-labelledby="destroyCustomerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('customer.delete_title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p> {{ __('customer.delete_text') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('customer.cancel') }}</button>

                    <button type="button" wire:click.prevent="destroyCustomer()" class="btn btn-danger close-modal" data-bs-dismiss="modal">
                        {{ __('customer.delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

