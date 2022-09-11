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
        <div class="col-md-9 mt-5" style="margin: 0 auto">
            <div class="mb-2" style="text-align: right">
            </div>
            @if(session()->has('deleted'))
                <div class="alert alert-success">
                    {{ session('deleted') }}
                </div>
            @endif
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
                            <i class="fas fa-trash" wire:click="customerIdForDestroy({{ $customer->id }})"
                               data-bs-toggle="modal" data-bs-target="#destroyCustomerModal"
                               style="cursor:pointer; color: #c50d0d"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                    @if(session()->has('update'))
                        <div class="alert alert-success">
                            {{ session('update') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="updateCustomer">
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                Ad:
                            </div>
                            <div class="col-md-9">
                                <input type="text" wire:model.lazy="full_name" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                E-mail:
                            </div>
                            <div class="col-md-9">
                                <input type="email" wire:model.lazy="email" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group mb-2">
                            <div class="col-md-3">
                                Doğum Tarihi:
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
                                <button type="submit" class="btn btn-primary mt-2">Güncelle</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Silme Onayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Kayıt silinecek. Onaylıyor musunuz?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>

                    <button type="button" wire:click.prevent="destroyCustomer()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Sil</button>
                </div>
            </div>
        </div>
    </div>

</div>

