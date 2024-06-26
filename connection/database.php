<?php

class AdminDB
{
    public $url = 'localhost';
    public $username = 'root';
    public $password = '';
    public $dbname = 'admin_db';
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->url;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            // if ($this->conn) {
            //     echo "Connection successful";
            // }
        } catch (PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
    }

    // SELECT * FROM settings WHERE id = 1 ORDER BY id DESC LIMIT 1
    public function dataList($table, $column = '', $where = [], $orderby = 'ORDER BY id ASC', $limit = '')
    {
        $this->conn->query("SET CHARACTER SET 'utf8'");
        $sql = "SELECT * FROM $table";
        if (!empty($column) && !empty($where)) {
            $sql .= ' ' . $column;
            if (!empty($orderby)) {
                $sql .= ' ' . $orderby;
            }
            if (!empty($limit)) {
                $sql .= ' LIMIT ' . $limit;
            }
            $exec = $this->conn->prepare($sql);
            $exec->execute($where);
            $data = [];
            $result = $exec->rowCount();
            if ($result > 0) {
                $data += $exec->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            if (!empty($orderby)) {
                $sql .= ' ' . $orderby;
            }
            if (!empty($limit)) {
                $sql .= ' LIMIT ' . $limit;
            }
            $data = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($data) {
            $datas = [];
            foreach ($data as $value) {
                $datas[] = $value;
            }
            return $datas;
        } else {
            return false;
        }
    }

    public function crudExec($table, $columm = '', $where = [], $limit = '')
    {
        $this->conn->query("SET CHARACTER SET 'utf8'");
        if (!empty($columm) && !empty($where)) {
            $sql = $table . ' ' . $columm;
            if (!empty($limit)) {
                $sql .= ' LIMIT ' . $limit;
            }
            $exec = $this->conn->prepare($sql);
            $result = $exec->execute($where);
        } else {
            $sql = $table . ' ' . $columm;
            if (!empty($limit)) {
                $sql .= ' LIMIT ' . $limit;
            }
            $result = $this->conn->exec($sql);
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function selfLink($title, $options = array())
    {
        $str = mb_convert_encoding((string)$title, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true
        );
        $options = array_merge($defaults, $options);
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z',
            // Arabic
            'ء' => 'e', 'ا' => 'e', 'أ' => 'e', 'إ' => 'i', 'آ' => 'e', 'ؤ' => 'v', 'ئ' => 'ke', 'ب' => 'b', 'ت' => 't', 'ث' => 's', 'ج' => 'c', 'ح' => 'h', 'خ' => 'h', 'د' => 'd', 'ذ' => 'z', 'ر' => 'r', 'ز' => 'z', 'س' => 's', 'ش' => 's', 'ص' => 's', 'ض' => 'd', 'ط' => 'b', 'ظ' => 't', 'ع' => 'a',
            'غ' => 'g', 'ف' => 'f', 'ق' => 'g', 'ك' => 'k', 'ل' => 'l', 'م' => 'm', 'ن' => 'n', 'ه' => 'h', 'و' => 'v', 'ي' => 'y', 'ة' => 't', 'ى' => 'k'
        );
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

    public function insertModule()
    {
        if (!empty($_POST['title'])) {
            $title = $_POST['title'];
            if (!empty($title)) {
                $status = $_POST['status'];
                if (!empty($status)) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $module_table_name = str_replace("-", "", $this->selfLink($title));
                $checkModuleName = $this->dataList('modules', 'WHERE module_table_name = ?', [$module_table_name], ' ORDER BY id ASC', 1);
                if ($checkModuleName) {
                    return false;
                } else {
                    $createTable = $this->crudExec('
                    CREATE TABLE `' . $module_table_name . '` (
                        `id` int(11) NOT NULL,
                        `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                        `self_link` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                        `kategori_id` int(11) DEFAULT NULL,
                        `text` text COLLATE utf8_turkish_ci,
                        `image_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                        `seo_key` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                        `description` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                        `status` int(5) DEFAULT NULL,
                        `sequence_number` int(11) DEFAULT NULL,
                        `date` date DEFAULT NULL
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
                    ');
                    $addModule = $this->crudExec("INSERT INTO modules", "SET title=?,module_table_name=?,status=?,date=?", [$title, $module_table_name, $status, date("Y-m-d")]);
                    $addModule = $this->crudExec("INSERT INTO categories", "SET title=?,self_link=?,module_table_name=?,status=?,date=?", [$title, $module_table_name, 'module', $status, date("Y-m-d")]);
                    if ($addModule) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }
}
