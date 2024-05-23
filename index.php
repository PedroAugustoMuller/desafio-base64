<?php
$dirPath = './files';
$newPath = './images';

$files = scandir($dirPath);
foreach($files as $file)
{
    $filePath = $dirPath . '/' . $file;
    if(is_file($filePath))
    {
        $f = fopen($filePath, 'r');
        $contents = fread($f, filesize($filePath));
        fclose($f);
        $data = explode( ',', $contents );
        $fileName = basename($filePath);
        $extension = explode('/',$data[0]);
        $newFPath = $newPath . '/nome.'. $extension[1];
        $nf = fopen($newFPath, 'wb');
        fwrite( $nf, base64_decode( $data[ 1 ] ) );
        fclose($nf);
    }
}