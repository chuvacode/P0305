<?php


namespace App\Http\Traits;


use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Collection;
use function Sodium\add;

trait Crypter
{

    public function decryptArray ($array) {
        if (!is_array($array)) return $array;

        return array_map(function ($item) {
            try {
                if (is_string($item)) {
                    return decrypt($item);
                }

                if (is_array($item)) {
                    return $this->decryptArray($item);
                }

                if ($item instanceof Collection) {
                    return $this->decryptCollection($item);
                }
            } catch (DecryptException $exception) {
            }

            return $item;

        }, $array);
    }

    public function decryptCollection ($collection)
    {

        if ($collection instanceof Collection) {
            $collection = $collection->flatMap(function ($values)
            {
                return [array_map(function ($item) {
                    try {

                        if (is_string($item)) {
                            return decrypt($item);
                        }

                        if (is_array($item)) {
                            return $this->decryptArray($item);
                        }

                        if ($item instanceof Collection) {
                            return $this->decryptCollection($item);
                        }

                        return $item;

                    } catch (DecryptException $exception) {
                    }
                }, $values->toArray())];
            });
        }

        return $collection;
    }

    public function encryptCollection ($collection) {
        return array_map(function ($item) {
            return encrypt($item);
        }, $collection);
    }

}
