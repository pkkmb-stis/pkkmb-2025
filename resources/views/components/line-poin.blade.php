<div>
    <canvas x-init='run_chart($el)'></canvas>
    <script>
        function run_chart(el){
                const data = JSON.parse(`<?= $attributes['list-poin'] ?>`);
                const akumulasi = {
                    label: 'Akumulasi Poin',
                    borderColor: 'rgba(52, 185, 166)',
                    data: data,
                };
                const footer = (tooltipItems) => {
                    const tooltipItem = tooltipItems[0];

                    const alasan = tooltipItem.raw.alasan;
                    const keterangan = tooltipItem.raw.keterangan;
                    const pertambahan = tooltipItem.raw.pertambahan;
                    const cadangan = tooltipItem.raw.cadangan;


                    const catatan = [];
                    if(alasan) catatan.push(`Diberikan karena ${alasan}`)
                    if(pertambahan){
                        if (pertambahan >= 0)
                            catatan.push(`Poin ini menambah akumulasi poin sebesar ${pertambahan}. `)
                        else
                            catatan.push(`Poin ini mengurangi poin akumulasi sebesar ${pertambahan * -1}. `)
                    }

                    if(keterangan) catatan.push(`${keterangan}. `)
                    if(cadangan) catatan.push(`Poin cadanganmu : ${cadangan}.`)

                    if(catatan)
                        return catatan;
                };

                var myChart = new Chart(el,{
                    type: 'line',
                    data: {
                        labels: data.map((value) => value.x),
                        datasets: [akumulasi]
                    },
                    options : {
                        responsive :true,
                        plugins: {
                            title: {
                                display: true,
                                text: `Akumulasi Poin`,
                                font: {
                                    size: 18
                                },
                                padding: {
                                    bottom: 15
                                }
                            },
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    beforeFooter : (tooltip) => {
                                        const data = tooltip[0].raw;

                                        const catatan = [];
                                        catatan.push(`${data.jenis} ${data.nama} : ${data.poin} poin`);

                                        if (data.time)
                                            catatan.push(`Diperoleh pada ${data.time}`);
                                        return catatan;
                                    },
                                    footer: footer,
                                    title: (tooltip) => tooltip[0].raw.title
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                            }
                        },
                    }
                });
        }
    </script>
</div>
