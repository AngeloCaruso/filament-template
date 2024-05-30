<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

abstract class BlogPostsChartTwo extends ChartWidget
{
    // protected static ?string $heading = 'Chart';
    protected static ?int $sort = 3;


   /* protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Publicaciones de blog creadas',
                    'data' => [45, 77, 89],
                    'backgroundColor' => '#AFDCF7',
                    'borderColor' => '#AFDCF7',
                ],
            ],
            'labels' => ['1', '2', '3'],
        ];
    }*/


    abstract protected function getType(): string;
    /*protected function getType(): string
    {
        return 'bar';
    }*/
}
