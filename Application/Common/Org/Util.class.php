<?php

/**
 * 通用函数
 */

namespace Common\Org;

class Util {

	private static $instance;

	/**
	 * 这里必须注释一个return 才会有方法提示
	 * @return Util
	 */
	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * 字符串切割成数组
	 * @param type $str
	 * @return type
	 * @example strSplit('abc') => array('a','b','c')
	 */
	public static function strSplit($str) {
		$count = mb_strlen($str, 'UTF-8');
		$result = array();
		for ($i = 1; $i <= $count; $i++) {
			$result[] = mb_substr($str, $i - 1, 1, 'UTF-8');
		}
		return $result;
	}

	/**
	 * 取首字母
	 * @param type $s0
	 * @return string
	 */
	public static function get_letter($s0) {
		$firstchar_ord = ord(strtoupper($s0{0}));
		if (($firstchar_ord >= 65 and $firstchar_ord <= 91) or ($firstchar_ord >= 48 and $firstchar_ord <= 57))
			return $s0{0};
		$s = iconv("UTF-8", "gb2312", $s0);
		$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
		if ($asc >= -20319 and $asc <= -20284)
			return "A";
		if ($asc >= -20283 and $asc <= -19776)
			return "B";
		if ($asc >= -19775 and $asc <= -19219)
			return "C";
		if ($asc >= -19218 and $asc <= -18711)
			return "D";
		if ($asc >= -18710 and $asc <= -18527)
			return "E";
		if ($asc >= -18526 and $asc <= -18240)
			return "F";
		if ($asc >= -18239 and $asc <= -17923)
			return "G";
		if ($asc >= -17922 and $asc <= -17418)
			return "H";
		if ($asc >= -17417 and $asc <= -16475)
			return "J";
		if ($asc >= -16474 and $asc <= -16213)
			return "K";
		if ($asc >= -16212 and $asc <= -15641)
			return "L";
		if ($asc >= -15640 and $asc <= -15166)
			return "M";
		if ($asc >= -15165 and $asc <= -14923)
			return "N";
		if ($asc >= -14922 and $asc <= -14915)
			return "O";
		if ($asc >= -14914 and $asc <= -14631)
			return "P";
		if ($asc >= -14630 and $asc <= -14150)
			return "Q";
		if ($asc >= -14149 and $asc <= -14091)
			return "R";
		if ($asc >= -14090 and $asc <= -13319)
			return "S";
		if ($asc >= -13318 and $asc <= -12839)
			return "T";
		if ($asc >= -12838 and $asc <= -12557)
			return "W";
		if ($asc >= -12556 and $asc <= -11848)
			return "X";
		if ($asc >= -11847 and $asc <= -11056)
			return "Y";
		if ($asc >= -11055 and $asc <= -10247)
			return "Z";
		return $s;
	}

	/**
	 * 取首字母缩写
	 * @param type $str
	 * @return type
	 */
	public static function getletter($str) {
		$str = self::strSplit($str);
		$res = '';
		foreach ($str as $k) {
			$res .= self::get_letter($k);
		}
		return $res;
	}

	public static function getThumb($pic, $type) {
		if (is_file(ROOT_PATH . UPLOAD_PATH . str_replace('.', '_' . $type . '.', $pic)))
			return UPLOAD_PATH . str_replace('.', '_' . $type . '.', $pic);
		if (is_file(ROOT_PATH . UPLOAD_PATH . $pic))
			return UPLOAD_PATH . $pic;
		return UPLOAD_PATH . 'default_house.jpg';
	}

	/**
	 * 截取字符串
	 * @param type $str
	 * @param type $start
	 * @param type $length
	 * @param type $charset
	 * @param type $suffix
	 * @return type
	 */
	public static function csubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = '...') {
		if (function_exists("mb_substr")) {
			if (mb_strlen($str, $charset) <= $length)
				return $str;
			$slice = mb_substr($str, $start, $length, $charset);
		}else {
			$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
			$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
			preg_match_all($re[$charset], $str, $match);
			if (count($match[0]) <= $length)
				return $str;
			$slice = join("", array_slice($match[0], $start, $length));
		}
		if ($suffix)
			return $slice . $suffix;
		return $slice;
	}

	/**
	 * 替换
	 * @param type $map
	 * @return type
	 */
	public static function maping($map) {
		$mapping = array(
			':' => ',',
			'：' => ',',
			'(' => '',
			'（' => '',
			')' => '',
			'）' => ''
		);
		return str_replace(array_keys($mapping), $mapping, $map);
	}

	public static function htmlquery() {
		$effectParams = array_filter(I('get.'));
		unset($effectParams['PageNo']);
		$htmlquery = http_build_query($effectParams);
		if ($htmlquery)
			return '?' . $htmlquery . '&';
		return '?';
	}

	public static function switch_val_en_all($number) {//传入编码GB2312编码的中文值，返回对应的拼音“全拼”
		$en_full = array(
			array("a", -20319),
			array("ai", -20317),
			array("an", -20304),
			array("ang", -20295),
			array("ao", -20292),
			array("ba", -20283),
			array("bai", -20265),
			array("ban", -20257),
			array("bang", -20242),
			array("bao", -20230),
			array("bei", -20051),
			array("ben", -20036),
			array("beng", -20032),
			array("bi", -20026),
			array("bian", -20002),
			array("biao", -19990),
			array("bie", -19986),
			array("bin", -19982),
			array("bing", -19976),
			array("bo", -19805),
			array("bu", -19784),
			array("ca", -19775),
			array("cai", -19774),
			array("can", -19763),
			array("cang", -19756),
			array("cao", -19751),
			array("ce", -19746),
			array("ceng", -19741),
			array("cha", -19739),
			array("chai", -19728),
			array("chan", -19725),
			array("chang", -19715),
			array("chao", -19540),
			array("che", -19531),
			array("chen", -19525),
			array("cheng", -19515),
			array("chi", -19500),
			array("chong", -19484),
			array("chou", -19479),
			array("chu", -19467),
			array("chuai", -19289),
			array("chuan", -19288),
			array("chuang", -19281),
			array("chui", -19275),
			array("chun", -19270),
			array("chuo", -19263),
			array("ci", -19261),
			array("cong", -19249),
			array("cou", -19243),
			array("cu", -19242),
			array("cuan", -19238),
			array("cui", -19235),
			array("cun", -19227),
			array("cuo", -19224),
			array("da", -19218),
			array("dai", -19212),
			array("dan", -19038),
			array("dang", -19023),
			array("dao", -19018),
			array("de", -19006),
			array("deng", -19003),
			array("di", -18996),
			array("dian", -18977),
			array("diao", -18961),
			array("die", -18952),
			array("ding", -18783),
			array("diu", -18774),
			array("dong", -18773),
			array("dou", -18763),
			array("du", -18756),
			array("duan", -18741),
			array("dui", -18735),
			array("dun", -18731),
			array("duo", -18722),
			array("e", -18710),
			array("en", -18697),
			array("er", -18696),
			array("fa", -18526),
			array("fan", -18518),
			array("fang", -18501),
			array("fei", -18490),
			array("fen", -18478),
			array("feng", -18463),
			array("fo", -18448),
			array("fou", -18447),
			array("fu", -18446),
			array("ga", -18239),
			array("gai", -18237),
			array("gan", -18231),
			array("gang", -18220),
			array("gao", -18211),
			array("ge", -18201),
			array("gei", -18184),
			array("gen", -18183),
			array("geng", -18181),
			array("gong", -18012),
			array("gou", -17997),
			array("gu", -17988),
			array("gua", -17970),
			array("guai", -17964),
			array("guan", -17961),
			array("guang", -17950),
			array("gui", -17947),
			array("gun", -17931),
			array("guo", -17928),
			array("ha", -17922),
			array("hai", -17759),
			array("han", -17752),
			array("hang", -17733),
			array("hao", -17730),
			array("he", -17721),
			array("hei", -17703),
			array("hen", -17701),
			array("heng", -17697),
			array("hong", -17692),
			array("hou", -17683),
			array("hu", -17676),
			array("hua", -17496),
			array("huai", -17487),
			array("huan", -17482),
			array("huang", -17468),
			array("hui", -17454),
			array("hun", -17433),
			array("huo", -17427),
			array("ji", -17417),
			array("jia", -17202),
			array("jian", -17185),
			array("jiang", -16983),
			array("jiao", -16970),
			array("jie", -16942),
			array("jin", -16915),
			array("jing", -16733),
			array("jiong", -16708),
			array("jiu", -16706),
			array("ju", -16689),
			array("juan", -16664),
			array("jue", -16657),
			array("jun", -16647),
			array("ka", -16474),
			array("kai", -16470),
			array("kan", -16465),
			array("kang", -16459),
			array("kao", -16452),
			array("ke", -16448),
			array("ken", -16433),
			array("keng", -16429),
			array("kong", -16427),
			array("kou", -16423),
			array("ku", -16419),
			array("kua", -16412),
			array("kuai", -16407),
			array("kuan", -16403),
			array("kuang", -16401),
			array("kui", -16393),
			array("kun", -16220),
			array("kuo", -16216),
			array("la", -16212),
			array("lai", -16205),
			array("lan", -16202),
			array("lang", -16187),
			array("lao", -16180),
			array("le", -16171),
			array("lei", -16169),
			array("leng", -16158),
			array("li", -16155),
			array("lia", -15959),
			array("lian", -15958),
			array("liang", -15944),
			array("liao", -15933),
			array("lie", -15920),
			array("lin", -15915),
			array("ling", -15903),
			array("liu", -15889),
			array("long", -15878),
			array("lou", -15707),
			array("lu", -15701),
			array("lv", -15681),
			array("luan", -15667),
			array("lue", -15661),
			array("lun", -15659),
			array("luo", -15652),
			array("ma", -15640),
			array("mai", -15631),
			array("man", -15625),
			array("mang", -15454),
			array("mao", -15448),
			array("me", -15436),
			array("mei", -15435),
			array("men", -15419),
			array("meng", -15416),
			array("mi", -15408),
			array("mian", -15394),
			array("miao", -15385),
			array("mie", -15377),
			array("min", -15375),
			array("ming", -15369),
			array("miu", -15363),
			array("mo", -15362),
			array("mou", -15183),
			array("mu", -15180),
			array("na", -15165),
			array("nai", -15158),
			array("nan", -15153),
			array("nang", -15150),
			array("nao", -15149),
			array("ne", -15144),
			array("nei", -15143),
			array("nen", -15141),
			array("neng", -15140),
			array("ni", -15139),
			array("nian", -15128),
			array("niang", -15121),
			array("niao", -15119),
			array("nie", -15117),
			array("nin", -15110),
			array("ning", -15109),
			array("niu", -14941),
			array("nong", -14937),
			array("nu", -14933),
			array("nv", -14930),
			array("nuan", -14929),
			array("nue", -14928),
			array("nuo", -14926),
			array("o", -14922),
			array("ou", -14921),
			array("pa", -14914),
			array("pai", -14908),
			array("pan", -14902),
			array("pang", -14894),
			array("pao", -14889),
			array("pei", -14882),
			array("pen", -14873),
			array("peng", -14871),
			array("pi", -14857),
			array("pian", -14678),
			array("piao", -14674),
			array("pie", -14670),
			array("pin", -14668),
			array("ping", -14663),
			array("po", -14654),
			array("pu", -14645),
			array("qi", -14630),
			array("qia", -14594),
			array("qian", -14429),
			array("qiang", -14407),
			array("qiao", -14399),
			array("qie", -14384),
			array("qin", -14379),
			array("qing", -14368),
			array("qiong", -14355),
			array("qiu", -14353),
			array("qu", -14345),
			array("quan", -14170),
			array("que", -14159),
			array("qun", -14151),
			array("ran", -14149),
			array("rang", -14145),
			array("rao", -14140),
			array("re", -14137),
			array("ren", -14135),
			array("reng", -14125),
			array("ri", -14123),
			array("rong", -14122),
			array("rou", -14112),
			array("ru", -14109),
			array("ruan", -14099),
			array("rui", -14097),
			array("run", -14094),
			array("ruo", -14092),
			array("sa", -14090),
			array("sai", -14087),
			array("san", -14083),
			array("sang", -13917),
			array("sao", -13914),
			array("se", -13910),
			array("sen", -13907),
			array("seng", -13906),
			array("sha", -13905),
			array("shai", -13896),
			array("shan", -13894),
			array("shang", -13878),
			array("shao", -13870),
			array("she", -13859),
			array("shen", -13847),
			array("sheng", -13831),
			array("shi", -13658),
			array("shou", -13611),
			array("shu", -13601),
			array("shua", -13406),
			array("shuai", -13404),
			array("shuan", -13400),
			array("shuang", -13398),
			array("shui", -13395),
			array("shun", -13391),
			array("shuo", -13387),
			array("si", -13383),
			array("song", -13367),
			array("sou", -13359),
			array("su", -13356),
			array("suan", -13343),
			array("sui", -13340),
			array("sun", -13329),
			array("suo", -13326),
			array("ta", -13318),
			array("tai", -13147),
			array("tan", -13138),
			array("tang", -13120),
			array("tao", -13107),
			array("te", -13096),
			array("teng", -13095),
			array("ti", -13091),
			array("tian", -13076),
			array("tiao", -13068),
			array("tie", -13063),
			array("ting", -13060),
			array("tong", -12888),
			array("tou", -12875),
			array("tu", -12871),
			array("tuan", -12860),
			array("tui", -12858),
			array("tun", -12852),
			array("tuo", -12849),
			array("wa", -12838),
			array("wai", -12831),
			array("wan", -12829),
			array("wang", -12812),
			array("wei", -12802),
			array("wen", -12607),
			array("weng", -12597),
			array("wo", -12594),
			array("wu", -12585),
			array("xi", -12556),
			array("xia", -12359),
			array("xian", -12346),
			array("xiang", -12320),
			array("xiao", -12300),
			array("xie", -12120),
			array("xin", -12099),
			array("xing", -12089),
			array("xiong", -12074),
			array("xiu", -12067),
			array("xu", -12058),
			array("xuan", -12039),
			array("xue", -11867),
			array("xun", -11861),
			array("ya", -11847),
			array("yan", -11831),
			array("yang", -11798),
			array("yao", -11781),
			array("ye", -11604),
			array("yi", -11589),
			array("yin", -11536),
			array("ying", -11358),
			array("yo", -11340),
			array("yong", -11339),
			array("you", -11324),
			array("yu", -11303),
			array("yuan", -11097),
			array("yue", -11077),
			array("yun", -11067),
			array("za", -11055),
			array("zai", -11052),
			array("zan", -11045),
			array("zang", -11041),
			array("zao", -11038),
			array("ze", -11024),
			array("zei", -11020),
			array("zen", -11019),
			array("zeng", -11018),
			array("zha", -11014),
			array("zhai", -10838),
			array("zhan", -10832),
			array("zhang", -10815),
			array("zhao", -10800),
			array("zhe", -10790),
			array("zhen", -10780),
			array("zheng", -10764),
			array("zhi", -10587),
			array("zhong", -10544),
			array("zhou", -10533),
			array("zhu", -10519),
			array("zhua", -10331),
			array("zhuai", -10329),
			array("zhuan", -10328),
			array("zhuang", -10322),
			array("zhui", -10315),
			array("zhun", -10309),
			array("zhuo", -10307),
			array("zi", -10296),
			array("zong", -10281),
			array("zou", -10274),
			array("zu", -10270),
			array("zuan", -10262),
			array("zui", -10260),
			array("zun", -10256),
			array("zuo", -10254)
		); //全拼数据集数组
		if ($number > 0 && $number < 160) {
			return chr($number);
		} elseif ($number < -20319 || $number > -10247) {
			return '';
		} else {
			for ($i = count($en_full) - 1; $i >= 0; $i--) {
				if ($en_full[$i][1] <= $number) {
					break;
				}
			}
			return $en_full[$i][0];
		}
	}

	public static function switch_val_en_top($number) {//传入编码GB2312编码的中文值，返回对应的拼音“首字母”
		$en_head = array(
			array(-20319, -20284, 'A'),
			array(-20283, -19776, 'B'),
			array(-19775, -19219, 'C'),
			array(-19218, -18711, 'D'),
			array(-18710, -18527, 'E'),
			array(-18526, -18240, 'F'),
			array(-18239, -17923, 'G'),
			array(-17922, -17416, 'H'),
			array(-17417, -16475, 'J'),
			array(-16474, -16213, 'K'),
			array(-16212, -15641, 'L'),
			array(-15640, -15166, 'M'),
			array(-15165, -14923, 'N'),
			array(-14922, -14915, 'O'),
			array(-14914, -14631, 'P'),
			array(-14630, -14150, 'Q'),
			array(-14149, -14091, 'R'),
			array(-14090, -13319, 'S'),
			array(-13318, -12839, 'T'),
			array(-12838, -12557, 'W'),
			array(-12556, -11848, 'X'),
			array(-11847, -11056, 'Y'),
			array(-11055, -10247, 'Z')
		); //首字母数据集数组
		if ($number > 0 && $number < 160) {
			return chr($number);
		} elseif ($number < -20319 || $number > -10247) {
			return '';
		} else {
			for ($i = count($en_head) - 1; $i >= 0; $i--) {
				if ($en_head[$i][0] < $number && $en_head[$i][1] > $number) {
					break;
				}
			}
			return $en_head[$i][2];
		}
	}

	/**
	 * 中文 to 拼音
	 * @param type $string
	 * @param type $top
	 * @return type
	 */
	public static function zh_to_en($string, $top = false) {//传入需要处理的字符串，后获得对应的字符编码，最后传入到获得拼音的函数
		$return_str = "";
		$string = mb_convert_encoding($string, 'GB2312', 'UTF-8'); //转换编码：utf-8->gbk
		//$string = iconv('UTF-8', 'GB2312', $string); //转换编码：utf-8->GB2312
		for ($i = 0; $i < strlen($string); $i++) {
			$letter = ord(substr($string, $i, 1));
			if ($letter > 160) {
				$tmp = ord(substr($string, ++$i, 1));
				$letter = $letter * 256 + $tmp - 65536;
			}
			if ($top) {
				$return_str .= Util::switch_val_en_top($letter); //获得拼音头字母
			} else {
				$return_str .= Util::switch_val_en_all($letter); //获得中文（汉字全拼）
			}
		}
		return $return_str;
	}

	/**
	 * 生成唯一字符串
	 * @return string
	 */
	public static function guid($hyphen = '') {
		$charid = strtoupper(md5(uniqid(mt_rand(), true)));
		$uuid =
				substr($charid, 0, 8) . $hyphen .
				substr($charid, 8, 4) . $hyphen .
				substr($charid, 12, 4) . $hyphen .
				substr($charid, 16, 4) . $hyphen .
				substr($charid, 20, 12);
		return $uuid;
	}

	/**
	 * discuz 经典php加密解密函数
	 * @param $string： 明文 或 密文
	 * @param $operation：DECODE表示解密,其它表示加密
	 * @param $key： 密匙
	 * @param $expiry：密文有效期
	 */
	public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
		$ckey_length = 4;
		$key = md5($key ? $key : C('AUTHCODE_KEY'));
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
		$cryptkey = $keya . md5($keya . $keyc);
		$key_length = strlen($cryptkey);
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
		$string_length = strlen($string);
		$result = '';
		$box = range(0, 255);
		$rndkey = array();
		for ($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
		for ($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
		for ($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		if ($operation == 'DECODE') {
			if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc . str_replace('=', '', base64_encode($result));
		}
	}

	/**
	 * 验证字符串为空
	 *
	 * @param unknown $str
	 * @param string $isTrim是否去掉左右两边的空格
	 * @return return_type
	 * @author Cloud
	 * @since 2014-05-27
	 * @copyright TCMS
	 */
	public static function isEmpty($str, $isTrim = true) {
		if ($isTrim) {
			$str = trim($str);
		}
		if (empty($str) && ($str != 0 || $str != "0")) {
			return true;
		}
		return false;
	}

	/**
	 * 验证字符串不为空
	 * @param unknown $str要验证的字符串
	 * @param string $isTrim是否去掉左右两边的空格
	 * @return return_type
	 * @author Cloud
	 * @since 2014-05-27
	 * @copyright TCMS
	 */
	public static function notEmpty($str, $isTrim = true) {
		if ($isTrim) {
			$str = trim($str);
		}
		if (empty($str) && ($str != 0 || $str != "0")) {
			return false;
		}
		return true;
	}

	/**
	 * 系统邮件发送函数
	 * @param string $to    接收邮件者邮箱
	 * @param string $name  接收邮件者名称
	 * @param string $subject 邮件主题
	 * @param string $body    邮件内容
	 * @param string $attachment 附件列表 单文件/数组
	 * @example
	 * $file = realpath(APP_ROOT . '/Public/Uploads/logo.png');
	 * \Common\Org\Util::SendMail('@qq.com', 'Gary', 'test', 'content', $file);
	 * @return boolean
	 */
	public static function SendMail($to, $name, $subject = '', $body = '', $attachment = null) {
		$config = C('TCIT_EMAIL_CONFIG');
		$mail = new Mailer(); //PHPMailer对象
		$mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
		$mail->IsSMTP();  // 设定使用SMTP服务
		$mail->SMTPDebug = 0;   // 关闭SMTP调试功能
		// 1 = errors and messages
		// 2 = messages only
		$mail->SMTPAuth = true;   // 启用 SMTP 验证功能
		$mail->SMTPSecure = 'ssl';  // 使用安全协议
		$mail->Host = $config['SMTP_HOST'];  // SMTP 服务器
		$mail->Port = $config['SMTP_PORT'];  // SMTP服务器的端口号
		$mail->Username = $config['SMTP_USER'];  // SMTP服务器用户名
		$mail->Password = $config['SMTP_PASS'];  // SMTP服务器密码
		$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
		$replyEmail = $config['REPLY_EMAIL'] ? $config['REPLY_EMAIL'] : $config['FROM_EMAIL'];
		$replyName = $config['REPLY_NAME'] ? $config['REPLY_NAME'] : $config['FROM_NAME'];
		$mail->AddReplyTo($replyEmail, $replyName);
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$mail->AddAddress($to, $name);
		if (is_array($attachment)) { // 添加附件
			foreach ($attachment as $file) {
				is_file($file) && $mail->AddAttachment($file);
			}
		} else {
			is_file($attachment) && $mail->AddAttachment($attachment);
		}
		return $mail->Send() ? true : $mail->ErrorInfo;
	}

}

?>