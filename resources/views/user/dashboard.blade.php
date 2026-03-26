@extends('layouts.app')

@section('content')

<h2>📊 Performance Dashboard</h2>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:15px">

    @foreach($stats as $stat)
        <div style="background:#fff;padding:15px;border-radius:10px">
            <strong>{{ $stat->field->name }}</strong>
            <h3>{{ $stat->value }}</h3>
        </div>
    @endforeach

</div>

<hr>

<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let labels = [
    @foreach($stats as $stat)
        "{{ $stat->field->name }}",
    @endforeach
];

let data = [
    @foreach($stats as $stat)
        {{ $stat->value ?? 0 }},
    @endforeach
];

new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Performance',
            data: data
        }]
    }
});
</script>

@endsection