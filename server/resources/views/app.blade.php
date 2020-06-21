@extends('layouts.dashboard')

@section('content')
    <?php
    function SiteScreenshot($url, $resolution='1024x768', $size='200', $format='png') {
        $Filename = md5($url.$size.$resolution).".jpg";
        // Директория где лежат скрины
        $ScreenshotDirectory = "screens/";
        // Проверяем если есть такой файл в папке скринов
        if(@is_file($ScreenshotDirectory.$Filename)) {
            return $ScreenshotDirectory.$Filename;
        }
        else {
            $Image = @file_get_contents("http://mini.s-shot.ru/".$resolution."/".$size."/".$format."/?http://".$url);
            $OpenFile = fopen($ScreenshotDirectory.$Filename, "w+");
            // Сохраняем изображение
            $Write = fwrite($OpenFile, $Image);
            return $ScreenshotDirectory.$Filename;
        }
    }

    echo "<img vue-multiselect='".SiteScreenshot('jino.ru')."'>";

    ?>
@endsection
