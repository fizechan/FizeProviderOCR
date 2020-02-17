<?php

namespace fize\provider\ocr;

use fize\provider\ocr\item\General;
use fize\provider\ocr\item\Idcard;
use fize\provider\ocr\item\Bankcard;
use fize\provider\ocr\item\BusinessLicense;
use fize\provider\ocr\item\VehicleLicense;
use fize\provider\ocr\item\DrivingLicense;

/**
 * 接口定义
 */
interface OcrHandler
{

    /**
     * 通用文字识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return General[]
     */
    public function general($image, array $options = []);

    /**
     * 身份证识别
     * @param string $image 图片路径
     * @param string $side 哪一面
     * @param array $options 选项
     * @return Idcard
     */
    public function idcard($image, $side, array $options = []);

    /**
     * 银行卡识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return Bankcard
     */
    public function bankcard($image, array $options = []);

    /**
     * 营业执照识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return BusinessLicense
     */
    public function businessLicense($image, array $options = []);

    /**
     * 行驶证识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return VehicleLicense
     */
    public function vehicleLicense($image, array $options = []);

    /**
     * 驾驶证识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return DrivingLicense
     */
    public function drivingLicense($image, array $options = []);

    /**
     * 车牌识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return string
     */
    public function licencePlate($image, array $options = []);

    /**
     * VIN码识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return string
     */
    public function vinCode($image, array $options = []);

    /**
     * 二维码识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return string
     */
    public function qrcode($image, array $options = []);
}
