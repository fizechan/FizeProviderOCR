<?php


namespace fize\provider\ocr\item;

/**
 * 项：营业执照
 */
class BusinessLicense
{
    /**
     * @var string 单位名称
     */
    public $companyName;

    /**
     * @var string 类型
     */
    public $type;

    /**
     * @var string 法人
     */
    public $legalPerson;

    /**
     * @var string 地址
     */
    public $address;

    /**
     * @var string 有效期(Y-m-d)
     */
    public $validDate;

    /**
     * @var string 证件编号
     */
    public $number;

    /**
     * @var string 社会信用代码
     */
    public $uscCode;
}
