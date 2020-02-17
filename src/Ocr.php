<?php

namespace fize\provider\ocr;

/**
 * OCR识别
 */
class Ocr
{
    /**
     * 身份证头像面
     */
    const IDCARD_SIDE_FRONT = 'front';

    /**
     * 身份证国徽面
     */
    const IDCARD_SIDE_BACK = 'back';

    /**
     * 银行卡类型：未知
     */
    const BANK_CARD_TYPE_UNKNOWN = 0;

    /**
     * 银行卡类型：借记卡
     */
    const BANK_CARD_TYPE_DEBIT = 1;

    /**
     * 银行卡类型：信用卡
     */
    const BANK_CARD_TYPE_CREDIT = 2;

    /**
     * @var OcrHandler
     */
    private static $handler;

    /**
     * 取得单例
     * @param string $handler 接口名称
     * @param array $config 接口参数
     * @return OcrHandler
     */
    public static function getInstance($handler, array $config = null)
    {
        if (empty(self::$handler)) {
            $class = '\\' . __NAMESPACE__ . '\\handler\\' . $handler;
            self::$handler = new $class($config);
        }
        return self::$handler;
    }
}
