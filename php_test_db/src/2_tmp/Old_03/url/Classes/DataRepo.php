<?php


namespace PhpPro\url\Classes;
use Exception;

/**
 * Class DataRepo
 * Класс для записи (чтения) данных в (из) репозиторий(я)
 * @package PhpPro\url\Classes
 */
class DataRepo
{
    public function __construct($path)
    {
        $this->repositPath= $path; //Путь к файлу-хранилищу
    }

    /**
     * Метод сохраняет строку в репозиторий
     * @param $strCode
     * @return bool
     */
    public function saveStringRepo($strCode):bool{
       date_default_timezone_set('Europe/Kyiv');//Устанавливаем часовой пояс
       $date = date('m/d/Y h:i:s a', time()).PHP_EOL;//Получаем текущее время
       $res = true;
       try {
           $fp = fopen ($this->repositPath, "a+");
           fwrite($fp,$date);
           fwrite($fp,$strCode);
           fclose($fp);}
       catch (Exception $e) {
           $res=false;
           echo "*** Помилка запису у файл *** ". PHP_EOL;
       }
       return $res;
   }

    /**
     * Метод читает строку из файла, а при его отсутствии выдает сообщение об ошибке
     * @return string
     */
    public function readCodeRepo(): string
    {

        if (file_exists($this->repositPath))
        {
            $lines = file($this->repositPath); // теперь в $lines массив строк файла
            $section=$lines[count($lines)-2].$lines[count($lines)-1];//Вычитываем последние две строки
        }
        else {
            $this->urlName = '';
            $this->logger->uniError('помилка декодування');

        }
        return $section;
    }
}

