<?php


namespace fize\provider\ocr\item;

/**
 * 项：驾驶证
 */
class DrivingLicense
{
    /**
     * @var string 证号
     */
    public $number;

    /**
     * @var string 有效期限
     */
    public $validPeriod;

    /**
     * @var string 准驾车型
     */
    public $ratifyModel;

    /**
     * @var string 有效起始日期(Y-m-d)
     */
    public $indateBeginDate;

    /**
     * @var string 住址
     */
    public $address;

    /**
     * @var string 姓名
     */
    public $name;

    /**
     * @var string 国籍
     */
    public $country;

    /**
     * @var string 出生日期(Y-m-d)
     */
    public $birthday;

    /**
     * @var string 性别
     */
    public $gender;

    /**
     * @var string 初次领证日期(Y-m-d)
     */
    public $firstIssueDate;
}
