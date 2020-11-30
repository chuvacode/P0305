<?php
$browser = new COM("InternetExplorer.Application");
$browser->Visible = true;
$browser->Fullscreen = true;
$browser->StatusBar = false;

$browser->Navigate("http://www.habrahabr.ru");
while ($browser->Busy)
    com_message_pump(4000);

$handle = $browser->HWND;
$screenWidth = $browser->Width;
$screenHeight = $browser->Height;
$documentHeight = $browser->Document->body->scrollHeight;

$scrollWidth = 20;
$scrollHeight = 20;
$testPartSize = 10*1024;

$im = imagecreatetruecolor($screenWidth - $scrollWidth, $documentHeight);
for($top = 0; $top < $documentHeight; $top += $screenHeight)
{
    $browser->Document->documentElement->scrollTop=$top;
    while ($browser->Busy)
        com_message_pump(4000);
    echo $browser->Document->documentElement->scrollTop.PHP_EOL;

    for($i = 0; $i < 5; $i++)
    {
        $part = imagegrabwindow($handle, 0);
        $dark = imagecolorallocate($part, 0, 0, 0);
        imagefilledrectangle($part, $screenWidth - $scrollWidth, 0, $screenWidth, $screenHeight, $dark);
        $testFile = sprintf("screenshot_%05d.png", $top);
        imagepng($part, $testFile, 9, PNG_ALL_FILTERS);
        clearstatcache();
        if(filesize($testFile) > $testPartSize)
            break;

        echo "Bad part, name: {$testFile}, try to generate again.".PHP_EOL;
    }

    imagecopy(
        $im, $part,
        0, $top,
        0, (!$top || ($top + $screenHeight) < $documentHeight) ? 0 : $screenHeight - $scrollHeight - $documentHeight % $screenHeight,
        $screenWidth - $scrollWidth, $screenHeight);
    imagedestroy($part);
}
imagepng($im, "screenshot.png", 9, PNG_ALL_FILTERS);
imagedestroy($im);

$browser->Quit();

