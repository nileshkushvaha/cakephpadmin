<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $designation
 * @property string $content
 * @property string|null $profile_photo
 * @property string|null $facebook_url
 * @property string|null $linkedin_url
 * @property string|null $twitter_url
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\User $user
 */
class Team extends Entity
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
        'user_id' => true,
        'name' => true,
        'designation' => true,
        'content' => true,
        'profile_photo' => true,
        'facebook_url' => true,
        'linkedin_url' => true,
        'twitter_url' => true,
        'status' => true,
        'created' => true,
        'updated' => true,
        'user' => true
    ];
}
