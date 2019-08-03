<?php
declare(strict_types=1);

namespace App\Models;


class Generate
{
    private const TYPE_INT = '1';
    private const TYPE_STR = '2';
    private const TYPE_MIX = '3';
    private const TYPE_GUID = '4';

    /**
     * @param array $characteristic
     * @return array
     */
    public function generator(array $characteristic): array
    {
        $randomString = $this->selector($characteristic);

        $id = $this->setDb($randomString, $characteristic['type']);

        $randMass = [
            'id' => $id,
            'value' => $randomString,
        ];

        return $randMass;
    }

    /**
     * @param array $characteristic
     * @return string
     */
    private function selector(array $characteristic): string
    {
        switch ($characteristic) {
            case $characteristic['type'] === self::TYPE_INT:
                $characters = '0123456789';
                $randomString = $this->setRandom($characteristic['length'], $characters);
                break;
            case $characteristic['type'] === self::TYPE_STR:
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = $this->setRandom($characteristic['length'], $characters);
                break;
            case $characteristic['type'] === self::TYPE_MIX:
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = $this->setRandom($characteristic['length'], $characters);
                break;
            case $characteristic['type'] === self::TYPE_GUID:
                $randomString = $this->guid($characteristic['length']);
                break;
            default:
                if ($characteristic['type'] !== '') {
                    $characters = $characteristic['type'];
                    $randomString = $this->setRandom($characteristic['length'], $characters);
                } else {
                    $randomString = 'You passed an empty value';
                }
        }
        return $randomString;
    }

    /**
     * @param string $length
     * @param string $characters
     * @return string
     */
    private function setRandom(string $length, string $characters): string
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param string $length
     * @return string
     */
    private function guid(string $length): string
    {
        if ($length > 36) {
            return 'the GUID cannot be greater than 32b';
        } else {
            if (function_exists('com_create_guid')) {
                return trim(com_create_guid(), '{}');
            }
            $guid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
                mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479),
                mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
            $guid = mb_strimwidth($guid, 0, (int)$length);
            return $guid;
        }
    }

    /**
     * @param string $value
     * @param string $type
     * @return bool|string
     */
    private function setDb(string $value, string $type)
    {
        $db = \Db::getConnection();

        $sql = 'INSERT INTO rand(value, type) VALUES (:value, :type)';

        $result = $db->prepare($sql);

        $result->bindParam(':value', $value, \PDO::PARAM_STR);
        $result->bindParam(':type', $type, \PDO::PARAM_STR);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return false;
    }
}