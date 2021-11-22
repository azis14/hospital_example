<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// ============================= TOPIK 1 ============================
// ----------------------------- NOMOR 1 ----------------------------
Route::get('/nomor-1', function () {
    $hospitals = \App\Models\RumahSakit::all();

    return view('nomor-1', ['hospitals' => $hospitals, 'kota' => 'All']);
});

Route::post('/nomor-1', function (Request $request) {
    if ($request->kota == 'All') {
        return redirect('/nomor-1');
    }

    $hospitals = \App\Models\RumahSakit::where('kota_administrasi', $request->kota)->get();

    return view('nomor-1', ['hospitals' => $hospitals, 'kota' => $request->kota]);
});

// ----------------------------- NOMOR 2 ----------------------------
Route::get('/nomor-2', function () {
    $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', 'Rumah Sakit Umum')->get();

    return view('nomor-2', ['hospitals' => $hospitals]);
});

// ----------------------------- NOMOR 3 ----------------------------
Route::get('/nomor-3', function () {
    $hospitals = \App\Models\RumahSakit::all();
    $typeOptions = \App\Models\RumahSakit::select('jenis_rumah_sakit')->groupBy('jenis_rumah_sakit')->get();

    return view('nomor-3', ['hospitals' => $hospitals, 'typeOptions' => $typeOptions, 'tipe' => 'All']);
});

Route::post('/nomor-3', function (Request $request) {
    $typeOptions = \App\Models\RumahSakit::select('jenis_rumah_sakit')->groupBy('jenis_rumah_sakit')->get();

    if ($request->tipe == 'All') {
        return redirect('/nomor-3');
    }

    $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', $request->tipe)->get();

    return view('nomor-3', ['hospitals' => $hospitals, 'tipe' => $request->tipe, 'typeOptions' => $typeOptions]);
});

// ----------------------------- NOMOR 4 ----------------------------
Route::get('/nomor-4', function () {
    $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', 'Rumah Sakit Ibu dan Anak')->get();

    return view('nomor-4', ['hospitals' => $hospitals]);
});

// ----------------------------- NOMOR 5 ----------------------------
Route::get('/nomor-5', function () {
    $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', 'like', '%Khusus%')->get();

    return view('nomor-5', ['hospitals' => $hospitals]);
});

// ----------------------------- NOMOR 6 ----------------------------
Route::get('/nomor-6', function () {
    $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', 'Rumah Sakit Bersalin')->get();

    return view('nomor-6', ['hospitals' => $hospitals]);
});

// ============================= TOPIK 2 ============================
// ----------------------------- NOMOR 1 ----------------------------
Route::get('/nomor-7', function () {
    $hospitals = \App\Models\RumahSakit::all();

    return view('nomor-7', ['hospitals' => $hospitals, 'tipe' => '', 'kota' => '']);
});

Route::post('/nomor-7', function (Request $request) {
    if ($request->tipe == '' && $request->kota == '') {
        return redirect('/nomor-7');
    }

    $hospitals;

    if ($request->tipe == '') {
        $hospitals = \App\Models\RumahSakit::where('kota_administrasi', 'like', '%' . $request->kota . '%')->get();
    } else if ($request->kota == '') {
        $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', 'like', '%' . $request->tipe . '%')->get();
    } else {
        $hospitals = \App\Models\RumahSakit::where('jenis_rumah_sakit', 'like', '%' . $request->tipe . '%')->where('kota_administrasi', 'like', '%' . $request->kota . '%')->get();
    }

    return view('nomor-7', ['hospitals' => $hospitals, 'kota' => $request->kota, 'tipe' => $request->tipe]);
});

// ----------------------------- NOMOR 2 ----------------------------
Route::get('/nomor-8', function () {
    $hospitals = \App\Models\RumahSakit::all();

    return view('nomor-8', ['hospitals' => $hospitals, 'kecamatan' => '', 'kota' => '']);
});

Route::post('/nomor-8', function (Request $request) {
    if ($request->kecamatan == '' && $request->kota == '') {
        return redirect('/nomor-8');
    }

    $hospitals;

    if ($request->kecamatan == '') {
        $hospitals = \App\Models\RumahSakit::where('kota_administrasi', 'like', '%' . $request->kota . '%')->get();
    } else if ($request->kota == '') {
        $hospitals = \App\Models\RumahSakit::where('kecamatan', 'like', '%' . $request->kecamatan . '%')->get();
    } else {
        $hospitals = \App\Models\RumahSakit::where('kecamatan', 'like', '%' . $request->kecamatan . '%')->where('kota_administrasi', 'like', '%' . $request->kota . '%')->get();
    }

    return view('nomor-8', ['hospitals' => $hospitals, 'kota' => $request->kota, 'kecamatan' => $request->kecamatan]);
});

// ----------------------------- NOMOR 3 ----------------------------
Route::get('/nomor-9', function () {
    $hospitals = \App\Models\RumahSakit::all();

    return view('nomor-9', ['hospitals' => $hospitals, 'nama' => '', 'kota' => '']);
});

Route::post('/nomor-9', function (Request $request) {
    if ($request->nama == '' && $request->kota == '') {
        return redirect('/nomor-9');
    }

    $hospitals;

    if ($request->nama == '') {
        $hospitals = \App\Models\RumahSakit::where('kota_administrasi', 'like', '%' . $request->kota . '%')->get();
    } else if ($request->kota == '') {
        $hospitals = \App\Models\RumahSakit::where('nama_rumah_sakit', 'like', '%' . $request->nama . '%')->get();
    } else {
        $hospitals = \App\Models\RumahSakit::where('nama_rumah_sakit', 'like', '%' . $request->nama . '%')->where('kota_administrasi', 'like', '%' . $request->kota . '%')->get();
    }

    return view('nomor-9', ['hospitals' => $hospitals, 'kota' => $request->kota, 'nama' => $request->nama]);
});

// ----------------------------- NOMOR 4 ----------------------------
Route::get('/nomor-10', function () {
    $hospitals = \App\Models\RumahSakitCovid::all();

    return view('nomor-10', ['hospitals' => $hospitals, 'nama' => '', 'kota' => '']);
});

Route::post('/nomor-10', function (Request $request) {
    if ($request->nama == '' && $request->kota == '') {
        return redirect('/nomor-10');
    }

    $hospitals;

    if ($request->nama == '') {
        $hospitals = \App\Models\RumahSakitCovid::where('kota_madya', 'like', '%' . $request->kota . '%')->get();
    } else if ($request->kota == '') {
        $hospitals = \App\Models\RumahSakitCovid::where('nama_rumah_sakit', 'like', '%' . $request->nama . '%')->get();
    } else {
        $hospitals = \App\Models\RumahSakitCovid::where('nama_rumah_sakit', 'like', '%' . $request->nama . '%')->where('kota_madya', 'like', '%' . $request->kota . '%')->get();
    }

    return view('nomor-10', ['hospitals' => $hospitals, 'kota' => $request->kota, 'nama' => $request->nama]);
});

// ----------------------------- NOMOR 5 ----------------------------
Route::get('/nomor-11', function () {
    $hospitals = \App\Models\RumahSakitCovid::all();

    return view('nomor-11', ['hospitals' => $hospitals, 'kelurahan' => '', 'kecamatan' => '']);
});

Route::post('/nomor-11', function (Request $request) {
    if ($request->kelurahan == '' && $request->kecamatan == '') {
        return redirect('/nomor-11');
    }

    $hospitals;

    if ($request->kelurahan == '') {
        $hospitals = \App\Models\RumahSakitCovid::where('kecamatan', 'like', '%' . $request->kecamatan . '%')->get();
    } else if ($request->kecamatan == '') {
        $hospitals = \App\Models\RumahSakitCovid::where('kelurahan', 'like', '%' . $request->kelurahan . '%')->get();
    } else {
        $hospitals = \App\Models\RumahSakitCovid::where('kelurahan', 'like', '%' . $request->kelurahan . '%')->where('kecamatan', 'like', '%' . $request->kecamatan . '%')->get();
    }

    return view('nomor-11', ['hospitals' => $hospitals, 'kelurahan' => $request->kelurahan, 'kecamatan' => $request->kecamatan]);
});

// ----------------------------- NOMOR 6 ----------------------------
Route::get('/nomor-12', function () {
    $hospitals = \App\Models\RumahSakitCovid::all();

    return view('nomor-12', ['hospitals' => $hospitals, 'kota' => '', 'kecamatan' => '']);
});

Route::post('/nomor-12', function (Request $request) {
    if ($request->kota == '' && $request->kecamatan == '') {
        return redirect('/nomor-12');
    }

    $hospitals;

    if ($request->kota == '') {
        $hospitals = \App\Models\RumahSakitCovid::where('kecamatan', 'like', '%' . $request->kecamatan . '%')->get();
    } else if ($request->kecamatan == '') {
        $hospitals = \App\Models\RumahSakitCovid::where('kota_madya', 'like', '%' . $request->kota . '%')->get();
    } else {
        $hospitals = \App\Models\RumahSakitCovid::where('kota_madya', 'like', '%' . $request->kota . '%')->where('kecamatan', 'like', '%' . $request->kecamatan . '%')->get();
    }

    return view('nomor-12', ['hospitals' => $hospitals, 'kota' => $request->kota, 'kecamatan' => $request->kecamatan]);
});