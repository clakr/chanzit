<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('index');
});

Route::prefix('questions')->name('questions.')->group(function () {
    Route::post('three', function (Request $request) {

        // TODO

        $result = '';
        $n = $request->input('question');

        if (is_int((int) $n)) {
            $words  = [];

            $onesDict = [
                '1' => 'one',
                '2' => 'two',
                '3' => 'three',
                '4' => 'four',
                '5' => 'five',
                '6' => 'six',
                '7' => 'seven',
                '8' => 'eight',
                '9' => 'nine',
                '10' => 'ten',
                '11' => 'eleven',
                '12' => 'twelve',
                '13' => 'thirteen',
                '14' => 'fourteen',
                '15' => 'fifteen',
                '16' => 'sixteen',
                '17' => 'seventeen',
                '18' => 'eighteen',
                '19' => 'nineteen',
            ];

            $tensDict = [
                '1' => 'ten',
                '2' => 'twenty',
                '3' => 'thirty',
                '4' => 'forty',
                '5' => 'fifty',
                '6' => 'sixty',
                '7' => 'seventy',
                '8' => 'eighty',
                '9' => 'ninety',
                '10' => 'hundred',
            ];

            $thousandsDict = [
                '1' => 'thousand',
                '2' => 'million',
                '3' => 'billion',
            ];

            $n_length = strlen($n);
            $levels = (int)(($n_length + 2) / 3);
            $max_length = $levels * 3;
            $n = str_pad($n, $max_length, "00", STR_PAD_LEFT);
            $n_levels = str_split($n, 3);

            foreach ($n_levels as $n_part) {
                $levels--;

                $hundreds = (int) ($n_part / 100);
                $hundreds = $hundreds ? "{$onesDict[$hundreds]} hundred " : '';

                $tens = (int) ($n_part % 100);

                $singles = '';

                if ($tens < 20) {
                    $tens = (int)$tens ? $onesDict[$tens] : 'zero';
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = $hundreds != '' ? "and {$tensDict[$tens]}" : $tensDict[$tens];

                    $singles = (int) ($n_part % 10);
                    $singles = $singles ? " {$onesDict[$singles]}" : '';
                }
                if ("{$hundreds}{$tens}{$singles}" != '') {
                    $words[] = "{$hundreds}{$tens}{$singles}" . ($levels ? " {$thousandsDict[$levels]}" : '');
                }
            }

            $commas = count($words);
            $commas > 1 && $commas--;

            $result = implode(', ', $words);

            // $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);
            // $result = $f->format($n);
        } else {
            dump('qwe');
        }

        return view('question.three', ['result' => $result]);
    })->name('three.post');

    Route::get('three', function () {
        return view('question.three');
    })->name('three');
});
