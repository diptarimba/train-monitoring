@extends('layouts.page')

@section('tab-title', 'Water Level Chart')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Water Level Chart"
        href="{{ route('train.wagon.water.chart', ['train' => $train->id, 'wagon' => $wagon->id]) }}" current="index" />
    <x-back route="{{ route('train.wagon.water.index', ['train' => $train->id, 'wagon' => $wagon->id]) }}" />
    <x-cards.fullpage>
        <x-slot name="header">
            <div class="flex-grow-1">
                <x-cards.header title="Water Level Chart of {{ $wagon->name }} on {{ $train->name }}" />
            </div>
            <div class="flex-grow-2">
                <input type="text" class="form-control" name="daterange" value="01/01/2023 - 01/31/2023" />
            </div>
        </x-slot>
        <x-slot name="body">
            <button class="btn btn-primary mb-2" onclick="exportChart()">Export to PDF</button>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </x-slot>
    </x-cards.fullpage>
@endsection

@section('footer-custom')
    <script>
        // mengambil URL saat ini
        let currentUrl = window.location.search;

        // membuat objek URLSearchParams dari URL saat ini
        var searchParams = new URLSearchParams(currentUrl);

        $(function() {
            $('input[name="daterange"]').daterangepicker({
                    opens: 'left', // position of calendar popup
                    startDate: searchParams.get('start_date') ?? moment().startOf(
                        'month'), // initial start date
                    endDate: searchParams.get('end_date') ?? moment().endOf('month'), // initial end date
                    locale: {
                        format: 'YYYY-MM-DD' // date format
                    }
                },
                function(start, end, label) {
                    // menambahkan query string baru pada objek URLSearchParams
                    searchParams.set('start_date', start.format('YYYY-MM-DD'));
                    searchParams.set('end_date', end.format('YYYY-MM-DD'));

                    // melakukan redirect ke URL yang baru
                    window.location.search = searchParams.toString();
                });
        });
    </script>
    <script>
        var data = JSON.parse('{!! $data !!}');
        var labels = data['labels'];
        var values = data['value'];

        var ctx = document.getElementById('myChart').getContext('2d');

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Water Level',
                    data: values,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            beginAtZero: true
                        },
                        title: {
                            display: true,
                            text: 'Liter'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Periode'
                        }
                    }
                },
                plugins: {
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'xy'
                        }
                    }
                }
            }
        });

        function exportChart() {
            var canvas = document.getElementById('myChart');
            var title = 'Water Level Chart of {{ $wagon->name }} on {{ $train->name }}';
            var subtitle = 'Periode: ';
            var save = ''
            var systemFormatDate = "YYYY-MM-DD";
            var humanFormatDate = "DD MMMM YYYY";

            var startDate = searchParams.get('start_date');
            var endDate = searchParams.get('end_date');

            var dateFormat = startDate && endDate ?
                moment(startDate, systemFormatDate).format(humanFormatDate) + ' - ' + moment(endDate, systemFormatDate)
                .format(humanFormatDate) :
                moment().startOf('month').format(humanFormatDate) + ' - ' + moment().endOf('month').format(humanFormatDate);

            subtitle += dateFormat
            save += dateFormat

            var imgData;
            html2canvas(canvas).then(function(canvas) {
                var imgWidth = 210;
                var pageHeight = 297;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;
                var position = 0;
                var doc = new jspdf.jsPDF('p', 'mm');
                doc.setFontSize(16);
                doc.text(title, 10, 10);
                doc.setFontSize(12);
                doc.text(subtitle, 10, 18);
                imgData = canvas.toDataURL('image/png');
                var margin = 10;
                var chartDim = {
                    x: margin,
                    y: 30,
                    width: imgWidth - margin * 2,
                    height: imgHeight - margin * 2
                };
                doc.setLineWidth(0.5);
                doc.rect(chartDim.x, chartDim.y, chartDim.width, chartDim.height, 'S');
                doc.addImage(imgData, 'PNG', chartDim.x, chartDim.y, chartDim.width, chartDim.height);
                heightLeft -= pageHeight;
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position + 25, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                doc.save('WL {{ $train->name }} ' + save + '.pdf');
            });
        }
    </script>

@endsection
