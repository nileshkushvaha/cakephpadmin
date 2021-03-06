<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GalleryCategory Entity
 *
 * @property int $id
 * @property int|null $article_id
 * @property int $user_id
 * @property string $title
 * @property string|null $content
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Gallery[] $galleries
 */
class GalleryCategory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'article_id' => true,
        'user_id' => true,
        'title' => true,
        'content' => true,
        'status' => true,
        'created' => true,
        'article' => true,
        'user' => true,
        'galleries' => true
    ];
}
