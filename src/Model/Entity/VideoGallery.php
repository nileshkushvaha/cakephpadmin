<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VideoGallery Entity
 *
 * @property int $id
 * @property int $gallery_category_id
 * @property string $url
 * @property string $filename
 * @property string $filemime
 * @property string $filesize
 * @property int $sort_order
 * @property string $description
 * @property string $cloud_tags
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\GalleryCategory $gallery_category
 */
class VideoGallery extends Entity
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
        'gallery_category_id' => true,
        'url' => true,
        'filename' => true,
        'filemime' => true,
        'filesize' => true,
        'sort_order' => true,
        'description' => true,
        'cloud_tags' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'gallery_category' => true
    ];
}
