<?php

namespace Vegitable;
use \InvalidArgumentException;

class Version
{
    public $familyNumber;
    public $updateNumber;

    /**
     * 妥当バージョンであるかを判定する
     *
     * @param  string $name
     * @return string
     */
    public static function isValid($name)
    {
        try{
            if (self::parse($name)){
                return true;
            }else {
                return false;
            }
        }catch(InvalidArgumentException $e){return false;}
    }

    /**
     * 与えられたバージョンからバージョンインスタンスを返す
     *
     * @param  string $name
     * @return string
     */
    public static function parse($name)
    {
        if (preg_match('/^JDK([0-9]+)u([0-9]+)$/',$name, $matches)){
            $familyNumber = $matches[1];
            $updateNumber = $matches[2];
            $obj = new Version();
            $obj->familyNumber = $familyNumber;
            $obj->updateNumber = $updateNumber;
            return $obj;
        }
        throw new InvalidArgumentException('');
    }

    public function lt($target){

        return self::compare($this, $target) < 0;
    }

    public function gt($target){
        return self::compare($this, $target) > 0;;
    }

    /**
    * $obj1が$obj2より大きい場合は1以上
    * $obj1が$obj2と同じ場合は0
    * $obj1が$obj2より小さい場合は-1以下
    */
    private static function compare($obj1, $obj2){
        $fam1 = $obj1->familyNumber;
        $fam2 = $obj2->familyNumber;

        if ($fam1 === $fam2){
            $upd1 = $obj1->updateNumber;
            $upd2 = $obj2->updateNumber;
            return $upd1 - $upd2;
        }
        return $fam1 - $fam2;
    }

    public function nextLimitedUpdate(){
        if ($this->updateNumber){
            while(true){
                $i = $this->updateNumber;

            }
        }
    }
    public function nextCriticalPatchUpdate(){



    }
    public function nextSecurityAlert(){



    }
}
