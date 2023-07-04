<?php
/**
 * Lightweight Whois Server in File Reader
 *
 * @author HanbitGaram
 * @copyright (c) 2022 HanbitGaram
 * @license https://hanb.jp/license/limit_software_2.html
 */
class FileReader{
    private ?string $fileName = null;
    private ?string $fileContent = null;
    protected ?string $returnType = 'string';

    public function __construct( ?string $fileName = null ) {
        $this->fileName = $fileName;
    }

    /**
     * @throws Exception
     */
    private function fileReadAble(): void {
        if(!file_exists($this->fileName)) throw new Exception("File Not Found");
    }

    /**
     * @return void
     */
    private function readFileContent(): void {
        $fp = fopen($this->fileName, 'r');
        $this->fileContent = fread($fp, filesize($this->fileName));
        fclose($fp);
    }

    /**
     * @throws Exception
     */
    private function checkVaildType( ?string $type='' ): void {
        $this->returnType = match ($this->returnType) {
            'string', 'object', 'json', 'array' => $type,
            default => throw new Exception('invalid type - ' . $this->returnType),
        };
    }

    /**
     * @throws Exception
     */
    public function returnType(?string $type='') {
        $this->checkVaildType( $type );
    }

    /**
     * @return void
     * @throws Exception
     */
    private function returnTypeProcess(): void {
        $this->fileContent = match ($this->returnType) {
            'string' => (string)$this->fileContent,
            'object', 'json' => json_decode($this->fileContent),
            'array' => json_decode($this->fileContent, true),
            default => throw new Exception('Unspecified Error'),
        };
    }

    /**
     * @return string|object|array|null FileContent Return
     * @throws Exception Exception(File Error)
     */
    public function get(): string|object|array|null {
        $this->fileReadAble();
        $this->readFileContent();
        $this->returnTypeProcess();

        return $this->fileContent;
    }
}