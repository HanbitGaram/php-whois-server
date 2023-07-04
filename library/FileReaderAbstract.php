<?php
/**
 * Lightweight Whois Server in File Reader
 *
 * @author HanbitGaram
 * @copyright (c) 2022 HanbitGaram
 * @license https://hanb.jp/license/limit_software_2.html
 */
abstract class FileReaderAbstract{
    protected ?string $returnType = 'string';

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
}