<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
use PHPcode\phpcode;

/*二维码
*/
class QRcode extends BaseAdmin(){
	
	}
    /*public function qrcode(){
        $qrCode = new QrCode();//实列化二维码类
 
        $setVersion = $qrCode -> setVersion(20);//0——40
        //设置版本号，QR码符号共有40种规格的矩阵，从21x21（版本1），到177x177（版本40），每一版本符号比前一版本 每边增加4个模块。
 
        $setErrorCorrection = $qrCode -> setErrorCorrection(2);//容错级别,2的容错率:30%
        //容错级别：0：15%，1：7%，2：30%，3：25%
 
        $setModuleSize = $qrCode -> setModuleSize(2);//设置QR码模块大小
 
        $setImageType = $qrCode -> setImageType('png');//设置二维码保存类型
 
        $logo = 'D:\phpStudy\PHPTutorial\WWW\month13\dao\Think5\public\img\1.jpg';//logo图片
        $setLogo = $qrCode -> setLogo($logo);//二维码中间的图片
 
        $setLogoSize = $qrCode -> setLogoSize(120);//设置logo大小
 
        $value = '你好啊'; //二维码内容（可以是url网址，是url网址就会跳转）
        $setText = $qrCode -> setText($value);//设置文字以隐藏QR码。
 
        $setSize = $qrCode -> setSize(512);//二维码生成后的大小
 
        $setPadding = $qrCode -> setPadding(48);//设置二维码的边框宽度，默认16
 
        $setDrawQuietZone = $qrCode -> setDrawQuietZone(true);//设置模块间距
 
        $setDrawBorder = $qrCode -> setDrawBorder(true);//给二维码加边框。。。
        $text = '****';//可以是汉字，但是需要字体
        $setLabel = $qrCode -> setLabel($text);//在生成的图片下面加上文字
 
        $setLabelFontSize = $qrCode -> setLabelFontSize(39);//生成的文字大小、
 
        // $lablePath = 'uploads/qr/qr.TTF';
        // $setLabelFontPath = $qrCode -> setLabelFontPath($lablePath);//设置标签字体
 
        $color_foreground = ['r' => 108, 'g' => 182, 'b' => 229, 'a' => 0];
        $setForegroundColor = $qrCode -> setForegroundColor($color_foreground);//生成的二维码的颜色
 
        $color_background = ['r' => 213, 'g' => 241, 'b' => 251, 'a' => 0];
        $setBackgroundColor = $qrCode -> setBackgroundColor($color_background);//生成的图片背景颜色
 
        $flieName = 'liukelk.jpg';//二维码的名字
        $res = $qrCode -> save($flieName);//生成二维码
 
        $qrCode -> render(ROOT_PATH.'public/er/'.$flieName);//储存二维码图片的地址
 
        return $this->fetch();
    }*/
}
