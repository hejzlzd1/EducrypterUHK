<?php

namespace App\Algorithms;

class StreamCipher extends CipherBase
{
    protected int $dataFrame;

    public function getIv(): int
    {
        return $this->dataFrame;
    }

    public function setIv(int $dataFrame): void
    {
        $this->dataFrame = $dataFrame;
    }

    protected function expandOrTrimToSpecificBits($data, $size)
    {
        $dataLength = mb_strlen($data);
        if ($dataLength < $size) {
            // If data is shorter, pad with zeros
            $data = str_pad($data, $size, '0', STR_PAD_LEFT);
        } elseif ($dataLength > $size) {
            // If data is longer, truncate to x bits
            $data = mb_substr($data, 0, $size);
        }

        return $data;
    }
}
