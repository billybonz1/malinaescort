<?php
/**
 * @link http://web-systems.com.ua/
 * @link http://price-r.ru/
 * @copyright Copyright (c) 2013 price-R.ru
 * @license http://opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 */
class ThumbnailHelper extends CFileHelper
{
    private static $_thumbnail_folder;
    private static $_assets_folder;

    private static $_thumbnail_folder_url;
    private static $_assets_folder_url;

    /**
     * @param $src
     * @param array $options
     * @param null|string $no_image
     * @return bool|string
     * @throws Exception
     */
    public static function getThumb($src, $options = [], $no_image = null)
    {
        $options = CMap::mergeArray([
            'width' => false,
            'height' => false,
            'proportional' => true,
            'format' => CImageHandler::IMG_JPEG,
        ], is_array($options) ? $options : []);
        $no_image = is_file($no_image) ? $no_image : Yii::getPathOfAlias('images') . DIRECTORY_SEPARATOR . 'no_image.png';
        if (
            (YII_DEBUG && (!empty($src) && !is_file($src))) ||
            (empty($src) && !is_file($no_image))
        ) {
            return "http://placehold.it/{$options['width']}x{$options['height']}";
        } elseif (empty($src) && is_file($no_image)) {
            $input = $no_image;
        } else {
            $input = is_file($src) ? $src : $no_image;
        }

        //$file_name = md5($input . implode(',', $options)) . '.' . self::getFormatById($options['format']);
        $file_name = basename($input) . implode('_', $options) . '.' . self::getFormatById($options['format']);
        $file_path = self::getThumbnailFolder() . DIRECTORY_SEPARATOR . $file_name;
        $file_url = self::getThumbnailFolderUrl() . '/' . $file_name;
        if (is_file($file_path)) {
            return $file_url;
        }
        try {
            /** @var CImageHandler $ih */
            $ih = Yii::app()->ih->load($input);
            $ih->thumb($options['width'], $options['height'], $options['proportional'])
                ->save($file_path, $options['format']);
        } catch (Exception $e) {
            if (YII_DEBUG) {
                return "http://placehold.it/{$options['width']}x{$options['height']}" . "<!--{$e->getMessage()}-->";
            }
        }
        return $file_url;
    }

    private static function getThumbnailFolder()
    {
        if (empty(self::$_thumbnail_folder)) {
            self::$_thumbnail_folder = self::getAssetsFolder() . DIRECTORY_SEPARATOR . 'thumbnail';
        }
        if (!is_dir(self::$_thumbnail_folder)) {
            parent::createDirectory(self::$_thumbnail_folder);
        }
        return self::$_thumbnail_folder;
    }

    private static function getAssetsFolder()
    {
        if (empty(self::$_assets_folder)) {
            self::$_assets_folder = Yii::app()->assetManager->basePath;
        }
        return self::$_assets_folder;
    }

    private static function getThumbnailFolderUrl()
    {
        if (empty(self::$_thumbnail_folder_url)) {
            self::$_thumbnail_folder_url = self::getAssetsFolderUrl() . '/thumbnail';
        }
        return self::$_thumbnail_folder_url;
    }

    private static function getAssetsFolderUrl()
    {
        if (empty(self::$_assets_folder_url)) {
            self::$_assets_folder_url = Yii::app()->assetManager->baseUrl;
        }
        return self::$_assets_folder_url;
    }

    private static function getFormatById($id = null)
    {
        $output = '';
        switch ($id) {
            case CImageHandler::IMG_GIF;
                $output = 'gif';
                break;
            case CImageHandler::IMG_JPEG:
                $output = 'jpg';
                break;
            default:
                $output = 'png';
        }
        return $output;
    }
}
