<?php

namespace App\Services;

class FileService
{
    /**
     * Raed JSON data from file.
     *
     * @param string $filePath
     *
     * @return array
     */
    public static function jsonFromFile($filePath)
    {
        try {
            $json = file_get_contents($filePath);

            if ($json === false) {
                throw new \Exception("Unable to read the JSON file.");
            }

            $data = json_decode($json);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON in the file.");
            }

            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
