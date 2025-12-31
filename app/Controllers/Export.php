<?php

namespace App\Controllers;

use App\Models\M_stock;
use App\Models\M_masuk;
use App\Models\M_keluar;
use Mpdf\Mpdf;

class Export extends BaseController
{
    public function stock()
    {
        $model = new M_stock();
        $data['judul'] = "Stock Barang (Inventory)";
        $data['rows']  = $model->findAll();

        return view("export/stock", $data);
    }

    public function masuk()
    {
        $model = new M_masuk();
        $data['judul'] = "Barang Masuk (Inventory)";
        $data['rows']  = $model->getAllData();

        return view("export/masuk", $data);
    }

    public function keluar()
    {
        $model = new M_keluar();
        $data['judul'] = "Barang Keluar (Inventory)";
        $data['rows']  = $model->getAllData();

        return view("export/keluar", $data);
    }


    // ============================
    // PDF EXPORT
    // ============================

    public function stock_pdf()
    {
        $mpdf = new Mpdf();

        $model = new M_stock();
        $data['rows']  = $model->findAll();
        $data['judul'] = "Laporan Stock Barang";

        $html = view("export/stock", $data);

        $mpdf->WriteHTML($html);
        return $mpdf->Output("stock_barang.pdf", "D");
    }

    public function masuk_pdf()
    {
        $mpdf = new Mpdf();

        $model = new M_masuk();
        $data['rows']  = $model->getAllData();
        $data['judul'] = "Laporan Barang Masuk";

        $html = view("export/masuk", $data);

        $mpdf->WriteHTML($html);
        return $mpdf->Output("barang_masuk.pdf", "D");
    }

    public function keluar_pdf()
    {
        $mpdf = new Mpdf();

        $model = new M_keluar();
        $data['rows']  = $model->getAllData();
        $data['judul'] = "Laporan Barang Keluar";

        $html = view("export/keluar", $data);

        $mpdf->WriteHTML($html);
        return $mpdf->Output("barang_keluar.pdf", "D");
    }


    // ============================
    // EXCEL EXPORT
    // ============================

    public function stock_excel()
    {
        $model = new M_stock();
        $data['rows'] = $model->findAll();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=stock_barang.xls");

        return view("export/stock", $data);
    }

    public function masuk_excel()
    {
        $model = new M_masuk();
        $data['rows'] = $model->getAllData();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=barang_masuk.xls");

        return view("export/masuk", $data);
    }

    public function keluar_excel()
    {
        $model = new M_keluar();
        $data['rows'] = $model->getAllData();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=barang_keluar.xls");

        return view("export/keluar", $data);
    }
}
