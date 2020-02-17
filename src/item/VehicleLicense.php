<?php


namespace fize\provider\ocr\item;

/**
 * 项：行驶证
 */
class VehicleLicense
{

    /**
     * @var string 品牌型号
     */
    public $brandModel;

    /**
     * @var string 发证日期(Y-m-d)
     */
    public $issueDate;

    /**
     * @var string 使用性质
     */
    public $useNature;

    /**
     * @var string 发动机号码
     */
    public $engineNumber;

    /**
     * @var string 号牌号码
     */
    public $plateNumber;

    /**
     * @var string 所有人
     */
    public $owner;

    /**
     * @var string 地址
     */
    public $address;

    /**
     * @var string 注册日期(Y-m-d)
     */
    public $registerDate;

    /**
     * @var string 车辆识别代号
     */
    public $vin;

    /**
     * @var string 车辆类型
     */
    public $carType;
}
