<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChangePasswordLog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|resource $ip_address
 * @property string $password
 * @property \Cake\I18n\FrozenTime $change_time
 *
 * @property \App\Model\Entity\User $user
 */
class ChangePasswordLog extends Entity
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
        'ip_address' => true,
        'password' => true,
        'change_time' => true,
        'user' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
