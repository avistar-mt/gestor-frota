@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
                <h3>Check-in para Reserva #{{ $reservation->id }}</h3>
                @foreach ($reservation->checkins as $checklist)
                <div class="card mb-4">
                    <div class="card-header">{{ $checklist->step->string() }}</div>
                    <div class="card-body">
                        @if ($checklist->user_id)
                        {{ $checklist->status->string() }} por {{ $checklist->user->name }} em {{ $checklist->updated_at->format('d/m/Y H:i') }}
                        @else
                        <form action="{{ route('reservation-checkin.update', ['reservation' => $reservation->id, 'id' =>$checklist->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="btn-group w-100" role="group">
                                    <button type="submit" name="status" value="approved" class="btn btn-sm btn-success mb-0 w-50">Aprovado</button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger mb-0 w-50">Reprovado</button>
                                </div>
                            </div>
                            @error('step')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </form>
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