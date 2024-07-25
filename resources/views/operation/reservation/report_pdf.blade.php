<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Reservas</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Reservas</h1>
    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>Data Inicio Reserva</th>
            <th>Data Fim Reserva</th>
            <th>Placa</th>
            <th>Motorista'</th>
            <th>Filial</th>
            <th>Status</th>
            <th>Motivo</th>
            <th>Data Criação</th>
            <th>Data Atualização</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->reservation_star }}</td>
                <td>{{ $reservation->reservation_end }}</td>
                <td>{{ $reservation->vehicle->plate }}</td>
                <td>{{ $reservation->driver->name }}</td>
                <td>{{ $reservation->branch->name }}</td>
                <td>{{ $reservation->status }}</td>
                <td>{{ $reservation->motive }}</td>
                <td>{{ $reservation->created_at }}</td>
                <td>{{ $reservation->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
