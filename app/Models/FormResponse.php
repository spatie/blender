<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Referer\Referer;

class FormResponse extends Model
{
    protected $guarded = ['id'];

    public static function boot()
    {
        static::creating(function (FormResponse $formResponse) {
            $formResponse->referer = app(Referer::class)->get();
        });
    }

    public static function downloadAll()
    {
        Excel::create('Responses '.date('Y-m-d'), function ($excel) {
            $excel->sheet('Responses', function ($sheet) {
                $sheet->freezeFirstRow();

                $sheet->cells('A1:Z1', function ($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setBorder('node', 'none', 'solid', 'none');
                });

                $sheet->fromModel(self::all());
            });
        })->download('xlsx');
    }
}
