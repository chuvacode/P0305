<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseJSON;
use App\Models\Screenshot;
use Illuminate\Http\Request;

class ScreenshotController extends Controller
{

    use ResponseJSON;

    public function screenshot($url) {
//        header('Access-Control-Allow-Origin', 'http://localhost:3000');
        // Поиск в бд
        $screenshot = Screenshot::where('site', 'LIKE', $url)->get();

        // Если уже есть в бд
        if ($screenshot->count() !== 0) {
            return $this->responseJSON('200', 'Success', [
                'screenshot' => $screenshot->first()->toArray()['image']
            ]);
        }

        // вызов методов сервиса
        $api_data = file_get_contents("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=http://" . $url . "&screenshot=true");
        // расшифровка данных** json
        $api_data = json_decode($api_data, true);

        // данные снимка
        $screenshot = $api_data['lighthouseResult']['audits']['final-screenshot']['details']['data'];
        $screenshot = str_replace(array('_','-'),array('/','+'),$screenshot);

        Screenshot::create([
            'site' => $url,
            'image' => $screenshot
        ]);

        return $this->responseJSON('200', 'Success', [
            'screenshot' => $screenshot
        ]);
    }
}
