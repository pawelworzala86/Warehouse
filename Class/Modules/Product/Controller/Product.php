<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\ProductModel;
use App\Modules\Other\Model\FileModel;
use App\Image;
use App\Common;
use App\Modules\Product\Model\CatalogModel;

class Product extends Controller
{
    const THUMB_IMAGE_WIDTH = 250;
    const IMAGE_WIDTH = 1000;

    public function __construct(ProductModel $productModel, CatalogModel $catalogModel)
    {
        $this->product = $productModel;
        $this->catalogModel = $catalogModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                if ($this->checkPrivilage('product-edit')) {
                    @$this->product->setParams($_POST['product']);

                    $filesArray = $this->reArrayFiles($_FILES['image']);
                    foreach ($filesArray as $image) {
                        $pathinfo = pathinfo($image['name']);
                        $ext = $pathinfo['extension'];

                        $name = Common::getRandomChars(32) . '.' . $ext;
                        $fileLink = 'Files/Product/' . self::IMAGE_WIDTH . '/' . $name;
                        move_uploaded_file($image['tmp_name'], $fileLink);
                        $file = $this->saveImage($fileLink, $ext, self::IMAGE_WIDTH, $name);
                        $name = Common::getRandomChars(32) . '.' . $ext;
                        $name = 'Files/Product/' . self::THUMB_IMAGE_WIDTH . '/' . $name;
                        copy($file['link'], $name);
                        $thumb = $this->saveImage($name, $ext, self::THUMB_IMAGE_WIDTH);
                        $this->product->addPicture($file['id'], $thumb['id']);
                    };

                    $this->product->save();
                }
            }
        }

        parent::__construct();
    }

    public function saveImage(string $tmpName, string $ext, int $width, string $name = null): array
    {
        Image::resize($tmpName, $tmpName, $width, $ext);
        if ($name===null) {
            $name = Common::getRandomChars(32) . '.' . $ext;
        }
        $fileLink = 'Files/Product/' . $width . '/' . $name;
        copy($tmpName, $fileLink);
        $fileModel = new FileModel;
        $fileModel->setLink($fileLink);
        return [
            'link' => $fileLink,
            'id' => $fileModel->save(),
        ];
    }

    public function reArrayFiles(array &$file_post = null): array
    {
        if (!isset($file_post)) {
            return [];
        }
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    public function __invoke($id = null)
    {
        $this->assign('product', $this->product->getProduct($id));
        $this->assign('tree', $this->catalogModel->getCatalog($id));
        $this->display('Product/Product');
    }

}
