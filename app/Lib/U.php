<?
/**
 *  General library. It's usable anywhere.
 */
class U extends Object {
  //public static function isEmpty($needle, $data) {
  //  return (!isset($data[$needle]) || (($data[$needle] !== 0) && empty($data[$needle])));
  //}
  // return: emptyの時return true.  not emptyかexceptionの時return false.
  public static function isEmpty($needle, $data) {
    //return (!is_array($data) || !isset($data[$needle]) || (($data[$needle] !== 0) && empty($data[$needle])));
    return (is_array($data) 
	    && (!array_key_exists($needle, $data) || (($data[$needle] !== 0) && empty($data[$needle]))));
  }
  // return: not emptyの時return true.  emptyかexceptionの時return false.
  public static function notEmpty($needle, $data) {
    // MEMO: Should not be like this -> return !self::isEmpty($needle,$data);
    return (is_array($data) && array_key_exists($needle, $data) && (($data[$needle] === 0) || !empty($data[$needle])));
  }
  // return: emptyかexceptionの時return true.  not emptyの時return false.
  public static function notPrepared($needle, $data) {
    // MEMO: Should not be like this -> return !self::notEmpty($needle, $data);
    return (!is_array($data) || !array_key_exists($needle, $data)
	    || (($data[$needle] !== 0) && ($data[$needle] !== false) && empty($data[$needle])));
  }

  public static function trimSpace($str) {
    if (!is_string($str)) return '';

    // MEMO: pregに渡せる文字列には限界があり、下記パターンの正規表現にたいしては、14155が限界値。
    // 　　　これより長い値を渡すとセグメンテーションフォルトとなってしまう。
    if (strlen($str) > 14155) return $str;
    // MEMO: (?:.|\n)は改行を含む全ての文字列。因に、\rは.に含まれる。
    //    return preg_replace('/^[ 　\r\n]*(.*?)[ 　\r\n]*$/u', '$1', $str);
    return preg_replace('/^[ 　\r\n]*((?:.|\n)*?)[ 　\r\n]*$/u', '$1', $str);
  }

  // UTF-8文字列をUnicodeエスケープする。ただし英数字と記号はエスケープしない。
  public static function unicode_decode($str) {
    return preg_replace_callback("/((?:[^\x09\x0A\x0D\x20-\x7E]{3})+)/", "self::decode_callback", $str);
  }
  public static function decode_callback($matches) {
    $char = mb_convert_encoding($matches[1], "UTF-16", "UTF-8");
    $escaped = "";
    for ($i = 0, $l = strlen($char); $i < $l; $i += 2) {
      $escaped .=  "\u" . sprintf("%02x%02x", ord($char[$i]), ord($char[$i+1]));
    }
    return $escaped;
  }

  // Unicodeエスケープされた文字列をUTF-8文字列に戻す
  public static function unicode_encode($str) {
    return preg_replace_callback("/\\\\u([0-9a-zA-Z]{4})/", "self::encode_callback", $str);
  }
  public static function encode_callback($matches) {
    $char = mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UTF-16");
    return $char;
  }

  // 起算日から日数を指定して日付を算出
  public static function detect_date($initial_date, $days, $backward = false) {
    $aDay = 60 * 60 * 24;
    $difference = $days * $aDay;
    if ($backward) $date = strtotime($initial_date) - $difference;
    else $date = strtotime($initial_date) + $difference;
    return $date;
  }

  // 起算日から終了日までの日数を算出
  public static function detect_days($initial_date, $final_date) {
    $aDay = 60 * 60 * 24;
    $subtract = strtotime($final_date) - strtotime($initial_date);
    if ($subtract < 0) $subtract = $subtract * -1;
    return floor($subtract / $aDay);
  }

  // timeから曜日を出す
  public static function week($time, $type = 'jp') {
    if ($type == 'jp') $week = array('日','月','火','水','木','金','土');
    else $week = array('Sun','Mon','Tue','Wed','Thr','Fri','Sat');
    $w = date('w', $time);
    return $week[$w];
  }

  public static function nextMonth($month) {
    if (!is_numeric($month)) return false;
    return ($month == 12) ? 1 : ($month + 1);
  }
  public static function lastMonth($month) {
    if (!is_numeric($month)) return false;
    return ($month == 1) ? 12 : ($month - 1);
  }

  public static function daysInMonth($month = false, $year = false) {
    $lastDay = self::lastDayInMonth($month, $year);
    $ret = array();
    for($day = 1; $day <= $lastDay; $day++) {
      $ret[] = sprintf('%4d-%02d-%02d', $year, $month, $day);
    }
    return $ret;
  }
  public static function day1($month = false, $year = false) {
    if (!$year) $year = date('Y', time());
    if (!$month) $month = date('m', time());
    return sprintf('%4d-%02d-01', $year, $month);
  }
  public static function lastDayInMonth($month = false, $year = false) {
    if (!$year) $year = date('Y', time());
    if (!$month) $month = date('m', time());
    return date("t", mktime(0, 0, 0, $month, 1, $year));
  }

  const MOMENT_YEAR     = 'year';
  const MOMENT_MONTH    = 'month';
  const MOMENT_DATE     = 'day';
  const MOMENT_HOUR     = 'hour';
  const MOMENT_MIN      = 'min';
  const MOMENT_SEC      = 'sec';
  public static function nextMoment($datetime, $moment) {
    if ($moment === self::MOMENT_YEAR) {
      $str = date('Y-01-01', strtotime($datetime)) . ' +1 year';
    } elseif ($moment === self::MOMENT_MONTH) {
      $str = date('Y-m', strtotime($datetime)) . ' +1 month';
    } elseif ($moment === self::MOMENT_DATE) {
      $str = date('Y-m-d', strtotime($datetime)) . ' +1 day';
    } elseif ($moment === self::MOMENT_HOUR) {
      $str = date('Y-m-d H:00:00', strtotime($datetime)) . ' +1 hour';
    } elseif ($moment === self::MOMENT_MIN) {
      $str = date('Y-m-d H:i:00', strtotime($datetime)) . ' +1 minute';
    } elseif ($moment === self::MOMENT_SEC) {
      $str = date('Y-m-d H:i:s', strtotime($datetime)) . ' +1 second';
    } else {
      return false;
    }
    return date('Y-m-d H:i:s', strtotime($str));
  }

  // yyyymmddHHiiss 形式の入力をyyyy-mm-dd HH:ii:ss 形式にし、またその精度が年月日時分秒どこまでなのかを返す。
  public static function parseInputDate($datetime) {
    $res = array();

    // Year
    $year = substr($datetime, 0, 4);
    if (($year === FALSE) || !is_numeric($year)) return FALSE;
    $res['accuracy'] = self::MOMENT_YEAR;

    // Month
    $month = substr($datetime, 4, 2);
    if ($month !== FALSE) $res['accuracy'] = self::MOMENT_MONTH;
    else $month = '01';

    // Day
    $day = substr($datetime, 6, 2);
    if ($day !== FALSE) $res['accuracy'] = self::MOMENT_DATE;
    else $day = '01';

    // 日付チェック
    if (!checkdate($month, $day, $year)) return FALSE;

    $res['date'] = $year . '-' . $month . '-' . $day;

    // Hour
    $hour = substr($datetime, 8, 2);
    if ($hour === FALSE) return $res;

    $res['accuracy'] = self::MOMENT_HOUR;

    // Minute
    $minute = substr($datetime, 10, 2);
    if ($minute !== FALSE) $res['accuracy'] = self::MOMENT_MIN;
    else $minute = '01';

    $second = substr($datetime, 12, 2);
    if ($second !== FALSE) $res['accuracy'] = self::MOMENT_SEC;
    else $second = '01';

    $res['date'] .= ' ' . $hour . ':' . $minute . ':' . $second;
    return $res;
  }

  public static function toDate($datetime) {
    if (empty($datetime)) return false;
    return date('Y-m-d', strtotime($datetime));
  }
}