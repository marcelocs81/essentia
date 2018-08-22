<?php

namespace Application\Http;

use Application\Model\Exception\BusinessRuleException;
use Zend\Http\Response\Stream;

class DownloadResponse extends Stream
{

    private $fileInfo;

    public function __construct(\SplFileInfo $fileInfo, $realName, $view = false)
    {
        $this->fileInfo = $fileInfo;

        if(null === $this->fileInfo || ! file_exists($this->fileInfo->getRealPath())){
            throw new BusinessRuleException("Oopss... Infelizmente não encontramos o arquivo que você estava procurando.");
        }

        $this->setStream(fopen($this->fileInfo->getRealPath(), 'r'));
        $this->setStreamName($this->fileInfo->getFilename());

        $finfo           = finfo_open(FILEINFO_MIME_TYPE);
        $mimeContentType = finfo_file($finfo, $this->fileInfo->getRealPath());

        $attachment = 'attachment;';
        if($view){
            $attachment = '';
        }

        $this->getHeaders()->addHeaders(
            array(
                'Content-Disposition' => sprintf('%s filename="%s"', $attachment, $realName),
                'Content-Type'        => $mimeContentType,
                'Content-Length'      => $this->fileInfo->getSize()
            )
        );

        finfo_close($finfo);
    }

}