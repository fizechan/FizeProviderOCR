<?php


namespace fize\provider\ocr\item;

/**
 * 项：身份证
 */
class Idcard
{
    /**
     * @var string 身份证号码
     */
    public $id;

    /**
     * @var string 姓名
     */
    public $name;

    /**
     * @var string 性别
     */
    public $gender;

    /**
     * @var string 民族
     */
    public $nation;

    /**
     * @var string 出生日期(Y-m-d)
     */
    public $birthday;

    /**
     * @var string 住址
     */
    public $address;

    /**
     * @var string 签发机关
     */
    public $issue;

    /**
     * @var string 有效期开始(Y-m-d)
     */
    public $indateBegin;

    /**
     * @var string 有效期结束(Y-m-d)
     */
    public $indateEnd;
}
