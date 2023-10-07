<?php

namespace App\Models;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FilesModel
{
    /**
     * @param string $path - Путь до папки куда сохранить файл
     * @param string $fileName - Название файла с разрешением
     *
     * @return string
     */
    public static function getPathSave(string $path, string $fileName): string
    {
        return '/upload/' . trim($path, '/') . '/' . trim($fileName, '/');
    }

    /**
     * @param string $path - Путь до папки куда сохранить файл
     * @param File|UploadedFile $file - Файл для сохранения
     * @param string $fileName - Название файла с разрешением
     *
     * @return void
     */
    public static function putFileAs(string $path, File|UploadedFile $file, string $fileName): void
    {
        Storage::putFileAs('/upload/' . $path, $file, $fileName);
    }
}
