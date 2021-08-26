<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Otp Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $email
 * @property string|null $mobile_number
 * @property int $otp
 * @property int|null $verified
 * @property int|null $repeats
 * @property int|null $wrong_attempt
 * @property \Cake\I18n\FrozenTime $updated
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 */
class Otp extends Entity
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
        'email' => true,
        'mobile_number' => true,
        'otp' => true,
        'verified' => true,
        'repeats' => true,
        'wrong_attempt' => true,
        'updated' => true,
        'created' => true,
        'user' => true
    ];
}
