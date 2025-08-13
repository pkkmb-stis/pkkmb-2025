<div>
    <canvas x-init="run{{$attributes['id'].'_canvas'}}()" id='{{$attributes['id']}}-canvas'></canvas>

    <p class="text-center mt-4 text-sm">Akumulasi Poin: <b>{{$attributes['poin']}}</b></p>
    <p class="text-center text-sm">Poin Cadangan: <b>{{$attributes['poin-cadangan']}}</b></p>

    {{-- @push('script-bottom') --}}
    <script>
        function run{{$attributes['id'].'_canvas'}}(){
            var ctx_{{$attributes['id']}} = document.getElementById('{{$attributes['id']}}-canvas')
            var myChart_{{$attributes['id']}} = new Chart(ctx_{{$attributes['id']}}, {
                type: 'doughnut',
                data: {
                    labels: ['Akumulasi Poin', 'Menuju Maksimal'],
                    datasets: [{
                        label: '# of Votes',
                        data: [ {{ $attributes['poin'] }}, {{(int)$attributes['poin-max'] - (int)$attributes['poin'] }}],
                        backgroundColor: [
                            "{{$attributes['backgroundColor'] ?? 'rgba(52, 185, 166, 0.5)' }}",
                            'rgba(255, 255, 255, 0.2)',
                        ],
                        borderColor: 'rgba(52, 185, 166)',
                        borderWidth : 1.5,
                        hoverOffset: 4,
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        }
    </script>
    {{-- @endpush --}}
</div>
