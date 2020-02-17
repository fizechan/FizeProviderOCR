<?php


namespace fize\provider\ocr\item;

/**
 * 项：银行卡
 */
class Bankcard
{

    /**
     * @var string 卡号
     */
    public $number;

    /**
     * @var string 有效期
     */
    public $validDate;

    /**
     * @var int 卡类型
     */
    public $type;

    /**
     * @var string 银行名
     */
    public $bankName;
}
