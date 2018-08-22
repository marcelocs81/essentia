<?php

namespace Application\Http;

use Application\Model\Exception\BusinessRuleException;
use Zend\Http\Response\Stream;

class ImageResponse extends Stream
{

    private $fileInfo;

    public function __construct(\SplFileInfo $fileInfo, $realName)
    {
        $this->fileInfo = $fileInfo;

        if(null === $this->fileInfo || ! file_exists($this->fileInfo->getRealPath())){
            throw new BusinessRuleException('Oopss... Infelizmente não encontramos o arquivo que você estava procurando.');
        }

        $this->setStream(fopen($this->fileInfo->getRealPath(), 'r'));
        $this->setStreamName($this->fileInfo->getFilename());

        $finfo           = finfo_open(FILEINFO_MIME_TYPE);
        $mimeContentType = finfo_file($finfo, $this->fileInfo->getRealPath());

        $this->getHeaders()->addHeaders(
            array(
                'Content-Disposition' => sprintf('filename="%s"', $realName),
                'Content-Type'        => $mimeContentType,
                'Content-Length'      => $this->fileInfo->getSize()

            )
        );

        finfo_close($finfo);
    }

}