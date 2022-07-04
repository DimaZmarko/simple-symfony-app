<?php

namespace App\Utils;

trait TempFileHelperTrait
{
    public function createTempFile(string $content, string $filePrefix): string
    {
        $tempFileName = $this->filesystem->tempnam(sys_get_temp_dir(), $filePrefix);
        $tempFile = fopen($tempFileName, 'wb+');

        if (!\is_resource($tempFile)) {
            throw new \RuntimeException('Unable to create a temporary file.');
        }

        fwrite($tempFile, $content);
        fclose($tempFile);

        return $tempFileName;
    }
}
