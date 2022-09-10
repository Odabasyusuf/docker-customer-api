@extends('layouts.master')

@section('title', "Customer List")

@section('content')

    <div class="row mt-4">
        <div style="text-align: center;">
            <a href="{{ request()->url() }}" class="btn btn-sm btn-dark"> <i class="fas fa-list"></i>   {{ __('customer.all') }} </a>
            <a href="?status={{ \App\Enums\StatusEnum::ACTIVE }}" class="btn btn-sm btn-success"> <i class="fas fa-user-check"></i>   {{ __('customer.active') }} </a>
            <a href="?status={{ \App\Enums\StatusEnum::PASSIVE }}" class="btn btn-sm btn-danger"> <i class="fas fa-ban"></i>   {{ __('customer.passive') }} </a>
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

@endsection
