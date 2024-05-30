<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

 abstract class BlogPostsChart extends ChartWidget
{
    // protected static ?string $heading = 'Chart';
    protected static ?int $sort = 3;

   /* protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Publicaciones de blog creadas',
                    'data' => [0, 10, 5, 2, 21, 32, 45],
                    'backgroundColor' => '#AFDCF7',
                    'borderColor' => '#AFDCF7',
                ],
            ],
            'labels' => ['1', '2', '3', '4', '5', '6', '7'],
        ];
    }*/

    abstract protected function getType(): string;
    /*protected function getType(): string
    {
        return 'line';
    }*/
}
