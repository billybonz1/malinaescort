<?php

class Language
{
	private static $defaultLanguage='ru';
	private static $siteLanguages = array('ru','en','tr');

    static function getActive(){
      $_SESSION['lang'] = 
        $lang=explode('/',$_SERVER['REQUEST_URI'])[1];
         $_SESSION['lang'] = in_array($lang, self::$siteLanguages) ? $lang : self::$defaultLanguage;
        return in_array($lang, self::$siteLanguages) ? $lang : self::$defaultLanguage;
    }


    static function getList(){
		return self::$siteLanguages;
	}

    static function getHtmlList($wrapTag = '', $wrapParams = array()){
        $wrapParams["class"]="jsLangPick";

        foreach(self::getList() as $lang){
            $wrapParams["data-lang"]=$lang;
            echo ($wrapTag ? CHtml::openTag($wrapTag, $wrapParams) : '')
            . L::t($lang)
            . ($wrapTag ? CHtml::closeTag($wrapTag, $wrapParams) : '');
        }
    }
	
	 static function getHreflang()
    {
        $sn=$_SERVER['SERVER_NAME'];
        $path=parse_url($_SERVER['REQUEST_URI'])['path'];
        $links='';
       // $links = "<link rel='alternate' href='http://".(strlen(explode('.',$sn)[0])==2 ? substr($sn,3) : $sn)."' hreflang='x-defaul' /> ";
          foreach(self::getList() as $lang){
            $prefix=$lang!='ru'?$lang.'.':'';
            $link = $prefix.(strlen(explode('.',$sn)[0])==2 ? substr($sn,3) : $sn);
              if($lang=='ua')
              {
                  $lang='uk';
              }
              $links.=" <link rel=\"alternate\" href=\"https://".$link.$path."\" hreflang=\"".$lang."\" /> ";
			 
          }
        return $links;
    }
}