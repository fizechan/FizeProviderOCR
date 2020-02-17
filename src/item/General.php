<?php


namespace fize\provider\ocr\item;

/**
 * 项：通用文字识别
 */
class General
{

    /**
     * @var string 字符串
     */
    public $words;

    /**
     * @var int 左上顶点的水平坐标
     */
    public $left;

    /**
     * @var int 左上顶点的垂直坐标
     */
    public $top;

    /**
     * @var int 长方形的宽度
     */
    public $width;

    /**
     * @var int 长方形的高度
     */
    public $height;
}
