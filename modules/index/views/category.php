<?php
/**
 * @filesource modules/index/views/category.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Category;

use Kotchasan\Html;
use Kotchasan\Http\Request;

/**
 * module=category.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\View
{
    /**
     * ฟอร์มแก้ไขหมวดหมู่.
     *
     * @param Request $request
     * @param int     $account_id
     * @param int     $typ
     *
     * @return string
     */
    public function render(Request $request, $account_id, $typ)
    {
        $datas = \Index\Category\Model::all($account_id, $typ);
        if (empty($datas)) {
            $list = Html::create('aside', array(
                'class' => 'error',
                'innerHTML' => '{LNG_Sorry, no information available for this item.}',
            ));
        } else {
            $list = Html::create('ol', array(
                'class' => 'editinplace_list',
                'id' => 'category',
            ));
            foreach ($datas as $item) {
                $row = $list->add('li', array(
                    'id' => 'category_'.$item['category_id'],
                ));
                $row->add('span', array(
                    'innerHTML' => '['.$item['category_id'].']',
                    'class' => 'no',
                ));
                $row->add('span', array(
                    'id' => 'category_name_'.$account_id.'_'.$item['category_id'].'_'.$typ,
                    'innerHTML' => $item['topic'],
                    'title' => '{LNG_Click to edit}',
                ));
            }
            $list->script('initEditInplace("category", "index/model/category/submit");');
        }

        return $list->render();
    }
}
