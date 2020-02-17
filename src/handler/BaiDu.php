<?php


namespace fize\provider\ocr\handler;

use RuntimeException;
use AipOcr;
use fize\provider\ocr\OcrHandler;
use fize\provider\ocr\item\General;
use fize\provider\ocr\item\Idcard;
use fize\provider\ocr\item\Bankcard;
use fize\provider\ocr\item\BusinessLicense;
use fize\provider\ocr\item\VehicleLicense;
use fize\provider\ocr\item\DrivingLicense;

/**
 * 百度
 */
class BaiDu implements OcrHandler
{

    /**
     * @var AipOcr 百度OCR
     */
    private $ocr;

    /**
     * 初始化
     * @param array $config 参数配置
     */
    public function __construct(array $config)
    {
        $this->ocr = new AipOcr($config['appId'], $config['apiKey'], $config['secretKey']);
    }

    /**
     * 通用文字识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return General[]
     */
    public function general($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->accurate($image, $options);
        if (isset($res['error_code']) && $res['error_code'] > 0) {
            throw new RuntimeException($res['error_msg'], $res['error_code']);
        }
        $items = [];
        foreach ($res['words_result'] as $result) {
            $item = new General();
            $item->words = $result['words'];
            $item->left = $result['location']['left'];
            $item->top = $result['location']['top'];
            $item->width = $result['location']['width'];
            $item->height = $result['location']['height'];
            $items[] = $item;
        }
        return $items;
    }

    /**
     * 身份证识别
     * @param string $image 图片路径
     * @param string $side 哪一面
     * @param array $options 选项
     * @return Idcard
     */
    public function idcard($image, $side, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->idcard($image, $side, $options);
        if (isset($res['error_code']) && $res['error_code'] > 0) {
            throw new RuntimeException($res['error_msg'], $res['error_code']);
        }

        $idcard = new Idcard();
        if ($side == 'front') {
            $idcard->id = $res['words_result']['公民身份号码']['words'];
            $idcard->name = $res['words_result']['姓名']['words'];
            $idcard->gender = $res['words_result']['性别']['words'];
            $idcard->nation = $res['words_result']['民族']['words'];
            $idcard->birthday = date('Y-m-d', strtotime($res['words_result']['出生']['words']));
            $idcard->address = $res['words_result']['住址']['words'];
        } else {
            $idcard->issue = $res['words_result']["签发机关"]['words'];
            var_dump($res['words_result']);
        }
        return $idcard;
    }

    /**
     * 银行卡识别
     * @param string $image 银行卡照片
     * @param array $options 选项
     * @return Bankcard
     */
    public function bankcard($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->bankcard($image, $options);
        if (isset($res['error_code']) && $res['error_code'] > 0) {
            throw new RuntimeException($res['error_msg'], $res['error_code']);
        }

        $bankcard = new Bankcard();
        $bankcard->number = $res['result']['bank_card_number'];
        $bankcard->validDate = $res['result']['valid_date'];
        $bankcard->type = $res['result']['bank_card_type'];
        $bankcard->bankName = $res['result']['bank_name'];
        return $bankcard;
    }

    /**
     * 营业执照识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return BusinessLicense
     */
    public function businessLicense($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->businessLicense($image, $options);
        if (isset($res['error_code']) && $res['error_code'] > 0) {
            throw new RuntimeException($res['error_msg'], $res['error_code']);
        }

        $item = new BusinessLicense();
        $item->companyName = $res['words_result']['单位名称']['words'];
        $item->type = $res['words_result']['类型']['words'];
        $item->legalPerson = $res['words_result']['法人']['words'];
        $item->address = $res['words_result']['地址']['words'];
        $item->validDate = date('Y-m-d', strtotime($res['words_result']['有效期']['words']));
        $item->number = $res['words_result']['证件编号']['words'];
        $item->uscCode = $res['words_result']['社会信用代码']['words'];
        return $item;
    }

    /**
     * 行驶证识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return VehicleLicense
     */
    public function vehicleLicense($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->vehicleLicense($image, $options);
        if (isset($res['errno']) && $res['errno'] > 0) {
            throw new RuntimeException($res['msg'], $res['errno']);
        }

        $item = new VehicleLicense();
        $result = $res['data']['words_result'];
        $item->brandModel = $result['品牌型号']['words'];
        $item->issueDate = date('Y-m-d', strtotime($result['发证日期']['words']));
        $item->useNature = $result['使用性质']['words'];
        $item->engineNumber = $result['发动机号码']['words'];
        $item->plateNumber = $result['号牌号码']['words'];
        $item->owner = $result['所有人']['words'];
        $item->address = $result['住址']['words'];
        $item->registerDate = date('Y-m-d', strtotime($result['注册日期']['words']));
        $item->vin = $result['车辆识别代号']['words'];
        $item->carType = $result['车辆类型']['words'];
        return $item;
    }

    /**
     * 驾驶证识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return DrivingLicense
     */
    public function drivingLicense($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->drivingLicense($image, $options);
        if (isset($res['errno']) && $res['errno'] > 0) {
            throw new RuntimeException($res['msg'], $res['errno']);
        }

        $item = new DrivingLicense();
        $result = $res['data']['words_result'];
        $item->number = $result['证号']['words'];
        $item->validPeriod = $result['有效期限']['words'];
        $item->ratifyModel = $result['准驾车型']['words'];
        $item->indateBeginDate = date('Y-m-d', strtotime($result['有效起始日期']['words']));
        $item->address = $result['住址']['words'];
        $item->name = $result['姓名']['words'];
        $item->country = $result['国籍']['words'];
        $item->birthday = date('Y-m-d', strtotime($result['出生日期']['words']));
        $item->gender = $result['性别']['words'];
        $item->firstIssueDate = date('Y-m-d', strtotime($result['初次领证日期']['words']));
        return $item;
    }

    /**
     * 车牌识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return string
     */
    public function licencePlate($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->licensePlate($image, $options);
        if (isset($res['errno']) && $res['errno'] > 0) {
            throw new RuntimeException($res['msg'], $res['errno']);
        }
        return $res['data']['words_result']['number'];
    }

    /**
     * VIN码识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return string
     */
    public function vinCode($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->vinCode($image, $options);
        if (isset($res['error_code']) && $res['error_code'] > 0) {
            throw new RuntimeException($res['error_msg'], $res['error_code']);
        }
        return $res['words_result'][0]['words'];
    }

    /**
     * 二维码识别
     * @param string $image 图片路径
     * @param array $options 选项
     * @return string
     */
    public function qrcode($image, array $options = [])
    {
        $image = file_get_contents($image);
        $res = $this->ocr->qrcode($image, $options);
        if (isset($res['error_code']) && $res['error_code'] > 0) {
            throw new RuntimeException($res['error_msg'], $res['error_code']);
        }
        return $res['codes_result'][0]['text'][0];
    }
}
