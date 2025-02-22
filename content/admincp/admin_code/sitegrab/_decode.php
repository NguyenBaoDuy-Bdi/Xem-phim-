<?php


Class Decode {

    private $rda;
    private $sof;
    private $Mf;
    private $Yv;
    private $Ki;
    private $Dol = array(1, 2, 4, 8, 16, 32, 64, 128, 27, 54, 108, 216, 171, 77, 154, 47, 94, 188, 99, 198, 151, 53, 106, 212, 179, 125, 250, 239, 197, 145);
    private $Qre = array(99, 124, 119, 123, 242, 107, 111, 197, 48, 1, 103, 43, 254, 215, 171, 118, 202, 130, 201, 125, 250, 89, 71, 240, 173, 212, 162, 175, 156, 164, 114, 192, 183, 253, 147, 38, 54, 63, 247, 204, 52, 165, 229, 241, 113, 216, 49, 21, 4, 199, 35, 195, 24, 150, 5, 154, 7, 18, 128, 226, 235, 39, 178, 117, 9, 131, 44, 26, 27, 110, 90, 160, 82, 59, 214, 179, 41, 227, 47, 132, 83, 209, 0, 237, 32, 252, 177, 91, 106, 203, 190, 57, 74, 76, 88, 207, 208, 239, 170, 251, 67, 77, 51, 133, 69, 249, 2, 127, 80, 60, 159, 168, 81, 163, 64, 143, 146, 157, 56, 245, 188, 182, 218, 33, 16, 255, 243, 210, 205, 12, 19, 236, 95, 151, 68, 23, 196, 167, 126, 61, 100, 93, 25, 115, 96, 129, 79, 220, 34, 42, 144, 136, 70, 238, 184, 20, 222, 94, 11, 219, 224, 50, 58, 10, 73, 6, 36, 92, 194, 211, 172, 98, 145, 149, 228, 121, 231, 200, 55, 109, 141, 213, 78, 169, 108, 86, 244, 234, 101, 122, 174, 8, 186, 120, 37, 46, 28, 166, 180, 198, 232, 221, 116, 31, 75, 189, 139, 138, 112, 62, 181, 102, 72, 3, 246, 14, 97, 53, 87, 185, 134, 193, 29, 158, 225, 248, 152, 17, 105, 217, 142, 148, 155, 30, 135, 233, 206, 85, 40, 223, 140, 161, 137, 13, 191, 230, 66, 104, 65, 153, 45, 15, 176, 84, 187, 22);
    private $QreInverse = array(82, 9, 106, 213, 48, 54, 165, 56, 191, 64, 163, 158, 129, 243, 215, 251, 124, 227, 57, 130, 155, 47, 255, 135, 52, 142, 67, 68, 196, 222, 233, 203, 84, 123, 148, 50, 166, 194, 35, 61, 238, 76, 149, 11, 66, 250, 195, 78, 8, 46, 161, 102, 40, 217, 36, 178, 118, 91, 162, 73, 109, 139, 209, 37, 114, 248, 246, 100, 134, 104, 152, 22, 212, 164, 92, 204, 93, 101, 182, 146, 108, 112, 72, 80, 253, 237, 185, 218, 94, 21, 70, 87, 167, 141, 157, 132, 144, 216, 171, 0, 140, 188, 211, 10, 247, 228, 88, 5, 184, 179, 69, 6, 208, 44, 30, 143, 202, 63, 15, 2, 193, 175, 189, 3, 1, 19, 138, 107, 58, 145, 17, 65, 79, 103, 220, 234, 151, 242, 207, 206, 240, 180, 230, 115, 150, 172, 116, 34, 231, 173, 53, 133, 226, 249, 55, 232, 28, 117, 223, 110, 71, 241, 26, 113, 29, 41, 197, 137, 111, 183, 98, 14, 170, 24, 190, 27, 252, 86, 62, 75, 198, 210, 121, 32, 154, 219, 192, 254, 120, 205, 90, 244, 31, 221, 168, 51, 136, 7, 199, 49, 177, 18, 16, 89, 39, 128, 236, 95, 96, 81, 127, 169, 25, 181, 74, 13, 45, 229, 122, 159, 147, 201, 156, 239, 160, 224, 59, 77, 174, 42, 245, 176, 200, 235, 187, 60, 131, 83, 153, 97, 23, 43, 4, 126, 186, 119, 214, 38, 225, 105, 20, 99, 85, 33, 12, 125);
    private $blz = 128;
    private $szj = 192;

    public function __construct() {
        $this->rda = array(0, 0, 0, 0, array(0, 0, 0, 0, 10, 0, 12, 0, 14), 0, array(0, 0, 0, 0, 12, 0, 12, 0, 14), 0, array(0, 0, 0, 0, 14, 0, 14, 0, 14));
        $this->sof = array(0, 0, 0, 0, array(0, 1, 2, 3), 0, array(0, 1, 2, 3), 0, array(0, 1, 3, 4));
        $this->Ki = $this->blz / 32;
        $this->Yv = $this->szj / 32;
        $this->Mf = $this->rda[$this->Yv][$this->Ki];
    }

    public function decrypt($src, $key) {
        $loc5 = Array();
        $loc7 = Array();
        $loc6 = $this->HexToChars($src);
        $loc4 = $this->blz / 8;
        $loc8 = $this->keyExpansion($this->strToChars($key));
        for ($loc3 = count($loc6) / $loc4 - 1; $loc3 > 0; --$loc3) {
            $loc7 = $this->decryption($this->array_slice_js_compat($loc6, $loc3 * $loc4, ($loc3 + 1) * $loc4), $loc8);
            //mode ECB
            $loc5 = $this->concat($loc7, $loc5);
        } // end of for
        $loc5 = $this->concat($this->decryption(array_slice($loc6, 0, $loc4), $loc8), $loc5);
        return $this->charsToStr($loc5);
    }

    function array_slice_js_compat($array, $start, $finish = 0) {
        $len = $finish - $start;
        if ($len < 0)
            $len = 0 - $len;
        return array_slice($array, $start, $len);
    }

    function concat($s1, $s2) {
        if (is_array($s1) && is_array($s2))
            return array_merge($s1, $s2);
        elseif (( is_array($s1) && !is_array($s2) ) || (!is_array($s1) && is_array($s2) )) {
            return false;
        }
        else
            return $s1 . $s2;
    }

    function charsToStr($chars) {
        $loc3 = "";
        for ($loc1 = 0; $loc1 < count($chars); ++$loc1) {
            $loc3 .= chr($chars[$loc1]);
        } // end of for
        return ($loc3);
    }

    public function decryption($block, $expandedKey) {
        $block = $this->packBytes($block);
        $this->InverseFinalRound($block, array_slice($expandedKey, $this->Ki * $this->Mf));
        for ($loc2 = $this->Mf - 1; $loc2 > 0; --$loc2) {
            $this->InverseRound($block, array_slice($expandedKey, $this->Ki * $loc2, $this->Ki * ($loc2 + 1)));
        }
        $this->addRoundKey($block, $expandedKey);
        return $this->unpackBytes($block);
    }

    function unpackBytes($packed) {
        $loc1 = Array();
        for ($loc2 = 0; $loc2 < count($packed[0]); ++$loc2) {
            $loc1[] = $packed[0][$loc2];
            $loc1[] = $packed[1][$loc2];
            $loc1[] = $packed[2][$loc2];
            $loc1[] = $packed[3][$loc2];
        } // end of for
        return $loc1;
    }

    public function InverseFinalRound(&$state, $roundKey) {
        $this->addRoundKey($state, $roundKey);
        $this->shiftRow($state, "decrypt");
        $this->byteSub($state, "decrypt");
    }

    function InverseRound(&$state, $roundKey) {
        $this->addRoundKey($state, $roundKey);
        $this->mixColumn($state, "decrypt");
        $this->shiftRow($state, "decrypt");
        $this->byteSub($state, "decrypt");
    }

    function mixColumn(&$state, $dir) {
        $loc5 = Array();
        for ($loc2 = 0; $loc2 < $this->Ki; ++$loc2) {
            for ($loc4 = 0; $loc4 < 4; ++$loc4) {
                if ($dir == "encrypt") {
                    $loc5[$loc4] = $this->mult_GF256($state[$loc4][$loc2], 2) ^ $this->mult_GF256($state[($loc4 + 1) % 4][$loc2], 3) ^ $state[($loc4 + 2) % 4][$loc2] ^ $state[($loc4 + 3) % 4][$loc2];
                    continue;
                } // end if
                $loc5[$loc4] = $this->mult_GF256($state[$loc4][$loc2], 14) ^ $this->mult_GF256($state[($loc4 + 1) % 4][$loc2], 11) ^ $this->mult_GF256($state[($loc4 + 2) % 4][$loc2], 13) ^ $this->mult_GF256($state[($loc4 + 3) % 4][$loc2], 9);
            } // end of for
            for ($loc4 = 0; $loc4 < 4; ++$loc4) {
                $state[$loc4][$loc2] = $loc5[$loc4];
            }
        }
    }

    function mult_GF256($x, $y) {
        $loc4 = 0;
        $loc2 = 1;
        while ($loc2 < 256) {
            if ($x & $loc2) {
                $loc4 = $loc4 ^ $y;
            } // end if
            $loc2 = $loc2 * 2;
            $y = $this->xtime($y);
        } // end while
        return ($loc4);
    }

    function xtime($poly) {
        $poly = $poly << 1;
        return ($poly & 256 ? ($poly ^ 283) : ($poly));
    }

    public function packBytes($octets) {
        $loc2 = Array();
        $loc2[0] = Array();
        $loc2[1] = Array();
        $loc2[2] = Array();
        $loc2[3] = Array();
        for ($loc1 = 0; $loc1 < count($octets); $loc1 = $loc1 + 4) {
            $loc2[0][$loc1 / 4] = $octets[$loc1];
            $loc2[1][$loc1 / 4] = $octets[$loc1 + 1];
            $loc2[2][$loc1 / 4] = $octets[$loc1 + 2];
            $loc2[3][$loc1 / 4] = $octets[$loc1 + 3];
        } // end of for
        return $loc2;
    }

    public function addRoundKey(&$state, $roundKey) {
        for ($loc2 = 0; $loc2 < $this->Ki; ++$loc2) {
            $state[0][$loc2] = $state[0][$loc2] ^ $roundKey[$loc2] & 255;
            $state[1][$loc2] = $state[1][$loc2] ^ $roundKey[$loc2] >> 8 & 255;
            $state[2][$loc2] = $state[2][$loc2] ^ $roundKey[$loc2] >> 16 & 255;
            $state[3][$loc2] = $state[3][$loc2] ^ $roundKey[$loc2] >> 24 & 255;
        } // end of for
    }

    public function shiftRow(&$state, $dir) {
        for ($loc2 = 1; $loc2 < 4; ++$loc2) {
            if ($dir == "encrypt") {
                $state[$loc2] = $this->cyclicShiftLeft($state[$loc2], $this->sof[$this->Ki][$loc2]);
                continue;
            } // end if
            $state[$loc2] = $this->cyclicShiftLeft($state[$loc2], $this->Ki - $this->sof[$this->Ki][$loc2]);
        } // end of for
    }

    function cyclicShiftLeft($src, $pos) {
        $loc2 = array_slice($src, 0, $pos);
        $src = array_merge(array_slice($src, $pos), $loc2);
        return ($src);
    }

    function byteSub(&$state, $dir) {
        $loc5 = $this->QreInverse;
        for ($loc3 = 0; $loc3 < 4; ++$loc3) {
            for ($loc2 = 0; $loc2 < $this->Ki; ++$loc2) {
                $state[$loc3][$loc2] = $loc5[$state[$loc3][$loc2]];
            } // end of for
        } // end of for
    }

    public function keyExpansion($key) {
        $loc2 = 0;
        $this->Yv = $this->szj / 32;
        $this->Ki = $this->blz / 32;
        $loc4 = array();
        $this->Mf = $this->rda[$this->Yv][$this->Ki];
        for ($loc3 = 0; $loc3 < $this->Yv; ++$loc3) {
            $loc4[$loc3] = @$key[4 * $loc3] | @$key[4 * $loc3 + 1] << 8 | @$key[4 * $loc3 + 2] << 16 | @$key[4 * $loc3 + 3] << 24;
        }
        for ($loc3 = $this->Yv; $loc3 < $this->Ki * ($this->Mf + 1); ++$loc3) {
            $loc2 = $loc4[$loc3 - 1];
            if ($loc3 % $this->Yv == 0) {
                $loc2 = ($this->Qre[$loc2 >> 8 & 0xFF] | $this->Qre[$loc2 >> 16 & 255] << 8 | $this->Qre[$loc2 >> 24 & 255] << 16 | $this->Qre[$loc2 & 255] << 24) ^ $this->Dol[floor($loc3 / $this->Yv) - 1];
            } else if ($this->Yv > 6 && $loc3 % $this->Yv == 4) {
                $loc2 = $this->Qre[$loc2 >> 24 & 0xFF] << 24 | $this->Qre[$loc2 >> 16 & 255] << 16 | $this->Qre[$loc2 >> 8 & 255] << 8 | $this->Qre[$loc2 & 255];
            } // end else if
            $loc4[$loc3] = $loc4[$loc3 - $this->Yv] ^ $loc2;
        }
        return $loc4;
    }

    public function strToChars($str) {
        $loc3 = Array();
        for ($loc1 = 0; $loc1 < strlen($str); ++$loc1) {
            $loc3[] = ord($str[$loc1]);
        }
        return $loc3;
    }

    public function HexToChars($hex) {
        $loc = array();
        for ($i = substr($hex, 0, 2) == "0x" ? (2) : (0); $i < strlen($hex); $i = $i + 2) {
            $loc[] = intval(substr($hex, $i, 2), 16);
        }
        return $loc;
    }

}