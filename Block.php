<?php

class Block {
    public $index;
    public $timestamp;
    public $data;
    public $previous_hash;
    public $hash;
    public $nonce;
    public $difficult;

    public function __construct($index, $timestamp, $data, $previous_hash = "") {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previous_hash = $previous_hash;
        $this->nonce = 0;
        $this->hash = $this->calculateHash();
        $this->difficult = 0;
    }

    public function calculateHash() {
        return hash("sha256", $this->index . $this->timestamp . $this->data . $this->previous_hash . $this->nonce);
    }

    public function mineBlock($difficulty) {
        $target = str_repeat("0", $difficulty);
        while (substr($this->hash, 0, $difficulty) !== $target) {
            $this->nonce++;
            $this->hash = $this->calculateHash();
        }
        //echo "Block mined: " . $this->hash . "\n";
        $this->difficult = $difficulty;
    }
}