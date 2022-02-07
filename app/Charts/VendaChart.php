<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class VendaChart
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        return $this->chart->donutChart()
            ->setTitle('Top 3 marcas vendidas.')
            ->setSubtitle('Ano 2021.')
            ->addData([30, 24, 20])
            ->setLabels(['Samsung', 'Apple', 'Xiaomi']);
    }
}
