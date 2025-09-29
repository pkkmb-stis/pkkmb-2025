<div class="mt-4">
    <canvas x-init="run{{$attributes['id'].'_canvas'}}()" id='{{$attributes['id']}}-canvas'></canvas>

    <p class="text-center mt-2 text-md">Banyak Poin Berdasarkan Kategori </p>

    @push('script-bottom')
    <script>
        function run{{$attributes['id'].'_canvas'}}() {
            var ctx_{{$attributes['id']}} = document.getElementById('{{$attributes['id']}}-canvas')
            var myChart_{{$attributes['id']}} = new Chart(ctx_{{$attributes['id']}}, {
                type: 'bar',
                data: {
                    labels: ['Bonus', 'Pelanggaran', 'Penebusan'],
                    datasets: [{
                        label: 'Banyak Poin',
                        data: [{{$attributes['bonus']}}, {{$attributes['pelanggaran']}},{{$attributes['penebusan']}}],
                        backgroundColor: [
                            'rgba(52, 185, 166, 0.2)',
                            'rgba(215, 49, 75, 0.2)',
                            'rgba(255, 210, 49, 0.2)',
                            'rgba(30, 41, 87, 0.2)',
                        ],
                        borderColor: [
                                'rgb(52, 185, 166)',
                                'rgb(215, 49, 75)',
                                'rgb(255, 210, 49)',
                                'rgb(30, 41, 87)',
                                ],
                        borderWidth : 1,
                        hoverOffset: 4,
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        }
    </script>
    @endpush
</div>
