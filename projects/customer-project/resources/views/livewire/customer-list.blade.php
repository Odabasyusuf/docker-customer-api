<div>
    <div class="row mt-4">
        <div style="text-align: center;">
            <button type="button" class="btn btn-sm btn-dark" wire:click="statusChange('{{ \App\Enums\StatusEnum::NULL }}')"><i class="fas fa-user-check"></i>   {{ __('customer.all') }}</button>
            <button type="button" class="btn btn-sm btn-success" wire:click="statusChange('{{ \App\Enums\StatusEnum::ACTIVE }}')"><i class="fas fa-user-check"></i>   {{ __('customer.active') }}</button>
            <button type="button" class="btn btn-sm btn-danger" wire:click="statusChange('{{ \App\Enums\StatusEnum::PASSIVE }}')"><i class="fas fa-ban"></i>   {{ __('customer.active') }}</button>
        </div>
        <div style="position: fixed; top: 58px; left: 45%;">
            <div wire:loading class="spinner-border mt-2" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="col-md-9 mt-5" style="margin: 0 auto">
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
                <tbody>
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
                            <i class="fas fa-pen" style="color: cornflowerblue"></i>  
                            <i class="fas fa-trash" style="color: #c50d0d"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
