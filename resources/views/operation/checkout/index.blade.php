@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
                <h3>Check-out para Reserva #{{ $reservation->id }}</h3>
                @foreach ($reservation->checkouts as $checklist)
                <div class="card mb-4">
                    <div class="card-header">{{ $checklist->step->string() }}</div>
                    <div class="card-body">
                        @if ($checklist->user_id)
                        {{ $checklist->status->string() }} por {{ $checklist->user->name }} em {{ $checklist->updated_at->format('d/m/Y H:i') }}
                        @else
                            <a href="{{ route('reservation-checkout.edit', ['reservation' => $checklist->reservation_id, 'id' => $checklist->getKey()]) }}" class="btn btn-primary">Iniciar</a>
                        @endif
                    </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('reservation-management') }}" class="btn btn-light m-0">Volta</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection