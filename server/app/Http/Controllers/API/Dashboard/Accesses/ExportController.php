<?php

namespace App\Http\Controllers\API\Dashboard\Accesses;

use App\Http\Controllers\Controller;
use App\Http\Traits\Crypter;
use Illuminate\Http\Request;
use PHPExcel;
use App\Models\AccessHost;
use App\Models\AccessOther;
use App\Models\AccessSite;

class ExportController extends Controller
{
    use Crypter;

    public function getDownloadExport() {
        return \URL::temporarySignedRoute(
            'all-export', now()->addSeconds(5), ['user' => 1]
        );
    }

    public function export(Request $request) {
        // Проверка сигнатуры ссылки
        if (!$request->hasValidSignature()) return;

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
//        $objPHPExcel->getProperties()->setCreator("Consultator")->setLastModifiedBy("Consultator")->setTitle("Consultator")->setSubject("Consultator")->setDescription("Αρχείο Εξαγωγής Σχολίων")->setKeywords("Σχόλια")->setCategory("Αρχείο Σχολίων");

        /* Заполняем лист: Хостинги */
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setTitle('Хостинги');
        $hosts = $this->decryptCollection(AccessHost::all());
        $sheet->getColumnDimensionByColumn(0)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(1)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(2)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(3)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(4)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(5)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(6)->setAutoSize(true);
        $sheet
            ->setCellValue('A1', 'Наименование')
            ->setCellValue('B1', 'Логин')
            ->setCellValue('C1', 'Пароль')
            ->setCellValue('D1', 'FTP сервер')
            ->setCellValue('E1', 'Логин')
            ->setCellValue('F1', 'Пароль')
            ->setCellValue('G1', 'Комментарий');
        for ($i = 0; $i < $hosts->count(); $i++) {
            $host = $hosts[$i];
            $index = $i + 2;
            $sheet
                ->setCellValue('A'.$index, $host['title'])
                ->setCellValue('B'.$index, $host['host_login'])
                ->setCellValue('C'.$index, $host['host_password'])
                ->setCellValue('D'.$index, $host['ftp_server'])
                ->setCellValue('E'.$index, $host['ftp_login'])
                ->setCellValue('F'.$index, $host['ftp_password'])
                ->setCellValue('G'.$index, $host['comment']);
            $sheet->getCell('A'.$index)->getHyperlink()->setUrl($host['link_sign_in']);
        }


        /* Заполняем лист: Сайты */
        $objPHPExcel->createSheet(1);
        $objPHPExcel->setActiveSheetIndex(1);
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setTitle('Сайты');
        $sites = $this->decryptCollection(AccessSite::with('host.host')->get());
        $sheet->getColumnDimensionByColumn(0)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(1)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(2)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(3)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(4)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(5)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(6)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(7)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(8)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(9)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(10)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(11)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(12)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(13)->setAutoSize(true);
        $sheet
            ->setCellValue('A1', 'Наименование')
            ->setCellValue('B1', 'Страница авторизации')
            ->setCellValue('C1', 'Логин')
            ->setCellValue('D1', 'Пароль')
            ->setCellValue('E1', 'Хостинг')
            ->setCellValue('F1', 'FTP сервер')
            ->setCellValue('G1', 'Логин')
            ->setCellValue('H1', 'Пароль')
            ->setCellValue('I1', 'Сервер БД')
            ->setCellValue('J1', 'Имя БД')
            ->setCellValue('K1', 'Логин БД')
            ->setCellValue('L1', 'Пароль БД')
            ->setCellValue('M1', 'Комментарий');
        for ($i = 0; $i < $sites->count(); $i++) {
            $site = $sites[$i];
            $index = $i + 2;
            $sheet
                ->setCellValue('A'.$index, $site['title'])
                ->setCellValue('B'.$index, "Ссылка на авторизацию")
                ->setCellValue('C'.$index, $site['admin_panel_login'])
                ->setCellValue('D'.$index, $site['admin_panel_password'])
                ->setCellValue('E'.$index, $site['host']['host']['title'] != "" ? $site['host']['host']['title'] . "(" . $site['host']['host']['host_login'] . ")" : "Не привязан")
                ->setCellValue('F'.$index, $site['ftp_server'])
                ->setCellValue('G'.$index, $site['ftp_login'])
                ->setCellValue('H'.$index, $site['ftp_password'])
                ->setCellValue('I'.$index, $site['db_server'])
                ->setCellValue('J'.$index, $site['db_name'])
                ->setCellValue('K'.$index, $site['db_login'])
                ->setCellValue('L'.$index, $site['db_password'])
                ->setCellValue('M'.$index, $site['comment']);
            $sheet->getCell('A'.$index)->getHyperlink()->setUrl($site['site_url']);
            $sheet->getCell('B'.$index)->getHyperlink()->setUrl($site['admin_panel_url']);

        }

        /* Заполняем лист: Сайты */
        $objPHPExcel->createSheet(2);
        $objPHPExcel->setActiveSheetIndex(2);
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setTitle('Другие аккаунты');
        $others = $this->decryptCollection(AccessOther::all());
        $sheet->getColumnDimensionByColumn(0)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(1)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(2)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(3)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(4)->setAutoSize(true);
        $sheet->getColumnDimensionByColumn(5)->setAutoSize(true);
        $sheet
            ->setCellValue('A1', 'Наименование')
            ->setCellValue('B1', 'E-mail')
            ->setCellValue('C1', 'Логин')
            ->setCellValue('D1', 'Пароль')
            ->setCellValue('E1', 'Номер телефона')
            ->setCellValue('F1', 'Комментарий');
        for ($i = 0; $i < $others->count(); $i++) {
            $other = $others[$i];
            $index = $i + 2;
            $sheet
                ->setCellValue('A'.$index, $other['title'])
                ->setCellValue('B'.$index, $other['email'])
                ->setCellValue('C'.$index, $other['login'])
                ->setCellValue('D'.$index, $other['password'])
                ->setCellValue('E'.$index, $other['phone'])
                ->setCellValue('F'.$index, $other['comment']);
            $sheet->getCell('A'.$index)->getHyperlink()->setUrl($other['link_sign_in']);
        }

        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . "Доступы" . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        $objPHPExcel->disconnectWorksheets();
        unset($objPHPExcel);
    }
}
