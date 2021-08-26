<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate|null $date_of_birth
 * @property string|null $organization
 * @property string $shortname
 * @property string $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property int|null $gender
 * @property string $email
 * @property string|null $mobile_number
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $country
 * @property int|null $state_id
 * @property int|null $district_id
 * @property string|null $city_name
 * @property string $address
 * @property int $pincode
 * @property string|null $profile_photo
 * @property string|null $website
 * @property int|null $star
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\District $district
 */
class UserProfile extends Entity
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
        'date_of_birth' => true,
        'organization' => true,
        'shortname' => true,
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'gender' => true,
        'email' => true,
        'mobile_number' => true,
        'phone' => true,
        'fax' => true,
        'country' => true,
        'state_id' => true,
        'district_id' => true,
        'city_name' => true,
        'address' => true,
        'pincode' => true,
        'profile_photo' => true,
        'website' => true,
        'star' => true,
        'created' => true,
        'user' => true,
        'state' => true,
        'district' => true
    ];
}
