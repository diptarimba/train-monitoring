@if (isset($needrange))
    @push('footer-carrier')
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
            optionDatatables = {
                dom: 'lBftrip',
                buttons: [{
                        extend: 'excel',
                        className: 'btn btn-outline-primary',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-outline-primary buttons-pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        customize: function(doc) {
                            // Set the page margins
                            doc.pageMargins = [40, 60, 40, 60];

                            // Set the default font size
                            doc.defaultStyle.fontSize = 10;

                            // mengambil URL saat ini
                            let currentUrl = window.location.search;

                            // membuat objek URLSearchParams dari URL saat ini
                            var searchParams = new URLSearchParams(currentUrl);

                            var dateSubTitle = '';
                            var systemFormatDate = "YYYY-MM-DD";
                            var humanFormatDate = "DD MMMM YYYY";

                            // Set judul dokumen PDF
                            var rawTitlePage = document.title.split("|")
                            var startDate = searchParams.get('start_date');
                            var endDate = searchParams.get('end_date');
                            if (startDate && endDate) {
                                dateSubTitle = 'Periode: ' + moment(startDate, systemFormatDate).format(
                                        humanFormatDate) +
                                    ' - ' + moment(endDate, systemFormatDate).format(humanFormatDate)
                            } else {
                                dateSubTitle = 'Periode: ' + moment().startOf('month').format(humanFormatDate) +
                                    ' - ' +
                                    moment().endOf('month').format(humanFormatDate)
                            }

                            doc.content[0].text = '{{ $titlepage }}'
                            doc.content.splice(1, 0, {
                                text: dateSubTitle,
                                alignment: 'center',
                                margin: [0, 0, 0, 15]
                            });

                            // Set the table layout to center
                            doc.content[2].layout = {
                                hLineWidth: function(i, node) {
                                    return 0.5;
                                },
                                vLineWidth: function(i, node) {
                                    return 0.5;
                                },
                                hLineColor: function(i, node) {
                                    return '#aaa';
                                },
                                vLineColor: function(i, node) {
                                    return '#aaa';
                                },
                                fillColor: function(i, node) {
                                    return (i % 2 === 0) ? '#eee' : '#fff';
                                },
                                paddingLeft: function(i, node) {
                                    return 10;
                                },
                                paddingRight: function(i, node) {
                                    return 10;
                                },
                                paddingTop: function(i, node) {
                                    return 5;
                                },
                                paddingBottom: function(i, node) {
                                    return 5;
                                },
                                fillColor: '#fff',
                                alignment: 'center'
                            }

                        }
                    },
                    // {
                    //     extend: 'print',
                    //     className: 'btn btn-outline-primary'
                    // }
                ],
                pagingType: 'full_numbers',
                // pageLength: 10, //pagelength,
                lengthMenu: [
                    [10, 25, 50, 100, 250, -1],
                    [10, 25, 50, 100, 250, "All"]
                ],
                processing: true,
                serverSide: true,
                searching: true,
            }
        </script>
    @endpush
@else
    @push('footer-carrier')
        <script>
            // mengambil URL saat ini
            let currentUrl = window.location.search;

            // membuat objek URLSearchParams dari URL saat ini
            var searchParams = new URLSearchParams(currentUrl);
            optionDatatables = {
                processing: true,
                serverSide: true,
                searching: true,
            }
        </script>
    @endpush
@endif
