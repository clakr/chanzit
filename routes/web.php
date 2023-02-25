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

        $result = '';
        $conversion = '';

        $input = $request->input('input');
        $n = ctype_digit($input) ? intval($input) : null;

        $req_url = 'https://v6.exchangerate-api.com/v6/bd2e3e943d06c4496644481a/latest/PHP';
        $response_json = file_get_contents($req_url);
        $response = json_decode($response_json);

        if (is_int($n)) {

            if ($n === 0) {
                $result = 'zero';
                $conversion = 0;
            } else {
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
                        $tens = (int)$tens ? $onesDict[$tens] : '';
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

                if ('success' === $response->result) {
                    $conversion = round(($n * $response->conversion_rates->USD), 4);
                }
            }
        } else {
            $input = str_replace(' and ', ' ', strtolower(trim($input)));
            $input = preg_replace('/\s+/', ' ', $input);
            $input = explode(' ', $input);

            if (in_array('million', $input) || in_array('billion', $input)) {
                $result = 'System is not capable to provide results to inputs greater than million';
                $conversion = null;
            } else {
                $map = [
                    'one' => '1',
                    'two' => '2',
                    'three' => '3',
                    'four' => '4',
                    'five' => '5',
                    'six' => '6',
                    'seven' => '7',
                    'eight' => '8',
                    'nine' => '9',
                    'ten' => '10',
                    'eleven' => '11',
                    'twelve' => '12',
                    'thirteen' => '13',
                    'fourteen' => '14',
                    'fifteen' => '15',
                    'sixteen' => '16',
                    'seventeen' => '17',
                    'eighteen' => '18',
                    'nineteen' => '19',
                    'twenty' => '20',
                    'thirty' => '30',
                    'forty' => '40',
                    'fifty' => '50',
                    'sixty' => '60',
                    'seventy' => '70',
                    'eighty' => '80',
                    'ninety' => '90',
                    'hundred' => '100',
                    'thousand' => '1000',
                    'million' => '1000000',
                    'billion' => '1000000000',
                ];

                $total = 0;
                $intLeftOver = 0;
                foreach ($input as $strWords) {

                    switch ($strWords) {

                        case 'thousand':
                            if (0 == $total && 0 == $intLeftOver) {
                                $total = 1 * $map[$strWords];
                            } else if (0 != $total && 0 == $intLeftOver) {
                                $total = $total . substr($map[$strWords], 1);
                            } else {
                                $total = ($total +  $intLeftOver) * $map[$strWords];
                            }

                            $intLeftOver = 0;
                            break;
                        case 'hundred':
                            if (0 == $total && 0 == $intLeftOver) {
                                $total = 1 * $map[$strWords];
                            } else if (0 != $total && 0 == $intLeftOver) {
                                $total = $total + $map[$strWords];
                            } else {
                                $total = $total + ($intLeftOver * $map[$strWords]);
                            }
                            $intLeftOver = 0;
                            break;

                        default:
                            $intLeftOver = $intLeftOver + $map[$strWords];
                            break;
                    }
                }

                $total = $total + $intLeftOver;
                $result = $total;

                if ('success' === $response->result) {
                    $conversion = round(($total * $response->conversion_rates->USD), 4);
                }
            }
        }

        return view('question.three', [
            'result' => $result,
            'conversion' => $conversion
        ]);
    })->name('three.post');

    Route::get('one', function () {
        return view('question.one');
    })->name('one');

    Route::get('two', function () {
        return view('question.two');
    })->name('two');

    Route::get('three', function () {
        return view('question.three');
    })->name('three');
});
