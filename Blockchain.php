<?php

class Blockchain
{
    private $chain;
    private $difficulty;

    public function __construct() {
        $this->chain = [$this->createGenesisBlock()];
        //echo "Dificultad##". $this->difficulty ."###";
    }

    public function createGenesisBlock() {
        return new Block(0, date("Y-m-d H:i:s"), "Genesis Block", "0");
    }

    public function getLatestBlock() {
        return end($this->chain);
    }

    public function addBlock($newBlock) {
        $this->difficulty = random_int(3, 5); // Ajusta la dificultad aquí
        $newBlock->previous_hash = $this->getLatestBlock()->hash;
        $newBlock->mineBlock($this->difficulty);
        $this->chain[] = $newBlock;
    }

    public function isChainValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previous_hash !== $previousBlock->hash) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return Block[]
     */
    public function getChain(): array
    {
        return $this->chain;
    }


    public function getdifficulty(): int
    {
        return $this->difficulty;
    }

}