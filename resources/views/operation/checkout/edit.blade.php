@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto">
            <div class="card card-body mt-4">
                <h3>Check-out para Reserva #{{ $checkout->reservation->getKey() }}</h3>
                <div class="alert alert-warning">
                    <h4>Tira uma foto do <strong>{{ $checkout->step->string() }}</strong>. A PLACA DEVE APARECER NA FOTO</h4>
                </div>
                <form enctype="multipart/form-data" action="{{ route('reservation-checkout.update', ['reservation' => $checkout->reservation->getKey(), 'id' => $checkout->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Selecionar Foto</label>
                        <input type="file" class="form-control" capture="enviroment" name="image">
                    </div>

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

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('reservation-checkout', $checkout->reservation_id) }}" class="btn btn-light m-0">Volta</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection