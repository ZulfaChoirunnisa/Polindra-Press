<?php
$bukus = App\Models\Buku::where('status', 'pending')->orderBy('id', 'desc')->limit(5)->get();
$bookYear = App\Models\Buku::selectRaw('YEAR(created_at) AS tahun, COUNT(*) AS jumlah')->where('status', 'accept')->where('publish', 'is_publish')->groupBy('tahun')->orderBy('tahun', 'asc')->limit(10)->get();
$jumlahBuku = [];
$tahunBuku = [];
foreach ($bookYear as $key => $value) {
    $jumlahBuku[$key] = $value->jumlah;
    $tahunBuku[$key] = $value->tahun;
}
$jumlah = implode(', ', $jumlahBuku);
$tahun = implode(', ', $tahunBuku);
?>

@extends('layouts.index')
@section('main-content')
    <h1 style="font-weight: bold; color: #012970; text-align: center;">Selamat Datang Admin</h1>
    <h1 style="font-weight: bold; color: #012970; text-align: center;">di Sistem Pengajuan Buku Polindra Press</h1>
    <p style="text-align: center; color: #012970;">Kami menghargai dedikasi Anda dalam mengelola dan memproses pengajuan
        buku.</p>
    <p style="text-align: center; color: #012970;">Mari bersama-sama meningkatkan kualitas literasi.</p>

    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Reports <span>/Today</span></h5>
        </div>

        <div class="card-body">

            <!-- Line Chart -->
            <div id="reportsChart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Jumlah Buku',
                            data: [{{ $jumlah }}],
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            type: 'year',
                            categories: [{{ $tahun }}]
                        },
                        tooltip: {
                            x: {
                                format: 'Y'
                            },
                        }
                    }).render();
                });
            </script>
            <!-- End Line Chart -->

        </div>

    </div>
@endsection
