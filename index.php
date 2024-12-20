<?php
$dirPath = './files';

    $files = scandir($dirPath);
    foreach($files as $filePath)
    {
        $file = $dirPath . '/' . $filePath;
        if(is_file($file))
        {
            $targetFileContents = readTargetFile($file);
            $targetFileData = explode(',', $targetFileContents);
            $targetFileData[1] = base64_decode($targetFileData[1]);
            createNewFile($targetFileData,$file);
        }
    }

function createNewFile(array $oldFileData, string $oldFile)
{
    echo "createNewFile" . PHP_EOL;
    $newDirpath = './images';
    $oldFileName = basename($oldFile,'.txt'); 
    $fileExtension = preg_split('#(/|;)#',$oldFileData[0]);
    $newFilePath = $newDirpath . '/' . $oldFileName . '.' . $fileExtension[1];
    $newFile = fopen($newFilePath, 'w');
    fwrite($newFile, $oldFileData[1]);
    fclose($newFile);
    echo "createNewFile" . PHP_EOL;
}

function readTargetFile(string $targetFilePath)
{
    echo "readTargetFile" . PHP_EOL;
    $f = fopen($targetFilePath, 'r');
    $contents = fread($f, filesize($targetFilePath));
    fclose($f);
    echo "readTargetFile" . PHP_EOL;
    return $contents;
}